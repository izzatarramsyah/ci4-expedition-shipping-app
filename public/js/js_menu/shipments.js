var table_input_shipments = $('#table-item-shipments').DataTable({
    "columnDefs": [
        { "width": "150px", "targets": 0, "className": "text-center" }, 
        { "width": "100px", "targets": 1, "className": "text-center" }, 
        { "width": "50px", "targets": 2, "className": "text-center" },  
        { "width": "50px", "targets": 3, "className": "text-center" }, 
        { "width": "50px", "targets": 4, "className": "text-center" } ,
    ],
    "autoWidth": false,
});
var shipmentsId;
var weightRates;

loadRoute();
loadWeight();

var shipments = (function () {
    var itemShipment = [];
    var subTotal = 0;

    function Item(
        itemType, 
        itemWeight, 
        itemName, 
        itemQuantity
    ) {
        this.itemType = itemType;
        this.itemWeight = itemWeight;
        this.itemName = itemName;
        this.itemQuantity = itemQuantity;
    }

    var obj = {};

    obj.listItem = function () {
        return itemShipment;
     };

    obj.emptyItem = function (){
        itemShipment = [];
    };

    obj.addItem = function ( itemType, itemWeight, itemName, itemQuantity ) {
        var item = new Item(
            itemType, 
            itemWeight, 
            itemName, 
            itemQuantity
        );
        itemShipment.push(item);
    };

    obj.removeItem = function (itemName) {
        for (var i = 0; i < itemShipment.length; i++) {
            if (itemShipment[i].itemName === itemName) {
                itemShipment.splice(i, 1);
              break;
            }
        }
    };

    obj.setCountForItem = function (itemName, quantity) {
        for (var i = 0; i < itemShipment.length; i++) {
          if (itemShipment[i].itemName === itemName) {
            itemShipment[i].itemQuantity = quantity;
            break;
          }
        }
    };

    obj.subTotal = function () {
        for (var i = 0; i < itemShipment.length; i++) {
            for ( var y = 0; y < weightRates.length; y++ ) {
                if ( Number(itemShipment[i].itemWeight) >= Number(weightRates[y].min_weight) && 
                    itemShipment[i].itemWeight <= weightRates[y].max_weight ) {
                        subTotal += Number(itemShipment[i].itemQuantity) * Number(weightRates[y].price);
                        break;
                }
            }
        }
        return subTotal.toFixed(0);
    };

    obj.total = function (shippingCost) {
        var total = subTotal + Number(shippingCost);
        return total.toFixed(0);
    };

    return obj;
})();

function getCustomerByName(customerName, callback){
    $.ajax({
        url: 'getCustomerByName',
        method: 'POST',
        data: {
            customerName: customerName
        },
        success: function(response) {
            callback(response.object)
        },
        error: function(response) {
            console.error(response);
        }
    });
}

$('#sender-name').on('input', function() {
    var customerName = $(this).val();
    getCustomerByName(customerName, function(response) {
       $('#sender-phone-no').val(response[0].phone);
       $('#sender-address').val(response[0].address);
    });
});

$('#rec-name').on('input', function() {
    var customerName = $(this).val();
    getCustomerByName(customerName, function(response) {
       $('#rec-phone-no').val(response[0].phone);
       $('#deliv-address').val(response[0].address);
    });
});

$('#btnAddDataShipments').click(function() {
    var arrValidate = [];
    arrValidate.push('sender-name', 'sender-address', 'sender-phone-no', 'rec-name', 
        'deliv-address', 'deliv-area', 'rec-phone-no');
    if (isInputValid(arrValidate)) {
        shipments.emptyItem();
        $('#modal-input-shipments').modal('show');
    }
});

$('#btnAddItemShipments').click(function() {
    var arrValidate = [];
    arrValidate.push('item-type', 'item-name', 'item-weight', 'item-quantity');
    if ( isInputValid(arrValidate) ) {
        var itemType     = $("#item-type").val();
        var itemWeight   = $("#item-weight").val();
        var itemName     = $("#item-name").val();
        var itemQuantity = $("#item-quantity").val();
        shipments.addItem(itemType, itemWeight, itemName, itemQuantity);
        drawTableItemShipments();
        $('btnSubmitAddItemShipments').prop('disabled',false);
    }
});

$("#table-item-shipments").on("click", ".itemCount", function(event) {
    var itemName = $(this).attr("data-item-name");
    var quantity = Number($(this).val());
    shipments.setCountForItem(itemName, quantity);
});

$("#table-item-shipments").on("click", ".deleteItem", function(event) {
    var itemName = $(this).attr("data-item-name");
    shipments.removeItem(itemName);
    drawTableItemShipments();
});

