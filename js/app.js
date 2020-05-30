// Controls the mobile nav
let hambergur = document.getElementsByClassName('hamburger-wrap')[0];  
let mb_nav = document.getElementById('mobile-nav-container');

hambergur.addEventListener("click", function(){
    mb_nav.classList.toggle("Gone");
})