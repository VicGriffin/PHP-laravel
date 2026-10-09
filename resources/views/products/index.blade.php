@extends('layouts.app')

@section('title', 'Products')

@section('content')
    <h1>Products</h1>

    <div class="toolbar">
        <a class="btn" href="{{ route('products.create') }}">Add product</a>
    </div>

    <div class="card">
        @if (count($products) === 0)
            <p class="muted">No products yet.</p>
        @else
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Selling price</th>
                        <th>Quantity</th>
                        <th>Low stock level</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td><a href="{{ route('products.show', $product) }}">{{ $product->name }}</a></td>
                            <td>{{ number_format($product->selling_price, 2) }}</td>
                            <td>{{ $product->quantity }}</td>
                            <td>{{ $product->low_stock_level }}</td>
                            <td>
                                @if ($product->quantity <= $product->low_stock_level)
                                    <span class="badge">Low stock</span>
                                @else
                                    In stock
                                @endif
                            </td>
                            <td>
                                <div class="actions">
                                    <a href="{{ route('products.edit', $product) }}">Edit</a>
                                    <form method="POST" action="{{ route('products.destroy', $product) }}" onsubmit="return confirm('Delete this product?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" type="submit">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
