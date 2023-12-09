$(document).ready(function () {
    listenAddProduct();
})

function listenAddProduct() {
    $("#add-prod-form").on("submit", function (e) {
        e.preventDefault();
        var formData = new FormData(this);

        console.log(formData);
    })
}