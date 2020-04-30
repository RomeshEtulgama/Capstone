// --------------- Client --------------- //

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

// --------------- Products --------------- //

function submitAddProductForm() {
  var index = Number($('#productInputINDEX').val());
  var name = $('#productInputNAME').val();
  var description = $('#productInputDESCRIPTION').val();
  var unitprice = $('#productInputUNITPRICE').val();
  var remarks = $('#productInputREMARKS').val();
  var clients = $('#productSelectCLIENTS').val();

  if (clients.length == 0)
    clients = "";

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

// --------------- Invoices --------------- //
function populate_select_field(str, selected = 0) {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById(str).innerHTML = this.responseText;
    }
  };
  if (selected == 0)
    xmlhttp.open("GET", "functions.php?q=" + str, true);
  else
    xmlhttp.open("GET", "functions.php?q=" + str + "&select=" + selected, true);
  xmlhttp.send();
}

function populate_quantity_field(str) {
  // Defining the local dataset
  var packets = ["5", "10", "15", "20"];
  var i = 0;
  while (i++ < 10)
    packets.push(String(i * 25));

  // Constructing the suggestion engine
  var packets = new Bloodhound({
    datumTokenizer: Bloodhound.tokenizers.whitespace,
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    local: packets
  });

  // Initializing the typeahead
  $('#' + str).typeahead({
    hint: false,
    highlight: true, /* Enable substring highlighting */
    minLength: 1 /* Specify minimum characters required for showing result */
  }, {
    name: 'packets',
    source: packets
  });
}

function select_product(row_id) {
  var c_id = $("#invoiceSelectCLIENT_" + String(row_id)).val()
  populate_select_field("invoiceSelectPRODUCT_" + String(row_id), c_id);
  setTimeout(() => {
    $("#invoiceSelectPRODUCT_" + String(row_id)).selectpicker('refresh');
  }, 100);
  setTimeout(() => {
    set_unit_price(row_id);
  }, 100);
  setTimeout(() => {
    set_total_outstanding(row_id, c_id);
    var that = document.activeElement;
    $('[tabIndex=' + (+that.tabIndex + 1) + ']')[0].focus();
  }, 100);

}

function calculate_amount(row_id) {
  // select_product(row_id);
  var quantity = Number($("#invoiceQUANTITY_" + String(row_id)).val());
  var unit_price = Number($("#invoiceUNITPRICE_" + String(row_id)).val());
  var amount = quantity * unit_price;
  amount = (amount).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
  // alert(amount);
  $('#invoiceAMOUNT_' + String(row_id)).val(amount);
}

function set_total_outstanding(row_id, c_id) {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {

    if (this.readyState == 4 && this.status == 200) {
      $("#invoiceOUTSTANDING_" + String(row_id)).val(this.responseText);
    }
  };
  xmlhttp.open("GET", "functions.php?q=get_total_outstanding&client_id=" + c_id, true);
  xmlhttp.send();
}

function set_unit_price(row_id) {
  var product_id = Number($("#invoiceSelectPRODUCT_" + String(row_id)).val());
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {

    if (this.readyState == 4 && this.status == 200) {
      t = document.getElementById("invoiceUNITPRICE_" + String(row_id));
      if (t != null)
        t.value = this.responseText;
    }
  };
  xmlhttp.open("GET", "functions.php?q=get_unit_price&product_id=" + product_id, true);
  xmlhttp.send();
  setTimeout(() => {
    calculate_amount(row_id);
  }, 100);
}

