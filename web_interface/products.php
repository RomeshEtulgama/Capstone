<div class="starter-template">
    <h1>Products</h1>
    <p class="lead">Use this interface to interact with the Products table.<br> All the allowed functions are available here.</p>
</div>

<!-- Available Products -->
<div class="card bg-dark mb-3">
    <!-- Default panel contents -->
    <nav class="navbar navbar-dark bg-dark text-white">
        <h4>Products</h4>

        <!-- search the table -->
        <button type="button" class="btn btn-success col-sm-2" data-toggle="modal" data-target="#addProductModal">Add New Product</button>

        <input class="form-control col-sm-3" type="search" id="products_filter_input" onkeyup="filter_table('products_filter_input', 'products_table', 5)" placeholder="Search for products">
    </nav>

    <!-- Products Table -->
    <table class="table table-hover table-dark table-responsive-sm table-small-text" id="products_table">
        <?php //view_products(); 
        ?>
    </table>
    <script>
        Populate_table("products_table");
    </script>

</div>

<!-- Edit Product Modal -->
<div class="modal fade bd-example-modal-lg " id="editProductModal" tabindex="-1" role="dialog" aria-labelledby="editProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content bg-dark text-white">
            <div class="modal-header">
                <h5 class="modal-title" id="editProductModalLabel">Edit Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="editproductform-modal-body">


            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary submitBtn" data-toggle="modal" data-target="#editProductModal" onclick="submitEditProductForm()">Submit</button>
            </div>
        </div>
    </div>
</div>

<!-- Add Product Modal -->
<div class="modal fade bd-example-modal-lg " id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="addProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content bg-dark text-white">
            <div class="modal-header">
                <h5 class="modal-title" id="addProductModalLabel">Add New Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="was-validated m-sm-3" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" id="add_product_form" autocomplete="off">

                    <!-- INDEX, NAME, DESCRIPTION, UNIT PRICE -->
                    <div class="form-row">

                        <!-- INDEX -->
                        <div class="col-md-2 mb-3 d-none">
                            <label for="productInputINDEX">Index</label>
                            <input type="number" class="form-control" id="productInputINDEX">
                        </div>

                        <!-- NAME -->
                        <div class="col-md-4 mb-3">
                            <label for="productInputNAME">Name</label>
                            <input type="text" class="form-control" id="productInputNAME" placeholder="Milk Toffee xxx/=" autocomplete="off">
                        </div>

                        <!-- DESCRIPTION -->
                        <div class="col-md-5 mb-3">
                            <label for="productInputDESCRIPTION">Description</label>
                            <input type="text" class="form-control" id="productInputDESCRIPTION" placeholder="This is what printed on the invoice">
                        </div>

                        <!-- UNIT PRICE -->
                        <div class="col-md-3 mb-3">
                            <label for="productInputUNITPRICE">Unit Price</label>
                            <input type="number" step="0.01" class="form-control" id="productInputUNITPRICE">
                        </div>

                    </div>

                    <!-- REMARKS -->
                    <div class="form-row">

                        <div class="col-md-6 mb-3">
                            <label for="productInputREMARKS">Remarks</label>
                            <textarea class="form-control" id="productInputREMARKS" rows="3"></textarea>
                        </div>

                    </div>

                    <!-- SELECT CLIENTS -->
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="productSelectCLIENTS">Select Clients</label>
                            <select id="productSelectCLIENTS" class="selectpicker" data-width="100%" data-live-search="true" data-actions-box="true" data-none-selected-text="Select Clients" multiple data-selected-text-format="count > 6" multiple>
                                <?php select_clients(true); ?>
                            </select>
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary submitBtn" data-toggle="modal" data-target="#addProductModal" onclick="submitAddProductForm()">Submit</button>
            </div>
        </div>
    </div>
</div>

<!-- Delete Product Confirmation Modal -->
<div class="modal fade" id="deleteProductModal" tabindex="-1" role="dialog" aria-labelledby="deleteProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content bg-dark text-white">
            <div class="modal-header" style="border-bottom : 1px solid #495057">
                <h5 class="modal-title" id="deleteProductModalLabel">Delete Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body delete-product-modal-body">


            </div>

            <div class="modal-footer delete-product-modal-footer" style="border-top : 1px solid #495057">
                <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                  <button type="submit" class="btn btn-primary submitBtn" data-toggle="modal" data-target="#deleteClientModal" onclick="deleteClient()">Yes</button> -->
            </div>
        </div>
    </div>
</div>