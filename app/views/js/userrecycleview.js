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
                    var date = new Date(data);
                    var options = { 
                        year: 'numeric', 
                        month: 'short', 
                        day: 'numeric', 
                        hour: 'numeric', 
                        minute: 'numeric', 
                        hour12: true 
                    };
                    
                    var html = `<span>${date.toLocaleDateString("en-US", options)}</span>`;
                    return html;
                }
            },
            { data: 'rec_point' },
            { data: 'center_name' },
            {
                data: 'rec_status',
                render: function (data, type, row) {
                    if (data === "Cancelled") {
                        badgeClass = "badge badge-danger";
                        statusText = "Cancelled";

                    } else if (data === "Completed") {
                        badgeClass = "badge badge-success";
                        statusText = "Completed";

                    } else if (data === "Processing") {
                        badgeClass = "badge badge-warning";
                        statusText = "Processing";

                    } else if (data === "Pending") {
                        badgeClass = "badge badge-warning";
                        statusText = "Pending";
                    }

                    var html = `<span class="${badgeClass}">${statusText}</span>`;
                    return html;
                }
            },
            { 
                data: 'time_create', 
                visible: false
            }
        ],
        order: [
            [5, 'desc']
        ],
    })
}