<!DOCTYPE html>

<html lang="en">
  <head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
      <meta name="description" content="">
      <meta name="author" content="">
      <link rel="icon" href="https://getbootstrap.com/docs/3.3/favicon.ico">
      <link rel="canonical" href="https://getbootstrap.com/docs/3.3/examples/starter-template/">

      <title>Capstone Test Interface</title>

      <!-- Bootstrap core CSS -->
      <!-- <link href="./index_files/bootstrap.min.css" rel="stylesheet"> -->
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

      <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

      <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
      <link href="./index_files/ie10-viewport-bug-workaround.css" rel="stylesheet">

      <!-- Custom styles for this template -->
      <link href="./index_files/starter-template.css" rel="stylesheet">

      <link rel="stylesheet" href="css/style.css">

      <script src="./index_files/ie-emulation-modes-warning.js.download"></script>  

      <script type="text/javascript" src="js/functions.js"></script>


      <?php include('functions.php'); ?>

      <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
  </head>

  <body>
      <nav class="navbar fixed-top navbar-expand-xl navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Capstone</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="#">Clients <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Features</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Pricing</a>
            </li>
          </ul>
          <span class="navbar-text">
            Testing interface
          </span>
        </div>
      </nav>

      <div class="container">

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
            <input class="form-control col-sm-3" type="search" placeholder="Search" aria-label="Search for clients..." onkeyup="filter_table('clients_table_filter_input', 'clients_table', 5)" id="clients_table_filter_input" >
          </nav>

          <!-- Table -->
          <table class="table table-hover table-dark table-sm" id="clients_table">
            <?php display_clients_table(); ?>
          </table>
        </div>
      
        <!-- Active Clients -->
        <div class="card bg-dark mb-3">
        <!-- Default panel contents -->
          <nav class="navbar navbar-dark bg-dark text-white">
            <h4>Active Clients</h4>
          
            <!-- search the table -->
            <button type="button" class="btn btn-success col-sm-2" data-toggle="modal" data-target="#addClientModel">Add New</button>

            <input class="form-control col-sm-3" type="search" id="active_clients_filter_input" onkeyup="filter_table('active_clients_filter_input', 'active_clients_table', 4)" placeholder="Search for active clients" >
          </nav>

          <!-- Table -->
          <table class="table table-hover table-dark table-sm" id="active_clients_table">
            <?php view_clients(); ?>
          </table>

        </div>
      
        <!-- Enable Client -->
        <div class="card bg-dark text-white col-sm-5" >
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
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
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

        <!-- Edit Client Model -->
        <div class="modal fade bd-example-modal-lg " id="editClientModel" tabindex="-1" role="dialog" aria-labelledby="editClientModelLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content bg-dark text-white">
              <div class="modal-header">
                <h5 class="modal-title" id="editClientModelLabel">Edit Client</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                
                <form class="was-validated m-sm-3" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" id = "edit_client_form">
                  <div class="form-row">

                    <!-- ID -->
                    <div>
                      <label for="InputID">ID</label>
                      <input type="number" class="form-control" id="InputID">
                    </div>

                    <!-- INDEX -->
                    <div class="col-md-2 mb-3">
                      <label for="InputINDEX">Index</label>
                      <input type="number" class="form-control" id="InputINDEX" value="0">
                    </div>

                    <!-- CODE -->
                    <div class="col-md-3 mb-3">
                      <label for="InputCODE">Code No</label>
                      <input type="text" class="form-control" id="InputCODE" value="<?php echo $client_data; ?>">
                    </div>
                  </div>

                  <div class="form-row">

                    <!-- NAME -->
                    <div class="col-md-4 mb-3">
                      <label for="InputNAME">Name</label>
                      <input type="text" class="form-control" id="InputNAME" placeholder="Mr. Romesh Bandara">
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
                        <?php select_products(); ?>
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
                <button type="submit" class="btn btn-primary submitBtn" onclick="submitEditClientForm()">Submit</button>
              </div>
            </div>
          </div>
        </div>

        <!-- Add Client Model -->
        <div class="modal fade bd-example-modal-lg " id="addClientModel" tabindex="-1" role="dialog" aria-labelledby="addClientModelLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content bg-dark text-white">
              <div class="modal-header">
                <h5 class="modal-title" id="addClientModelLabel">Add New Client</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form class="was-validated m-sm-3" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" id = "add_client_form">
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
                      <input type="text" class="form-control" id="InputNAME" placeholder="Mr. Romesh Bandara">
                    </div>

                    <!-- ADDRESS -->
                    <div class="col-md-4 mb-3">
                      <label for="InputADDRESS">Address</label>
                      <input type="text" class="form-control" id="InputADDRESS" placeholder="Etulgama, Thalatuoya">
                    </div>

                    <!-- NICKNAME -->
                    <div class="col-md-4 mb-3">
                      <label for="IndputNICKNAME">Nickname</label>
                      <input type="text" class="form-control" id="InputNICKNAME" placeholder="Etulgama Romesh">
                    </div>
                  </div>

                  <div class="form-row">

                    <!-- PRODUCT -->
                    <div class="col-md-6 mb-3">
                      <label for="InputPRODUCT">Default Product</label>
                      <select class="custom-select is-invalid" id="InputPRODUCT">
                        <?php select_products(); ?>
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
                <button type="submit" class="btn btn-primary submitBtn" onclick="submitAddClientForm()">Submit</button>
              </div>
            </div>
          </div>
        </div>

      </div>
      <!-- /.container -->

      <!-- Bootstrap core JavaScript
      ================================================== -->
      <!-- Placed at the end of the document so the pages load faster -->
      <script src="./index_files/jquery.min.js.download"></script>
      <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
      <script src="./index_files/bootstrap.min.js.download"></script>
      <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
      <script src="./index_files/ie10-viewport-bug-workaround.js.download"></script>
    
  </body>
</html>