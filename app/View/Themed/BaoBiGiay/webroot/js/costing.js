var PurchaseOrder = {
  init: function() {
    if($('._datetime_picker').size()){
      $('._datetime_picker').datetimepicker({
        pickTime: false,
        useCurrent: false
      });
    }

    var bodyElement = $("body");
    //luc load page
    Product.initPrice();

    bodyElement.on("input", "._num_product", function(e) {
      var numProduct = $(this).val();
      var id = $(this).attr("data-id");
      var price = parseFloat($('#_price_'+id).html());
      if(Product.isInt(numProduct)){
        var totalPrice = price * numProduct;
        totalPrice = Product.Round(totalPrice)
        $('#_total_price_'+id).html(totalPrice);
      }else{
        $('#_total_price_'+id).html(0);
      }
      Product.sumPrice();
    });

  },

};
var WorksSheet = {
  init: function(){
    this.addProductProgress()
    this.removeProductProgress();
    this.editProductProgress();
    $('body').on('hidden.bs.modal', '.modal', function () {
      //$(this).removeData('bs.modal');
      WorksSheet.resetModalData()
    });
  },
  resetModalData: function(){
    $('#_progress_id').val('');
    $('#_progress_order').val('');
    $('#_progress_name').val('');
    $('#_progress_location').val('');
    $('#_progress_description').val('');
    $('#_progress_msg').addClass("hidden");
  },
  addProductProgress: function(){
    var bodyElement = $("body");
    //bodyElement.on("click", "#_progress_ok", function(e) {
    $('#_progress_ok').click(function(){
      var errorMsg = '';

      var progressOrder = $('#_progress_order').val();
      var progressName = $('#_progress_name').val();
      var progressId = $('#_progress_id').val();
      var progressAtLocation = $('#_progress_location').val();
      var progressDescription = $('#_progress_description').val();
      if(!progressName){
        errorMsg = 'Please input name';
      }else if(!progressAtLocation){
        errorMsg = 'Please input location';
      }
      if(errorMsg){
        $('#_progress_msg').removeClass("hidden");
        $('#_progress_msg').html(errorMsg);
        return false;
      }else{
        var maxOrder = 0;
        $('._progress_order').each(function(){
          var itemOrder = parseInt($(this).html());
          if(itemOrder > maxOrder){
            maxOrder =  itemOrder;
          }
        });
        var tableElement = $('#_bodyAddedProgress');
        var mapData = {};
        mapData.progress_name = progressName;
        mapData.progress_location = progressAtLocation;
        mapData.progress_description = progressDescription;
        if(!progressId){
          mapData.order = (maxOrder + 1);
          mapData.id = Product.uniqId('pp_');
          var html = $("#tableRowTemplateWorksSheet").tmpl(mapData);
          tableElement.append(html);
        }else{
          mapData.id = progressId;
          mapData.order = progressOrder;
          var html = $("#tableRowTemplateWorksSheet").tmpl(mapData);
          var selectedRow = $('#_row_'+progressId);
          selectedRow.replaceWith(html);
        }


      }
      WorksSheet.resetModalData();
    });
  },
  removeProductProgress: function(){
    var bodyElement = $("body");
    bodyElement.on("click", "._removeProgress", function(e) {
      var selectedRow = $(this).parent().parent();
      selectedRow.remove();
      var order = 0;
      $('._progress_order').each(function(){
        order ++;
        $(this).html(order);
      });
    });
  },
  editProductProgress: function(){
    var bodyElement = $("body");
    bodyElement.on("click", "._editProgress", function(e) {
      var progressId = $(this).attr('data-id');
      var selectedRow = $(this).parent().parent();
      var td = selectedRow.children('td');
      var mapData = {};
      if(td.length) {
        $('#_progress_id').val(progressId);
        $('#_progress_order').val($(td[0]).text());
        $('#_progress_name').val($(td[1]).text());
        $('#_progress_location').val($(td[2]).text());
        $('#_progress_description').val($(td[3]).text());
      }
      $('#progressModal').modal();
    });
  }
};
var Product = {
  init:function(){
    this.addProduct();
    this.removeProduct();
  },
  removeProduct: function(){
    var bodyElement = $("body");
    bodyElement.on("click", "._removeProduct", function(e) {
      var selectedRow = $(this).parent().parent();
      var td = selectedRow.children('td');
      var mapData = {};
      if(td.length){
        mapData.id = $(td[0]).text();
        mapData.item_no = $(td[1]).text();
        mapData.name = $(td[2]).text();
        mapData.unit_name = $(td[3]).text();
        mapData.spec = $(td[4]).text();
        selectedRow.remove();
        var dt = $('#_product_dt').dataTable();
        dt.fnAddData(
          [
            mapData.id,
            mapData.item_no,
            mapData.name,
            mapData.unit_name,
            mapData.spec,
            '<a class="btn btn-default btn-sm _addProduct">Add product</a>'
          ]
        );
      }
    });

  },
  addProduct: function() {
    var bodyElement = $("body");
    bodyElement.on("click", "._addProduct", function(e) {
      var selectedRow = $(this).parent().parent();
      var td = selectedRow.children('td');
      var mapData = {};
      if(td.length){
        mapData.id = $(td[0]).text();
        mapData.item_no = $(td[1]).text();
        mapData.name = $(td[2]).text();
        mapData.unit_name = $(td[3]).text();
        mapData.spec = $(td[4]).text();
        var tableElement = $('#_bodyAddedProduct');
        var html = $("#tableRowTemplate").tmpl(mapData);
        tableElement.prepend(html);
        var row = $(this).closest('tr');
        var dt = $('#_product_dt').dataTable();
        dt.fnDeleteRow(row);
      }
    });
  },
  isInt: function(value){
    var isInt = false;
    if(Math.floor(value) == value && $.isNumeric(value) && value > 0) {
      isInt = true;
    }
    return isInt;
  },
  uniqId: function(prefix){
    var text = '';
    var possible = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    for(var i=0; i < 10; i++){
      text += possible.charAt(Math.floor(Math.random() * possible.length));
    }
    var id = Math.round(new Date().getTime() + (Math.random() * 100))+text;
    var ret = prefix ? prefix+id : id;
    return ret;
  },
  Round: function(value){
    value = Math.round(value * 1000);
    return value/1000;
  },
  initPrice: function(){
    $('._num_product').each(function(){
      var numProduct = $(this).val();
      var id = $(this).attr("data-id");
      var price = parseFloat($('#_price_'+id).html());
      if(Product.isInt(numProduct)){
        var totalPrice = price * numProduct;
        totalPrice = Product.Round(totalPrice)
        $('#_total_price_'+id).html(totalPrice);
      }else{
        $('#_total_price_'+id).html(0);
      }
      Product.sumPrice();
    });
  },
  sumPrice: function(){
    var sumPrice = 0;
    $('._total_price').each(function(){
      var price = parseFloat($(this).html());
      sumPrice += price;
    });
    sumPrice = Product.Round(sumPrice);
    $('#_sum_price').html(sumPrice);
  }
};
$(document).ready(function() {
  PurchaseOrder.init();
  Product.init();
  WorksSheet.init();
});