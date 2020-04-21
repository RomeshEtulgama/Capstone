<?php
function connect()
{
	$servername = "localhost";
	$username = "root";
	$password = "romesh1995";
	//000webhost db password : Romeshetulgama+1995
	$dbname = "amila_inv_db";
	//000webhost db name : id10251950_amila_inv_db

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);

	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	//echo "Connected successfully <br>";
	return $conn;
}

function disconnect($connection)
{
	$connection->close();
}

function test_input($data)
{
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

function execute_sql($sql_query)
{
	$connection = connect();
	if (!mysqli_query($connection, $sql_query)) {
		echo ("Error : " . mysqli_error($connection));
	} else {
		$connection->query($sql_query);
	}
	disconnect($connection);
}

# ------ Clients ------ #

function display_clients_table()
{

	$conn = connect();
	// sql to select table
	$sql = "select * from `clients`";

	$result = $conn->query($sql);

	if ($result) {
		echo "<thead><tr>
						<th>id</th>
						<th>Index</th>
						<th>Name</th>
						<th>Address</th>
						<th>Nickname</th>
						<th>CodeNo</th>
						<th>Contact1</th>
						<th>Contact2</th>
						<th>DefaultProduct</th>
						<th>Remarks</th>
						<th>Timestamp</th>
						<th>Enabled</th>
					</tr></thead>";
		// output data of each row
		while ($row = $result->fetch_assoc()) {
			echo "<tr>
						<td>" . $row["id"] . "</td>
						<td>" . $row["Index"] . "</td>
						<td>" . $row["Name"] . "</td>
						<td>" . $row["Address"] . "</td>
						<td>" . $row["Nickname"] . "</td>
						<td>" . $row["CodeNo"] . "</td>
						<td>" . $row["Contact1"] . "</td>
						<td>" . $row["Contact2"] . "</td>
						<td>" . $row["DefaultProduct"] . "</td>
						<td>" . $row["Remarks"] . "</td>
						<td>" . $row["Timestamp"] . "</td>
						<td>" . $row["enabled"] . "</td>
					</tr>";
		}
	} else {
		echo "0 results";
	}
	disconnect($conn);
}

function view_clients()
{
	$conn = connect();
	// sql to select table
	$sql = "call view_clients()";

	$result = $conn->query($sql);

	$table_data = "";

	if ($result) {
		$table_data .= "<thead><tr>
						<th class=\"text-center\">ID</th>
						<th>Name</th>
						<th>Address</th>
						<th>Nickname</th>
						<th style=\"display : none\">CodeNo</th>
						<th>Contacts</th>
						<th>DefaultProduct</th>
						<th>Remarks</th>
						<th class=\"text-center\">Actions</th>
					</tr></thead>";
		// output data of each row
		while ($row = $result->fetch_assoc()) {
			$table_data .= "<tr>
						<td class=\"text-center\">" . $row["Index"] . "</td>
						<td>" . $row["Name"] . "</td>
						<td>" . $row["Address"] . "</td>
						<td>" . $row["Nickname"] . "</td>
						<td style=\"display : none\">" . $row["CodeNo"] . "</td>
						<td>" . $row["Contact1"] . "\n" . $row["Contact2"] . "</td>
						<td>" . $row["DefaultProduct"] . "</td>
						<td>" . $row["Remarks"] . "</td>
						<td class=\"text-center\" >
							<form method=\"post\">
								<button type=\"button\" class=\"btn btn-danger btn-sm\" name=\"delete\" data-toggle=\"modal\" data-target=\"#deleteClientModal\" 
								data-whatever=\"" . $row["id"] . "\">Delete
								</button>
								<button type=\"button\" class=\"btn btn-warning btn-sm\" name=\"edit\" data-toggle=\"modal\" data-target=\"#editClientModal\" 
								data-whatever=\"" . $row["id"] . "\"> Edit
								</button>
							</form>
						</td> 
					</tr>";
		}
		return $table_data;
	} else {
		echo "0 results";
	}
	disconnect($conn);
}

function select_enabled_clients()
{
	$conn = connect();
	// sql to select table
	$sql = "SELECT id, `Index`, Name, Address, Nickname, Remarks FROM clients WHERE enabled=1;";

	$result = $conn->query($sql);

	if ($result) {
		// output data of each row
		while ($row = $result->fetch_assoc()) {
			echo "<option value=" . $row["id"] . ">" . $row["Index"] . "&emsp;" . $row["Name"] . "&emsp;" . $row["Address"] . "&emsp;" . $row["Nickname"] . "&emsp;" . $row["Remarks"] . "</option>";
		}
	} else {
		echo "0 results";
	}
	disconnect($conn);
}

function select_disabled_clients()
{
	$conn = connect();
	// sql to select table
	$sql = "SELECT id, `Index`, Name, Address, Nickname, Remarks FROM clients WHERE enabled=0;";

	$result = $conn->query($sql);

	if ($result) {
		// output data of each row
		while ($row = $result->fetch_assoc()) {
			echo "<option value=" . $row["id"] . ">" . $row["Index"] . "&emsp;" . $row["Name"] . "&emsp;" . $row["Address"] . "&emsp;" . $row["Nickname"] . "&emsp;" . $row["Remarks"] . "</option>";
		}
	} else {
		echo "0 results";
	}
	disconnect($conn);
}

function select_products($full_mode = false, $select_product = 0)
{
	$conn = connect();
	// sql to select table
	$sql = "SELECT id, Name FROM products WHERE enabled=1 ORDER BY id ASC;";

	$result = $conn->query($sql);

	if ($full_mode == false) {
		return $result;
	} else {
		// output data of each row
		while ($row = $result->fetch_assoc()) {
			$option = "<option value=";
			$option .= $row["id"] . " ";
			if($select_product == $row["id"]){
				$option .= "selected";
			}
			$option .= ">";
			$option .= $row["Name"];
			$option .= "</option>";
			echo $option;
		}
	}

	disconnect($conn);
}

function add_client($c_index, $c_name, $c_address, $c_nickname, $c_code, $c_contact1, $c_contact2, $c_defaultproduct, $c_remarks)
{
	if (strlen($c_name) >= 5) {
		$sql = "call add_client('$c_index', '$c_name', '$c_address', '$c_nickname', '$c_code','$c_contact1', '$c_contact2', '$c_defaultproduct', '$c_remarks');";
		execute_sql($sql);
	}
}

function get_client($id)
{
	if ($id != NULL) {
		$conn = connect();
		$sql = "select * from `clients` where (id=" . $id . ");";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		disconnect($conn);
		return array($row["Index"], $row["Name"], $row["Address"], $row["Nickname"], $row["CodeNo"], $row["Contact1"], $row["Contact2"], $row["DefaultProduct"], $row["Remarks"], $row["Timestamp"], $row["enabled"]);
		//return $row["Name"];
	}
}

function get_outstanding($client_id){
	return "14.25";
}

function remove_client($id)
{
	execute_sql("call remove_client('" . $id . "');");
}

function enable_client($id)
{
	execute_sql("call enable_client('" . $id . "');");
}

function edit_client($c_id, $c_index, $c_name, $c_address, $c_nickname, $c_code, $c_contact1, $c_contact2, $c_defaultproduct, $c_remarks)
{
	if (strlen($c_name) >= 5) {
		$sql = "call edit_client('$c_id', '$c_index', '$c_name', '$c_address', '$c_nickname', '$c_code','$c_contact1', '$c_contact2', '$c_defaultproduct', '$c_remarks');";
		execute_sql($sql);
	}
}

# ------ Products ------ #

function view_products()
{
	$conn = connect();
	// sql to select table
	$sql = "call view_products()";

	$result = $conn->query($sql);

	$table_data = "";

	if ($result) {
		$table_data .= "<thead><tr>
						<th class=\"text-center\">ID</th>
						<th>Name</th>
						<th>Description</th>
						<th class=\"text-center\">Unit Price (LKR)</th>
						<th>Remarks</th>
						<th class=\"text-center\">Actions</th>
					</tr></thead>";
		// output data of each row
		while ($row = $result->fetch_assoc()) {
			$table_data .= "<tr>
		        		<td class=\"text-center\">" . $row["Index"] . "</td>
		        		<td>" . $row["Name"] . "</td>
		        		<td>" . $row["Description"] . "</td>
		        		<td class=\"text-right\" style=\"padding-right :5%\">" . $row["UnitPrice"] . "</td>
		        		<td>" . $row["Remarks"] . "</td>
		        		<td class=\"text-center\">
		        			<form method=\"post\">
								<button type=\"button\" class=\"btn btn-danger btn-sm\" name=\"delete\" data-toggle=\"modal\" data-target=\"#deleteProductModal\" 
								data-whatever=\"" . $row["id"] . "\">Delete
								</button>
							</form>
						</td> 
					</tr>";
					
					// ----------- Removed Edit Product Button - Editing products causes Logical Errors ------------ //
					// <button type=\"button\" class=\"btn btn-warning btn-sm\" name=\"edit_product\" data-toggle=\"modal\" data-target=\"#editProductModal\" 
					// data-whatever=\"" . $row["id"] . "\"> Edit
					// </button>

			// if(isset($_POST["delete_product".$row["id"]])) { 
			//     remove_product($row["id"]) ; 
			// }
		}
		return $table_data;
	} else {
		echo "0 results";
	}
	disconnect($conn);
}

function select_clients($full_mode = false)
{
	$conn = connect();
	// sql to select table
	$sql = "CALL get_clients()";

	$result = $conn->query($sql);

	if ($full_mode == false) {
		return $result;
	} else {
		// output data of each row
		while ($row = $result->fetch_assoc()) {
			$option = "<option value=";
			$option .= $row["id"] . " ";
			$option .= "data-subtext=";
			$option .= $row["DISPLAY2"];
			$option .= ">";
			$option .= $row["DISPLAY1"];
			$option .= "</option>";
			echo $option;
			// echo json_encode($option);
		}
	}

	disconnect($conn);
}

function add_product($p_index, $p_name, $p_description, $p_unitprice, $p_remarks, $p_clients)
{

	$p_id = null;

	if (strlen($p_name) >= 5) {
		$sql = "call add_product(0, '$p_name', '$p_description', '$p_unitprice', '$p_remarks');";
		execute_sql($sql);

		$p_id = 0;

		$conn = connect();
		// sql to select table
		$sql = "select max(id) as 'LAST_ID' from products;";

		$result = $conn->query($sql);

		if ($result) {
			while ($row = $result->fetch_assoc()) {
				$p_id = $row["LAST_ID"];
			}
		}
		disconnect($conn);

		if($p_clients != ""){
			foreach ($p_clients as $c_id) {
				$sql = "call update_DefaultProduct($c_id, $p_id);";
				execute_sql($sql);
			}
		}
	}
}

function edit_product($c_id, $c_name, $c_description, $c_unitprice, $c_remarks)
{
	if (strlen($c_name) >= 1) {
		$sql = "call edit_product('$c_id', '$c_name', '$c_description', '$c_unitprice', '$c_remarks');";
		// make edit product procedure in sql !!!!!!!!!!!!!!!!!!!!!
		execute_sql($sql);
	}
}

function get_product($id)
{
	if ($id != NULL) {
		$conn = connect();
		$sql = "select * from `products` where (id=" . $id . ");";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		disconnect($conn);
		return array($row["Index"], $row["Name"], $row["Description"], $row["UnitPrice"], $row["Remarks"], $row["Timestamp"]);
		//return $row["Name"];
	}
}

function remove_product($id)
{
	execute_sql("call remove_product('" . $id . "');");
}

# ------ Routes ------ #
function get_routes()
{
	$conn = connect();
	// sql to select table
	$sql = "call get_routes()";

	$result = $conn->query($sql);

	$radio = "";
	$radio_checked = "checked";
	if($result) {
		while ($row = $result->fetch_assoc()) {
			$radio .= "<label class=\"btn btn-secondary\" style=\"max-width : 100px\">\n";
			$radio .= "<input type=\"radio\" name=\"".$row["id"]."\" id=\"routes-radio\" ".$radio_checked." value=\"".$row["Acronym"]."\"> ".$row["Name"]."\n";
			$radio .= "</label>";
			$radio_checked = "";
		}
	} else {
		echo "0 results";
	}
	$radio .= "<label id=\"new-route-btn\"class=\"btn btn-dark col-sm-2\" style=\"max-width : 120px\">\n";
	$radio .= "<input type=\"radio\" name=\"new\" id=\"routes-radio\" " . $radio_checked . " value=\"new\" >Add Route\n";
	$radio .= "</label>";
	return $radio;
	
	disconnect($conn);
}

function view_orders()
{
	$conn = connect();
	// sql to select table
	$sql = "call view_orders()";

	$result = $conn->query($sql);

	$table_data = "";

	if ($result) {
		$table_data .= "<thead><tr>
						<th class=\"text-center\">Serial No</th>
						<th>Route</th>
						<th>Order No</th>
						<th>Trip No</th>
						<th>Client Name</th>
						<th>Client Address</th>
						<th>Product Name</th>
						<th>Quantity</th>
					</tr></thead>";
		// output data of each row
		while ($row = $result->fetch_assoc()) {
			$table_data .= "<tr>
						<td class=\"text-center\">" . $row["SerialNo"] . "</td>
						<td>" . $row["Acronym"] . "</td>
						<td>" . $row["OrdNo"] . "</td>
						<td>" . $row["trip_no"] . "</td>
						<td>" . $row["c_name"] . "</td>
						<td>" . $row["Address"] . "</td>
						<td>" . $row["p_name"] . "</td>
						<td>" . $row["quantity"] . "</td>
					</tr>";
		}
		return $table_data;
	} else {
		echo "0 results";
	}
	disconnect($conn);
}

function calculate_amount($quantity, $p_id){
	$amount = 0;
	try {
		$amount = $quantity * get_product($p_id)[3];
	} catch(Exception $e) {
		$amount = 0;
	}
	echo number_format($amount, 2, '.', ',');
		
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (isset($_POST["sub"])) {

		//	add client form
		if ($_POST["sub"] == "add_client_form") {
			$index = $name = $address = $nickname = $code = $contact1 = $contact2 = $defaultproduct = $remarks = NULL;
			$index = $_POST["sub_index"];
			$name = $_POST["sub_name"];
			$address = $_POST["sub_address"];
			$nickname = $_POST["sub_nickname"];
			$code = $_POST["sub_code"];
			$contact1 = $_POST["sub_contact1"];
			$contact2 = $_POST["sub_contact2"];
			$defaultproduct = $_POST["sub_defaultproduct"];
			$remarks = $_POST["sub_remarks"];

			add_client($index, $name, $address, $nickname, $code, $contact1, $contact2, $defaultproduct, $remarks);
		}

		//	edit client form
		if ($_POST["sub"] == "edit_client_form") {
			$id = $index = $name = $address = $nickname = $code = $contact1 = $contact2 = $defaultproduct = $remarks = NULL;
			$id = $_POST["sub_id"];
			$index = $_POST["sub_index"];
			$name = $_POST["sub_name"];
			$address = $_POST["sub_address"];
			$nickname = $_POST["sub_nickname"];
			$code = $_POST["sub_code"];
			$contact1 = $_POST["sub_contact1"];
			$contact2 = $_POST["sub_contact2"];
			$defaultproduct = $_POST["sub_defaultproduct"];
			$remarks = $_POST["sub_remarks"];

			edit_client($id, $index, $name, $address, $nickname, $code, $contact1, $contact2, $defaultproduct, $remarks);
		}

		// delete client
		if ($_POST["sub"] == "delete_client") {
			$id = NULL;
			$id = $_POST["sub_id"];

			remove_client($id);
		}

		//	add product form
		if ($_POST["sub"] == "add_product_form") {
			$index = $name = $description = $unitprice = $remarks = $clients = NULL;
			$index = $_POST["sub_index"];
			$name = $_POST["sub_name"];
			$description = $_POST["sub_description"];
			$unitprice = $_POST["sub_unitprice"];
			$remarks = $_POST["sub_remarks"];
			$clients = $_POST["sub_clients"];

			add_product($index, $name, $description, $unitprice, $remarks, $clients);
		}

		//	edit product form
		if ($_POST["sub"] == "edit_product_form") {
			$id = $index = $name = $address = $nickname = $code = $contact1 = $contact2 = $defaultproduct = $remarks = NULL;
			$id = $_POST["sub_id"];
			$name = $_POST["sub_name"];
			$description = $_POST["sub_description"];
			$unitprice = $_POST["sub_unitprice"];
			$remarks = $_POST["sub_remarks"];
			edit_product($id, $name, $description, $unitprice, $remarks);
		}

		// delete product
		if ($_POST["sub"] == "delete_product") {
			$id = NULL;
			$id = $_POST["sub_id"];

			remove_product($id);
		}

		// add order
		if ($_POST["sub"] == "add_order_form") {
			$data = $_POST["sub_data"];
			// echo '<pre>'; print_r($data); echo '</pre>';
			$route_id = $data[0][0];
			$order_no = $data[0][1];
			$order_date = $data[0][2];
			$order_remarks = $data[0][3];
			//header("Location: index.php?message=User name or Email id already exists.");
			// echo "----------------data[1]----------------";
			// echo '<pre>'; print_r($data[1]); echo '</pre>';
			// echo "----------------count(data[1])----------------";

			$conn = connect();
			$sql = "call add_order(".$route_id.",\"".$order_date."\",".$order_no.",\"".$order_remarks."\",@o_id);\n";
			// echo $sql."\n";
			$conn->query($sql);
			$sql = "SELECT @o_id as o_id";
			$o_id = 0;
			$result = $conn->query($sql);
			if($result) {
				$row = $result->fetch_assoc();
				$o_id = $row["o_id"];
				// echo "o_id : ".$o_id."\n"; 
			}
			for ($i=0, $len=count($data[1]); $i<$len; $i++) {
				$c_id = $data[1][$i][0];
				$qty = $data[1][$i][1];
				$p_id = $data[1][$i][2];
				
				if($o_id > 0){
					$sql = "call add_trip(".$o_id.",".$c_id.",@t_id);\n";
					// echo $sql."\n";
					$conn->query($sql);
					$sql = "SELECT @t_id as t_id";
					$t_id = 0;
					$result = $conn->query($sql);
					if($result) {
						$row = $result->fetch_assoc();
						$t_id = $row["t_id"];
						// echo "t_id : ".$t_id."\n"; 
					}
					if($t_id > 0){
						$sql = "call add_invoice(".$p_id.",".$qty.",".$t_id.");";
						// echo $sql."\n";
						$result = $conn->query($sql);
					}
				}
			}

		}
	}
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
	if (isset($_REQUEST["q"])) {
		$populate_request = $_REQUEST["q"];
		$table_data = "";
		if ($populate_request == "active_clients_table") {
			$table_data = view_clients();
			echo $table_data === "" ? "Error" : $table_data;
		} elseif ($populate_request == "products_table") {
			$table_data = view_products();
			echo $table_data === "" ? "Error" : $table_data;
		} elseif ($populate_request == "routes_radio") {
			$tab_data = get_routes();
			echo $tab_data == "" ? "Error" : $tab_data;
		} elseif (substr($populate_request, 0, 19)  == "invoiceSelectCLIENT") {
			$select_data = select_clients(true);
			echo $select_data == "" ? "" : $select_data;
		} elseif (substr($populate_request, 0, 20) == "invoiceSelectPRODUCT") {
			if (isset($_REQUEST["select"])) {
				$p_id = get_client($_REQUEST["select"])[7];
				$select_data = select_products(true, $p_id);
			} else {
				$select_data = select_products(true);
			}
			echo $select_data == "" ? "" : $select_data;
		} elseif ($populate_request == "calculate_amount") {
			$quantity = $_REQUEST["quantity"];
			$p_id = $_REQUEST["product_id"];
			if($quantity != 'NaN' && $p_id != 'Nan'){
				calculate_amount($quantity, $p_id);
				// echo "0.00";
			} else {
				echo "0.00";
			}
		} elseif ($populate_request  == "get_unit_price") {
			$p_id = $_REQUEST["product_id"];
			$unitprice = get_product($p_id)[3];
			echo $unitprice == "" ? "" : $unitprice;
		} elseif ($populate_request  == "get_total_outstanding") {
			$c_id = $_REQUEST["client_id"];
			$outstanding = get_outstanding($c_id);
			echo $outstanding == "" ? "" : $outstanding;
		} elseif ($populate_request  == "orders_table") {
			$table_data = view_orders();
			echo $table_data === "" ? "Error" : $table_data;
		}
	}
}
