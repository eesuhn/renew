$(document).ready(function () {
    listenLogin();
})

function listenLogin() {
    $("#user-login").on("submit", function (e) {
        e.preventDefault();
        var formData = $(this).serialize();

        sendAjax(
            "/renew/login",
            formData,
            function (response) {
                setNotification("Login successful.");
                redirect("/renew/");
            },
            function (response) {
                handleErrorText(response.data);
            },
            "AJAX Error: Unable to login user."
        );
    })
}