let changeButton = document.querySelector("#change-button");

changeButton.addEventListener('click',function () {
    let sortPrice = document.querySelector("#sort");

    sortPrice.disabled = !sortPrice.disabled;
})
