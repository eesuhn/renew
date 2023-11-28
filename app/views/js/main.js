/**
 * Send AJAX POST request.
 * 
 * @param {string} url 
 * @param {string} formData 
 * @param {function} sucFunc Success callback function.
 * @param {function} errFunc Error callback function.
 * @param {string} ajaxError (Optional)
 */
function sendAjax(
    url, 
    formData, 
    sucFunc, 
    errFunc, 
    ajaxError = "AJAX Error: Unable to send AJAX request.") {
    
    $.ajax({
        url: url,
        type: "POST",
        data: formData,
        dataType: "json",

        success: function (response) {
            if (response.success && typeof sucFunc == "function") {
                sucFunc(response);
                
            } else if (!response.success && typeof errFunc == "function") {
                errFunc(response);
            }
        },
        error: function (xhr) {
            console.log(xhr.responseText);
            throw new Error(ajaxError);
        }
    })
}

/**
 * Get AJAX segment.
 * 
 * @param {string} url 
 * @param {function} sucFunc 
 * @param {string} ajaxError 
 */
function getSeg(
    url, 
    sucFunc, 
    ajaxError = "AJAX Error: Unable to get segment.") {

    $.ajax({
        url: url,
        type: "GET",
        dataType: "html",

        success: function (response) {
            sucFunc(response);
        },
        error: function (xhr) {
            console.log(xhr.responseText);
            throw new Error(ajaxError);
        }
    })
}

/**
 * Redirect to another page.
 * 
 * @param {string} url 
 * @param {boolean} replace (Optional) Default is href.
 */
function redirect(url, replace = false) {
    replace ? window.location.replace(url) : (window.location.href = url);
}

/**
 * Handle AJAX errors : Text.
 * 
 * @param {object} errors 
 */
function handleErrorText(errors) {
    $(".errorText").text("");

    $.each(errors, function (field, message) {
        $("#" + field + "Error").text(message);
    });
}

/**
 * Initialize modal behavior.
 * Focus on specified input element when modal is shown.
 * Clear input element when modal is hidden.
 * 
 * @param {string} modalId 
 * @param {string} focusId Input element to focus on.
 * @param {function} showFunc (Optional) Function to execute when modal is shown.
 * @param {function} hidFunc (Optional) Function to execute when modal is hidden.
 */
function focusModal(
    modalId, 
    focusId, 
    showFunc = null, 
    hidFunc = null) {
    
    const $modal = $(modalId);
    const focusable = $modal.find('a, button, input, select, textarea, [tabindex]:not([tabindex="-1"])');

    $modal.on('shown.bs.modal', () => {
        $(focusId).focus();

        if (typeof showFunc == "function") {
            showFunc();
        }
    });

    /**
     * When modal is open, pressing tab will cycle through focusable elements.
     */
    $modal.on('keydown', (e) => {
        if (e.key === 'Tab') {
            e.preventDefault();

            const index = focusable.index($(':focus'));
            const nextElement = focusable[index + 1] || focusable[0];

            $(nextElement).focus();
        }
    });

    $modal.on('hidden.bs.modal', () => {
        focusable.val("");

        if (typeof hidFunc == "function") {
            hidFunc();
        }
    });
}