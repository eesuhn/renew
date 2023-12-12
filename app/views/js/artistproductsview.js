$(document).ready(function() {
    listenAddProduct();
    getArtistProd();
});

function listenAddProduct() {
    $("#add-prod-form").on("submit", function (e) {
        e.preventDefault();
        var formData = new FormData(this);

        sendAjax(
            "/renew/add-product",
            formData,
            function (response) {
                setNotification('Product added successfully.');
                redirect('/renew/artist-products');
            },
            function (response) {
                handleErrorText(response.data);
            },
            "AJAX Error: Unable to add product."
        );
    })
}

function getArtistProd() {
    getData(
        '/renew/get-artist-products',
        function (response) {
            setArtistProdTable(response.data);
        }, 
        "AJAX Error: Unable to get artist products."
    )
}

/**
 * Sets the artist products table.
 * 
 * @param {Array} data 
 * - name
 * - description
 * - price
 * - quantity
 */
function setArtistProdTable(data) {
    $('#artist-products').DataTable({
        data: data,
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
}