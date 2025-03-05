function addToCart(item) {

    let isLoggedIn = document.querySelector('meta[name="user-logged-in"]').getAttribute("content") === "true";

    if (!isLoggedIn) {
        alert("يجب عليك تسجيل الدخول قبل إضافة عناصر إلى السلة!");
        window.location.href = "auth/login";
        return;
    }

    let cart = JSON.parse(localStorage.getItem("cart")) || [];
    let existingItem = cart.find(cartItem => cartItem.id === item.id);
    if (existingItem) {
        alert("هذا العنصر موجود بالفعل في السلة!");
        return;
    }

    cart.push(item);
    localStorage.setItem("cart", JSON.stringify(cart));

    alert(item.name + " تمت إضافته إلى السلة!");
}



function getCart() {
    return JSON.parse(localStorage.getItem('cart')) || [];
}

function clearCart() {
    localStorage.removeItem('cart');
}



document.getElementById("checkoutForm").addEventListener("submit", function (event) {
    let cart = getCart();

    if (cart.length === 0) {
        alert("❌ السلة فارغة!");
        event.preventDefault();
        return;
    }

    document.getElementById("cartInput").value = JSON.stringify(cart);
});

fetch('/api/auth/login', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ email: 'user@example.com', password: 'password123' })
})
.then(response => response.json())
.then(data => {
    if (data.token) {
        localStorage.setItem('authToken', data.token);
    } else {
        alert('خطأ في تسجيل الدخول!');
    }
});
const token = localStorage.getItem('authToken');

fetch('/api/order/store', {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json',
        'Authorization': `Bearer ${token}`
    },
    body: JSON.stringify({
        cart: [
            { id: 1, type: 'hall', price: 200 },
            { id: 2, type: 'service', price: 100 }
        ]
    })
})
.then(response => response.json())
.then(data => {
    if (data.status === 'success') {
        alert(data.message);
    } else {
        alert('خطأ: ' + data.message);
    }
})
.catch(error => console.error('Error:', error));
