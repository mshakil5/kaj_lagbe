<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Success Notification</title>
</head>
<body>
    <p>Dear {{ $user->name ?? 'Customer' }},</p>

    @if(isset($user->name))
        <p>Name: {{ $user->name }}</p>
    @endif

    <p>Payment was successfully processed.</p>

    <p>Amount: {{ $payment->amount }} {{ $payment->currency }}</p>
    
    <p>Thank you </p>
</body>
</html>
