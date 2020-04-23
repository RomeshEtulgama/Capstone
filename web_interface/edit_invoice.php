<?php 
	
	$i_id = NULL;
	
	if(isset($_POST['id'])){
		$i_id = $_POST['id'];
		try{
			include("functions.php");
			$invoice_data = get_invoice($i_id);
		} catch(Exception $e){
		}
	}
		
		$r_name = $invoice_data[0];
		$o_no = $invoice_data[8];
		$o_date = $invoice_data[1];
		$c_id = $invoice_data[9];
		$qty = $invoice_data[7];
		$p_id = $invoice_data[10];

		$form = "<form class=\"was-validated m-sm-3\" method=\"post\" action=htmlspecialchars(\$_SERVER[\"PHP_SELF\"]); id = \"edit_invoice_form\">";
                    
			$form .=  "        <div class=\"form-row\">\n";
			$form .=  "\n";
			$form .=  "          <!-- edit Route -->\n";
			$form .=  "          <div class=\"form-group mr-4\">\n";
			$form .=  "            <label for=\"edit_route\">Route</label>\n";
			$form .=  "            <div class=\"input-group mb-3\">\n";
			$form .=  "              <input readonly type=\"text\" class=\"form-control\" id=\"edit_route\" autocomplete=\"off\" value=\"".$r_name."\">\n";
			$form .=  "            </div>\n";
			$form .=  "          </div>\n";
			$form .=  "\n";
			$form .=  "          <!-- edit Order No -->\n";
			$form .=  "          <div class=\"form-group col-sm-3 mr-4\">\n";
			$form .=  "            <label for=\"edit_order_no\">Order No</label>\n";
			$form .=  "            <div class=\"input-group mb-3\">\n";
			$form .=  "              <div class=\"input-group-prepend\">\n";
			$form .=  "                <span class=\"input-group-text bg-dark text-white\" id=\"edit-basic-addon3\">TST</span>\n";
			$form .=  "              </div>\n";
			$form .=  "              <input readonly type=\"number\" class=\"form-control\" id=\"edit_order_no\" aria-describedby=\"edit-basic-addon3\" autocomplete=\"off\" value=\"".$o_no."\">\n";
			$form .=  "            </div>\n";
			$form .=  "          </div>\n";
			$form .=  "\n";
			$form .=  "          <!-- edit Order Date -->\n";
			$form .=  "          <div class=\"form-group col-sm-3 mr-4\">\n";
			$form .=  "            <label for=\"edit_order_date\">Order Date</label>\n";
			$form .=  "            <input readonly autocomplete=\"off\" id=\"edit_order_date\" type=\"date\" class=\"form-control\" value=\"".$o_date."\"> \n";
			$form .=  "          </div>\n";
			$form .=  "\n";
			$form .=  "        </div>\n";
			$form .=  "\n";
			$form .=  "        <div class=\"form-row\">\n";
			$form .=  "          <div class=\"form-group mr-4\">\n";
			$form .=  "            <label for=\"edit_order_no\">Select Client</label>\n";
			$form .=  "            <div class=\"input-group mb-3\">\n";
			$form .=  "              <select name = \"edit_client_name\"  id = \"invoiceSelectCLIENT_edit\" class=\"selectpicker\" data-live-search=\"true\" data-actions-box = \"true\" data-none-selected-text=\"Select Client\"></select>\n";
			$form .=  "            </div>\n";
			$form .=  "          </div>  \n";
			$form .=  "\n";
			$form .=  "          <div class=\"form-group mr-4\">\n";
			$form .=  "            <label for=\"edit_order_no\">Select Product</label>\n";
			$form .=  "            <div class=\"input-group mb-3\">\n";
			$form .=  "              <select id = \"invoiceSelectPRODUCT_edit\" class=\"selectpicker\" data-live-search=\"true\" data-actions-box = \"true\" data-none-selected-text=\"Select Product\"></select>\n";
			$form .=  "            </div>\n";
			$form .=  "          </div>\n";
			$form .=  "\n";
			$form .=  "          <div class=\"form-group mr-4\">\n";
			$form .=  "            <label for=\"edit_order_no\">Quantity</label>\n";
			$form .=  "            <div class=\"input-group mb-3\">\n";
			$form .=  "              <input type=\"number\" class=\"form-control\" id=\"edit_quantity\" autocomplete=\"off\" value=\"".$qty."\">\n";
			$form .=  "            </div>\n";
			$form .=  "          </div>                  \n";
			$form .=  "        </div>\n";
			$form .=  "      </form>";
		
		echo $form;
		exit;
?>