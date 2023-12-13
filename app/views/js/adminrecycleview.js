$(document).ready(function() {
    getAdminRecLog();
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
                data: 'rec_id',
                render: function (data, type, row) {
                    return ellipsisMenuAdminRec(data);
                }
            },
            { 
                data: 'time_create', 
                visible: false
            }
        ],
        order: [
            [6, 'desc']
        ],
        columnDefs: [
            { 
                targets: [5], 
                orderable: false 
            }
        ]
    })
}

function ellipsisMenuAdminRec(recId) {
    var html = 
        `<div class="dropdown">
            <button class="btn dropdown-btn" type="button" id="ellipsisDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-v"></i>
            </button>
            <div class="dropdown-menu" aria-labelledby="ellipsisDropdown">
                <a class="dropdown-item" href="${recId}">Edit</a>
                <a class="dropdown-item" href="${recId}">Delete</a>
            </div>
        </div>`;

    return html;
}