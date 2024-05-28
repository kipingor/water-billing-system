<!DOCTYPE html>
<html>
<head>
    <title>Bill</title>
    <style>
        /* Define your CSS styles here */
    </style>
</head>
<body>
    <h1>Water Bill</h1>
    <p>Customer: {{ $customer->first_name }} {{ $customer->last_name }}</p>
    <p>Account Number: {{ $customer->account_number }}</p>
    <p>Billing Period: {{ $bill->billing_period }}</p>
    <p>Due Date: {{ $bill->due_date->format('Y-m-d') }}</p>
    <p>Amount Due: {{ $bill->amount }}</p>
    <!-- Add any additional bill details here -->
</body>
</html>