function add_row() {

  var t = $('#invoices_table').DataTable();
  var counter = t.rows().count() + 1;

  no_field = "<label style=\"display: block; text-align: center;\" >" + String(counter) + "</label>";
  client_name_field = "<select name = \"client_name\"  id = \"invoiceSelectCLIENT_" + String(counter) + "\" class=\"selectpicker\" data-width=\"100%\" data-live-search=\"true\" data-actions-box = \"true\" data-none-selected-text=\"Select Client\" onchange=\"select_product(" + counter + ")\" tabIndex=\"" + counter + "1\"></select>";
  quantity_field = "<input name = \"quantity\" id = \"invoiceQUANTITY_" + String(counter) + "\" type=\"number\" class=\"typeahead form-control table-cell bg-dark text-white\" style=\"border : 0px\" autocomplete=\"off\" spellcheck=\"false\" onchange=\"calculate_amount(" + counter + ")\" tabIndex=\"" + counter + "2\">";
  product_field = "<select id = \"invoiceSelectPRODUCT_" + String(counter) + "\" class=\"selectpicker\" data-width=\"100%\" data-live-search=\"true\" data-actions-box = \"true\" data-none-selected-text=\"Select Product\" onchange=\"set_unit_price(" + counter + ")\" ></select>";
  unit_price_field = "<input readonly id = \"invoiceUNITPRICE_" + String(counter) + "\" class=\"typeahead form-control table-cell bg-dark text-white\" value=0 style=\"text-align: right\" onchange=\"calculate_amount(" + counter + ")\">";
  amount_field = "<input readonly id = \"invoiceAMOUNT_" + String(counter) + "\" class=\"typeahead form-control table-cell bg-dark text-white\" value=0 style=\"text-align: right\">";
  total_outstanding_field = "<input readonly id = \"invoiceOUTSTANDING_" + String(counter) + "\" class=\"typeahead form-control table-cell bg-dark text-white\"  value=0.00 style=\"text-align: right\">";

  t.row.add([
    no_field,
    client_name_field,
    quantity_field,
    product_field,
    unit_price_field,
    amount_field,
    total_outstanding_field
  ]).draw(false);

  populate_select_field("invoiceSelectCLIENT_" + String(counter));


  setTimeout(() => {
    $("#invoiceSelectCLIENT_" + String(counter)).selectpicker();
    $("#invoiceSelectCLIENT_" + String(counter)).selectpicker('val', 0);
  }, 100);

  populate_quantity_field("invoiceQUANTITY_" + String(counter));

  populate_select_field("invoiceSelectPRODUCT_" + String(counter));

  setTimeout(() => {
    $("#invoiceSelectPRODUCT_" + String(counter)).selectpicker();
    $("#invoiceSelectPRODUCT_" + String(counter)).selectpicker('val', 0);
  }, 100);
  //$("#invoiceAMOUNT_" + String(counter)).typeahead();

}

function clear_invoices_table() {
  var t = $('#invoices_table').DataTable();
  t.clear();
  t.draw();
  add_row();
}

function change_acronym_for_ORDNO(str) {
  document.getElementById("basic-addon3").textContent = str;
}

function submitAddOrderForm() {
  var i_route_id = Number(document.getElementById("basic-addon3").value);
  var i_order_no = Number(document.getElementById("order_no").value);
  var i_order_date = (document.getElementById("order_date").value);
  var i_order_remarks = document.getElementById("order_remarks").value;
  var i_header;
  if (isNaN(i_order_no) || i_order_no <= 0) {
    alert("Please fill Order No.");
  } else {

    i_header = [i_route_id, i_order_no, i_order_date, i_order_remarks];
    var table = $("#invoices_table").dataTable();
    var rows = table.fnGetNodes();
    var i_entries = [];
    rows.forEach(row => {
      var client_id = Number(row.cells[1].lastElementChild.firstElementChild.value);
      var quantity = Number(row.cells[2].lastElementChild.firstElementChild.value);
      var product_id = Number(row.cells[3].lastElementChild.firstElementChild.value);
      if (client_id > 0 && product_id > 0)
        i_entries.push([client_id, quantity, product_id]);
    });
    var i_order_data = [i_header, i_entries];

    if (i_entries.length < 1)
      alert("Please add some orders in the table");
    else
      $.post("./functions.php", {
        sub: "add_order_form",
        sub_data: i_order_data
      });

    setTimeout(() => {
      Populate_table('orders_table');
    }, 1000);

  }



  // alert([route_id, order_no, order_date, order_remarks]);

}

