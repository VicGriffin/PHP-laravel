<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Business App')</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: #f3f4f6;
            color: #111827;
            font-family: Arial, Helvetica, sans-serif;
        }

        nav {
            display: flex;
            align-items: center;
            gap: 20px;
            background: #111827;
            padding: 14px 24px;
        }

        nav a {
            color: #ffffff;
            text-decoration: none;
            font-size: 15px;
        }

        nav a:hover {
            text-decoration: underline;
        }

        .container {
            max-width: 1000px;
            margin: 24px auto;
            padding: 0 16px;
        }

        h1 {
            font-size: 26px;
            margin: 0 0 16px 0;
        }

        h2 {
            font-size: 18px;
            margin: 0 0 12px 0;
        }

        p {
            font-size: 15px;
        }

        a {
            color: #2563eb;
        }

        .card {
            background: #ffffff;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            padding: 16px;
            margin-bottom: 16px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: #ffffff;
        }

        th,
        td {
            border: 1px solid #d1d5db;
            padding: 8px 10px;
            text-align: left;
            font-size: 14px;
        }

        th {
            background: #f9fafb;
        }

        label {
            display: block;
            margin-bottom: 4px;
            font-size: 14px;
            font-weight: bold;
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 4px;
            border: 1px solid #9ca3af;
            border-radius: 4px;
            font-size: 14px;
            font-family: Arial, Helvetica, sans-serif;
        }

        textarea {
            min-height: 70px;
        }

        .field {
            margin-bottom: 16px;
            max-width: 420px;
        }

        .btn {
            display: inline-block;
            background: #2563eb;
            color: #ffffff;
            border: none;
            border-radius: 4px;
            padding: 9px 16px;
            font-size: 14px;
            cursor: pointer;
            text-decoration: none;
        }

        .btn:hover {
            background: #1d4ed8;
        }

        .btn-danger {
            background: #dc2626;
        }

        .btn-danger:hover {
            background: #b91c1c;
        }

        .btn-secondary {
            background: #6b7280;
        }

        .btn-secondary:hover {
            background: #4b5563;
        }

        .success {
            background: #dcfce7;
            border: 1px solid #16a34a;
            color: #166534;
            border-radius: 4px;
            padding: 10px 12px;
            margin-bottom: 16px;
            font-size: 14px;
        }

        .error {
            background: #fee2e2;
            border: 1px solid #dc2626;
            color: #991b1b;
            border-radius: 4px;
            padding: 10px 12px;
            margin-bottom: 16px;
            font-size: 14px;
        }

        .error ul {
            margin: 0;
            padding-left: 18px;
        }

        .field-error {
            color: #dc2626;
            font-size: 13px;
            margin-bottom: 12px;
        }

        .badge {
            display: inline-block;
            background: #fef3c7;
            border: 1px solid #f59e0b;
            color: #92400e;
            border-radius: 10px;
            padding: 2px 8px;
            font-size: 12px;
        }

        .muted {
            color: #6b7280;
            font-size: 14px;
        }

        .actions {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .stats {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-bottom: 16px;
        }

        .stat {
            background: #ffffff;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            padding: 14px 18px;
            min-width: 170px;
        }

        .stat .label {
            font-size: 13px;
            color: #6b7280;
            margin-bottom: 6px;
        }

        .stat .value {
            font-size: 22px;
            font-weight: bold;
        }

        .toolbar {
            margin-bottom: 16px;
        }
    </style>
</head>
<body>
<nav>
    <a href="{{ route('dashboard') }}">Dashboard</a>
    <a href="{{ route('products.index') }}">Products</a>
    <a href="{{ route('sales.index') }}">Sales</a>
    <a href="{{ route('expenses.index') }}">Expenses</a>
</nav>

<div class="container">
    @if (session('success'))
        <div class="success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="error">{{ session('error') }}</div>
    @endif

    @yield('content')
</div>
</body>
</html>
