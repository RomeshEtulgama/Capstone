<!DOCTYPE html>
<html lang="en">

<head>

  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Web application for simple accounting operations">
  <meta name="author" content="Romesh Etulgama">

  <link rel="icon" href="images/favicon.ico">

  <title>Quentin Interface</title>

  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="css/bootstrap.min.css" >
  <script src="js/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
  <script src="js/popper.min.js" ></script>
  <script src="js/bootstrap.min.js" ></script>

  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/font-awesome.min.css">

  <script src="./index_files/ie-emulation-modes-warning.js.download"></script>

  <script type="text/javascript" src="js/functions.js"></script>

  <?php include('functions.php'); ?>

  <!-- BOOTSTRAP SELECT PLUGIN -->
  <link rel="stylesheet" href="css/bootstrap-select.min.css">
  <script src="js/bootstrap-select.min.js"></script>

  <!-- Datepicker -->
  <script src="js/gijgo.min.js" type="text/javascript"></script>
  <link href="css/gijgo.min.css" rel="stylesheet" type="text/css" />

  <!-- Custom styles for this template -->
  <link href="css/simple-sidebar.css" rel="stylesheet">

</head>

<body>



  <div>
    <div class="container" id="navbar" style="padding-top: 3.5em">
      <?php include('navbar.php'); ?>
    </div>
  </div>

  <div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="bg-dark border-right" style="border-right-width: 3px !important;" id="sidebar-wrapper">
      <div class="list-group list-group-flush">
        <a href="#" onclick="alert('Dashboard');" class="list-group-item list-group-item-action bg-dark text-white">
          <h5><i class="fa fa-tachometer"></i>&nbsp;&nbsp;Dashboard</h5>
        </a>
        <a href="#" onclick="sidebar_active('Clients');" class="list-group-item list-group-item-action bg-dark text-white"><i class="fa fa-users"></i>&nbsp;&nbsp;&nbsp;Clients</a>
        <a href="#" onclick="sidebar_active('Products');" class="list-group-item list-group-item-action bg-dark text-white"><i class="fa fa-shopping-cart"></i>&nbsp;&nbsp;&nbsp;Products</a>
        <a href="#" onclick="sidebar_active('Invoices');" class="list-group-item list-group-item-action bg-dark text-white"><i class="fa fa-paper-plane"></i>&nbsp;&nbsp;&nbsp;Invoices</a>
        <a href="#" onclick="sidebar_active('Payments');" class="list-group-item list-group-item-action bg-dark text-white"><i class="fa fa-money"></i>&nbsp;&nbsp;&nbsp;Payments</a>
        <a href="#" onclick="sidebar_active('Reports');" class="list-group-item list-group-item-action bg-dark text-white"><i class="fa fa-bar-chart"></i>&nbsp;&nbsp;&nbsp;Reports</a>
      </div>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper sdd">
      <div class="container-fluid px-0">

        <div class="container" id="Clients_area" style="max-width: 100%">
          <?php include("public/clients.php"); ?>
        </div>

        <div class="container" id="Products_area" style="max-width: 100%">
          <?php include("public/products.php"); ?>
        </div>

        <div class="container" id="Invoices_area" style="max-width: 100%">
          <?php include("public/invoices.php"); ?>
        </div>

        <div class="container" id="Payments_area" style="max-width: 100%">
          <?php include("public/payments.php"); ?>
        </div>
      </div>
    </div>

  </div>
  <!-- /#wrapper -->

  <!-- Menu Toggle Script -->
  <script>
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
    $("#Clients_area").hide();
    $("#Products_area").hide();
    // $("#Invoices_area").hide();
    $("#Payments_area").hide();
  </script>

  <!-- Placed at the end of the document so the pages load faster -->
  <script src="./index_files/bootstrap.min.js.download"></script>

  <!-- DataTables -->
  <script type="text/javascript" src="./js/dataTables.min.js"></script>
  <!-- <script type="text/javascript" src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script> -->

  <!-- Typeahead -->
  <script src="js/typeahead.bundle.js" type="text/javascript"></script>

</body>

</html>