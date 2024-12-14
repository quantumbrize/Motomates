<div class="page-content">


    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between ">
            <button type="button" class="btn btn-sm btn-success" id="submitBtn" onclick="submitProducts()">Update
            Products</button>
            </div>
        </div>
        <style>

        .fa-redo {
            margin-left: 25px;
            cursor: pointer;
        }
        #product-table {
        table-layout: fixed; /* Ensures column widths are respected */
        width: 100%; /* Makes the table take up the full width */
    }

    #product-table th, 
    #product-table td {
        width: 250px; /* Default width for all columns */
        word-wrap: break-word; /* Wrap long content within the cell */
        overflow: hidden; /* Hide overflowing content */
        text-overflow: ellipsis; /* Optional: Add ellipsis for long text */
        white-space: normal; /* Allow wrapping */
    }

    /* Specific width for the checkbox column */
    #product-table th:first-child, 
    #product-table td:first-child {
        width: 50px; /* Small width for the checkbox column */
    }
    </style>
        <div class="col-12" style="overflow-x: auto; width: 100%;">
            
        <table id="product-table" class="table nowrap align-middle table-hover" style="width:100%">
    <thead>
        <tr>
            <th></th>
            <th>Product</th>
            <th>Store Name</th>
            <th>Make</th>
            <th>Model</th>
            <th>Year</th>
            <th>Mileage</th>
            <th>Location</th>
            <th>Doors</th>
            <th>Badges</th>
            <th>Category</th>
            <th>Tax</th>
            <th>Discount</th>
            <th>Price</th>
            <th>Details</th>
            <th>Images</th>
            <th>Stocks</th>
        </tr>
    </thead>
    <tbody id="product-table-body">
        <!-- Table rows dynamically generated here -->
    </tbody>
</table>

            <!-- <button type="button" class="btn btn-sm btn-success" onclick="addRow()">Add Another Product</button> -->
            <!-- <button type="button" class="btn btn-sm btn-success" id="submitBtn" onclick="submitProducts()">Submit
                Products</button> -->

            <!-- Modal for CKEditor -->
            <div id="descriptionModal" class="modal">
                <div class="modal-content">
                    <span class="close-button" onclick="closeModal()">&times;</span>
                    <h2>Edit Description</h2>
                    <!-- Textarea for CKEditor -->
                    <textarea id="editor"></textarea>
                    <!-- Hidden input to store row reference -->
                    <input type="hidden" id="currentRowIndex">
                    <button type="button" class="btn btn-success btn-lg" id="productDescriptionBtn" onclick="saveDescription()">Save
                        Description</button>
                </div>
            </div>
            <div id="imageUploadModal" class="modal" style="display:none;">
                <div class="modal-content">
                    <span class="close-button" id="closeImageModal" style="cursor:pointer;">&times;</span>
                    <h4>Upload Multiple Images<small>(Upload 1080x1080 Image)*</small></h4>
                    <input type="file" id="imageInput" accept="image/*" multiple>
                    <p id="num-of-files"></p>
                    <div id="imagePreviewContainer"></div>
                    <div id="existingProductImgContainer"></div>
                    <button id="submitImages" class="btn btn-success btn-lg" onclick="updateProductImages()">Submit Images</button>
                </div>
            </div>
            <div id="priceModel" class="modal" style="display:none;">
                <div class="modal-content">
                    <span class="close-button" id="closePriceModal" style="cursor:pointer;">&times;</span>
                    <h4>Add Prices</h4>
                    <div class="col-12" style="overflow-x: auto; ">
                        <table id="product-price-table" class="table nowrap align-middle table-hover">
                            <thead>
                                <tr>
                                    <th>Quantity Min</th>
                                    <th>Quantity Max</th>
                                    <th>Price</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody id="product-price-table-body">
                                <tr>
                                    <td><input type="text" placeholder="Enter Min Quantity" required></td>
                                    <td><input type="text" placeholder="Enter Max Quantity" required></td>
                                    <td><input type="text" placeholder="Price" required></td>
                                    <td>
                                        <button class="btn btn-md btn-danger" type="button"
                                            onclick="removePriceRow(this)">
                                            <i class="ri-delete-bin-7-line"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div style="display: flex; gap: 10px;">
                            <button type="button" class="btn btn-md btn-success" id="submitPriceBtn" onclick="submitPrice()">Save Price</button>
                            <button type="button" class="btn btn-md btn-success" onclick="addPriceRow()">Add Price +</button>
                        </div>
                    </div>
                </div>
            </div>
            <div id="stockUpdateModal" class="modal" style="display:none;">
                <div class="modal-content modal-content-stock">
                    <span class="close-button" id="closeStockUpdateModal">&times;</span>
                    <h2>Update Stock</h2>
                    <!-- Textarea for CKEditor -->
                    <!-- <textarea id="editor"></textarea> -->
                        <table class="table" style="width: 300px;">
                            <thead>
                                <tr style="text-align: center;">
                                    <th>Size</th>
                                    <th>Quantity</th>
                                </tr>
                            </thead>
                            <tbody id="product_details">
                                
                            </tbody>
                        </table>

                    <input type="hidden" id="currentRowIndex">
                    <!-- <button type="button" class="btn btn-success btn-lg" id="productDescriptionBtn" onclick="saveDescription()">Save
                        Description
                    </button> -->
                </div>
            </div>
        </div>

    </div>



</div>