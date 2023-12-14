$(document).ready(function () {
    getCartTotal();
    calcTotal();
    listenCartCheckout();
    listenRedeemPoint();
});

/**
 * Set subtotal amount
 * 
 * @param {number} amount 
 */
function setSubtotal(amount = 0) {
    const html = `RM ${amount}`

    $('#sub-total').html(html);
    $('#sub-total-hidden').val(amount);
}

/**
 * Set discount total amount
 * 
 * @param {number} amount 
 */
function setDiscountTotal(amount = 0) {
    const html = `- RM ${amount}`

    $('#discount-total').html(html);
    $('#discount-total-hidden').val(amount);
}

/**
 * Set total amount
 * 
 * @param {number} amount 
 */
function setTotalRm(amount) {
    const html = `RM ${amount}`

    $('#total-rm').html(html);
    $('#total-rm-hidden').val(amount);
}

/**
 * Calculate total amount
 */
function calcTotal() {
    const subTotal = $('#sub-total-hidden').val();
    const discountTotal = $('#discount-total-hidden').val();
    const total = subTotal - discountTotal;

    setTotalRm(total);
}

function listenCartCheckout() {
    $('#cart-checkout-btn').click(function () {
        var discountTotal = $('#discount-total-hidden').val();

        sendAjax(
            '/renew/checkout?disc-total=' + discountTotal,
            null,
            function (response) {
                setNotification('Checkout successful.');
                redirect('/renew/orders');
            },
            function (response) {
                console.log(response.data);
            },
            "AJAX Error: Unable to checkout."
        )
    });
}

function getCartTotal() {
    getData(
        '/renew/get-cart-total',
        function (response) {
            setSubtotal(response.data);
        },
        "AJAX Error: Unable to get cart total."
    )
}

function listenRedeemPoint() {
    $('#redeem-point-btn').click(function () {
        var point = $('#redeem-point').val();
        setDiscountTotal(point);
    });
}