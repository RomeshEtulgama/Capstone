<?php
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
?>