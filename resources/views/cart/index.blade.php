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
        p {
            color: white;
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

        tbody {
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
            font-size: 14px;
            border-radius: 5px;
            transition: 0.3s;
            background-color: #e74c3c;
            color: white;
        }

        .btn-delete:hover {
            background-color: #a71d2a;
        }

        .btn-clear {
            background-color: red;
            padding: 10px 15px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            color: white;
            transition: 0.3s;
            border: none;
        }

        .btn-clear:hover {
            background-color: darkred;
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
            <a href="/"><button class="btn-back">x</button></a>
        </div>

        <div id="cartItems">
            <p>🛒 جاري تحميل السلة...</p>
        </div>

        <h3 class="total">💰 الإجمالي: <span id="totalPrice">0</span> جنيه</h3>

        <div class="checkout-container">
            <button id="clearCartBtn" class="btn-clear">🚮 مسح السلة</button>

            <form id="checkoutForm" action="{{route('order.checkout')}}" method="POST">
                <input type="hidden" name="cart" id="cartInput">
                <button type="submit" class="checkout-btn">✅ إتمام الطلب</button>
            </form>
        </div>
    </div>

    <script>
        function getCart() {
            return JSON.parse(localStorage.getItem("cart")) || [];
        }

        function displayCart() {
            let cart = getCart();
            let cartContainer = document.getElementById("cartItems");
            let totalPriceElement = document.getElementById("totalPrice");
            let totalPrice = 0;

            if (cart.length === 0) {
                cartContainer.innerHTML = "<p>🛒 السلة فارغة</p>";
                totalPriceElement.innerText = "0";
                return;
            }

            let content = "<table><thead><tr><th>الاسم</th><th>السعر</th><th>إجراء</th></tr></thead><tbody>";
            cart.forEach((item, index) => {
                totalPrice += item.price;
                content += `<tr>
                    <td>${item.name}</td>
                    <td><strong style="color: #28a745;">${item.price.toLocaleString()} جنيه</strong></td>
                    <td><button onclick="removeFromCart(${index})" class="btn-delete">❌ حذف</button></td>
                </tr>`;
            });
            content += "</tbody></table>";

            cartContainer.innerHTML = content;
            totalPriceElement.innerText = totalPrice.toLocaleString();
        }

        function removeFromCart(index) {
            let cart = getCart();
            cart.splice(index, 1);
            localStorage.setItem("cart", JSON.stringify(cart));
            displayCart();
        }

        document.getElementById("clearCartBtn").addEventListener("click", function() {
            localStorage.removeItem("cart");
            displayCart();
        });

        displayCart();
    </script>


<script src="{{ asset('js/cart.js')}}"></script>

</body>
</html>
