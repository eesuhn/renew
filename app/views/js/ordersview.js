$(document).ready(function() {
    getUserOrdersTable();
});

function getUserOrdersTable() {
    getData(
        '/renew/get-all-orders',
        function (response) {
            setUserOrdersTable(response.data);
        }, 
        "AJAX Error: Unable to get user orders."
    )
}

/**
 * Sets the user orders table.
 * 
 * @param {Array} data 
 */
function setUserOrdersTable(data) {
    $('#order-history').DataTable({
        data: data,
        columns: [
            { data: 'order_id' },
            { 
                data: 'time_create', 
                render: function (data, type, row) {
                    return formatdate(data);
                }
            },
            { data: 'total' },
            {
                data: 'order_status',
                render: function (data, type, row) {
                    return badgeStatus(data);
                }
            },
        ],
        order: [
            [1, 'desc']
        ]
    })
}