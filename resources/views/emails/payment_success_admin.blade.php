<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Success Notification for Admin</title>
</head>
<body>
    <p>Dear Admin,</p>
    
    <p>A payment was successfully processed by a user. Here are the details:</p>
    
    <p>User Name: {{ $user->name }}</p>
    <p>User Email: {{ $user->email }}</p>
    <p>Transaction ID: {{ $payment->payment_id }}</p>
    <p>Amount: {{ $payment->amount }} {{ $payment->currency }}</p>
    
    <p>Thank you,</p>
</body>
</html>
