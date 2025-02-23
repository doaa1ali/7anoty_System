document.querySelector('.menu-toggle label').addEventListener('click', function() {
    document.querySelector('.sidebar').classList.toggle('closed');
    document.querySelector('.main-content').classList.toggle('shift-left');
});



setTimeout(function() {
    document.querySelector('.alert').style.display = 'none';
}, 3000);


document.addEventListener("DOMContentLoaded", function () {
    let links = document.querySelectorAll(".header-nav a");
    let currentPath = window.location.pathname;

    links.forEach(link => {
        if (link.getAttribute("href") === currentPath) {
            link.classList.add("active");
        }

        link.addEventListener("click", function () {
            links.forEach(item => item.classList.remove("active"));
            this.classList.add("active");
        });
    });
});

function toggleServiceForm() {
    var formContainer = document.getElementById("serviceFormContainer");
    formContainer.style.display = (formContainer.style.display === "none" || formContainer.style.display === "") ? "block" : "none";
}



//
function searchInMap() {
    let searchQuery = document.getElementById('mapSearch').value;
    if (searchQuery) {
        let googleSearchUrl = `https://www.google.com/maps/search/?api=1&query=${encodeURIComponent(searchQuery)}`;
        window.open(googleSearchUrl, '_blank'); // فتح البحث في نافذة جديدة
    }
}

function updateMap(lat, long) {
    let mapFrame = document.getElementById('mapFrame');
    let newSrc = `https://www.google.com/maps?q=${lat},${long}&z=15&output=embed`;
    mapFrame.src = newSrc;

    document.getElementById('lat').value = lat;
    document.getElementById('long').value = long;
}

document.getElementById('mapFrame').addEventListener('click', function () {
    let lat = 30.0444 + (Math.random() * 0.01); // محاكاة اختيار موقع
    let long = 31.2357 + (Math.random() * 0.01);
    updateMap(lat, long);
});
