$(document).ready(function() {
    getUserList();
    listenEditUser();
    listenDelUser();
});

function getUserList() {
    getData(
        '/renew/get-user-list',
        function (response) {
            setUserListTable(response.data);
        }, 
        "AJAX Error: Unable to get admin recycle data."
    )
}

function setUserListTable(data) {
    $('#admin-user-list').DataTable({
        data: data,
        columns: [
            { data: 'user_id' },
            { data: 'user_name' },
            { data: 'email' },
            { 
                data: 'time_create', 
                render: function (data, type, row) {
                    return formatdate(data);
                }
            },
            { 
                data: 'role',
                render: function (data, type, row) {
                    return badgeRole(data);
                }
            },
            {
                data: {
                    'user_id': 'user_id',
                    'role': 'role'
                },
                render: function (data, type, row) {
                    return ellipsisUserList(data['user_id'], data['role']);
                }
            }
        ],
        order: [
            [3, 'desc']
        ],
        columnDefs: [
            { 
                targets: [5], 
                orderable: false 
            }
        ]
    })
}

function ellipsisUserList(userId, userRole) {
    
    var public = '';
    var artist = '';
    var admin = '';
    var cancelled = '';

    switch (userRole) {
        case 'public':
            public = 'selected';
            break;
        case 'artist':
            artist = 'selected';
            break;
        case 'admin':
            admin = 'selected';
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
                    <button type="button" class="ellipsis-btn" data-toggle="modal" data-target="#edit-user-modal-${userId}">Edit</button>
                </a>
                <a class="dropdown-item">
                    <button class="ellipsis-btn" data-toggle="modal" data-target="#delete-user-modal-${userId}">Delete</button>
                </a>
            </div>
        </div>
        
        <div class="modal fade" id="edit-user-modal-${userId}" tabindex="-1" role="dialog" aria-labelledby="edit-user-modal-label" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header edit-user-modal-header">
                        <h5 class="modal-title" id="edit-user-modal-label">Edit User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="edit-user-form-${userId}" method="POST">
                        <div class="modal-body edit-user-input">
                            <div class="form-group">
                                <label for="user-role" class="col-form-label">Status:</label>
                                <select class="form-control" id="user-role" name="user-role">
                                    <option ${public} value="public">Public</option>
                                    <option ${artist} value="artist">Artist</option>
                                    <option ${admin} value="admin">Admin</option>
                                </select>
                            </div>
                            <div class="form-group edit-user-submit">
                                <button type="submit" data-user-id="${userId}" data-dismiss="modal" class="btn btn-primary edit-user-btn">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="modal fade" id="delete-user-modal-${userId}" tabindex="-1" role="dialog" aria-labelledby="edit-user-modal-label" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header edit-user-modal-header">
                        <h5 class="modal-title" id="edit-user-modal-label">Delete Recycle</h5>
                    </div>
                    <form id="delete-user-form-${userId}" method="POST">
                        <div class="modal-body edit-user-input">
                            <div class="form-group edit-user-submit">
                                <button type="submit" data-user-id="${userId}" data-dismiss="modal" class="btn btn-primary delete-user-btn">Confirm</button>
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

function listenEditUser() {
    $(document).on('click', '.edit-user-btn', function (e) {
        e.preventDefault();
        var userId = $(this).data('user-id');
        var formData = new FormData($('#edit-user-form-' + userId)[0]);

        sendAjax(
            '/renew/update-user?user-id=' + userId,
            formData,
            function (response) {
                setNotification('User updated');
                redirect('/renew/admin-user-list');
            },
            function (response) {
                console.log(response);
            },
            "AJAX Error: Unable to update user."
        );
    });
}

function listenDelUser() {
    $(document).on('click', '.delete-user-btn', function (e) {
        e.preventDefault();
        var userId = $(this).data('user-id');

        sendAjax(
            '/renew/delete-user?user-id=' + userId,
            null,
            function (response) {
                setNotification('User deleted');
                redirect('/renew/admin-user-list');
            },
            function (response) {
                console.log(response);
            },
            "AJAX Error: Unable to delete user."
        )
    });
}