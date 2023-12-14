$(document).ready(function () {
    listenEditProfile();
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
                redirect("/renew/edit-profile");
            },
            function (response) {
                handleErrorText(response.data);
            },
            "AJAX Error: Unable to edit profile."
        );
    })
}