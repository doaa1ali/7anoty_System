<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>الدفع</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #333;
            direction: rtl;
            text-align: center;
        }
        
        .container {
            width: 50%;
            margin: 40px auto;
            background: #000;
            padding: 20px;
            box-shadow: 0 0 15px rgba(255, 255, 255, 0.7);
            border-radius: 10px;
        }

        h1, p, label {
            color: white;
        }

        input, select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: none;
        }

        .btn-pay {
            width: 100%;
            background-color: #FFD700;
            color: black;
            padding: 10px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s;
            font-weight: bold;
        }

        .btn-pay:hover {
            background-color: #e0a800;
        }
    </style>
</head>
<body>   
    <div class="container">
        <h1>💳 صفحة الدفع</h1>
        <p>يرجى إدخال تفاصيل الدفع لإكمال الطلب</p>

        <form action="{{ route('payment.process') }}" method="POST">
            @csrf
            <label for="name">👤 الاسم الكامل</label>
            <input type="text" id="name" name="name" required>

            <label for="email">📧 البريد الإلكتروني</label>
            <input type="email" id="email" name="email" required>

            <label for="phone">📞 رقم الهاتف</label>
            <input type="text" id="phone" name="phone" required>

            <label for="payment_method">💰 طريقة الدفع</label>
            <select id="payment_method" name="payment_method">
                <option value="credit_card">💳 بطاقة ائتمان</option>
                <option value="paypal">💰 باي بال</option>
                <option value="cash">💵 الدفع عند الاستلام</option>
            </select>

            <button type="submit" class="btn-pay">✅ إتمام الدفع</button>
        </form>
    </div>
</body>
</html>
