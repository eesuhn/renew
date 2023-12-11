$(document).ready(function() {
    $('#file-input').on('change', function() {
        var fileName = $(this).val().split('\\').pop();
        $('#file-name').text(fileName || 'No file chosen');
    });
});