<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $totalSales = (float) Sale::sum('total');
        $totalExpenses = (float) Expense::sum('amount');
        $profit = $totalSales - $totalExpenses;
        $productCount = Product::count();
        $totalStock = (int) Product::sum('quantity');

        $products = Product::orderBy('name')->get();
        $lowStockProducts = [];

        foreach ($products as $product) {
            if ($product->quantity <= $product->low_stock_level) {
                $lowStockProducts[] = $product;
            }
        }

        $lastSales = Sale::orderBy('id', 'desc')->take(5)->get();

        return view('dashboard', compact(
            'totalSales',
            'totalExpenses',
            'profit',
            'productCount',
            'totalStock',
            'lowStockProducts',
            'lastSales',
        ));
    }
}
