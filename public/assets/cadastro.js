const button = document.querySelector("#eye-password");
const inputPass = document.querySelector("#password");

button.onclick = function () {
    if (inputPass.getAttribute("type") === "password") {
        inputPass.setAttribute("type", "text");
    } else {
        inputPass.setAttribute("type", "password");
    }
};
