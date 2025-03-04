<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>سلة المشتريات</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #333;
            direction: rtl;
            text-align: center;
        }

        .container {
            width: 80%;
            margin: 40px auto;
            background: #000;
            padding: 20px;
            box-shadow: 0 0 15px rgba(255, 255, 255, 0.7);
            border-radius: 10px;
        }

        h1 {
            color: white;
            margin-bottom: 15px;
        }

        .btn {
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

        .checkout-container {
            margin-top: 20px;

        }

        .checkout-btn {
            width: 80%;
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

        .checkout-btn:hover {
            background-color: #e0a800;
        }


        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }

        thead {
            background-color: #333;
            color: white;
        }

        th, td {
            padding: 15px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }


        tbody{
            background-color: rgb(26, 26, 26);
            color: white;
        }

        tbody tr:hover {
            background-color: #4f4f4f;
        }

        .btn-delete {
            padding: 8px 12px;
            border: none;
            cursor: pointer;
            text-decoration: none;
            font-size: 10px;
            border-radius: 5px;
            transition: 0.3s;
            text-align: center;
            background-color: #e74c3c;
            color: white;
        }

        .btn-delete:hover {
            background-color: #a71d2a;
        }

        .total {
            font-size: 1.3rem;
            color: #007bff;
            font-weight: bold;
            margin-top: 15px;
        }

        .alert {
            padding: 10px;
            margin-top: 15px;
            border-radius: 5px;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-info {
            background-color: #d1ecf1;
            color: #0c5460;
            border: 1px solid #bee5eb;
        }
    </style>
</head>
<body>

    <div class="container">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <h1>🛒 سلة الحجوزات</h1>

            <a href="/"><button  class="btn btn-back">x</button></a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-success">{{ session('error') }}</div>
        @endif

        @if(!empty($cart) && count($cart) > 0)
            <table>
                <thead>
                    <tr>
                        <th>الاسم</th>
                        <th>السعر</th>
                        <th>إجراء</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cart as $index => $item)
                        <tr>
                            <td>{{ $item['name'] }}</td>
                            <td><strong style="color: #28a745;">{{ number_format($item['price']) }} جنيه</strong></td>
                            <td>
                                <a href="{{ route('cart.remove', $index) }}" class="btn-delete"> حذف</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <h3 class="total">💰 الإجمالي: {{ number_format($totalPrice) }} جنيه</h3>

            <div class="checkout-container">
                <form action="{{ route('cart.checkout') }}" method="POST">
                    @csrf
                    <button type="submit" class="checkout-btn">🛍️ إتمام الطلب</button>
                </form>
            </div>

        @else
            <div class="alert alert-info">سلة الحجوزات فارغة! 🛒</div>
        @endif
    </div>


</body>
</html>
