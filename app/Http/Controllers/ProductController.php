<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(): View
    {
        $products = Product::orderBy('name')->get();

        return view('products.index', compact('products'));
    }

    public function create(): View
    {
        return view('products.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'selling_price' => ['required', 'numeric', 'min:0'],
            'quantity' => ['required', 'integer', 'min:0'],
            'low_stock_level' => ['required', 'integer', 'min:0'],
        ]);

        Product::create($validated);

        return redirect()->route('products.index')->with('success', 'Product added.');
    }

    public function show(Product $product): View
    {
        return view('products.show', compact('product'));
    }

    public function edit(Product $product): View
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'selling_price' => ['required', 'numeric', 'min:0'],
            'quantity' => ['required', 'integer', 'min:0'],
            'low_stock_level' => ['required', 'integer', 'min:0'],
        ]);

        $product->update($validated);

        return redirect()->route('products.show', $product)->with('success', 'Product updated.');
    }

    public function destroy(Product $product): RedirectResponse
    {
        if ($product->saleItems()->exists()) {
            return redirect()->route('products.index')->with('error', 'This product has already been sold, so it cannot be deleted.');
        }

        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted.');
    }
}
