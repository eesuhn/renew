$(document).ready(function() {
    listenAddProduct();
    getArtistProd();
    listenEditProdForm();
    listenDelProdForm();
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
                data: {
                    'prod_id': 'prod_id',
                    'price': 'price',
                    'quantity': 'quantity'
                },
                render: function (data, type, row) {
                    return ellipsisMenuArtist(data['prod_id'], data['price'], data['quantity']);
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

function ellipsisMenuArtist(prodId, price, quantity) {
    var html = 
        `<div class="dropdown">
            <button class="btn dropdown-btn" type="button" id="ellipsisDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-v"></i>
            </button>
            <div class="dropdown-menu" aria-labelledby="ellipsisDropdown">
                <a class="dropdown-item">
                    <button type="button" class="ellipsis-btn" data-toggle="modal" data-target="#edit-prod-modal-${prodId}">Edit</button>
                </a>
                <a class="dropdown-item">
                    <button class="ellipsis-btn" data-toggle="modal" data-target="#delete-prod-modal-${prodId}">Delete</button>
                </a>
            </div>
        </div>
        
        <div class="modal fade" id="edit-prod-modal-${prodId}" tabindex="-1" role="dialog" aria-labelledby="edit-prod-modal-label" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header edit-prod-modal-header">
                        <h5 class="modal-title" id="edit-prod-modal-label">Edit Product</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="edit-prod-form-${prodId}" method="POST">
                        <div class="modal-body edit-prod-input">
                            <div class="form-group">
                                <label for="prod-price" class="col-form-label">Price:</label>
                                <input type="number" class="form-control" id="prod-price" name="prod-price" step="1" value="${price}">
                                <span id="prodPriceError" class="errorText"></span>
                            </div>
                            <div class="form-group">
                                <label for="prod-quantity" class="col-form-label">Quantity:</label>
                                <input type="number" class="form-control" id="prod-quantity" name="prod-quantity" step="1" value="${quantity}">
                                <span id="prodQuantityError" class="errorText"></span>
                            </div>
                            <div class="form-group edit-prod-submit">
                                <button type="submit" data-prod-id="${prodId}" data-dismiss="modal" class="btn btn-primary edit-prod-btn">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="modal fade" id="delete-prod-modal-${prodId}" tabindex="-1" role="dialog" aria-labelledby="edit-prod-modal-label" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header edit-prod-modal-header">
                        <h5 class="modal-title" id="edit-prod-modal-label">Delete Product</h5>
                    </div>
                    <form id="delete-prod-form-${prodId}" method="POST">
                        <div class="modal-body edit-prod-input">
                            <div class="form-group edit-prod-submit">
                                <button type="submit" data-prod-id="${prodId}" data-dismiss="modal" class="btn btn-primary delete-prod-btn">Confirm</button>
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

function listenEditProdForm() {
    $(document).on('click', '.edit-prod-btn', function (e) {
        e.preventDefault();
        var prodId = $(this).data('prod-id');
        var formData = new FormData($('#edit-prod-form-' + prodId)[0]);

        sendAjax(
            '/renew/update-product?prod-id=' + prodId,
            formData,
            function (response) {
                setNotification('Product updated');
                redirect('/renew/artist-products');
            },
            function (response) {
                console.log(response);
            },
            "AJAX Error: Unable to edit product."
        );
    });
}

function listenDelProdForm() {
    $(document).on('click', '.delete-prod-btn', function (e) {
        e.preventDefault();
        var prodId = $(this).data('prod-id');

        sendAjax(
            '/renew/delete-product?prod-id=' + prodId,
            null,
            function (response) {
                setNotification('Product deleted');
                redirect('/renew/artist-products');
            },
            function (response) {
                console.log(response);
            },
            "AJAX Error: Unable to delete product."
        )
    });
}