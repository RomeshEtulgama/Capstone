function submitAddClientForm(){
  var index = $('#InputINDEX').val();
  var name = $('#InputNAME').val();
  var address = $('#InputADDRESS').val();
  var nickname = $('#InputNICKNAME').val();
  var code = $('#InputCODE').val();
  var contact1 = $('#InputCONTACT1').val();
  var contact2 = $('#InputCONTACT2').val();
  var defaultproduct = $('#InputPRODUCT').val();
  var remarks = $('#InputREMARKS').val();

  if(name.trim() == '' ){
        alert('Please enter client name.');
        $('#InputNAME').focus();
        return false;
    }else if(address.trim() == '' ){
        alert('Please enter client address.');
        $('#InputADDRESS').focus();
        return false;
    } else {
      
      $.post("./functions.php", {
        sub:"add_client_form",
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

function submitEditClientForm(){
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

  if(name.trim() == '' ){
        alert('Please enter client name.');
        $('#edit_InputNAME').focus();
        return false;
    }else if(address.trim() == '' ){
        alert('Please enter client address.');
        $('#edit_InputADDRESS').focus();
        return false;
    } else {
      
      $.post("./functions.php", {
        sub:"edit_client_form",
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

function filter_table(userInput, filtering_table, num_of_columns ) {
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

  for (j=0; j<num_of_columns; j++) {
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


$(document).ready(function(){
  $('#editClientModel').on('show.bs.modal', function (event) {

    //alert('The modal is about to be shown.');

    var button = $(event.relatedTarget); // Button that triggered the modal
    var client_id = button.data('whatever'); // Extract info from data-* attributes
    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    //var modal = $(this);
    //modal.find('#InputID').val(client_id);

      // AJAX request
    $.ajax({
      url: './editClient.php',
      type: 'POST',
      data: {clientid: client_id},
      //contentType: "text/plain",
      success: function(response) { //we got the response
          //alert('Successfully called');
          $('.editform-modal-body').html(response);
      },
      error: function(jqxhr, status, exception) {
          alert('Exception:', exception);
      }
    });
    //});
  });
});