function remove_invoice(id) {
  $.post("./functions.php", {
    sub: "remove_invoice",
    sub_id: id
  });

  setTimeout(() => {
    Populate_table('orders_table');
  }, 100);
}

function submitAddRouteForm() {
  var name = $('#route_name').val();
  var acronym = $('#route_acronym').val();

  if (name.trim() == '') {
    alert('Please enter route name.');
    $('#route_name').focus();
    return false;
  } else if (acronym.trim() == '') {
    alert('Please enter route acronym.');
    $('#route_acronym').focus();
    return false;
  } else {

    $.post("./functions.php", {
      sub: "add_route_form",
      sub_name: name,
      sub_acronym: acronym
    });

    setTimeout(() => {
      Populate_table('routes_radio');
    }, 500);
  }
}

// ------------------ Payments --------------------------- //
function add_payment_row() {
  var t = $('#payments_table').DataTable();
  var counter = t.rows().count() + 1;

  var payment_date = "<input id=\"paymentDATE_" + String(counter) + "\" style=\"border: 0px\" class=\"bg-dark text-white\" />";
  var payment_client_name_field = "<select name = \"client_name\"  id = \"paymentSelectCLIENT_" + String(counter) + "\" class=\"selectpicker\" data-width=\"100%\" data-live-search=\"true\" data-actions-box = \"true\" data-none-selected-text=\"Select Client\" tabIndex=\"" + counter + "101\" onchange=\"set_payment_client(" + String(counter) + ")\" ></select>";

  var payment_method_field = "<select name=\"method\" id = \"paymentSelectMETHOD_" + String(counter) + "\" class=\"selectpicker\" data-width=\"100%\" data-live-search=\"true\" data-actions-box = \"true\" data-none-selected-text=\"Select Method\" onchange=\"set_payment_method(" + String(counter) + ")\" tabIndex=\"" + counter + "102\">";
  payment_method_field += "     <option value = 1>Cash</option>";
  payment_method_field += "     <option value = 2>Bank Transfer</option>";
  payment_method_field += "     <option value = 3>Cheque</option>";
  payment_method_field += "</select>";

  var payment_amount_field = "<input name = \"amount\" id = \"paymentAMOUNT_" + String(counter) + "\" type=\"number\" class=\"form-control table-cell bg-dark text-white\" style=\"border : 0px\" autocomplete=\"off\" spellcheck=\"false\" onchange=\"set_payment_amount(" + counter + ")\" tabIndex=\"" + counter + "103\">";
  var payment_remarks_field = "<input name = \"remarks\" id = \"paymentREMARKS_" + String(counter) + "\" type=\"text\" class=\"form-control table-cell bg-dark text-white\" style=\"border : 0px\" autocomplete=\"off\" spellcheck=\"false\" onchange=\"set_payment_remarks(" + counter + ")\">";
  payment_remarks_field += "<input name=\"cheque_date\" id=\"paymentCHEQUEDATE_" + String(counter) + "\" style=\"border: 0px\" class=\"bg-dark text-white\" tabIndex=\"" + counter + "104\" onchange=\"set_payment_cheque_date(" + counter + ")\" />";

  //var total_outstanding_field = "<input readonly id = \"invoiceOUTSTANDING_" + String(counter) + "\" class=\"typeahead form-control table-cell bg-dark text-white\"  value=0.00 style=\"text-align: right\">";

  var payment_remove_button = "<button class=\"btn btn-sm btn-danger\" id=\"remove_payment\"  data-toggle=\"modal\" data-target=\"#deletePaymentModal\" data-whatever=\"\">";
	payment_remove_button += "<i class=\"fa fa-close\"></i>";
	payment_remove_button += "</button>";

  t.row.add([
    payment_date,
    payment_client_name_field,
    payment_method_field,
    payment_amount_field,
    payment_remarks_field,
    payment_remove_button
    //total_outstanding_field
  ]).draw(false);

  populate_select_field("paymentSelectCLIENT_" + String(counter));

  setTimeout(() => {
    $("#paymentSelectCLIENT_" + String(counter)).selectpicker();
    $("#paymentSelectCLIENT_" + String(counter)).selectpicker('val', 0);
  }, 100);

  var today = new Date();
  var yy = new Intl.DateTimeFormat('en', { year: 'numeric' }).format(today);
  var mm = new Intl.DateTimeFormat('en', { month: '2-digit' }).format(today);
  var dd = new Intl.DateTimeFormat('en', { day: '2-digit' }).format(today);

  $('#paymentDATE_' + String(counter)).datepicker({
    uiLibrary: 'bootstrap4',
    format: "yyyy-mm-dd",
    value: yy + "-" + mm + "-" + dd
  });

  $('#paymentCHEQUEDATE_' + String(counter)).datepicker({
    uiLibrary: 'bootstrap4',
    format: "yyyy-mm-dd"
  });
  $('#paymentCHEQUEDATE_' + String(counter)).datepicker('destroy');
  $('#paymentCHEQUEDATE_' + String(counter)).hide();

  // setTimeout(() => {}, 1);

  $("#paymentSelectMETHOD_" + String(counter)).selectpicker();
  $("#paymentSelectMETHOD_" + String(counter)).selectpicker('val', 1);
}

