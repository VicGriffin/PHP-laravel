<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class SaleController extends Controller
{
    public function index(): View
    {
        $sales = Sale::orderBy('id', 'desc')->get();

        return view('sales.index', compact('sales'));
    }

    public function create(): View
    {
        $products = Product::orderBy('name')->get();

        return view('sales.create', compact('products'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'product_id' => ['required', 'array'],
            'product_id.*' => ['nullable', 'integer', 'exists:products,id'],
            'quantity' => ['required', 'array'],
            'quantity.*' => ['nullable', 'integer', 'min:1'],
        ], [
            'product_id.required' => 'Please choose at least one product.',
            'product_id.*.integer' => 'One of the chosen products is not valid.',
            'product_id.*.exists' => 'One of the chosen products does not exist.',
            'quantity.*.integer' => 'A quantity must be a whole number.',
            'quantity.*.min' => 'Quantity must be at least 1.',
        ]);

        $productIds = [];
        $quantities = [];

        foreach ($validated['product_id'] as $key => $productId) {
            if ($productId) {
                $productIds[] = $productId;
                $quantities[] = $validated['quantity'][$key] ?? null;
            }
        }

        if (count($productIds) === 0) {
            return back()->withErrors(['product_id' => 'Please choose at least one product.'])->withInput();
        }

        if (in_array(null, $quantities, true)) {
            return back()->withErrors(['quantity' => 'Please enter a quantity for every product you chose.'])->withInput();
        }

        if (count($productIds) !== count(array_unique($productIds))) {
            return back()->withErrors(['product_id' => 'The same product was added twice. Each product can only appear once in a sale.'])->withInput();
        }

        try {
            $sale = DB::transaction(function () use ($productIds, $quantities) {
                $products = [];

                foreach ($productIds as $key => $productId) {
                    $product = Product::query()->lockForUpdate()->whereKey($productId)->first();

                    if ($product === null) {
                        throw new Exception('One of the chosen products does not exist.');
                    }

                    if ($quantities[$key] > $product->quantity) {
                        throw new Exception('Only '.$product->quantity.' of '.$product->name.' left in stock.');
                    }

                    $products[] = $product;
                }

                $total = 0;

                foreach ($products as $key => $product) {
                    $total = $total + ($product->selling_price * $quantities[$key]);
                }

                $sale = Sale::create(['total' => $total]);

                foreach ($products as $key => $product) {
                    $quantity = $quantities[$key];
                    $subtotal = $product->selling_price * $quantity;

                    $sale->items()->create([
                        'product_id' => $product->id,
                        'quantity' => $quantity,
                        'price' => $product->selling_price,
                        'subtotal' => $subtotal,
                    ]);

                    $product->quantity = $product->quantity - $quantity;
                    $product->save();
                }

                return $sale;
            });
        } catch (Exception $exception) {
            return back()->withErrors(['quantity' => $exception->getMessage()])->withInput();
        }

        return redirect()->route('sales.show', $sale)->with('success', 'Sale saved.');
    }

    public function show(Sale $sale): View
    {
        return view('sales.show', compact('sale'));
    }
}
