<div>
  <div class="container px-0" id="Products_area">

    <div class="starter-template">
      <h1>Invoices</h1>
      <p class="lead">Use this interface to interact with the Invoice Generation Process.<br> All the allowed functions are available here.</p>
    </div>

    <script>
      Populate_table("routes_radio")
    </script>

    <!-- Invoices -->
    <div id="invoices_card" class="card bg-dark text-white col-sm-12">
      <nav class="navbar navbar-dark bg-dark text-white pl-0">
        <h4>Invoices</h4>
      </nav>
      <label for="route">Route</label>
      <div class="form-row">
        <div id="routes_radio" class="btn-group btn-group-toggle pl-0" data-toggle="buttons"></div>
        <button type="button" class="btn btn-dark col-sm-1" data-toggle="modal" data-target="#addRouteModal">Add Route</button>
      </div>
      <br>
      <form>
        <div class="form-row">

          <!-- Order No -->
          <div class="form-group col-sm-2 mr-4">
            <label for="order_no">Order No</label>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text bg-dark text-white" id="basic-addon3"></span>
              </div>
              <input type="number" class="form-control" id="order_no" aria-describedby="basic-addon3" autocomplete="off">
            </div>
          </div>

          <!-- Order Date -->
          <div class="form-group col-sm-2 mr-4">
            <label for="order_date">Order Date</label>
            <input autocomplete="off" id="order_date">
            <script>
              $('#order_date').datepicker({
                uiLibrary: 'bootstrap4',
                format: 'yyyy-mm-dd'
              });
            </script>
          </div>

          <!-- Remarks -->
          <div class="form-group col-sm-7">
            <label for="order_remarks">Remarks</label>
            <div class="input-group mb-3">
              <textarea class="form-control" id="order_remarks" rows="1" autocomplete="off"></textarea>
            </div>
          </div>

        </div>

        <div class="form-row">
          <table class="table table-hover table-dark table-responsive-sm table-small-text table-bordered table-sm" id="invoices_table">
            <thead>
              <tr>
                <th scope="col" style="text-align: center; width: 6%">No</th>
                <th scope="col" style="text-align: center">Client Name</th>
                <th scope="col" style="text-align: center; width: 15%">Quantity</th>
                <th scope="col" style="text-align: center">Product</th>
                <th scope="col" style="text-align: center">Unit Price</th>
                <th scope="col" style="text-align: center">Amount</th>
                <th scope="col" style="text-align: center">Total Outstanding</th>
              </tr>
            </thead>
            <tbody>

            </tbody>
            <tfooter>
              <tr>
                <th colspan="7" style="text-align: center" onclick="add_row()">Add Row</th>
              </tr>
            </tfooter>
          </table>
        </div>
      </form>

      <hr>

      <div align='right'>
        <button type="submit" class="btn btn-primary submitBtn mr-5" onclick=submitAddOrderForm()>Submit</button>
      </div>

      <br>
      <table class="table table-hover table-dark table-responsive-sm table-small-text table-bordered table-sm" id="orders_table">
      </table>
      <script>
        Populate_table("orders_table");
      </script>

    </div>

    <!-- Delete Invoice Confirmation Modal -->
    <div class="modal fade" id="deleteInvoiceModal" tabindex="-1" role="dialog" aria-labelledby="deleteInvoiceModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content bg-dark text-white">
          <div class="modal-header" style="border-bottom : 1px solid #495057">
            <h5 class="modal-title" id="deleteInvoiceModalLabel">Delete Invoice</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <div class="modal-body delete-invoice-modal-body">


          </div>

          <div class="modal-footer delete-invoice-modal-footer" style="border-top : 1px solid #495057">

          </div>
        </div>
      </div>
    </div>

    <!-- Edit Invoice Modal -->
    <div class="modal fade bd-example-modal-lg" id="editInvoiceModal" tabindex="-1" role="dialog" aria-labelledby="editInvoiceModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content bg-dark text-white">
          <div class="modal-header" style="border-bottom : 1px solid #495057">
            <h5 class="modal-title" id="editInvoiceModalLabel">Edit Invoice</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <div class="modal-body edit-invoice-modal-body">


          </div>

          <div class="modal-footer edit-invoice-modal-footer" style="border-top : 1px solid #495057">

          </div>
        </div>
      </div>
    </div>

    <!-- Add Route Modal -->
    <div class="modal fade bd-example-modal-sm " id="addRouteModal" tabindex="-1" role="dialog" aria-labelledby="addRouteModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content bg-dark text-white">
          <div class="modal-header">
            <h5 class="modal-title" id="addRouteModalLabel">Add New Route</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form class="was-validated m-sm-3" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" id="add_route_form">
              
              <div class="form-row">

                <!-- NAME -->
                <div>
                  <label for="route_name">Name</label>
                  <input type="text" class="form-control" id="route_name" placeholder="Add route name" autocomplete="off">
                </div>

              </div>
              <br>
              <div class="form-row">
                <!-- ACRONYM -->
                <div>
                  <label for="route_acronym">Acronym</label>
                  <input type="text" class="form-control" id="route_acronym" placeholder="CMB, KDY">
                </div>

              </div>

            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary submitBtn" data-toggle="modal" data-target="#addRouteModal" onclick="submitAddRouteForm()">Submit</button>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>