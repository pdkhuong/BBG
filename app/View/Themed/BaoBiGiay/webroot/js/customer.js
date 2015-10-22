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
      if(!contactName){
        errorMsg = 'Please input name';
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
		$('#contact_id').val(null);
		$( "._removeContact" ).click(function() {
			var selectedRow = $(this).parent().parent();
			selectedRow.remove();
		});
	}
	
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