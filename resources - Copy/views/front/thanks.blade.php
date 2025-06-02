<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Payment Successful - Thank You</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons (for checkmark icon) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    
    <style>
        body {
            background-color: #f4f6f9;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .thank-you-container {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .thank-you-card {
            background: #ffffff;
            padding: 40px 30px;
            border-radius: 12px;
            box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 500px;
            width: 100%;
        }

        .thank-you-icon {
            font-size: 64px;
            color: #28a745;
            margin-bottom: 20px;
        }

        .thank-you-title {
            font-size: 28px;
            font-weight: 600;
            color: #333;
        }

        .thank-you-message {
            font-size: 18px;
            color: #555;
            margin-top: 10px;
            margin-bottom: 30px;
        }

        .btn-home {
            padding: 10px 25px;
            font-size: 16px;
            border-radius: 50px;
        }
    </style>
</head>
<body>

<div class="thank-you-container">
    <div class="thank-you-card">
        <div class="thank-you-icon">
            <i class="bi bi-check-circle-fill"></i>
        </div>
        <h2 class="thank-you-title">Payment Successful!</h2>
        <p class="thank-you-message">Thank you for your purchase. Your subscription has been activated successfully.</p>
        <p class="text-muted">We’ve sent a confirmation to your email with the payment details.</p>
        <a href="{{ url('/') }}" class="btn btn-primary btn-home">Back to Homepage</a>
    </div>
</div>

<!-- Bootstrap JS (Optional if you're using dropdowns/modal etc) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
