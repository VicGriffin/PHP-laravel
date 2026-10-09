@extends('layouts.app')

@section('title', 'Sales')

@section('content')
    <h1>Sales</h1>

    <div class="toolbar">
        <a class="btn" href="{{ route('sales.create') }}">New sale</a>
    </div>

    <div class="card">
        @if (count($sales) === 0)
            <p class="muted">No sales yet.</p>
        @else
            <table>
                <thead>
                    <tr>
                        <th>Sale</th>
                        <th>Date</th>
                        <th>Items</th>
                        <th>Total</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sales as $sale)
                        <tr>
                            <td>Sale #{{ $sale->id }}</td>
                            <td>{{ $sale->created_at }}</td>
                            <td>{{ $sale->items->count() }}</td>
                            <td>{{ number_format($sale->total, 2) }}</td>
                            <td><a href="{{ route('sales.show', $sale) }}">View</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
