$(document).ready(function() {
    getData(
        '/renew/get-artist-products',
        function (response) {
            $('#artist-products').DataTable({
                data: response.data,
                columns: [
                    { data: 'name' },
                    { data: 'description' },
                    { data: 'price' },
                    { data: 'quantity' },
                    {
                        data: 'null',
                        render: function (data, type, row) {
                            return '<a href="#" style="color: black !important;"><i class="fas fa-ellipsis-h"></i></a>';
                        }
                    }
                ]
            })
        }, 
        "AJAX Error: Unable to get artist products."
    )
});