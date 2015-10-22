$(document).ready(function() {	
	//click on button ok (dialog contact)
	$('#_contact_ok').click(function(){
      var errorMsg = '';
      var customerId = $('#customer_id').val();
	  var contactId = $("#_contact_id").val();
	  var contactName = $("#_contact_name").val();
	  var contactEmail = $("#_contact_email").val();
	  var contactPhone = $("#_contact_phone").val();
	  var contactAddress = $("#_contact_address").val();
	  var contactInfo = $("#_contact_info").val();
	  var contactFax = $("#_contact_fax").val();
	  
	  var reg_mail = /^[A-Za-z0-9]+([_\.\-]?[A-Za-z0-9])*@[A-Za-z0-9]+([\.\-]?[A-Za-z0-9]+)*(\.[A-Za-z]+)+$/;
	  var checkEmail = true;
	  if(!reg_mail.test(contactEmail) && contactEmail){
		checkEmail = false;
	  }
	  var checkPhone = true;
	  if((isNaN(contactPhone) || contactPhone.length<10 || contactPhone.length>11) && contactPhone){
		checkPhone = false;
	  }
	  var checkFax = true;
	  if((isNaN(contactFax) || contactFax.length<10 || contactFax.length>11) && contactFax){
		checkFax = false;
	  }
      if(!contactName){
        errorMsg = 'Please input name';
      }else if(!checkEmail){
		errorMsg = 'Please input a valid email address';
	  }else if(!checkPhone){
		errorMsg = 'Please input a valid phone number';
	  }else if(!checkFax){
		errorMsg = 'Please input a valid fax number';
	  }
      if(errorMsg){
        $('#_contact_msg').removeClass("hidden");
        $('#_contact_msg').html(errorMsg);
        return false;
      }else{
        var tableElement = $('#_bodyAddedContact');
        var mapData = {};
        mapData.name = contactName;
		mapData.email = contactEmail;
		mapData.phone = contactPhone;
		mapData.address = contactAddress;
		mapData.fax = contactFax;
		mapData.info = contactInfo;		
        if(!contactId){
          mapData.id = uniqId('pp_');  
          var html = $("#tableRowTemplateContact").tmpl(mapData);
          tableElement.append(html);
        }else{
          mapData.id = contactId;
          var html = $("#tableRowTemplateContact").tmpl(mapData);
          var selectedRow = $('#_row_'+contactId);
          selectedRow.replaceWith(html);
        }
      }
      resetModalContactData();
	  clickEdit();
    });
	//remove contact
	$( "._removeContact" ).click(function() {
		var selectedRow = $(this).parent().parent();
		selectedRow.remove();
	});
	
	function resetModalContactData(){
		$('#_contact_id').val(null);
		$("#_contact_name").val(null);
	    $("#_contact_email").val(null);
	    $("#_contact_phone").val(null);
	    $("#_contact_address").val(null);
	    $("#_contact_info").val(null);
	    $("#_contact_fax").val(null);
		$('#_contact_msg').addClass("hidden");
        $('#_contact_msg').html("");
		$( "._removeContact" ).click(function() {
			var selectedRow = $(this).parent().parent();
			selectedRow.remove();
		});
	}
	
	$('#contactModal').on('hidden.bs.modal', function () {
		resetModalContactData();
	})
	
	//edit contact
	clickEdit();
	
	function clickEdit(){
		$('._editContact').click(function(){
			var contactId = $(this).attr('data-id');
			var selectedRow = $(this).parent().parent();
			var td = selectedRow.children('td');
			var mapData = {};
			if(td.length) {
				$('#_contact_id').val(contactId);
				$('#_contact_name').val($('#CustomerContact' + contactId + 'Name').val());
				$('#_contact_email').val($('#CustomerContact' + contactId + 'Email').val());
				$('#_contact_phone').val($('#CustomerContact' + contactId + 'Phone').val());
				$('#_contact_address').val($('#CustomerContact' + contactId + 'Address').val());
				$('#_contact_info').val($('#CustomerContact' + contactId + 'Info').val());
				$('#_contact_fax').val($('#CustomerContact' + contactId + 'Fax').val());
			}
			$('#contactModal').modal();
		});
	}
	function uniqId(prefix){
		var text = '';
		var possible = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
		for(var i=0; i < 10; i++){
		  text += possible.charAt(Math.floor(Math.random() * possible.length));
		}
		var id = Math.round(new Date().getTime() + (Math.random() * 100))+text;
		var ret = prefix ? prefix+id : id;
		return ret;
	}
});