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
        }
	}
?>