function change_remarks_field(counter) {
  var payment_method_field = document.getElementById("paymentSelectMETHOD_" + String(counter));
  var payment_remarks_input = document.getElementById("paymentREMARKS_" + String(counter));
  var payment_cheque_date = $('#paymentCHEQUEDATE_' + String(counter));
  if (payment_method_field.value == "1" || payment_method_field.value == "2") {
    payment_remarks_input.style.display = "";
    payment_cheque_date.datepicker('destroy');
    payment_cheque_date.hide();
  } else {
    payment_remarks_input.style.display = "none";
    payment_cheque_date.show();
    payment_cheque_date.datepicker({
      uiLibrary: 'bootstrap4',
      format: "yyyy-mm-dd"
    });
    document.getElementById('paymentCHEQUEDATE_' + String(counter)).classList.add("bg-dark");
    document.getElementById('paymentCHEQUEDATE_' + String(counter)).classList.add("text-white");
  }


}

function set_payment_client(counter) {
  var that = document.activeElement;
  $('[tabIndex=' + (+that.tabIndex + 2) + ']')[0].focus();
}

function set_payment_method(counter) {
  var that = document.activeElement;
  $('[tabIndex=' + (+that.tabIndex + 1) + ']')[0].focus();
  change_remarks_field(counter);
}

function set_payment_amount(counter) {
  
}

function set_payment_remarks(counter) {

}

function set_payment_cheque_date(counter) {

}


