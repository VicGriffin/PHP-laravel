@extends('layouts.app')

@section('title', 'Edit product')

@section('content')
    <h1>Edit product</h1>

    <div class="card">
        <form method="POST" action="{{ route('products.update', $product) }}">
            @csrf
            @method('PUT')

            <div class="field">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}">
                @error('name')
                    <div class="field-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="field">
                <label for="selling_price">Selling price</label>
                <input type="number" id="selling_price" name="selling_price" step="0.01" min="0" value="{{ old('selling_price', $product->selling_price) }}">
                @error('selling_price')
                    <div class="field-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="field">
                <label for="quantity">Quantity in stock</label>
                <input type="number" id="quantity" name="quantity" min="0" value="{{ old('quantity', $product->quantity) }}">
                @error('quantity')
                    <div class="field-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="field">
                <label for="low_stock_level">Low stock level</label>
                <input type="number" id="low_stock_level" name="low_stock_level" min="0" value="{{ old('low_stock_level', $product->low_stock_level) }}">
                @error('low_stock_level')
                    <div class="field-error">{{ $message }}</div>
                @enderror
            </div>

            <button class="btn" type="submit">Update product</button>
            <a class="btn btn-secondary" href="{{ route('products.show', $product) }}">Cancel</a>
        </form>
    </div>
@endsection
