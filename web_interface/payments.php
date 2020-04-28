<div class="starter-template">
    <h1>Payments</h1>
    <p class="lead">Use this interface to interact with the Payments table.<br> All the allowed functions are available here.</p>
</div>

<!-- Payments -->
<div class="card bg-dark text-white col-sm-12">
    <!-- Default panel contents -->
    <nav class="navbar navbar-dark bg-dark text-white">
        <h4>Payments</h4>

        <!-- search the table -->
        <input class="form-control col-sm-3" type="search" id="payments_filter_input" onkeyup="filter_table('payments_filter_input', 'payments_table', 5)" placeholder="Search for payments">
    </nav>

    <!-- Payments Table -->
    <form>
        <div class="form-row">
            <table class="table table-hover table-dark table-responsive-sm table-small-text table-bordered table-sm" id="payments_table">
                <thead>
                    <tr>
                        <th scope="col" style="text-align: center">Date</th>
                        <th scope="col" style="text-align: center; width: 15%">Client Name</th>
                        <th scope="col" style="text-align: center">Payment Method</th>
                        <th scope="col" style="text-align: center">Amount</th>
                        <th scope="col" style="text-align: center">Remarks</th>
                        <th scope="col" style="text-align: center">Total Outstanding</th>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>
                <tfooter>
                    <tr>
                        <th colspan="7" style="text-align: center" onclick="add_payment_row()">Add Row</th>
                    </tr>
                </tfooter>
            </table>
        </div>
    </form>

</div>

<!-- Delete Payment Confirmation Modal -->
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