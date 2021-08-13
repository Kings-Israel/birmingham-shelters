<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BIRMINGHAM SHELTERS #{{ $invoice->id }}</title>
    <style>
        .nav-brand img {
            max-width: 120px;
            position: relative;
            top: 2px;
        }
        @page {
                margin: 100px 25px;
            }

        header {
            position: fixed;
            float: right;
            top: -60px;
            left: 0px;
            right: 0px;
            height: 50px;
        }
        body {
            background: #ffffff;
            color:#4e5c79;
            font-size:16px;
            font-family: 'Muli', sans-serif;
            margin: 0;
            overflow-x: hidden !important;
            font-weight: 400;
        }
        html {
            position: relative;
            min-height: 100%;
            background: #ffffff;
        }
    </style>
</head>
<body>
    <header>
        <a class="nav-brand" href="#">
            <img src="{{ asset('assets/img/logo.png') }}" class="logo" alt="" />
        </a>
    </header>
    <div class="container">
        <hr>
        <h4>Invoice Type: <strong>{{ $invoice->invoice_type }}</strong></h4>
        <h4>Paid By: <strong>{{ $invoice->user->full_name }}</strong></h4>
        <h4>Invoice Description:</h4>
        <p>{{ $invoice->description }}</p>

        <h4>Status: <strong style="color: green">PAID</strong></h4>
        <h4>Transaction ID: <strong>{{ $invoice->payment->transaction_id }}</strong></h4>
    </div>
    <hr>
</body>
</html>
