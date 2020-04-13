// Client

function submitAddClientForm() {
  var index = $('#InputINDEX').val();
  var name = $('#InputNAME').val();
  var address = $('#InputADDRESS').val();
  var nickname = $('#InputNICKNAME').val();
  var code = $('#InputCODE').val();
  var contact1 = $('#InputCONTACT1').val();
  var contact2 = $('#InputCONTACT2').val();
  var defaultproduct = $('#InputPRODUCT').val();
  var remarks = $('#InputREMARKS').val();

  if (name.trim() == '') {
    alert('Please enter client name.');
    $('#InputNAME').focus();
    return false;
  } else if (address.trim() == '') {
    alert('Please enter client address.');
    $('#InputADDRESS').focus();
    return false;
  } else {

    $.post("./functions.php", {
      sub: "add_client_form",
      sub_index: index,
      sub_name: name,
      sub_address: address,
      sub_nickname: nickname,
      sub_code: code,
      sub_contact1: contact1,
      sub_contact2: contact2,
      sub_defaultproduct: defaultproduct,
      sub_remarks: remarks
    });
  }
}

function submitEditClientForm() {
  var id = $('#edit_InputID').val();
  var index = $('#edit_InputINDEX').val();
  var name = $('#edit_InputNAME').val();
  var address = $('#edit_InputADDRESS').val();
  var nickname = $('#edit_InputNICKNAME').val();
  var code = $('#edit_InputCODE').val();
  var contact1 = $('#edit_InputCONTACT1').val();
  var contact2 = $('#edit_InputCONTACT2').val();
  var defaultproduct = $('#edit_InputPRODUCT').val();
  var remarks = $('#edit_InputREMARKS').val();

  if (name.trim() == '') {
    alert('Please enter client name.');
    $('#edit_InputNAME').focus();
    return false;
  } else if (address.trim() == '') {
    alert('Please enter client address.');
    $('#edit_InputADDRESS').focus();
    return false;
  } else {

    $.post("./functions.php", {
      sub: "edit_client_form",
      sub_id: id,
      sub_index: index,
      sub_name: name,
      sub_address: address,
      sub_nickname: nickname,
      sub_code: code,
      sub_contact1: contact1,
      sub_contact2: contact2,
      sub_defaultproduct: defaultproduct,
      sub_remarks: remarks
    });
  }
}

function deleteClient(id) {
  $.post("./functions.php", {
    sub: "delete_client",
    sub_id: id
  });
}

// Products

function submitAddProductForm() {
  var index = $('#productInputINDEX').val();
  var name = $('#productInputNAME').val();
  var description = $('#productInputDESCRIPTION').val();
  var unitprice = $('#productInputUNITPRICE').val();
  var remarks = $('#productInputREMARKS').val();
  var clients = $('#productSelectCLIENTS').val();

  if (name.trim() == '') {
    alert('Please enter product name.');
    $('#productInputINDEX').focus();
    return false;
  } else if (description.trim() == '') {
    alert('Please enter description address.');
    $('#productInputDESCRIPTION').focus();
    return false;
  } else {
    $.post("./functions.php", {
      sub: "add_product_form",
      sub_index: index,
      sub_name: name,
      sub_description: description,
      sub_unitprice: unitprice,
      sub_remarks: remarks,
      sub_clients: clients
    });
  }
}

function submitEditProductForm() {
  var id = $('#productID').val();
  var name = $('#productInputNAME').val();
  var description = $('#productInputDESCRIPTION').val();
  var unitprice = $('#productInputUNITPRICE').val();
  var remarks = $('#productInputREMARKS').val();

  if (name.trim() == '') {
    alert('Please enter product name.');
    $('#edit_InputNAME').focus();
    return false;
  } else if (description.trim() == '') {
    alert('Please enter product description.');
    $('#productInputDESCRIPTION').focus();
    return false;
  } else {

    $.post("./functions.php", {
      sub: "edit_product_form",
      sub_id: id,
      sub_name: name,
      sub_description: description,
      sub_unitprice: unitprice,
      sub_remarks: remarks
    });
  }
}

function deleteProduct(id) {
  $.post("./functions.php", {
    sub: "delete_product",
    sub_id: id
  });
}

