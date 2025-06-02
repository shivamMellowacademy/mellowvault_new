<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Reminder</title>
    <style>
        /* Base Styles */
        body {
            font-family: 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            line-height: 1.6;
            color: #333333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f5f5f5;
        }
        
        /* Email Container */
        .email-container {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }
        
        /* Header */
        .header {
            text-align: center;
            padding: 25px 20px;
            border-bottom: 1px solid #eeeeee;
            background-color: #f9f9f9;
        }
        
        .logo {
            max-width: 180px;
            height: auto;
        }
        
        /* Content */
        .content {
            padding: 25px;
        }
        
        /* Payment Details */
        .payment-details {
            background-color: #f8f9fa;
            padding: 16px;
            border-radius: 6px;
            margin: 20px 0;
            border-left: 4px solid #d9534f;
        }
        
        .detail-row {
            display: flex;
            margin-bottom: 8px;
        }
        
        .detail-label {
            font-weight: 600;
            min-width: 120px;
        }
        
        /* Button */
        .payment-button {
            display: inline-block;
            background-color: #00264d;
            color: #ffffff !important;
            padding: 12px 30px;
            text-decoration: none;
            border-radius: 4px;
            font-weight: 600;
            margin: 20px 0;
            text-align: center;
            transition: background-color 0.3s;
        }
        
        .payment-button:hover {
            background-color: #00264d;
        }
        
        /* Footer */
        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #eeeeee;
            font-size: 13px;
            color: #6c757d;
            text-align: center;
        }

        .ii a[href] {
            color: #ffffff !important;
        }
        
        /* Responsive */
        @media only screen and (max-width: 480px) {
            .content {
                padding: 15px;
            }
            
            .payment-button {
                display: block;
                width: 100%;
                box-sizing: border-box;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <img src="{{ asset('images/logo.png') }}" alt="Company Logo" class="logo">
        </div>
        
        <div class="content">
            <p>Dear {{ $employee->name ?? '' }},</p>
            
            <p>We would like to remind you that your <strong style="color: #d9534f;">advance salary payment is overdue</strong>. Kindly make the payment at your earliest convenience to avoid any late fees or service interruptions.</p>
            
            <div class="payment-details">
                <div class="detail-row">
                    <span class="detail-label">Payment Due:</span>
                    <span>{{ now()->format('F j, Y') }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Paid Amount:</span>
                    <span class="payment-difference">
                        Paid: {{ number_format($employee->payment_amount ?? 0, 2) }} {{ config('app.currency', 'IND') }}
                    </span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Total Amount:</span>
                    <span class="payment-difference">
                        {{ number_format($employee->perhr ?? 0, 2) }} {{ config('app.currency', 'IND') }}
                    </span>
                </div>
                 <div class="detail-row">
                    <span class="detail-label">Due Amount:</span>
                    <span class="payment-difference">
                        {{ number_format($employee->perhr - $employee->payment_amount ?? 0, 2) }} {{ config('app.currency', 'IND') }}
                    </span>
                </div>
                 <div class="detail-row">
                    <span class="detail-label">Tax:</span>
                    <span class="payment-difference">
                        {{ number_format( (($employee->perhr - $employee->payment_amount) * $tax )/ 100 ?? 0, 2) }} {{ config('app.currency', 'IND') }}
                    </span>
                </div>
            </div>
            
            <div style="text-align: center;">
                <a href="{{ $paymentLink }}" class="payment-button">
                    PAY NOW
                </a>
            </div>
            
            <p style="font-size: 14px; color: #6c757d;">
                For your convenience, you can also copy and paste this link into your browser:<br>
                <small style="word-break: break-all;">{{ $paymentLink }}</small>
            </p>
            
            <p>If you've already made this payment, please disregard this notice. For any questions about your account, please contact our support team at <a href="mailto:support@mellowvault.com">support@mellowvault.com</a>.</p>
        </div>
        
        <div class="footer">
            <p>© {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
            <p>
                {{ config('app.company_address') }}<br>
                Phone: {{ config('app.company_phone') }}
            </p>
        </div>
    </div>
</body>
</html>