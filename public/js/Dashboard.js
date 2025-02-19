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