function filter_table(userInput, filtering_table, num_of_columns) {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById(userInput);
  filter = input.value.toUpperCase();
  table = document.getElementById(filtering_table);
  tr = table.getElementsByTagName("tr");
  //th = table.getElementsByTagName("th");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 1; i < tr.length; i++) {
    tr[i].style.display = "none";
  }

  for (j = 0; j < num_of_columns; j++) {
    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[j];
      if (td) {
        txtValue = td.textContent || td.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
        }
      }
    }
  }
}

// Invoice Table
function populate_select_field(str){
  var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById(str).innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "functions.php?q="+str, true);
        xmlhttp.send(); 
}

function select_product($id){
  alert("select");
}

function add_row() {

  var t = $('#invoices_table').DataTable();
  var counter = t.rows().count() + 1;
  // onchange=\"select_product(" + counter + ")\"
  // onchange=\"calculate_amount()\"
  // onchange=\"calculate_amount(" + counter + ")\"
  // Client Name Field
  no_field = "<label style=\"display: block; text-align: center;\" >"+String(counter)+"</label>";
  client_name_field = "<select id = \"invoiceSelectCLIENT_" + String(counter) + "\" class=\"selectpicker\" data-width=\"100%\" data-live-search=\"true\" data-actions-box = \"true\" data-none-selected-text=\"Select Client\" ></select>"; 
  quantity_field = "<input id = \"inviceQUANTITY_" + String(counter) + "\" type=\"text\" class=\"typeahead form-control table-cell bg-dark text-white\" style=\"border : 0px\" autocomplete=\"off\" spellcheck=\"false\" value=\"25\" >";
  product_field = "<select id = \"invoiceSelectPRODUCT_" + String(counter) + "\" class=\"selectpicker\" data-width=\"100%\" data-live-search=\"true\" data-actions-box = \"true\" data-none-selected-text=\"Select Product\" ></select> ";
  amount_field = "<input readonly id = \"invoiceAMOUNT_" + String(counter) + "\" class=\"table-cell bg-dark text-white\" value=0 style=\"text-align: right\">";
  total_outstanding_field = "<input readonly id = \"invoiceOUTSTANDING_" + String(counter) + "\" class=\"table-cell bg-dark text-white\"  value=1467258.0 style=\"text-align: right\">";

  t.row.add([
    no_field,
    client_name_field,
    quantity_field,
    product_field,
    amount_field,
    total_outstanding_field
  ]).draw(false);

  populate_select_field("invoiceSelectCLIENT_" + String(counter));
  populate_select_field("invoiceSelectPRODUCT_" + String(counter));

  // (".selectpicker").selectpicker().selectpicker("render");

}

// Populate a table using ajax
function Populate_table(str) {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById(str).innerHTML = this.responseText;
    }
  };
  xmlhttp.open("GET", "functions.php?q=" + str, true);
  xmlhttp.send();
  refresh_datatable(str);
}

function refresh_datatable(str) {
  try {
    $('#' + str).DataTable().destroy();
    setTimeout(() => {
      $('#' + str).DataTable({
        "searching": false
      });
    }, 100);
  } catch (Exception) {
  }
}


