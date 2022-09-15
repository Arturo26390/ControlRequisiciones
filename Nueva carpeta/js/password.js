var passField = document.querySelector(".form__password-eye");
var btn = document.querySelector(".icon-eye");

// function cambia(){
//     const type = passField.getAttribute("type") === "password" ? "text" : "password";
//     passField.setAttribute("type", type);
// }

// btn.addEventListener("click", cambia());


function revelaPassword(){
    var passField = document.querySelector(".form__password-eye");
    var btn = document.querySelector(".icon-eye");

    console.log("entro");
    if (passField.type === "password") {
        passField.type = "text";
    } else {
        passField.type = "password";
    }
}