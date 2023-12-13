$(document).ready(function() {
    getUserRecPoint();
});

function getUserRecPoint() {
    getData(
        '/renew/get-user-rec-point',
        function (response) {
            setUserRecPointTable(response.data);
        }, 
        "AJAX Error: Unable to get user recycle point."
    )
}

/**
 * Sets the user recycle point table.
 * 
 * @param {Array} data 
 */
function setUserRecPointTable(data) {
    $('#point-history').DataTable({
        data: data,
        columns: [
            { data: 'rec_id' },
            { data: 'rec_name' },
            { 
                data: 'rec_time', 
                render: function (data, type, row) {
                    return formatdate(data);
                }
            },
            { 
                data: 'rec_point',
                render: function (data, type, row) {
                    if (data == 0) {
                        return '<span class="badge badge-completed">In Progress</span>';
                    }
                    return data;
                } 
            },
            { 
                data: 'time_create', 
                visible: false
            }
        ],
        order: [
            [4, 'desc']
        ]
    })
}