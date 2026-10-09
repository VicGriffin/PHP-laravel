@extends('layouts.app')

@section('title', 'New sale')

@section('content')
    <h1>New sale</h1>

    @if ($errors->any())
        <div class="error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <form method="POST" action="{{ route('sales.store') }}">
            @csrf

            @php
                $oldProducts = old('product_id', []);
                $oldQuantities = old('quantity', []);
            @endphp

            <table>
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    @for ($i = 0; $i < 6; $i++)
                        <tr>
                            <td>
                                <select name="product_id[]">
                                    <option value="">Choose a product</option>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}" @selected(($oldProducts[$i] ?? '') == $product->id)>{{ $product->name }} ({{ $product->quantity }} in stock)</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <input type="number" name="quantity[]" min="1" value="{{ $oldQuantities[$i] ?? '' }}">
                            </td>
                        </tr>
                    @endfor
                </tbody>
            </table>

            <p class="muted">Leave unused rows empty.</p>

            <button class="btn" type="submit">Complete sale</button>
            <a class="btn btn-secondary" href="{{ route('sales.index') }}">Cancel</a>
        </form>
    </div>
@endsection
