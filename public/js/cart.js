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

    displayCart();
}


function getCart() {
    return JSON.parse(localStorage.getItem('cart')) || [];
}

function clearCart() {
    localStorage.removeItem('cart');
}



document.getElementById("checkoutForm").addEventListener("submit", function(event) {
    let cart = JSON.parse(localStorage.getItem("cart")) || [];
    
    if (cart.length === 0) {
        event.preventDefault(); 
        alert("السلة فارغة! لا يمكن إتمام الطلب.");
        return;
    }

    document.getElementById("cartInput").value = JSON.stringify(cart);

    
    localStorage.removeItem("cart");
});

