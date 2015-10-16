var PurchaseOrder = {
  init: function() {
    if($('#div_order_date').size()){
      $('#div_order_date').datetimepicker({
        pickTime: false,
        useCurrent: false,
       // format:'YYYY/MM/DD hh:mm A'
      });
    }
    if($('#div_received_date').size()){
      $('#div_received_date').datetimepicker({
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
        mapData.id = td[0].innerText;
        mapData.item_no = td[1].innerText;
        mapData.name = td[2].innerText;
        mapData.unit_name = td[3].innerText;
        mapData.price = td[4].innerText;
        selectedRow.remove();
        var dt = $('#_product_dt').dataTable();
        dt.fnAddData(
          [
            mapData.id,
            mapData.item_no,
            mapData.name,
            mapData.unit_name,
            mapData.price,
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
        mapData.id = td[0].innerText;
        mapData.item_no = td[1].innerText;
        mapData.name = td[2].innerText;
        mapData.unit_name = td[3].innerText;
        mapData.price = td[4].innerText;
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
});