
$('#optDataMasterType').change(function() {
    var selectedValue = $(this).val();
    $('.inpGroupRoute').prop('hidden', true);
    $('.inpGroupWeightRoute').prop('hidden', true);
    $('.tblRoute').prop('hidden', true);
    $('.tblWeight').prop('hidden', true);
    if ( selectedValue == 'route' ) {
        loadRoute();
        $('.inpGroupRoute').prop('hidden', false);
        $('.tblRoute').prop('hidden', false);
    } else if ( selectedValue == 'weight' ) {
        loadWeight();
        $('.inpGroupWeightRoute').prop('hidden', false);
        $('.tblWeight').prop('hidden', false);
    }
});

function loadRoute(){
    var table = $('#table-route');
    table.dataTable().fnDestroy();
    table.DataTable({
        processing: true,
        columns: generateColumnTable('route'),
        ajax: {
            type: "GET",
            url: 'getListRoute',
            dataSrc: function(data) {
                if (data.statuscode != 200) {
                	toastr.error(data.message);
                    return new Array();
                }
                //add button for edit
                rows = data.object;
                for (var index = 0; index < rows.length; index++) {
                    var no = (index+1);
                    rows[index].no = no
                    rows[index].duration = rows[index].duration + ' Day';
                    rows[index].price = formatRupiah(rows[index].price)
                    rows[index].action = 
                    '<button type="button" onclick="showEditRoute(\''+( rows[index].shipment_code)+'\')" class="btn btn-info editRoute"><i class="fas fa-edit"></i></button> '+
                    '<button type="button" onclick="confirmDeleteRoute(\''+( rows[index].shipment_code)+'\')" class="btn btn-info deleteRoute"><i class="fas fa-trash"></i></button>'
                }
                return rows;
            },
            error: function(response) {
                toastr.error('System error. Please contact your administrator');
            },
        }
    });
}

function loadWeight(){
    var table = $('#table-weight');
    table.dataTable().fnDestroy();
    table.DataTable({
        processing: true,
        columns: generateColumnTable('weight'),
        columnDefs:[{ targets:1, visible:false }],
        ajax: {
            type: "GET",
            url: 'getListWeight',
            dataSrc: function(data) {
                if (data.statuscode != 200) {
                	toastr.error(data.message);
                    return new Array();
                }
                //add button for edit
                rows = data.object;
                for (var index = 0; index < rows.length; index++) {
                    var no = (index+1);
                    rows[index].no = no
                    rows[index].price = formatRupiah(rows[index].price);
                    rows[index].action = 
                    '<button type="button" onclick="showEditWeight(\''+( rows[index].id)+'\')" class="btn btn-info editRoute"><i class="fas fa-edit"></i></button> '+
                    '<button type="button" onclick="confirmDeleteWeight(\''+( rows[index].id)+'\')" class="btn btn-info deleteRoute"><i class="fas fa-trash"></i></button>'
                }
                return rows;
            },
            error: function(response) {
                toastr.error('System error. Please contact your administrator');
            },
        }
    });
}

function generateColumnTable(type) {
    var column = [];
    if ( type == 'route' ) {
        column = new Array(
            'no',
            'shipment_code',
            'destination',
            'duration',
            'price',
            'action'
        );
    } else if ( type == 'weight' ) {
        column = new Array(
            'no',
            'id',
            'min_weight',
            'max_weight',
            'price',
            'action'
        );
    }
 
    var result = new Array();
    for (var a = 0; a < column.length; a++) {
        var obj = {
            data: column[a]
        };
        result.push(obj);
    }
    return result;
}

$('#inpPrice').keyup(function() {
    var value = $('#inpPrice').val();
	$('#inpPrice').val(formatRupiah(value));
});

$('#BtnAddRoute').click(function() {
    var arrValidate = [];
    arrValidate.push('inpShipmentCode', 'inpDestination', 'inpDuration', 'inpPrice');
    if ( isInputValid(arrValidate) ) {
        showLoading('BtnAddRoute');
        var shipmentCode  = $("#inpShipmentCode").val();
        var destination   = $("#inpDestination").val();
        var duration      = $("#inpDuration").val();
        var price         = $("#inpPrice").val();
        showLoading();
        $.ajax({
            type: "POST",
            url: "saveRoute",
            data: {
                shipment_code : shipmentCode,
                destination : destination,
                duration : duration,
                price : price
            },
            success: function(response) {
                hideLoading('BtnAddRoute');
                if (response.statuscode != 200) {
                	toastr.error(response.message);
                    return;
                }
                refreshDatatable('table-route');
                toastr.success('Route added successfully');
            },
            error: function(response) {
                hideLoading('BtnAddRoute');
                toastr.error('System error. Please contact your administrator');
            },
        });
    }
});

function confirmDeleteRoute(shipmentCode){
    return alert_confirm('Are you sure want to delete this data ?', function(){deleteRoute(shipmentCode)})
}

function deleteRoute(shipmentCode){
    $.ajax({
        type: "POST",
        url: "deleteRoute",
        data: { code: shipmentCode },
        dataType: "json",
        success: function(response) {
            if (response.statuscode != 200) {
                toastr.error(response.message);
                return;
            }
            refreshDatatable('table-route');
            toastr.success('Delete Route Success');
        },
        error: function(response) {
            console.log(response);
            toastr.error('System error. Please contact your administrator');
        },
    });
}

