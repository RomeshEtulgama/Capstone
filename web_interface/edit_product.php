<?php 
	
	$client_id = $client_data = $c_index = $c_name = $c_address = $c_nickname = $c_code = $c_contact1 = $c_contact2 = $c_remarks = NULL;
	$c_defaultproduct = 1;
	
	//var_dump($_GET);
	//var_dump($_POST);
	//var_dump($_REQUEST);
	//var_dump($GLOBALS);
	
	if(isset($_POST["productid"])){
		$product_id = $_POST['productid'];
		if($product_id > 0){
			try{
				include("functions.php");
				$product_data = get_product($product_id);
			} catch(Exception $e){
			}
		}
	}
		//$p_index = $product_data[0];
		$p_name = $product_data[1];
		$p_description = $product_data[2];
		$p_unitprice = $product_data[3];
		$p_remarks = $product_data[4];

		$form = "<form class=\"was-validated m-sm-3\" method=\"post\" action=htmlspecialchars(\$_SERVER[\"PHP_SELF\"]); id = \"edit_product_form\">";
                    
			$form .= "<div class=\"form-row\">";

				$form .= "<div class=\"col-md-2 mb-3 d-none\">";
					$form .= "<label for=\"productID\">ID</label>";
					$form .= "<input type=\"number\" class=\"form-control\" id=\"productID\" value = ".$product_id.">";
				$form .= "</div>";

				$form .= "<div class=\"col-md-4 mb-3\">";
					$form .= "<label for=\"productInputNAME\">Name</label>";
					$form .= "<input type=\"text\" class=\"form-control\" id=\"productInputNAME\" placeholder=\"Milk Toffee xxx/=\" value = ".$p_name.">";
				$form .= "</div>";

				$form .= "<div class=\"col-md-5 mb-3\">";
					$form .= "<label for=\"productInputDESCRIPTION\">Description</label>";
					$form .= "<input type=\"text\" class=\"form-control\" id=\"productInputDESCRIPTION\" placeholder=\"This is what printed on the invoice\"  value = ".$p_description.">";
				$form .= "</div>";

				$form .= "<div class=\"col-md-3 mb-3\">";
					$form .= "<label for=\"productInputUNITPRICE\">Unit Price</label>";
					$form .= "<input type=\"number\" step = \"0.01\" class=\"form-control\" id=\"productInputUNITPRICE\"  value = ".$p_unitprice.">";
				$form .= "</div>";

			$form .= "</div>";

			$form .= "<div class=\"form-row\">";

				$form .= "<div class=\"col-md-6 mb-3\">";
					$form .= "<label for=\"productInputREMARKS\">Remarks</label>";
					$form .= "<textarea class=\"form-control\" id=\"productInputREMARKS\" rows=\"3\">".$p_remarks."</textarea>";
				$form .= "</div>";

			$form .= "</div>";

			// $form .= "<div class=\"form-row\">";
			// $form .= "<div class=\"col-md-12 mb-3\">";
			// $form .= "<label for=\"productEditSelectCLIENTS\">Select Clients</label>";
			// $form .= "<select id = \"productEditSelectCLIENTS\" ";
			// $form .= "class=\"selectpicker\" ";
			// $form .= "data-width=\"100%\" ";
			// $form .= "data-live-search=\"true\" ";
			// $form .= "data-actions-box = \"true\" ";
			// $form .= "data-none-selected-text=\"Select Clients\" ";
			// $form .= "multiple data-selected-text-format=\"count > 6\" ";
			// $form .= "multiple>";
			// $result = select_clients(false);
			// 		if ($result) {
			// 			// output data of each row
			// 			while($row = $result->fetch_assoc()) {
			// 				$form .= "<option value=";
			// 				$form .= $row["id"]." ";
			// 				$form .= "data-subtext=";
			// 				$form .= $row["DISPLAY2"];
			// 				$form .= ">";
			// 				$form .= $row["DISPLAY1"];
			// 				$form .= "</option>";
			// 			}
			// 		} else {
			// 			echo "0 results";
			// 		}		
			// $form .= "</select>";
			// $form .= "</div>";
			// $form .= "</div>";

			$form .= "</form>";
		
		echo $form;
		exit;
?>