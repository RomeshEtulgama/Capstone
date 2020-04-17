<div>
  <div class="container px-0" id="Products_area">

    <div class="starter-template">
      <h1>Invoices</h1>
      <p class="lead">Use this interface to interact with the Invoice Generation Process.<br> All the allowed functions are available here.</p>
    </div>

    <script>
      Populate_table("route_tabs")
    </script>

    <div id="route_tabs" class="card bg-dark text-white col-sm-12">
      <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">...</div>
      </div>
    </div>

    <!-- Testing Card -->
    <div id="route_tabs" class="card bg-dark text-white col-sm-12">
      <form>
        <div class="form-row">

          <!-- Order No -->
          <div class="form-group col-sm-2 mr-4">
            <label for="order_no-CMB">Order No</label>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text bg-dark text-white" id="basic-addon3-CMB">CMB</span>
              </div>
              <input type="number" class="form-control" id="order_no-CMB" aria-describedby="basic-addon3-CMB" autocomplete="off">
            </div>
          </div>

          <!-- Order Date -->
          <div class="form-group col-sm-2 mr-4">
            <label for="datepicker-CMB">Order Date</label>
            <input autocomplete="off" id="datepicker-CMB">
            <script>
              $('#datepicker-CMB').datepicker({
                uiLibrary: 'bootstrap4',
                format: 'yyyy-dd-mm'
              });
            </script>
          </div>

          <!-- Remarks -->
          <div class="form-group col-sm-7">
            <label for="order_remarks-CMB">Remarks</label>
            <div class="input-group mb-3">
              <textarea class="form-control" id="order_remarks-CMB" rows="1" autocomplete="off"></textarea>
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
    </div>

    <!-- <button id="addRow">Add Row</button> -->

    <!-- <div class="col-sm-10">
      <table class="table table-hover table-dark table-responsive-sm table-small-text table-bordered table-sm" id="invoices_table">
        <thead>
          <tr>
            <th scope="col" style="text-align: center; width: 6%">#</th>
            <th scope="col" style="text-align: center">Client Name</th>
            <th scope="col" style="text-align: center; width: 15%">Quantity</th>
            <th scope="col" style="text-align: center">Product</th>
            <th scope="col" style="text-align: center">Amount</th>
            <th scope="col" style="text-align: center">Total Outstanding</th>
          </tr>
        </thead>
        <tbody>

        </tbody>
      </table>
    </div> -->


  </div>
</div>