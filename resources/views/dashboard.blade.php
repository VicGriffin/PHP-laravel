@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <h1>Dashboard</h1>

    <div class="stats">
        <div class="stat">
            <div class="label">Total sales</div>
            <div class="value">{{ number_format($totalSales, 2) }}</div>
        </div>
        <div class="stat">
            <div class="label">Total expenses</div>
            <div class="value">{{ number_format($totalExpenses, 2) }}</div>
        </div>
        <div class="stat">
            <div class="label">Profit</div>
            <div class="value">{{ number_format($profit, 2) }}</div>
        </div>
        <div class="stat">
            <div class="label">Products</div>
            <div class="value">{{ $productCount }}</div>
        </div>
        <div class="stat">
            <div class="label">Total stock quantity</div>
            <div class="value">{{ $totalStock }}</div>
        </div>
        <div class="stat">
            <div class="label">Low stock products</div>
            <div class="value">{{ count($lowStockProducts) }}</div>
        </div>
    </div>

    <div class="card">
        <h2>Low stock products</h2>
        @if (count($lowStockProducts) === 0)
            <p class="muted">No products are low on stock.</p>
        @else
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Quantity</th>
                        <th>Low stock level</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($lowStockProducts as $product)
                        <tr>
                            <td><a href="{{ route('products.show', $product) }}">{{ $product->name }}</a></td>
                            <td>{{ $product->quantity }}</td>
                            <td>{{ $product->low_stock_level }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

    <div class="card">
        <h2>Last 5 sales</h2>
        @if (count($lastSales) === 0)
            <p class="muted">No sales yet.</p>
        @else
            <table>
                <thead>
                    <tr>
                        <th>Sale</th>
                        <th>Date</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($lastSales as $sale)
                        <tr>
                            <td><a href="{{ route('sales.show', $sale) }}">Sale #{{ $sale->id }}</a></td>
                            <td>{{ $sale->created_at }}</td>
                            <td>{{ number_format($sale->total, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
