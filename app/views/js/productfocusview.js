$(document).ready(function () {
    controlCartCount();
    listenProductFocusToCart();
});

/**
 * Update input value on click.
 * 
 * @param {object} btn 
 * @param {string} type 
 */
function updateInputValue(btn, type) {
    const fieldName = btn.attr('data-field');
    const input = $(`input[name='${fieldName}']`);
    const currentVal = parseInt(input.val()) || 0;
    const minValue = parseInt(input.attr('min')) || 0;
    const maxValue = parseInt(input.attr('max')) || Infinity;

    if (type === 'minus' && currentVal > minValue) {
        input.val(currentVal - 1).change();

    } else if (type === 'plus' && currentVal < maxValue) {
        input.val(currentVal + 1).change();
    }

    const isMinReached = parseInt(input.val()) === minValue;
    const isMaxReached = parseInt(input.val()) === maxValue;

    btn.attr('disabled', isMinReached || isMaxReached);
}

/**
 * Control cart count.
 * 
 * @returns {void}
 */
function controlCartCount() {
    $('.btn-number').click(function (e) {
        e.preventDefault();
        updateInputValue($(this), $(this).attr('data-type'));
    });

    $('.input-number').focusin(function () {
        $(this).data('oldValue', $(this).val());
    });

    $('.input-number').change(function () {
        const minValue = parseInt($(this).attr('min')) || 0;
        const maxValue = parseInt($(this).attr('max')) || Infinity;
        const valueCurrent = parseInt($(this).val()) || 0;
        const name = $(this).attr('name');

        if (valueCurrent < minValue || valueCurrent > maxValue) {
            alert(valueCurrent < minValue ? 'Sorry, the minimum value was reached' : 'Sorry, the maximum value was reached');
            $(this).val($(this).data('oldValue'));
        }

        $(".btn-number[data-type='minus'][data-field='" + name + "']").attr('disabled', valueCurrent <= minValue);
        $(".btn-number[data-type='plus'][data-field='" + name + "']").attr('disabled', valueCurrent >= maxValue);
    });

    $(".input-number").keydown(function (e) {
        const allowedKeys = [46, 8, 9, 27, 13, 190, 35, 36, 37, 39, 65];
        if (allowedKeys.includes(e.keyCode) ||
            (e.keyCode === 65 && e.ctrlKey === true) ||
            (e.keyCode >= 48 && e.keyCode <= 57) ||
            (e.keyCode >= 96 && e.keyCode <= 105)) {
            return;
        }
        e.preventDefault();
    });
}

function listenProductFocusToCart() {
    $(document).on('click', '.add-to-cart', function (e) {
        var prodDirName = $(this).data('prod-dir-name');
        var prodCount = $('#prod-count').val();

        sendAjax(
            '/renew/add-to-cart?' + 
            'prod-dir-name=' + prodDirName +
            '&prod-count=' + prodCount,
            null,
            function (response) {
                setNotification('Product added to cart');
                redirect('/renew/cart');
            },
            function (response) {
                console.log(response);
            },
            "AJAX Error: Unable to add product to cart."
        )
    });
}