function showEditRoute (shipmentCode) {
    $.ajax({
        type: "POST",
        url: "getRoute",
        data: { 
            code: shipmentCode 
        },
        dataType: "json",
        success: function(response) {
            if (response.statuscode != 200) {
                toastr.error(response.message);
                return;
            }
            $('#editShipmentCode').val(response.object[0].shipment_code);
            $('#editDestination').val(response.object[0].destination);
            $('#editDuration').val(response.object[0].duration);
            $('#editPrice').val(response.object[0].price);
            $('#modal-edit-route').modal('show');
        },
        error: function(response) {
            console.log(response);
        },
    });
}

$('#BtnSubmitEditRoute').click(function() {
    var arrValidate = [];
    arrValidate.push('editShipmentCode', 'editDestination', 'editDuration', 'editPrice');
    if ( isInputValid(arrValidate) ) {
        showLoading('BtnSubmitEditRoute');
        var shipment_code = $('#editShipmentCode').val();
        var destination   = $('#editDestination').val();
        var duration      = $('#editDuration').val();
        var price         = $('#editPrice').val();
        $.ajax({
            type: "POST",
            url: "updateRoute",
            data: {
                shipment_code : shipment_code,
                destination : destination,
                duration : duration,
                price : price
            },
            success: function(response) {
                hideLoading('BtnSubmitEditRoute');
                if (response.statuscode != 200) {
                    toastr.error(response.message);
                    return;
                }
                refreshDatatable('table-route');
                toastr.success('Edit Route Success');
                $('#modal-edit-route').modal('hide');
            },
            error: function(response) {
                hideLoading('BtnSubmitEditRoute');
                toastr.error('System error. Please contact your administrator');
            },
        });
    }
});

$('#BtnAddWeight').click(function() {
    var arrValidate = [];
    arrValidate.push('inpMinWeight', 'inpMaxWeight', 'inpPriceWeight');
    if ( isInputValid(arrValidate) ) {
        showLoading('BtnAddWeight');
        var minWeight = $("#inpMinWeight").val();
        var maxWeight = $("#inpMaxWeight").val();
        var price     = $("#inpPriceWeight").val();
        showLoading();
        $.ajax({
            type: "POST",
            url: "saveWeight",
            data: {
                minWeight : minWeight,
                maxWeight : maxWeight,
                price     : price
            },
            success: function(response) {
                hideLoading('BtnAddWeight');
                if (response.statuscode != 200) {
                    toastr.error(response.message);
                    return;
                }
                refreshDatatable('table-weight');
                toastr.success('Weight added successfully');
            },
            error: function(response) {
                hideLoading('BtnAddWeight');
                toastr.error('System error. Please contact your administrator');
            },
        });
    }
});

function confirmDeleteWeight(id){
    return alert_confirm('Are you sure want to delete this data ?', function(){deleteWeight(id)})
}

function deleteWeight(id){
    $.ajax({
        type: "POST",
        url: "deleteWeight",
        data: { id : id },
        dataType: "json",
        success: function(response) {
            if (response.statuscode != 200) {
                toastr.error(response.message);
                return;
            }
            refreshDatatable('table-weight');
            toastr.success('Delete Weight Success');
        },
        error: function(response) {
            console.log(response);
            toastr.error('System error. Please contact your administrator');
        },
    });
}

function showEditWeight (id) {
    $.ajax({
        type: "POST",
        url: "getWeight",
        data: { 
            id : id 
        },
        dataType: "json",
        success: function(response) {
            if (response.statuscode != 200) {
                toastr.error(response.message);
                return;
            }
            $('#editMinWeight').val(response.object[0].max_weight);
            $('#editMaxWeight').val(response.object[0].min_weight);
            $('#editPriceWeight').val(response.object[0].price);
            $('#idWeight').val(response.object[0].id);
            $('#modal-edit-weight').modal('show');
        },
        error: function(response) {
            console.log(response);
        },
    });
}

$('#BtnSubmitEditWeight').click(function() {
    var arrValidate = [];
    arrValidate.push('editMinWeight', 'editMaxWeight', 'editPriceWeight');
    if ( isInputValid(arrValidate) ) {
        showLoading('BtnSubmitEditWeight');
        var minWeight = $('#editMinWeight').val();
        var maxWeight = $('#editMaxWeight').val();
        var id        = $('#idWeight').val();
        var price     = $('#editPriceWeight').val();
        $.ajax({
            type: "POST",
            url: "updateWeight",
            data: {
                minWeight : minWeight,
                maxWeight : maxWeight,
                id        : id,
                price     : price
            },
            success: function(response) {
                hideLoading('BtnSubmitEditWeight');
                if (response.statuscode != 200) {
                    toastr.error(response.message);
                    return;
                }
                refreshDatatable('table-weight');
                toastr.success('Edit Weight Success');
                $('#modal-edit-weight').modal('hide');
            },
            error: function(response) {
                hideLoading('BtnSubmitEditRoute');
                toastr.error('System error. Please contact your administrator');
            },
        });
    }
});