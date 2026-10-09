@extends('layouts.app')

@section('title', 'Expenses')

@section('content')
    <h1>Expenses</h1>

    <div class="card">
        <h2>Record an expense</h2>

        <form method="POST" action="{{ route('expenses.store') }}">
            @csrf

            <div class="field">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" value="{{ old('title') }}">
                @error('title')
                    <div class="field-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="field">
                <label for="amount">Amount</label>
                <input type="number" id="amount" name="amount" step="0.01" min="0" value="{{ old('amount') }}">
                @error('amount')
                    <div class="field-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="field">
                <label for="date">Date</label>
                <input type="date" id="date" name="date" value="{{ old('date', date('Y-m-d')) }}">
                @error('date')
                    <div class="field-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="field">
                <label for="note">Note</label>
                <textarea id="note" name="note">{{ old('note') }}</textarea>
                @error('note')
                    <div class="field-error">{{ $message }}</div>
                @enderror
            </div>

            <button class="btn" type="submit">Save expense</button>
        </form>
    </div>

    <div class="card">
        <h2>All expenses</h2>

        @if (count($expenses) === 0)
            <p class="muted">No expenses yet.</p>
        @else
            <table>
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Amount</th>
                        <th>Date</th>
                        <th>Note</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($expenses as $expense)
                        <tr>
                            <td>{{ $expense->title }}</td>
                            <td>{{ number_format($expense->amount, 2) }}</td>
                            <td>{{ $expense->date }}</td>
                            <td>{{ $expense->note }}</td>
                            <td>
                                <form method="POST" action="{{ route('expenses.destroy', $expense) }}" onsubmit="return confirm('Delete this expense?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
