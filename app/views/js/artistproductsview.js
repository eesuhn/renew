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
            { data: 'prod_name' },
            { data: 'description' },
            { data: 'price' },
            { data: 'quantity' },
            {
                data: 'prod_id',
                render: function (data, type, row) {
                    return ellipsisMenuArtist(data);
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
        columnDefs: [
            { 
                targets: [4], 
                orderable: false 
            }
        ]
    })
}

function ellipsisMenuArtist(prodId) {
    var html = 
        `<div class="dropdown">
            <button class="btn dropdown-btn" type="button" id="ellipsisDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-v"></i>
            </button>
            <div class="dropdown-menu" aria-labelledby="ellipsisDropdown">
                <a class="dropdown-item" href="${prodId}">Edit</a>
                <a class="dropdown-item" href="${prodId}">Delete</a>
            </div>
        </div>`;

    return html;
}