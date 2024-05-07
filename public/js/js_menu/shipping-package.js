var table = $('#table-shipping-package').DataTable({
    "columnDefs": [
        { "width": "15px", "targets": 0, "className": "text-center" }, 
        { "width": "150px", "targets": 1, "className": "text-center" }, 
        { "width": "150px", "targets": 2, "className": "text-center" },  
        { "width": "15px", "targets": 3, "className": "text-center" }
    ],
    "autoWidth": false,
});
var listDataIsChecked = [];
loadRoute();
setDateRangePicker('inpDateRange');
        
function loadRoute() {
    $.ajax({
        type: "GET",
        url: "getListRoute",
        dataType: "json",
        success: function(response) {
            if (response.message.toLowerCase() == 'success') {
                var select = $('#optRoute');
                select.empty();
                select.append($('<option>', {
                    value: null,
                    text: '-- Select Delivery Area --',
                    selected: true,
                    disabled: true
                }));
                var dataObj = response.object;
                $.each(dataObj, function(key, value) {
                    select.append($('<option>', {
                        value: value.shipment_code,
                        text: value.destination
                    }));
                });
            }
        },
        error: function(response) {
            console.log(response);
        },
    });
}

function getDeliveryStatus() {
    var delivArea = $("#optRoute option:selected").val();
    var dateRange = $('#inpDateRange').val();
    var startDate = dateRange.substring(0, 10);
    var endDate = dateRange.substring(13, 23);
    $.ajax({
        type: "POST",
        url: "getDeliveryStatus",
        data: {
            endDate: endDate,
            startDate: startDate,
            delivArea: delivArea
        },
        dataType: "JSON",
        success: function(data) {
            if (data.statuscode != 200) {
                alert_error(data.message)
                return;
            } 
            if ($.fn.dataTable.isDataTable('#table-stok')) {
                $('#table-shipping-package').DataTable().destroy();
            }
            var dataArr = data.object;
            var no = 0;
	        for(var a=0;a<dataArr.length;a++){
                var dataObj = dataArr[a];
                no = no + 1;
                table.row.add([
                    no,
                    dataObj.shipment_id,
                    dataObj.status,
                    '<input type="checkbox" class="checkboxclass" id="checkbox-approve-' + dataObj.shipment_id + '"></input>'
                ]).draw(true);
            }
            table.draw();
        },
        error: function(response) {
            console.log(response);
        },
    });
}


function updateDeliveryStatus() {
    var list = table.rows().data().toArray();
    var arrCheckBox = [];
    table.$('input[type="checkbox"]').each(function() {
        if (this.checked) {
            arrCheckBox.push(this.id);
         }
    });
    if (arrCheckBox.length == 0) {
        toastr.error('Please check shipment to proccessed');
        return;
    }
    listDataIsChecked = [];
    for (var i = 0; i < list.length; i++) {
        var id = 'checkbox-approve-' + list[i][1];
        for (var x = 0; x < arrCheckBox.length; x++) {
            if (id == arrCheckBox[x]) {
                listDataIsChecked.push(list[i][1]);
            }
        }
    }
    var tableShippingUpdate = $('#table-shipping-update').DataTable({
        "columnDefs": [
            { "width": "15px", "targets": 0, "className": "text-center" },
            { "width": "159px", "targets": 1, "className": "text-center" },
        ],
        "autoWidth": false,
    });
    var no = 1;
    tableShippingUpdate.clear().draw();
    for(var i = 0; i < listDataIsChecked.length; i++){
        tableShippingUpdate.row.add([
            no,
            listDataIsChecked[i]
        ]).draw(true);
        no++;
    }    
    tableShippingUpdate.draw();
    $('#modal-process-update').modal('show');    
}

$('#btnSubmitAddItemShipments').click(function() {
    $('#modal-process-update').modal('hide');
    return alert_confirm('Are you sure want to update this shipments?', function() {
        updateShipements()
    });
});

function updateShipements(){
    var itemShipments = listDataIsChecked;
    var status =  $("#optStatusDelivery option:selected").val();
    $.ajax({
        type: "POST",
        url: "updateShipments",
        data: {
            itemShipments: itemShipments,
            status : status
        },
        success: function(response) {
            if (response.statuscode != 200) {
                toastr.error(response.message);
                return;
            }
            getDeliveryStatus();
            toastr.success('Shipment status update successfully');
        },
        error: function(response) {
            console.log(response);
            toastr.error('System error. Please contact your administrator');
        },
    });
}