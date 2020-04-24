<div class="starter-template">
    <h1>Clients</h1>
    <p class="lead">Use this interface to interact with the Clients table.<br> All the allowed functions are available here.</p>
</div>

<!-- Clients Table -->
<div class="card bg-dark mb-3">
    <!-- Default panel contents -->
    <nav class="navbar navbar-dark bg-dark text-white">
        <h4>Clients Table</h4>
        <!-- search table -->
        <input class="form-control col-sm-3" type="search" placeholder="Search" aria-label="Search for clients..." onkeyup="filter_table('clients_table_filter_input', 'clients_table', 5)" id="clients_table_filter_input">
    </nav>

    <!-- Table -->
    <table class="table table-hover table-dark table-responsive-sm table-small-text" id="clients_table">
        <?php display_clients_table(); ?>
    </table>
</div>

<!-- Active Clients -->
<div class="card bg-dark mb-3">
    <!-- Default panel contents -->
    <nav class="navbar navbar-dark bg-dark text-white">
        <h4>Active Clients</h4>

        <!-- search the table -->
        <button type="button" class="btn btn-success col-sm-2" data-toggle="modal" data-target="#addClientModal">Add New Client</button>

        <input class="form-control col-sm-3" type="search" id="active_clients_filter_input" onkeyup="filter_table('active_clients_filter_input', 'active_clients_table', 4)" placeholder="Search for active clients">
    </nav>

    <!-- Table -->
    <table class="table table-hover table-dark table-responsive-sm table-small-text" id="active_clients_table">

    </table>
    <script>
        Populate_table("active_clients_table");
    </script>
</div>

<!-- Enable Client -->
<div class="card bg-dark text-white col-sm-5">
    <!-- Default panel contents -->
    <div class="card-header">
        <h4>Enable Client</h4>
    </div>

    <!-- Table -->
    <table class="table text-white">
        <tr>
            <th>Index&emsp;
                Name&emsp;
                Address&emsp;
                Nickname&emsp;
                Remarks</th>
        </tr>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <tr>
                <th>
                    <select class="form-control" name="enabling_client">
                        <?php select_disabled_clients(); ?>
                    </select>
                </th>
            </tr>
            <tr>
                <th>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </th>
            </tr>
        </form>

        <?php
        $enabling_id = 0;

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            if (!empty($_POST["enabling_client"])) {
                $enabling_id = test_input($_POST["enabling_client"]);
            }
        }
        enable_client($enabling_id);
        ?>
    </table>
</div>

<!-- Edit Client Modal -->
<div class="modal fade bd-example-modal-lg " id="editClientModal" tabindex="-1" role="dialog" aria-labelledby="editClientModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content bg-dark text-white">
            <div class="modal-header">
                <h5 class="modal-title" id="editClientModalLabel">Edit Client</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="editform-modal-body">


            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary submitBtn" data-toggle="modal" data-target="#editClientModal" onclick="submitEditClientForm()">Submit</button>
            </div>
        </div>
    </div>
</div>

<!-- Add Client Modal -->
<div class="modal fade bd-example-modal-lg " id="addClientModal" tabindex="-1" role="dialog" aria-labelledby="addClientModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content bg-dark text-white">
            <div class="modal-header">
                <h5 class="modal-title" id="addClientModalLabel">Add New Client</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="m-sm-3" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" id="add_client_form">
                    <div class="form-row">

                        <!-- INDEX -->
                        <div class="col-md-2 mb-3">
                            <label for="InputINDEX">Index</label>
                            <input type="number" class="form-control" id="InputINDEX">
                        </div>

                        <!-- CODE -->
                        <div class="col-md-3 mb-3">
                            <label for="InputCODE">Code No</label>
                            <input type="text" class="form-control" id="InputCODE">
                        </div>
                    </div>

                    <div class="form-row">

                        <!-- NAME -->
                        <div class="col-md-4 mb-3">
                            <label for="InputNAME">Name</label>
                            <input type="text" class="form-control" id="InputNAME" placeholder="Mr. Romesh Bandara" autocomplete="off">
                        </div>

                        <!-- ADDRESS -->
                        <div class="col-md-4 mb-3">
                            <label for="InputADDRESS">Address</label>
                            <input type="text" class="form-control" id="InputADDRESS" placeholder="Etulgama, Thalatuoya">
                        </div>

                        <!-- NICKNAME -->
                        <div class="col-md-4 mb-3">
                            <label for="InputNICKNAME">Nickname</label>
                            <input type="text" class="form-control" id="InputNICKNAME" placeholder="Etulgama Romesh">
                        </div>
                    </div>

                    <div class="form-row">

                        <!-- PRODUCT -->
                        <div class="col-md-6 mb-3">
                            <label for="InputPRODUCT">Default Product</label>
                            <select class="custom-select is-invalid" id="InputPRODUCT">
                                <?php select_products(true); ?>
                            </select>
                        </div>

                        <!-- CONTACT1 -->
                        <div class="col-md-3 mb-3">
                            <label for="InputCONTACT1">Contact 1</label>
                            <input type="text" class="form-control" id="InputCONTACT1">
                        </div>

                        <!-- CONTACT2 -->
                        <div class="col-md-3 mb-3">
                            <label for="InputCONTACT2">Contact 2</label>
                            <input type="text" class="form-control" id="InputCONTACT2">
                        </div>
                    </div>

                    <div class="form-row">

                        <!-- REMARKS -->
                        <div class="col-md-6 mb-3">
                            <label for="InputREMARKS">Remarks</label>
                            <textarea class="form-control" id="InputREMARKS" rows="3"></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary submitBtn" data-toggle="modal" data-target="#addClientModal" onclick="submitAddClientForm()">Submit</button>
            </div>
        </div>
    </div>
</div>

<!-- Delete Client Confirmation Modal -->
<div class="modal fade" id="deleteClientModal" tabindex="-1" role="dialog" aria-labelledby="deleteClientModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content bg-dark text-white">
            <div class="modal-header" style="border-bottom : 1px solid #495057">
                <h5 class="modal-title" id="deleteClientModalLabel">Delete Client</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body delete-client-modal-body">


            </div>

            <div class="modal-footer delete-client-modal-footer" style="border-top : 1px solid #495057">
                <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        <button type="submit" class="btn btn-primary submitBtn" data-toggle="modal" data-target="#deleteClientModal" onclick="deleteClient()">Yes</button> -->
            </div>
        </div>
    </div>
</div>