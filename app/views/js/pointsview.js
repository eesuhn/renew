$(document).ready(function() {
    var data = [
        {
            "recycled":         "Newspaper",
            "date&time":        "2023-12-11 10:30:00",
            "pointsworth":      "300",
            "drop-off status":  "Completed"
        },
        {
            "recycled":         "Plastic bottles",
            "date&time":        "2023-12-11 10:30:00",
            "pointsworth":      "20",
            "drop-off status":  "In Progress"
        },
        {
            "recycled":         "Glass bottles",
            "date&time":        "2023-12-11 10:30:00",
            "pointsworth":      "0",
            "drop-off status":  "Cancelled"
        }
    ];

    $('#point-history').DataTable({
        data: data,
        columns: [
            { data: 'recycled' },
            {
                data: 'date&time',
                render: function (data, type, row) {
                    return '<span>' + data + '</span>'; 
                }
            },
            { data: 'pointsworth' },
            {
                data: 'drop-off status',
                render: function (data, type, row) {
                    return badgeStatus(data);
                }
            }
        ]
    });
});