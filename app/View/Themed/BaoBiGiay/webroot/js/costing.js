var BCommon = {
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
  init: function(){
    this.selectCustomer();
  },
  selectCustomer: function(){
    if($('#_change_customer').size()){
      $( "#_change_customer" ).change(function() {
        var customerId = $(this).val();
        var currentUrl = $(this).attr('data-current-url');
        var newUrl = currentUrl + '?customer_id='+customerId;
        window.location.href = newUrl;
      });
    }
  },
};
var PurchaseOrder = {
  init: function() {
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
    bodyElement.on("click", "._removeProduct2", function(e) {
      var selectedRow = $(this).parent().parent();
      selectedRow.remove();
    });

  },
  addProduct: function() {
    var bodyElement = $("body");
    bodyElement.on("click", "._addProduct", function(e) {
      var selectedRow = $(this).parent().parent();
      var td = selectedRow.children('td');
      var mapData = {};
      if(td.length){
        mapData.id = parseInt($(td[0]).text());
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
    bodyElement.on("click", "._addProduct2", function(e) {
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
      }
    });
  },
};
var WorksSheet = {
  init: function(){
    $('body').on('hidden.bs.modal', '.modal', function () {
      //$(this).removeData('bs.modal');
      //WorksSheet.resetModalData()
    });
    this.initProgress();
  },
  resetModalData: function(){
    $('#_progress_id').val('');
    $('#_progress_order').val('');
    $('#_progress_name').val('');
    $('#_progress_location').val('');
    $('#_progress_description').val('');
    $('#_progress_msg').addClass("hidden");
  },
  initProgress: function(){
    if($('#_costing_product').size()){
      $( "#_costing_product" ).change(function() {
        var productId = $(this).val();
        if(productId){
          $.post(sf.ajax_url + 'getCosting', {product_id: productId}, function (data) {
            data = JSON.parse(data);
            var costing = data.Costing;
            var order = 1;
            $('#_bodyAddedProgress').html('');
            var paperSubstance = parseFloat(costing.paper_substance);
            if(paperSubstance){
              WorksSheet.addRowStep(order, 'Cắt Giấy Tấm');
              order++;
            }
            var printingColor = parseFloat(costing.printing_color);
            if(printingColor){
              WorksSheet.addRowStep(order, 'In '+printingColor+" Màu");
              order++;
            }
            var vanish_oil = parseFloat(costing.vanish_oil);
            var vanish_opp = parseFloat(costing.vanish_opp);
            var vanish_uv = parseFloat(costing.vanish_uv);
            if(vanish_oil || vanish_opp || vanish_uv){
              WorksSheet.addRowStep(order, "Loại cán");
              order++;
            }
            var die_cut = parseFloat(costing.die_cut);
            if(die_cut){
              WorksSheet.addRowStep(order, "Bế");
              order++;
            }
            var gluing_1 = parseFloat(costing.gluing_1);
            var gluing_2 = parseFloat(costing.gluing_2);
            var gluing_3 = parseFloat(costing.gluing_3);
            if(gluing_1 || gluing_2 || gluing_3){
              WorksSheet.addRowStep(order, "Dán");
              order++;
            }
            var limination = parseFloat(costing.limination);
            if(limination){
              WorksSheet.addRowStep(order, "Bồi");
              order++;
            }
            WorksSheet.addRowStep(order, "Đóng Gói");
            order++;
          });
        }else{
          $('#_bodyAddedProgress').html('');
        }
      });
    }
  },
  addRowStep: function(order, progressName){
    var mapData = {};
    mapData.order = order;
    mapData.id = BCommon.uniqId('pp_');
    mapData.progress_name = progressName;
    var html = $("#tableRowTemplateWorksSheet").tmpl(mapData);
    $('#_bodyAddedProgress').append(html);
  }
};
var Costing = {
  init: function() {
    this.selectProduct();
  },
  selectProduct: function(){//chon product trong costing thi co mot so thong so thay doi theo
    if($('#_costing_product').size()){
      $( "#_costing_product" ).change(function() {
        var productId = $(this).val();
        if(productId){
          $.post(sf.ajax_url+'getProduct', {product_id: productId}, function( data ) {
            data = JSON.parse(data);
            if(data.Product.length && data.Product.width){
              var length = parseFloat(data.Product.length);
              var width = parseFloat(data.Product.width);
              var substance = parseFloat(data.Product.substance);
              $('#CostingSpecLength').val(length);
              $('#CostingSpecWidth').val(width);
              $('#CostingPaperLength').val(length + 1);
              $('#CostingPaperWidth').val(width + 1.5);
              $('#CostingPaperSubstance').val(substance);
            }
          });
        }

      });

    }
  }
}

$(document).ready(function() {
  BCommon.init();
  if($('._datetime_picker').size()){
    $('._datetime_picker').datetimepicker({
      pickTime: false,
      useCurrent: false
    });
  }
  if($('._purchase_order').size()){
    PurchaseOrder.init();
  }
  if($('._costing').size()) {
    Costing.init();
  }
  if($('._works_sheet').size()){
    WorksSheet.init();
  }

});