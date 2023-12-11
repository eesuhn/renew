$(document).ready(function() {
    var data = [
        {
            "recycled": "Bird House, Upcycled Glass Vases,...",
            "date&time": "2023-12-11 10:30:00",
            "total": "300",
            "status": "Completed",
            "office": "Edinburgh",
            "extn": "5421"
        },
        {
            "recycled": "Bird House, Upcycled Glass Vases,...",
            "date&time": "2023-12-11 10:30:00",
            "total": "20",
            "status": "Processing",
            "office": "Edinburgh",
            "extn": "8422"
        },
        {
            "recycled": "Bird House, Upcycled Glass Vases,...",
            "date&time": "2023-12-11 10:30:00",
            "total": "0",
            "status": "Cancelled",
            "office": "London",
            "extn": "2323"
        }
    ];

    $('#order-history').DataTable({
        data: data,
        columns: [
            { data: 'recycled' },
            {
                data: 'date&time',
                render: function (data, type, row) {
                    return '<span>' + data + '</span>';
                }
            },
            {
                data: 'status',
                render: function (data, type, row) {
                    var badgeClass = "";
                    var statusText = "";

                    if (data === "Cancelled") {
                        badgeClass = "badge badge-danger";
                        statusText = "Cancelled";

                    } else if (data === "Completed") {
                        badgeClass = "badge badge-success";
                        statusText = "Completed";

                    } else if (data === "Processing") {
                        badgeClass = "badge badge-warning";
                        statusText = "Processing";
                    }

                    return '<span class="' + badgeClass + '">' + statusText + '</span>';
                }
            },
            { data: 'total' }
        ]
    });
});