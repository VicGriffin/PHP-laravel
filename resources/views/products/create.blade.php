@extends('layouts.app')

@section('title', 'Add product')

@section('content')
    <h1>Add product</h1>

    <div class="card">
        <form method="POST" action="{{ route('products.store') }}">
            @csrf

            <div class="field">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}">
                @error('name')
                    <div class="field-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="field">
                <label for="selling_price">Selling price</label>
                <input type="number" id="selling_price" name="selling_price" step="0.01" min="0" value="{{ old('selling_price') }}">
                @error('selling_price')
                    <div class="field-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="field">
                <label for="quantity">Quantity in stock</label>
                <input type="number" id="quantity" name="quantity" min="0" value="{{ old('quantity', 0) }}">
                @error('quantity')
                    <div class="field-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="field">
                <label for="low_stock_level">Low stock level</label>
                <input type="number" id="low_stock_level" name="low_stock_level" min="0" value="{{ old('low_stock_level', 5) }}">
                @error('low_stock_level')
                    <div class="field-error">{{ $message }}</div>
                @enderror
            </div>

            <button class="btn" type="submit">Save product</button>
            <a class="btn btn-secondary" href="{{ route('products.index') }}">Cancel</a>
        </form>
    </div>
@endsection
