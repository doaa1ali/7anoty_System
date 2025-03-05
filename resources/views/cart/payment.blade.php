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

        h1, p{
            color: white;

        }

        label {
            color: white;
            text-align: right;
            display: block;
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 5px;
            margin-right: 10px;
            
            
            
        }

        input{
            width: 97%;
            padding: 10px;
            margin: 5px ;
            border-radius: 5px;
            border: none;

        } 
        
        
        select {
            width: 100%;
            padding: 10px;
            margin: 5px ;
            border-radius: 5px;
            border: none;
            margin-bottom:10px;
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


        .btn-back {
            background-color: red;
            color: white;
            border: none;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            font-weight: bold;
            cursor: pointer;
            border-radius: 5px;
            transition: background 0.3s ease-in-out;
        }

        .btn-back:hover {
            background-color: #555;
        }
    </style>
</head>
<body>   
    <div class="container">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <h1>💳 صفحة الدفع</h1>
            <a href="/"><button class="btn-back">x</button></a>
        </div>
        <p>يرجى إدخال تفاصيل الدفع لإكمال الطلب</p>

        <form action="{{ route('payment.process') }}" method="POST">
            @csrf
            <label for="name"> الاسم الكامل</label>
            <input type="text" id="name" name="name" required>

            <label for="email"> البريد الإلكتروني</label>
            <input type="email" id="email" name="email" required>

            <label for="phone"> رقم الهاتف</label>
            <input type="text" id="phone" name="phone" required>

            <label for="payment_method"> طريقة الدفع</label>
            <select id="payment_method" name="payment_method">
                <option value="credit_card"> بطاقة ائتمان</option>
                <option value="paypal"> باي بال</option>
                <option value="cash"> الدفع عند الاستلام</option>
            </select>

            <button type="submit" class="btn-pay">✅ إتمام الدفع</button>
        </form>
    </div>
</body>
</html>
