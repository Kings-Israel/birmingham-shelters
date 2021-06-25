<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BIRMINGHAM SHELTERS#{{ $invoice->id }}</title>
</head>
<body>
    <div class="container">
        BIRMINGHAM SHELTERES
        <hr>
        <h4>Invoice Type: <strong>{{ $invoice->invoice_type }}</strong></h4>
        <h4>Paid By: <strong>{{ $invoice->user->full_name }}</strong></h4>
        <h4>Invoice Description:</h4>
        <p>{{ $invoice->description }}</p>

        <h4>Status: <strong style="color: green">PAID</strong></h4>
        <h4>Transaction ID: <strong>{{ $invoice->payment->transaction_id }}</strong></h4>
    </div>
</body>
</html>