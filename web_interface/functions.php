<?php
	function connect(){
		$servername = "localhost";
		$username = "root";
		$password = "romesh1995";
		$dbname = "amila_inv_db";

		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);

		// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		}
		//echo "Connected successfully <br>";
		return $conn;
	}

	function disconnect( $connection){
		$connection->close();
	}

	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	function execute_sql($sql_query){
		$connection = connect();
		if (!mysqli_query($connection, $sql_query)){
			echo ("Error : " . mysqli_error($connection));
		} else {
			$connection->query($sql_query);
			
		}
		disconnect($connection);
	}

	# ------ Clients ------ #

	function display_clients_table(){
		
		$conn = connect();
		// sql to select table
		$sql = "select * from `clients`";

		$result = $conn->query($sql);

		if ($result) {
			echo "<tr>
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
					</tr>";
			// output data of each row
			while($row = $result->fetch_assoc()) {
				echo "<tr>
						<td>" . $row["id"]. "</td>
						<td>" . $row["Index"]. "</td>
						<td>" . $row["Name"]. "</td>
						<td>" . $row["Address"]. "</td>
						<td>" . $row["Nickname"]. "</td>
						<td>" . $row["CodeNo"]. "</td>
						<td>" . $row["Contact1"]. "</td>
						<td>" . $row["Contact2"]. "</td>
						<td>" . $row["DefaultProduct"]. "</td>
						<td>" . $row["Remarks"]. "</td>
						<td>" . $row["Timestamp"]. "</td>
						<td>" . $row["enabled"]. "</td>
					</tr>";
			}
		} else {
			echo "0 results";
		}
		disconnect($conn);
	}

	function view_clients(){
		$conn = connect();
		// sql to select table
		$sql = "call view_clients()";

		$result = $conn->query($sql);

		if ($result) {
			echo "<tr>
						<th class=\"text-center\">Index</th>
						<th>Name</th>
						<th>Address</th>
						<th>Nickname</th>
						<th>CodeNo</th>
						<th>Contact1</th>
						<th>Contact2</th>
						<th>DefaultProduct</th>
						<th>Remarks</th>
						<th>Actions</th>
					</tr>";
			// output data of each row
			while($row = $result->fetch_assoc()) {
				echo "<tr>
						<td class=\"text-center\">" . $row["Index"]. "</td>
						<td>" . $row["Name"]. "</td>
						<td>" . $row["Address"]. "</td>
						<td>" . $row["Nickname"]. "</td>
						<td>" . $row["CodeNo"]. "</td>
						<td>" . $row["Contact1"]. "</td>
						<td>" . $row["Contact2"]. "</td>
						<td>" . $row["DefaultProduct"]. "</td>
						<td>" . $row["Remarks"]. "</td>
						<td>
							<form method=\"post\">
								<button type=\"submit\" class=\"btn btn-danger btn-sm\" name=\"delete".$row["id"]. "\">Delete
								</button>
								<button type=\"button\" class=\"btn btn-warning btn-sm\" name=\"edit\" data-toggle=\"modal\" data-target=\"#editClientModel\" 
								data-whatever=\"".$row["id"]."\"> Edit
								</button>
							</form>
						</td> 
					</tr>";
				if(isset($_POST["delete".$row["id"]])) { 
					remove_client($row["id"]) ; 
				}
			}
		} else {
			echo "0 results";
		}
		disconnect($conn);
	}

	function select_enabled_clients(){
		$conn = connect();
		// sql to select table
		$sql = "SELECT id, `Index`, Name, Address, Nickname, Remarks FROM clients WHERE enabled=1;";

		$result = $conn->query($sql);

		if ($result) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
				echo "<option value=" .$row["id"].">" . $row["Index"]. "&emsp;" . $row["Name"]. "&emsp;" . $row["Address"]. "&emsp;" . $row["Nickname"]. "&emsp;" . $row["Remarks"]. "</option>";
			}
		} else {
			echo "0 results";
		}
		disconnect($conn);
	}

	function select_disabled_clients(){
		$conn = connect();
		// sql to select table
		$sql = "SELECT id, `Index`, Name, Address, Nickname, Remarks FROM clients WHERE enabled=0;";

		$result = $conn->query($sql);

		if ($result) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
				echo "<option value=" .$row["id"].">" . $row["Index"]. "&emsp;" . $row["Name"]. "&emsp;" . $row["Address"]. "&emsp;" . $row["Nickname"]. "&emsp;" . $row["Remarks"]. "</option>";
			}
		} else {
			echo "0 results";
		}
		disconnect($conn);
	}

	function select_products($full_mode = false){
		$conn = connect();
		// sql to select table
		$sql = "SELECT id, Name FROM products ORDER BY id ASC;";

		$result = $conn->query($sql);

		if($full_mode == false){
			return $result;
		} else {
			// output data of each row
			while($row = $result->fetch_assoc()) {
				$option = "<option value=";
				$option .= $row["id"]." ";
				$option .= ">";
				$option .= $row["Name"];
				$option .= "</option>";
				echo $option;
			}
		}

		disconnect($conn);
	
	}

	function add_client($c_index, $c_name, $c_address, $c_nickname, $c_code, $c_contact1, $c_contact2, $c_defaultproduct, $c_remarks){
		if(strlen($c_name) >= 5 ){
			$sql = "call add_client('$c_index', '$c_name', '$c_address', '$c_nickname', '$c_code','$c_contact1', '$c_contact2', '$c_defaultproduct', '$c_remarks');";
			execute_sql($sql);
		}
	}

	function get_client($id){
		if($id != NULL){
			$conn = connect();
			$sql = "select * from `clients` where (id=".$id.");";
			$result = $conn->query($sql);
			$row = $result->fetch_assoc();
			disconnect($conn);
			return array($row["Index"], $row["Name"], $row["Address"], $row["Nickname"], $row["CodeNo"], $row["Contact1"], $row["Contact2"], $row["DefaultProduct"], $row["Remarks"], $row["Timestamp"], $row["enabled"]);
		//return $row["Name"];
		}
	}

	function remove_client($id){
		execute_sql("call remove_client('" . $id . "');");
	}

	function enable_client($id){
		execute_sql("call enable_client('" . $id . "');");
	}

	function edit_client($c_id, $c_index, $c_name, $c_address, $c_nickname, $c_code, $c_contact1, $c_contact2, $c_defaultproduct, $c_remarks){
		if(strlen($c_name) >= 5 ){
			$sql = "call edit_client('$c_id', '$c_index', '$c_name', '$c_address', '$c_nickname', '$c_code','$c_contact1', '$c_contact2', '$c_defaultproduct', '$c_remarks');";
			execute_sql($sql);
		}
	}	

	# ------ Products ------ #

	function view_products(){
		$conn = connect();
		// sql to select table
		$sql = "call view_products()";

		$result = $conn->query($sql);

		if ($result) {
			echo "<tr>
						<th class=\"text-center\">Index</th>
						<th>Name</th>
						<th>Description</th>
						<th>Unit Price (LKR)</th>
						<th>Remarks</th>
						<th>Actions</th>
					</tr>";
		    // output data of each row
		    while($row = $result->fetch_assoc()) {
		        echo "<tr>
		        		<td class=\"text-center\">" . $row["Index"]. "</td>
		        		<td>" . $row["Name"]. "</td>
		        		<td>" . $row["Description"]. "</td>
		        		<td>" . $row["UnitPrice"]. "</td>
		        		<td>" . $row["Remarks"]. "</td>
		        		<td>
		        			<form method=\"post\">
			        			<button type=\"submit\" class=\"btn btn-danger btn-sm\" name=\"delete_product".$row["id"]. "\">Delete
								</button>
								<button type=\"button\" class=\"btn btn-warning btn-sm\" name=\"edit_product\" data-toggle=\"modal\" data-target=\"#editProductModel\" 
								data-whatever=\"".$row["id"]."\"> Edit
								</button>
							</form>
						</td> 
		        	</tr>";
		        if(isset($_POST["delete_product".$row["id"]])) { 
		            remove_product($row["id"]) ; 
		        }
	    	}
	    } else {
		    echo "0 results";
		}
		disconnect($conn);
	}

	function select_clients($full_mode = false){
		$conn = connect();
		// sql to select table
		$sql = "CALL get_clients()";

		$result = $conn->query($sql);

		if($full_mode == false){
			return $result;
		} else {
			// output data of each row
			while($row = $result->fetch_assoc()) {
				$option = "<option value=";
				$option .= $row["id"]." ";
				$option .= "data-subtext=";
				$option .= $row["DISPLAY2"];
				$option .= ">";
				$option .= $row["DISPLAY1"];
				$option .= "</option>";
				echo $option;
			}
		}

		disconnect($conn);
	
	}

	function add_product($p_index, $p_name, $p_description, $p_unitprice, $p_remarks, $p_clients){
	
		$p_id = null;

		if(strlen($p_name) >= 5 ){
			$sql = "call add_product('$p_index', '$p_name', '$p_description', '$p_unitprice', '$p_remarks');";
			execute_sql($sql);

			$p_id = 0;

			$conn = connect();
			// sql to select table
			$sql = "select max(id) as 'LAST_ID' from products;";

			$result = $conn->query($sql);

			if($result){
				while($row = $result->fetch_assoc()){
					$p_id = $row["LAST_ID"];
				}
			}

			foreach ($p_clients as $c_id){
				$sql = "call update_DefaultProduct($c_id, $p_id);";
				execute_sql($sql);
			}
		}
	}

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if(isset($_POST["sub"])){

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
		}
	}

	function remove_product($id){
		execute_sql("call remove_product('" . $id . "');");
	}
?>