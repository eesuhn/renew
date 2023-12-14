$(document).ready(function () {
    listenEditProfile();
    listenUpdatePwd();
})

function listenEditProfile() {
    $("#edit-profile-form").on("submit", function (e) {
        e.preventDefault();
        var formData = new FormData(this);

        sendAjax(
            "/renew/update-profile",
            formData,
            function (response) {
                setNotification("Update successful.");
                redirect("/renew/edit-artist-profile");
            },
            function (response) {
                handleErrorText(response.data);
            },
            "AJAX Error: Unable to edit profile."
        );
    })
}

function listenUpdatePwd() {
    $("#update-pwd-form").on("submit", function (e) {
        e.preventDefault();
        var formData = new FormData(this);

        sendAjax(
            "/renew/update-pwd",
            formData,
            function (response) {
                setNotification("Update successful.");
                redirect("/renew/edit-artist-profile");
            },
            function (response) {
                handleErrorText(response.data);
            },
            "AJAX Error: Unable to update password."
        );
    })
}