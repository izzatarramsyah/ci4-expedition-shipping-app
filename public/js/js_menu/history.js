setDateRangePicker('inpDateRange');
var tableHistory = $('#table-history').DataTable();
var tableDetailHist = $('#table-detail-shipments').DataTable({
    "columnDefs": [
        { "width": "150px", "targets": 0, "className": "text-center" }, 
        { "width": "50px", "targets": 1, "className": "text-center" }, 
        { "width": "50px", "targets": 2, "className": "text-center" }
    ],
    "autoWidth": false,
});

$('#btnSearchHistory').click(function() {
    var shipmentsId = $('#inpShipmentsId').val();
    var dateRange = $('#inpDateRange').val();
    var startDate = '';
    var endDate = '';

    if ( shipmentsId == null || shipmentsId == '' ) {
        startDate = dateRange.substring(0, 10);
        endDate = dateRange.substring(13, 23);
    } 
    
    $.ajax({
        type: "POST",
        url: "checkHistory",
        data: {
            shipmentsId: shipmentsId,
            startDate : startDate,
            endDate : endDate
        },
        dataType: "json",
        success: function(response) {
            console.log(response);
            if (response.statuscode != 200) {
                toastr.error(response.message)
                return;
            } else if (response.message.toLowerCase() == 'success') {
                if ($.fn.dataTable.isDataTable('#table-history')) {
                    $('#table-history').DataTable().destroy();
                }
                tableHistory.clear().draw();
                for (var i = 0; i < response.object.length; i++) {
                    tableHistory.row.add([
                        '<a href="javascript:void(0);" data-shipment-id="' + response.object[i].shipmentId +'" class="shipmentsDetail">'+ response.object[i].shipmentId + ' </a>',
                        response.object[i].receipmentName,
                        response.object[i].receipmentPhoneNo,
                        response.object[i].deliveryAddress,
                        response.object[i].senderName,
                        response.object[i].senderPhoneNo,
                        response.object[i].senderAddress,
                        '<a href="javascript:void(0);" data-shipment-id="' + response.object[i].shipmentId +'" class="deliveryStatus">'+ response.object[i].status + ' </a>'
                    ]).draw(true);
                }
                tableHistory.draw();
            }
        },
        error: function(response) {
            console.log(response);
            alert_info('System error. Please contact your administrator');
        },
    });
});

$("#table-history").on("click", ".deliveryStatus", function(event) {
    var shipmentId = $(this).attr("data-shipment-id");
    $.ajax({
        type: "POST",
        url: "getDeliveryStatusById",
        data: { shipmentId: shipmentId },
        dataType: "json",
        success: function(response) {
            console.log(response);
            if (response.statuscode != 200) {
                toastr.error(data.message)
                return;
            } 
            var content = '';
            response.object.forEach(items => {
                content += 
                    '<div><i class="fas fa-user bg-green"></i> ' +
                    '<div class="timeline-item">' +
                    '<span class="time"><i class="fas fa-clock"></i> ' + items.delivery_date + '</span>' +
                    '<h3 class="timeline-header no-border"> ' + items.status + '</h3>' +
                    '</div></div>';
            });
            $('.timeline').html(content);
            $('#modal-shipments-delivery').modal('show');
        },
        error: function(response) {
            console.log(response);
            alert_info('System error. Please contact your administrator');
        },
    });
});

$("#table-history").on("click", ".shipmentsDetail", function(event) {
    var shipmentId = $(this).attr("data-shipment-id");
    $.ajax({
        type: "POST",
        url: "getShipmentDetail",
        data: { shipmentId: shipmentId },
        dataType: "json",
        success: function(response) {
            console.log(response);
            if (response.statuscode != 200) {
                toastr.error(response.message)
                return;
            } 
            if ($.fn.dataTable.isDataTable('#table-history')) {
                $('#table-history').DataTable().destroy();
            }
            tableDetailHist.clear().draw();
            var dataObj = response.object;
            for (var i = 0; i < dataObj.length; i++) {
                tableDetailHist.row.add([
                    dataObj[i].item_name,
                    dataObj[i].quantity,
                    dataObj[i].weight
                ]).draw(true);
            }
            tableDetailHist.draw();
            $('#modal-detail-shipments').modal('show');
        },
        error: function(response) {
            console.log(response);
            alert_info('System error. Please contact your administrator');
        },
    });
});

