$(document).ready(function() {
    getAdminOrderLog();
    listenEditOrder();
});

function getAdminOrderLog() {
    getData(
        '/renew/get-admin-orders',
        function (response) {
            setAdminOrdersTable(response.data);
        }, 
        "AJAX Error: Unable to get admin orders data."
    )
}

function setAdminOrdersTable(data) {
    $('#admin-order').DataTable({
        data: data,
        columns: [
            { data: 'order_id' },
            { data: 'user_name' },
            { 
                data: 'time_create', 
                render: function (data, type, row) {
                    return formatdate(data);
                }
            },
            { data: 'total' },
            { data: 'discount' },
            {
                data: 'order_status',
                render: function (data, type, row) {
                    return badgeStatus(data);
                }
            },
            {
                data: {
                    'order_id': 'order_id',
                    'order_status': 'order_status'
                },
                render: function (data, type, row) {
                    return ellipsisAdminOrder(data['order_id'], data['order_status']);
                }
            }
        ],
        order: [
            [2, 'desc']
        ],
        columnDefs: [
            { 
                targets: [6], 
                orderable: false 
            }
        ]
    })
}

function ellipsisAdminOrder(orderId, orderStatus) {
    
    var pending = '';
    var processing = '';
    var completed = '';
    var cancelled = '';

    switch (orderStatus) {
        case 'pending':
            pending = 'selected';
            break;
        case 'processing':
            processing = 'selected';
            break;
        case 'completed':
            completed = 'selected';
            break;
        case 'cancelled':
            cancelled = 'selected';
            break;
    }

    var html = 
        `<div class="dropdown">
            <button class="btn dropdown-btn" type="button" id="ellipsisDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-v"></i>
            </button>
            <div class="dropdown-menu" aria-labelledby="ellipsisDropdown">
                <a class="dropdown-item">
                    <button type="button" class="ellipsis-btn" data-toggle="modal" data-target="#edit-order-modal-${orderId}">Edit</button>
                </a>
            </div>
        </div>
        
        <div class="modal fade" id="edit-order-modal-${orderId}" tabindex="-1" role="dialog" aria-labelledby="edit-order-modal-label" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header edit-order-modal-header">
                        <h5 class="modal-title" id="edit-order-modal-label">Edit Order</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="edit-order-form-${orderId}" method="POST">
                        <div class="modal-body edit-order-input">
                            <div class="form-group">
                                <label for="order-status" class="col-form-label">Status:</label>
                                <select class="form-control" id="order-status" name="order-status">
                                    <option ${pending} value="pending">Pending</option>
                                    <option ${processing} value="processing">Processing</option>
                                    <option ${completed} value="completed">Completed</option>
                                    <option ${cancelled} value="cancelled">Cancelled</option>
                                </select>
                            </div>
                            <div class="form-group edit-order-submit">
                                <button type="submit" data-order-id="${orderId}" data-dismiss="modal" class="btn btn-primary edit-order-btn">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>`;

    return html;
}

function listenEditOrder() {
    $(document).on('click', '.edit-order-btn', function (e) {
        e.preventDefault();
        var orderId = $(this).data('order-id');
        var formData = new FormData($('#edit-order-form-' + orderId)[0]);

        sendAjax(
            '/renew/update-order?order-id=' + orderId,
            formData,
            function (response) {
                setNotification('Order updated');
                redirect('/renew/admin-order');
            },
            function (response) {
                console.log(response);
            },
            "AJAX Error: Unable to edit order."
        );
    });
}