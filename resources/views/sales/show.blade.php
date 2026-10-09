@extends('layouts.app')

@section('title', 'Sale #'.$sale->id)

@section('content')
    <h1>Sale #{{ $sale->id }}</h1>

    <div class="card">
        <p><strong>Date:</strong> {{ $sale->created_at }}</p>
        <p><strong>Total:</strong> {{ number_format($sale->total, 2) }}</p>
    </div>

    <div class="card">
        <h2>Items</h2>
        <table>
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sale->items as $item)
                    <tr>
                        <td>{{ $item->product->name }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ number_format($item->price, 2) }}</td>
                        <td>{{ number_format($item->subtotal, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="toolbar">
        <a class="btn btn-secondary" href="{{ route('sales.index') }}">Back to sales</a>
    </div>
@endsection
