$(document).ready(function() {
	// show calendar for index page
	if($('#calendar').size()){
		$('#calendar').fullCalendar({
			eventSources: [
				{
					url: '/calendar/feed',
					type: 'POST',
					data: {
					},
					error: function() {
						alert('there was an error while fetching events!');
					},
				}

				// any other sources...

			],
			eventClick: function(event) {
			},
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,basicWeek,basicDay'
			},
			editable: false,
			eventLimit: true, // allow "more" link when too many events
			lang: 'vi',
		});
	}
	// pick from_date and to_date for edit page
	if($('._datetime_picker').size()){
	  var dateNow = new Date();
      $('._datetime_picker').datetimepicker({
        pickTime: true,
        useCurrent: false,
		sideBySide: true
      });
    }
	
	//click on button ok (dialog customer)
	$('#_customer_ok').click(function(){
      var errorMsg = '';
      var customerId = $('#customer_id').val();
	  var customerName = $("#customer_id option:selected").text();
      var calendarCustomerId = $('#_calendar_customer_id').val();
      var customerOrder = $('#_customer_order').val();
      if(!customerId){
        errorMsg = 'Please select customer';
      }
      if(errorMsg){
        $('#_customer_msg').removeClass("hidden");
        $('#_customer_msg').html(errorMsg);
        return false;
      }else{
        var maxOrder = 0;
        $('._customer_order').each(function(){
          var itemOrder = parseInt($(this).html());
          if(itemOrder > maxOrder){
            maxOrder =  itemOrder;
          }
        });
        var tableElement = $('#_bodyAddedCustomer');
        var mapData = {};
        mapData.customer_id = customerId;
        if(!calendarCustomerId){
          mapData.customerName = customerName;
		  mapData.id = uniqId('pp_');
          var html = $("#tableRowTemplateCustomer").tmpl(mapData);
          tableElement.append(html);
        }else{
          mapData.id = customerId;
          mapData.order = customerOrder;
          var html = $("#tableRowTemplateCustomer").tmpl(mapData);
          var selectedRow = $('#_row_'+customerId);
          selectedRow.replaceWith(html);
        }
      }
      resetModalCustomerData();
    });
	//remove customer
	$( "._removeCustomer" ).click(function() {
		var selectedRow = $(this).parent().parent();
		selectedRow.remove();
	});
	function resetModalCustomerData(){
		$('#customer_id').val(null);
		$( "._removeCustomer" ).click(function() {
			var selectedRow = $(this).parent().parent();
			selectedRow.remove();
		});
	}
	
	//click on button ok (dialog lead)
	$('#_lead_ok').click(function(){
      var errorMsg = '';
      var leadId = $('#lead_id').val();
	  var leadName = $("#lead_id option:selected").text();
      var calendarLeadId = $('#_calendar_lead_id').val();
      var leadOrder = $('#_lead_order').val();
      if(!leadId){
        errorMsg = 'Please select lead';
      }
      if(errorMsg){
        $('#_lead_msg').removeClass("hidden");
        $('#_lead_msg').html(errorMsg);
        return false;
      }else{
        var maxOrder = 0;
        $('._lead_order').each(function(){
          var itemOrder = parseInt($(this).html());
          if(itemOrder > maxOrder){
            maxOrder =  itemOrder;
          }
        });
        var tableElement = $('#_bodyAddedLead');
        var mapData = {};
        mapData.lead_id = leadId;
        if(!calendarLeadId){
          mapData.leadName = leadName;
		  mapData.id = uniqId('pp_');
          var html = $("#tableRowTemplateLead").tmpl(mapData);
          tableElement.append(html);
        }else{
          mapData.id = leadId;
          mapData.order = leadOrder;
          var html = $("#tableRowTemplateLead").tmpl(mapData);
          var selectedRow = $('#_row_'+leadId);
          selectedRow.replaceWith(html);
        }
      }
      resetModalLeadData();
    });
	//remove lead
	$( "._removeLead" ).click(function() {
		var selectedRow = $(this).parent().parent();
		selectedRow.remove();
	});
	function resetModalLeadData(){
		$('#lead_id').val(null);
		$( "._removeLead" ).click(function() {
			var selectedRow = $(this).parent().parent();
			selectedRow.remove();
		});
	}
	
	//click on button ok (dialog vendor)
	$('#_vendor_ok').click(function(){
      var errorMsg = '';
      var vendorId = $('#vendor_id').val();
	  var vendorName = $("#vendor_id option:selected").text();
      var calendarVendorId = $('#_calendar_vendor_id').val();
      var vendorOrder = $('#_vendor_order').val();
      if(!vendorId){
        errorMsg = 'Please select vendor';
      }
      if(errorMsg){
        $('#_vendor_msg').removeClass("hidden");
        $('#_vendor_msg').html(errorMsg);
        return false;
      }else{
        var maxOrder = 0;
        $('._vendor_order').each(function(){
          var itemOrder = parseInt($(this).html());
          if(itemOrder > maxOrder){
            maxOrder =  itemOrder;
          }
        });
        var tableElement = $('#_bodyAddedVendor');
        var mapData = {};
        mapData.vendor_id = vendorId;
        if(!calendarVendorId){
          mapData.vendorName = vendorName;
		  mapData.id = uniqId('pp_');
          var html = $("#tableRowTemplateVendor").tmpl(mapData);
          tableElement.append(html);
        }else{
          mapData.id = vendorId;
          mapData.order = vendorOrder;
          var html = $("#tableRowTemplateVendor").tmpl(mapData);
          var selectedRow = $('#_row_'+vendorId);
          selectedRow.replaceWith(html);
        }
      }
      resetModalVendorData();
    });
	//remove vendor
	$( "._removeVendor" ).click(function() {
		var selectedRow = $(this).parent().parent();
		selectedRow.remove();
	});
	function resetModalVendorData(){
		$('#vendor_id').val(null);
		$( "._removeVendor" ).click(function() {
			var selectedRow = $(this).parent().parent();
			selectedRow.remove();
		});
	}
	
	//click on button ok (dialog user)
	$('#_user_ok').click(function(){
      var errorMsg = '';
      var userId = $('#user_id').val();
	  var userName = $("#user_id option:selected").text();
      var calendarUserId = $('#_calendar_user_id').val();
      var userOrder = $('#_user_order').val();
      if(!userId){
        errorMsg = 'Please select user';
      }
      if(errorMsg){
        $('#_user_msg').removeClass("hidden");
        $('#_user_msg').html(errorMsg);
        return false;
      }else{
        var maxOrder = 0;
        $('._user_order').each(function(){
          var itemOrder = parseInt($(this).html());
          if(itemOrder > maxOrder){
            maxOrder =  itemOrder;
          }
        });
        var tableElement = $('#_bodyAddedUser');
        var mapData = {};
        mapData.user_id = userId;
        if(!calendarUserId){
          mapData.userName = userName;
		  mapData.id = uniqId('pp_');
          var html = $("#tableRowTemplateUser").tmpl(mapData);
          tableElement.append(html);
        }else{
          mapData.id = userId;
          mapData.order = userOrder;
          var html = $("#tableRowTemplateUser").tmpl(mapData);
          var selectedRow = $('#_row_'+userId);
          selectedRow.replaceWith(html);
        }
      }
      resetModalUserData();
    });
	//remove user
	$( "._removeUser" ).click(function() {
		var selectedRow = $(this).parent().parent();
		selectedRow.remove();
	});
	function resetModalUserData(){
		$('#user_id').val(null);
		$( "._removeUser" ).click(function() {
			var selectedRow = $(this).parent().parent();
			selectedRow.remove();
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