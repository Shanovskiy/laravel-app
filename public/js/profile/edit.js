let changeButton = document.querySelector("#change-button");

changeButton.addEventListener('click',function () {
    let passwordInput = document.querySelector("#password");

    passwordInput.disabled = !passwordInput.disabled;
})
