document.querySelector('.menu-toggle label').addEventListener('click', function() {
    document.querySelector('.sidebar').classList.toggle('closed');
    document.querySelector('.main-content').classList.toggle('shift-left');
});



setTimeout(function() {
    document.querySelector('.alert').style.display = 'none';
}, 3000);

