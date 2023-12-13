$(document).ready(function() {
    getUserRecLog();
});

function getUserRecLog() {
    getData(
        '/renew/get-user-recycle',
        function (response) {
            setUserRecTable(response.data);
        }, 
        "AJAX Error: Unable to get user recycle log."
    )
}

/**
 * Sets the user recycle log table.
 * 
 * @param {Array} data 
 */
function setUserRecTable(data) {
    $('#recycle-history').DataTable({
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
                data: 'time_create', 
                visible: false
            }
        ],
        order: [
            [5, 'desc']
        ]
    })
}