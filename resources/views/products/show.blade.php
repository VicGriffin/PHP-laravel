@extends('layouts.app')

@section('title', $product->name)

@section('content')
    <h1>{{ $product->name }}</h1>

    <div class="card">
        <p><strong>Selling price:</strong> {{ number_format($product->selling_price, 2) }}</p>
        <p><strong>Quantity in stock:</strong> {{ $product->quantity }}</p>
        <p><strong>Low stock level:</strong> {{ $product->low_stock_level }}</p>
        <p>
            <strong>Status:</strong>
            @if ($product->quantity <= $product->low_stock_level)
                <span class="badge">Low stock</span>
            @else
                In stock
            @endif
        </p>
    </div>

    <div class="toolbar">
        <a class="btn" href="{{ route('products.edit', $product) }}">Edit</a>
        <a class="btn btn-secondary" href="{{ route('products.index') }}">Back to products</a>
    </div>

    <div class="card">
        <form method="POST" action="{{ route('products.destroy', $product) }}" onsubmit="return confirm('Delete this product?');">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger" type="submit">Delete product</button>
        </form>
    </div>
@endsection
