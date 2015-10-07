var TradeshowEvent = {
  init: function() {
    if($('#div_from_date').size()){
      $('#div_from_date').datetimepicker({
        pickTime: false,
        useCurrent: false,
       // format:'YYYY/MM/DD hh:mm A'
      });
    }
    if($('#div_to_date').size()){
      $('#div_to_date').datetimepicker({
        pickTime: false,
        useCurrent: false
      });
    }
  },
  doSomething: function() {
  }
};
var Product = {
  init: function() {
    $("#cbProduct").on("change", function(){
      //$("._product").prop('checked', $(this).prop('checked'));
      var e = $(this);
      $("._product").each(function(){
        var el=$(this);
      if(e.is(":checked")){
        el.prop('checked', true).attr('checked', true).parent().find('a:first').addClass('checked');
      } else{
        el.prop('checked', false).attr('checked', false).parent().find('a:first').removeClass('checked');
      }  
      });
    });
    /*
    $('#_addProduct').click(function(){
      $('#_dialogChooseCategory').trigger("click");
      return false;
    });
    
    $('#_btnSelectCategory').click(function(){
      var createShopLink = $('#_category').val();
      if(createShopLink){
        window.location = createShopLink;
      }else{
        alert("Please select category");
      }
      return false;
    });*/
    
    $("#_category").change(function() {
      var createShopLink = $(this).val();
      if(createShopLink){
        window.location = createShopLink;
      }
    });
    
  },
}
$(document).ready(function() {
  TradeshowEvent.init();
  Product.init();
  
});