// ------------------------- Navbar -------------------------- //
function sidebar_active(str) {
  $("#Clients_area").hide(200, function(){});
  $("#Products_area").hide(200, function(){});
  $("#Invoices_area").hide(200, function(){});
  $("#Payments_area").hide(200, function(){});
  
  if(str == "Clients"){
    $("#Clients_area").show(200, function(){});
  }
  else if(str == "Products"){
    $("#Products_area").show(200, function(){});
  }
  else if(str == "Invoices"){
    $("#Invoices_area").show(200, function(){});
  }
  else if(str == "Payments"){
    $("#Payments_area").show(200, function(){});
  }
  else if(str == "Reports"){}
  
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
  if (str != 'routes_radio')
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

function edit_invoice(id) {
  var i_id = id;
  var c_id = $('#invoiceSelectCLIENT_edit').val();
  var p_id = $('#invoiceSelectPRODUCT_edit').val();
  var qty = $('#edit_quantity').val();

  $.post("./functions.php", {
    sub: "edit_invoice",
    sub_i_id: i_id,
    sub_c_id: c_id,
    sub_p_id: p_id,
    sub_qty: qty,
  });

  setTimeout(() => {
    Populate_table('orders_table');
  }, 500);

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

  // ------------------------------ Invoices -------------------------------------- //
  $('#deleteInvoiceModal').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget); // Button that triggered the modal
    var i_id = button.data('whatever'); // Extract info from data-* attributes
    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    //var modal = $(this);
    //modal.find('#InputID').val(client_id);
    var footer = "<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">No</button>";
    footer += "<button type=\"submit\" class=\"btn btn-primary submitBtn\" data-toggle=\"modal\" data-target=\"#deleteInvoiceModal\" onclick=\"remove_invoice(" + i_id + ")\">Yes</button>";


    // AJAX request
    $.ajax({
      url: './confirm_delete.php',
      type: 'POST',
      data: { type: "invoice", id: i_id },
      //contentType: "text/plain",
      success: function (response) { //we got the response
        //alert('Successfully called');
        $('.delete-invoice-modal-body').html(response);

        $('.delete-invoice-modal-footer').html(footer);
      },
      error: function (jqxhr, status, exception) {
        alert('Exception:', exception);
      }
    });
    //});
  });

  $('#editInvoiceModal').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget); // Button that triggered the modal
    var i_id = button.data('whatever'); // Extract info from data-* attributes
    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    //var modal = $(this);
    //modal.find('#InputID').val(client_id);
    var footer = "<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>";
    footer += "<button type=\"submit\" class=\"btn btn-primary submitBtn\" data-toggle=\"modal\" data-target=\"#editInvoiceModal\" onclick=\"edit_invoice(" + i_id + ")\">Submit</button>";


    // AJAX request
    $.ajax({
      url: './edit_invoice.php',
      type: 'POST',
      data: { type: "invoice", id: i_id },
      //contentType: "text/plain",
      success: function (response) { //we got the response
        //alert('Successfully called');
        $('.edit-invoice-modal-body').html(response);

        $('.edit-invoice-modal-footer').html(footer);
      },
      error: function (jqxhr, status, exception) {
        alert('Exception:', exception);
      }
    });
    //});
  });

  $('#editInvoiceModal').on('shown.bs.modal', function (event) {
    tries = 50;
    x = document.getElementById('invoiceSelectCLIENT_edit');
    y = document.getElementById('invoiceSelectPRODUCT_edit');
    while ((window.getComputedStyle(x).display == "none" || window.getComputedStyle(y).display == "none") && tries > 0) {
      $("#invoiceSelectCLIENT_edit").selectpicker();
      $("#invoiceSelectPRODUCT_edit").selectpicker();
      tries--;
    }


  });
  // --------------- Activating DataTables for Regular Bootstrap tables ---------------//

  $('#products_table').DataTable({
    "searching": false
  });

  $('#clients_table').DataTable({
    "searching": false
  });

  $('#active_clients_table').DataTable({
    "searching": false,
    "lengthMenu": [5, 10, 25, 50, 75, 100]
  });

  // Invoices
  $('#invoices_table').DataTable({
    "searching": false
  });

  $('#orders_table').DataTable({
    searching: false
  });

  add_row();

  $('input[type=radio][id="routes-radio"]').change(function () {
    if (this.name != "new") {
      document.getElementById("basic-addon3").textContent = this.value;
      document.getElementById("basic-addon3").value = this.name;
    }
    // else {
    //   // alert("Add New Route Modal");
    //   // $('#addRouteModal').modal('toggle');
    // }
  });

  init_route = $('input[type=radio][id="routes-radio"]')[0]
  document.getElementById("basic-addon3").textContent = init_route.value;
  document.getElementById("basic-addon3").value = init_route.name;

  // Payments
  $('#payments_table').DataTable({
    "searching": false
  });

  add_payment_row();

});

$(function () {
  $(document).on('keypress', function (e) {
    var that = document.activeElement;
    if (e.which == 13) {
      // e.preventDefault();
      if (that.name == "quantity") {
        try {
          $('[tabIndex=' + (+that.tabIndex + 9) + ']')[0].focus();
        } catch {
          add_row();
          setTimeout(() => {
            $('[tabIndex=' + (+that.tabIndex + 9) + ']')[0].focus();
          }, 100);
        }
      }
    }
  });
});

