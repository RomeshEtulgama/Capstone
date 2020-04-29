<!DOCTYPE html>

<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Web application for simple accounting operations">
  <meta name="author" content="Romesh Etulgama">

  <link rel="icon" href="images/favicon.ico">

  <title>Capstone Test Interface</title>

  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <script src="./index_files/ie-emulation-modes-warning.js.download"></script>

  <script type="text/javascript" src="js/functions.js"></script>

  <?php include('functions.php'); ?>

  <!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script> -->

  <!-- BOOTSTRAP SELECT PLUGIN -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>

  <!-- Datepicker -->
  <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
  <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />


</head>

<body data-spy="scroll" data-target="#capstone-nav" data-offset="0" >

  <?php include("navbar.php"); ?>

  <div>

    <div class="container" id="Clients_area" style="padding-top: 50px">
      <?php include("clients.php"); ?>
    </div>

    <div class="container" id="Products_area" style="padding-top: 50px">
      <?php include("products.php"); ?>
    </div>

    <div class="container" id="Invoices_area" style="padding-top: 50px">
      <?php include("invoices.php"); ?>
    </div>

    <div class="container" id="Payments_area" style="padding-top: 50px">
      <?php include("payments.php"); ?>
    </div>

  </div>
  
  <div id="scripts"></div>

  

  <!-- Bootstrap core JavaScript
      ================================================== -->
  <!-- Placed at the end of the document so the pages load faster -->
  <!-- <script src="./index_files/jquery.min.js.download"></script> -->
  <script src="./index_files/bootstrap.min.js.download"></script>

  <!-- DataTables -->
  <script type="text/javascript" src="./js/dataTables.js"></script>
  <!-- <script type="text/javascript" src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script> -->
  

  <!-- Typeahead -->
  <script src="js/typeahead.bundle.js" type="text/javascript"></script>

</body>

</html>