function drawTableItemShipments(){
    table_input_shipments.clear().draw();
    var arrayData = shipments.listItem();
    for (var i = 0; i < arrayData.length; i++) {
        table_input_shipments.row.add([
            arrayData[i].itemName,
            arrayData[i].itemType,
            arrayData[i].itemWeight,
            '<input type="number" style="width: 50px;" class="itemCount" data-item-name="' + arrayData[i].itemName +'" value="'+arrayData[i].itemQuantity+'"></input>',
            '<button type="button" class="btn btn-primary deleteItem" data-item-name="'+arrayData[i].itemName+'"><i class="fas fa-trash"></i></button> '
        ]).draw(true);
    }
}

$('#btnSubmitAddItemShipments').click(function() {
    var strInvSender = ' <strong> ' + $("#sender-name").val() + ' </strong><br> ' + $("#sender-address").val() + '<br> Phone: ' + $("#sender-phone-no").val();
    var strInvReceipment = ' <strong> ' + $("#rec-name").val() + ' </strong><br> ' + $("#deliv-address").val() + '<br> Phone: ' + $("#rec-phone-no").val();
    var tagDestination = $("#deliv-area option:selected").val();
    var temp = tagDestination.split("|");
    shipmentsId = temp[temp.length - 4] + new Date().getTime();
    var strShipmentId = '<b> Shipment ID : </b> ' + shipmentsId;
    var strDelivArea = '<b> Delivery Area  : </b> ' + temp[temp.length - 3];
    var shippingCost = '1000';
    var strShippingCost = '<b> Shipping Cost : </b> ' + formatRupiah(shippingCost);
    var strDuration = '<b> Duration : </b> ' + temp[temp.length - 1] + 'Day';
    $('#inv-sender').html(strInvSender);
    $('#inv-receipment').html(strInvReceipment);
    $('#inv-shipment-id').html(strShipmentId);
    $('#inv-delivery-area').html(strDelivArea);
    $('#inv-shipment-cost').html(strShippingCost);
    $('#inv-shipment-duration').html(strDuration);
    $('#inv-subtotal').html(formatRupiah(shipments.subTotal()));
    $('#inv-shippingCost').html(formatRupiah(shippingCost));
    $('#inv-total').html(formatRupiah(shipments.total(shippingCost)));
    var arrayData = shipments.listItem();
    var tbody = $('#table-invoice tbody');
    arrayData.forEach(function(rowData) {
        var row = $('<tr>');
          $.each(rowData, function(colIndex, cellData) {
            var cell = $('<td>');
            cell.text(cellData);
            row.append(cell);
        });
        tbody.append(row);
    });
    $('#modal-invoice').modal('show');
});

$('#btnConfirmAddNewShipments').click(function() {
    $('#modal-invoice').modal('hide');
    return alert_confirm('Are you sure want to create this shipments?', function() {
        createShipements()
    });
});

function createShipements() {
    var senderName        = $("#sender-name").val();
    var senderAddress     = $("#sender-address").val();
    var senderPhoneNo     = $("#sender-phone-no").val();
    var receipmentName    = $("#rec-name").val();
    var receipmentPhoneNo = $("#rec-phone-no").val();
    var develiveryAddress = $("#deliv-address").val();
    var itemShipments     = shipments.listItem();
    $.ajax({
        type: "POST",
        url: "createShipments",
        data: {
            shipmentsId : shipmentsId,
            senderName: senderName,
            senderAddress: senderAddress,
            senderPhoneNo: senderPhoneNo,
            receipmentName: receipmentName,
            receipmentPhoneNo: receipmentPhoneNo,
            develiveryAddress: develiveryAddress,
            itemShipments: itemShipments
        },
        success: function(response) {
            if (response.statuscode != 200) {
                alert_info ( response.message, function(){location.reload();} );
                return;
            }
            $('#idShipmentsInvoice').val(response.object);
            $('#idFormPrintInvoice').submit();
        },
        error: function(response) {
            console.log(response);
            hideLoading();
            alert_info('System error. Please contact your administrator');
        },
    });
}

function loadRoute(){
    $.ajax({
        type: "GET",
        url: "getListRoute",
        dataType: "json",
        success: function(response) {
            if (response.message.toLowerCase() == 'success') {
                var select = $('#deliv-area');
                select.empty();
                select.append($('<option>', { 
                    value: null,
                    text : '-- Select Delivery Area --',
                    selected : true, disabled : true
                }));
                var dataObj = response.object;
                $.each(dataObj, function(key, value) {
                    var tag = value.shipment_code + '|' + value.destination  + '|'  + value.price + '|' + value.duration 
                    select.append($('<option>', { 
                        value: tag,
                        text : value.destination 
                    }));
                });
            }
        },
        error: function(response) {
            console.log(response);
        },
    });
}

function loadWeight(){
    $.ajax({
        type: "GET",
        url: "getListWeight",
        dataType: "json",
        success: function(response) {
            if (response.message.toLowerCase() == 'success') {
                weightRates = response.object;
            }
        },
        error: function(response) {
            console.log(response);
        },
    });
}
