//Navbar behavior while scroll
const header = document.querySelector("header");

window.addEventListener("scroll", function(){
    header.classList.toggle("sticky", window.scrollY > 100)
})

//Show Password btn
document.addEventListener("DOMContentLoaded", function() {
    var passwordInput = document.getElementById("password");
    var showPasswordCheckbox = document.getElementById("showPassword");

    showPasswordCheckbox.addEventListener("change", function() {
        if (this.checked) {
            passwordInput.type = "text";
        } else {
            passwordInput.type = "password";
        }
    });
});

//Menu btn
document.addEventListener('DOMContentLoaded', function() {
    const menuIcon = document.querySelector('.menu-icon');
    const navbar = document.querySelector('.navbar');

    menuIcon.addEventListener('click', function(event) {
        navbar.classList.toggle('active');
        event.stopPropagation();
    });

    document.addEventListener('click', function() {
        navbar.classList.remove('active');
    });

    window.addEventListener('scroll', function() {
        navbar.classList.remove('active');
    });
});
