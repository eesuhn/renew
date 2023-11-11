$(document).ready(function () {
    showNotification();
})

/**
 * Shows a notification if there is one in the session storage
 * 
 * @constant {number} duration
 */
function showNotification() {
    var message = sessionStorage.getItem("notification");
    const duration = 3000;

    if (message) {
        $('#notification-text').text(message).parent().addClass('show');
        setTimeout(() => $('#notification').hide(), duration);
    }
    sessionStorage.removeItem("notification");
}

/**
 * Sets a notification in the session storage
 * 
 * @param {string} message 
 * @param {boolean} now (Optional) Default is not now.
 */
function setNotification(message, now = false) {
    sessionStorage.setItem("notification", message);
    if (now) {
        showNotification();
    }
}