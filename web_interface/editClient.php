<?php 
	
	$client_id = $client_data = $c_index = $c_name = $c_address = $c_nickname = $c_code = $c_contact1 = $c_contact2 = $c_remarks = NULL;
	$c_defaultproduct = 1;
	
	//var_dump($_GET);
	//var_dump($_POST);
	//var_dump($_REQUEST);
	//var_dump($GLOBALS);
	
	if(isset($_POST["clientid"])){
		$client_id = $_POST['clientid'];
		if($client_id > 0){
			try{
				include("functions.php");
				$client_data = get_client($client_id);
			} catch(Exception $e){
				
			}
		}
	}
	// 0815629992 //
		$c_index = $client_data[0];
		$c_name = $client_data[1];
		$c_address = $client_data[2];
		$c_nickname = $client_data[3];
		$c_code = $client_data[4];
		$c_contact1 = $client_data[5];
		$c_contact2 = $client_data[6];
		$c_defaultproduct = $client_data[7];
		$c_remarks = $client_data[8];

		$form = "<form class=\"was-validated m-sm-3\" method=\"post\" action=htmlspecialchars(\$_SERVER[\"PHP_SELF\"]) id = \"edit_client_form\">";

			//	INDEX, CODE
			$form .= "<div class=\"form-row\">";
				
				//	ID - hidden
				$form .= "<div class=\"col-md-2 mb-3 d-none\">";
					$form .= "<label for=\"edit_InputID\">ID</label>";
					$form .= "<input type=\"number\" class=\"form-control\" id=\"edit_InputID\" value=".$client_id." disabled>";
				$form .= "</div>";

				//	INDEX
				$form .= "<div class=\"col-md-2 mb-3\">";
					$form .= "<label for=\"edit_InputINDEX\">Index</label>";
					$form .= "<input type=\"number\" class=\"form-control\" id=\"edit_InputINDEX\" value=".$c_index." disabled>";
				$form .= "</div>";

				//	CODE
				$form .= "<div class=\"col-md-3 mb-3\">";
					$form .= "<label for=\"edit_InputCODE\">Code No</label>";
					$form .= "<input type=\"text\" class=\"form-control\" id=\"edit_InputCODE\" value=\"".$c_code."\">";
				$form .= "</div>";

			$form .= "</div>";

			// NAME, ADDRESS, NICKNAME
			$form .= "<div class=\"form-row\">";

				//	NAME
				$form .= "<div class=\"col-md-4 mb-3\">";
					$form .= "<label for=\"InputNAME\">Name</label>";
					$form .= "<input type=\"text\" class=\"form-control\" id=\"edit_InputNAME\" placeholder=\"Mr. Romesh Bandara\" value=\"".$c_name."\">";
				$form .= "</div>";

				// ADDRESS
				$form .= "<div class=\"col-md-4 mb-3\">";
					$form .= "<label for=\"InputADDRESS\">Address</label>";
					$form .= "<input type=\"text\" class=\"form-control\" id=\"edit_InputADDRESS\" placeholder=\"Etulgama, Thalatuoya\" value=\"".$c_address."\">";
				$form .= "</div>";

				// NICKNAME
				$form .= "<div class=\"col-md-4 mb-3\">";
					$form .= "<label for=\"InputNICKNAME\">Nickname</label>";
					$form .= "<input type=\"text\" class=\"form-control\" id=\"edit_InputNICKNAME\" placeholder=\"Etulgama Romesh\" value=\"".$c_nickname."\">";
				$form .= "</div>";

			$form .= "</div>";

			// PRODUCT, CONTACT1, CONTACT2
			$form .= "<div class=\"form-row\">";

				//	PRODUCT
				$form .= "<div class=\"col-md-6 mb-3\">";
					$form .= "<label for=\"InputPRODUCT\">Default Product</label>";
					$form .= "<select class=\"custom-select is-invalid\" id=\"edit_InputPRODUCT\">";
					$result = select_products(false);
					if ($result) {
						// output data of each row
						while($row = $result->fetch_assoc()) {
							$form .= "<option value=";
							$form .= $row["id"]." ";
							if($row["id"] == $c_defaultproduct){
								$form .= "selected = \"selected\"";
							}
							$form .= ">";
							$form .= $row["Name"];
							$form .= "</option>";
						}
					} else {
						echo "0 results";
					}				

					$form .= "</select>";
				$form .= "</div>";

				//	CONTACT1
				$form .= "<div class=\"col-md-3 mb-3\">";
					$form .= "<label for=\"InputCONTACT1\">Contact 1</label>";
					$form .= "<input type=\"text\" class=\"form-control\" id=\"edit_InputCONTACT1\" value=".$c_contact1.">";
				$form .= "</div>";

				//	CONTACT2
				$form .= "<div class=\"col-md-3 mb-3\">";
					$form .= "<label for=\"InputCONTACT2\">Contact 2</label>";
					$form .= "<input type=\"text\" class=\"form-control\" id=\"edit_InputCONTACT2\" value=".$c_contact2.">";
				$form .= "</div>";       
			$form .= "</div>";

			//	REMARKS
			$form .= "<div class=\"form-row\">";
				$form .= "<div class=\"col-md-6 mb-3\">";
				$form .= "<label for=\"InputREMARKS\">Remarks</label>";
				$form .= "<textarea class=\"form-control\" id=\"edit_InputREMARKS\" rows=\"3\">".$c_remarks."</textarea>";
				$form .= "</div>";
			$form .= "</div>";
		$form .= "</form>";
		
		echo $form;
		exit;
?>