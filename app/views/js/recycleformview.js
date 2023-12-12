$(document).ready(function() {
    listenRecycle();

    $('#rec-img').on('change', function() {
        var fileName = $(this).val().split('\\').pop();
        $('#rec-img-name').text(fileName || 'No file chosen');
    });
});

function listenRecycle() {
    $("#recycle-form").on("submit", function (e) {
        e.preventDefault();
        var formData = new FormData(this);

        sendAjax(
            "/renew/recycle",
            formData,
            function (response) {
                setNotification('Recycle request sent.');
                redirect('/renew');
            },
            function (response) {
                handleErrorText(response.data);
            },
        );
    })
}