
let userLogin = document.getElementById("login");
let userRegister = document.getElementById("register");
let colorMove = document.getElementById("btn");

function register(){
    userLogin.style.left ="-400px";
    userRegister.style.left ="50px";
    colorMove.style.left ="110px";
}
function login(){
    userLogin.style.left ="50px";
    userRegister.style.left ="450px";
    colorMove.style.left ="0px";
}
