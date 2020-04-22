<?php
    if(isset($_POST["type"])){
        if($_POST["type"] == "client") {
            $client_id = $_POST['id'];
            include("functions.php");
            $client_data = get_client($client_id);
            $response = "<h5>Are you sure you want to delete this client ?</h5>";
            $response .= "&nbsp&nbsp&nbsp   Name : ".$client_data[1]."<br>";
            $response .= "&nbsp&nbsp&nbsp   Address : ".$client_data[2]."<br>";
            if(strlen($client_data[3]) > 1)
                $response .= "&nbsp&nbsp&nbsp   Nickname : ".$client_data[3]."<br>";
            if(strlen($client_data[8]) > 1)
                $response .= "&nbsp&nbsp&nbsp   Remarks : ".$client_data[8];
            echo $response;
        } elseif($_POST["type"] == "product") {
            $product_id = $_POST['id'];
            include("functions.php");
            $product_data = get_product($product_id);
            $response = "<h5>Are you sure you want to delete this product ?</h5>";
            $response .= "&nbsp&nbsp&nbsp   Name : ".$product_data[1]."<br>";
            $response .= "&nbsp&nbsp&nbsp   Description : ".$product_data[2]."<br>";
            $response .= "&nbsp&nbsp&nbsp   Unit Price : ".$product_data[3]."<br>";
            if(strlen($product_data[4]) > 1)
                $response .= "&nbsp&nbsp&nbsp   Remarks : ".$product_data[4];
            echo $response;
        } elseif($_POST["type"] == "invoice") {
            $i_id = $_POST['id'];
            include("functions.php");
            $invoice_data = get_invoice($i_id);
            $response = "<h5>Are you sure you want to delete this Order ?</h5>";
            $response .= "<div class=\"container\">\n";
            $response .= "<div class=\"row justify-content-start\" >\n";
            $response .= "<div class=\"col-6\">\n";
            $response .= "<h5><b><span style=\"color:gray\">S/N : </span><span class=\"badge badge-warning\">".$invoice_data[3]."</span></b></h5>\n";
            $response .= "<b><span style=\"color:gray\">Date : </span></b>".$invoice_data[1]."\n";
            $response .= "<br>\n";
            $response .= "<b><span style=\"color:gray\">Invoice No : </span></b>".$invoice_data[2]."\n";
            $response .= "</div>\n";
            $response .= "</div>\n";
            $response .= "<div class=\"row justify-content-start\">\n";
            $response .= "<div class=\"col-12\">\n";
            $response .= "<b><span style=\"color:gray\">Name : </span></b>".$invoice_data[4]."\n";
            $response .= "<br>\n";
            $response .= "<b><span style=\"color:gray\">Address : </span></b>".$invoice_data[5]."\n";
            $response .= "<br><br>\n";
            $response .= "</div>\n";
            $response .= "</div>\n";
            $response .= "<div class=\"row\">\n";
            $response .= "<div class=\"col align-self-start\">\n";
            $response .= $invoice_data[6]."&nbsp&nbsp&nbsp&nbspX&nbsp&nbsp&nbsp&nbsp".$invoice_data[7]."\n";
            $response .= "</div>\n";
            $response .= "</div>\n";
            $response .= "</div>";
            echo $response;
        }
	}
?>