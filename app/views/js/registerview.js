$(document).ready(function () {
    listenRegister();
})

function listenRegister() {
    $("#user-register").on("submit", function (e) {
        e.preventDefault();
        var formData = $(this).serialize();

        sendAjax(
            "/renew/register",
            formData,
            function (response) {
                setNotification("Registration successful.");
                redirect("/renew/login");
            },
            function (response) {
                handleErrorText(response.data);
            },
            "AJAX Error: Unable to register user."
        );
    })
}