$(document).ready(function () {

  // --------------- Clients ---------------//

  $('#editClientModal').on('show.bs.modal', function (event) {

    //alert('The modal is about to be shown.');

    var button = $(event.relatedTarget); // Button that triggered the modal
    var client_id = button.data('whatever'); // Extract info from data-* attributes
    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    //var modal = $(this);
    //modal.find('#InputID').val(client_id);

    // AJAX request
    $.ajax({
      url: './edit_client.php',
      type: 'POST',
      data: { clientid: client_id },
      //contentType: "text/plain",
      success: function (response) { //we got the response
        //alert('Successfully called');
        $('.editform-modal-body').html(response);
      },
      error: function (jqxhr, status, exception) {
        alert('Exception:', exception);
      }
    });
    //});
  });

  $('#editClientModal').on('hidden.bs.modal', function (event) {
    Populate_table("active_clients_table");
  });

  $('#deleteClientModal').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget); // Button that triggered the modal
    var client_id = button.data('whatever'); // Extract info from data-* attributes
    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    //var modal = $(this);
    //modal.find('#InputID').val(client_id);
    var footer = "<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">No</button>";
    footer += "<button type=\"submit\" class=\"btn btn-primary submitBtn\" data-toggle=\"modal\" data-target=\"#deleteClientModal\" onclick=\"deleteClient(" + client_id + ")\">Yes</button>";


    // AJAX request
    $.ajax({
      url: './confirm_delete.php',
      type: 'POST',
      data: { type: "client", id: client_id },
      //contentType: "text/plain",
      success: function (response) { //we got the response
        //alert('Successfully called');
        $('.delete-client-modal-body').html(response);

        $('.delete-client-modal-footer').html(footer);
      },
      error: function (jqxhr, status, exception) {
        alert('Exception:', exception);
      }
    });
    //});
  });

  $('#deleteClientModal').on('hidden.bs.modal', function (event) {
    Populate_table("active_clients_table");
  });

  $('#addClientModal').on('hidden.bs.modal', function (event) {
    Populate_table("active_clients_table");
  });

  // --------------- Products ---------------//

  $('#editProductModal').on('show.bs.modal', function (event) {

    //alert('The modal is about to be shown.');

    var button = $(event.relatedTarget); // Button that triggered the modal
    var product_id = button.data('whatever'); // Extract info from data-* attributes
    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    //var modal = $(this);
    //modal.find('#InputID').val(client_id);

    // AJAX request
    $.ajax({
      url: './edit_product.php',
      type: 'POST',
      data: { productid: product_id },
      //contentType: "text/plain",
      success: function (response) { //we got the response
        //alert('Successfully called');
        $('.editproductform-modal-body').html(response);
      },
      error: function (jqxhr, status, exception) {
        alert('Exception:', exception);
      }
    });
    //});
  });

  $('#editProductModal').on('hidden.bs.modal', function (event) {
    Populate_table("active_clients_table");
    Populate_table("products_table");
  });

  $('#deleteProductModal').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget); // Button that triggered the modal
    var product_id = button.data('whatever'); // Extract info from data-* attributes
    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    //var modal = $(this);
    //modal.find('#InputID').val(client_id);
    var footer = "<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">No</button>";
    footer += "<button type=\"submit\" class=\"btn btn-primary submitBtn\" data-toggle=\"modal\" data-target=\"#deleteProductModal\" onclick=\"deleteProduct(" + product_id + ")\">Yes</button>";


    // AJAX request
    $.ajax({
      url: './confirm_delete.php',
      type: 'POST',
      data: { type: "product", id: product_id },
      //contentType: "text/plain",
      success: function (response) { //we got the response
        //alert('Successfully called');
        $('.delete-product-modal-body').html(response);

        $('.delete-product-modal-footer').html(footer);
      },
      error: function (jqxhr, status, exception) {
        alert('Exception:', exception);
      }
    });
    //});
  });

  $('#deleteProductModal').on('hidden.bs.modal', function (event) {
    Populate_table("products_table");
  });

  $('#addProductModal').on('hidden.bs.modal', function (event) {
    Populate_table("products_table");
  });

  // --------------- Activating DataTables for Regular Bootstrap tables ---------------//

  $('#products_table').DataTable({
    "searching": false
  });

  $('#clients_table').DataTable({
    "searching": false
  });

  $('#active_clients_table').DataTable({
    "searching": false
  });

  // Invoices Table
  $('#invoices_table').DataTable({
    "searching": false
  });

  add_row();

  // ---------------- Typeahead ---------------- //
  // Defining the local dataset
  var packets = ["5", "10", "15", "20"];
  var i = 0;
  while(i++ < 10)
    packets.push(String(i*25));
  
  // Constructing the suggestion engine
  var packets = new Bloodhound({
      datumTokenizer: Bloodhound.tokenizers.whitespace,
      queryTokenizer: Bloodhound.tokenizers.whitespace,
      local: packets
  });
  
  // Initializing the typeahead
  $('.typeahead').typeahead({
      hint: false,
      highlight: true, /* Enable substring highlighting */
      minLength: 1 /* Specify minimum characters required for showing result */
  },{
      name: 'packets',
      source: packets
  });


});
