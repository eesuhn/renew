$(document).ready(function() {
    getAdminRecLog();
    listenEditRecForm();
});

function getAdminRecLog() {
    getData(
        '/renew/get-admin-recycle',
        function (response) {
            setAdminRecTable(response.data);
        }, 
        "AJAX Error: Unable to get admin recycle data."
    )
}

function setAdminRecTable(data) {
    $('#admin-recycle').DataTable({
        data: data,
        columns: [
            { data: 'user_name' },
            { data: 'rec_name' },
            { 
                data: 'rec_time', 
                render: function (data, type, row) {
                    return formatdate(data);
                }
            },
            { data: 'rec_point' },
            { data: 'center_name' },
            {
                data: 'rec_status',
                render: function (data, type, row) {
                    return badgeStatus(data);
                }
            },
            {
                data: {
                    'rec_id': 'rec_id',
                    'rec_status': 'rec_status',
                    'rec_point': 'rec_point'
                },
                render: function (data, type, row) {
                    return ellipsisMenuAdminRec(data['rec_id'], data['rec_status'], data['rec_point']);
                }
            },
            { 
                data: 'time_create', 
                visible: false
            }
        ],
        order: [
            [7, 'desc']
        ],
        columnDefs: [
            { 
                targets: [6], 
                orderable: false 
            }
        ]
    })
}

function ellipsisMenuAdminRec(recId, recStatus, recPoint) {
    
    var pending = '';
    var processing = '';
    var completed = '';
    var cancelled = '';

    switch (recStatus) {
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
                    <button type="button" class="ellipsis-btn" data-toggle="modal" data-target="#edit-rec-modal-${recId}">Edit</button>
                </a>
                <a class="dropdown-item">
                    <button class="ellipsis-btn" data-toggle="modal" data-target="#delete-rec-modal-${recId}">Delete</button>
                </a>
            </div>
        </div>
        
        <div class="modal fade" id="edit-rec-modal-${recId}" tabindex="-1" role="dialog" aria-labelledby="edit-rec-modal-label" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header edit-rec-modal-header">
                        <h5 class="modal-title" id="edit-rec-modal-label">Edit Recycle</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="edit-rec-form-${recId}" method="POST">
                        <div class="modal-body edit-rec-input">
                            <div class="form-group">
                                <label for="rec-point" class="col-form-label">Point:</label>
                                <input type="number" class="form-control" id="rec-point" name="rec-point" step="1" value="${recPoint}">
                                <span id="prodPriceError" class="errorText"></span>
                            </div>
                            <div class="form-group">
                                <label for="rec-status" class="col-form-label">Status:</label>
                                <select class="form-control" id="rec-status" name="rec-status">
                                    <option ${pending} value="pending">Pending</option>
                                    <option ${processing} value="processing">Processing</option>
                                    <option ${completed} value="completed">Completed</option>
                                    <option ${cancelled} value="cancelled">Cancelled</option>
                                </select>
                            </div>
                            <div class="form-group edit-rec-submit">
                                <button type="submit" data-rec-id="${recId}" data-dismiss="modal" class="btn btn-primary edit-rec-btn">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="modal fade" id="delete-rec-modal-${recId}" tabindex="-1" role="dialog" aria-labelledby="edit-rec-modal-label" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header edit-rec-modal-header">
                        <h5 class="modal-title" id="edit-rec-modal-label">Delete Recycle</h5>
                    </div>
                    <form id="delete-rec-form-${recId}" method="POST">
                        <div class="modal-body edit-rec-input">
                            <div class="form-group edit-rec-submit">
                                <button type="submit" data-rec-id="${recId}" data-dismiss="modal" class="btn btn-primary delete-rec-btn">Confirm</button>
                                <button type="button" class="btn btn-secondary delete-close-btn" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        `;

    return html;
}

function listenEditRecForm() {
    $(document).on('click', '.edit-rec-btn', function (e) {
        e.preventDefault();
        var recId = $(this).data('rec-id');

        var formData = new FormData($('#edit-rec-form-' + recId)[0]);

        sendAjax(
            '/renew/update-recycle?rec-id=' + recId,
            formData,
            function (response) {
                setNotification('Recycle updated');
                redirect('/renew/admin-recycle');
            },
            function (response) {
                console.log(response);
            },
            "AJAX Error: Unable to edit recycle."
        );
    });
}

function listenEditRecForm() {
    $(document).on('click', '.delete-rec-btn', function (e) {
        e.preventDefault();
        var recId = $(this).data('rec-id');

        sendAjax(
            '/renew/delete-recycle?rec-id=' + recId,
            null,
            function (response) {
                setNotification('Recycle deleted');
                redirect('/renew/admin-recycle');
            },
            function (response) {
                console.log(response);
            },
            "AJAX Error: Unable to delete recycle."
        )
    });
}