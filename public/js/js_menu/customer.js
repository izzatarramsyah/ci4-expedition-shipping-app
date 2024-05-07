
loadCustomer();

function loadCustomer(){
    var table = $('#table-customer');
    table.dataTable().fnDestroy();
    table.DataTable({
        processing: true,
        columns: generateColumnTable(),
        ajax: {
            type: "GET",
            url: 'getListCustomer',
            dataSrc: function(data) {
                if (data.statuscode != 200) {
                	toastr.error(data.message);
                    return new Array();
                }
                //add button for edit
                rows = data.object;
                for (var index = 0; index < rows.length; index++) {
                    var no = (index+1);
                    rows[index].no = no;
                    rows[index].action = '<button type="button" onclick="showEidtCustomer(\''+(rows[index].id)+'\','+'\''+(rows[index].name)
                        +'\','+'\''+(rows[index].phone)+'\','+'\''+(rows[index].address)+'\','+'\''+(rows[index].status)+'\')" class="btn btn-info"><i class="fas fa-edit"></i></button> '+
                        '<button type="button" onclick="confirmDeleteCustomer(\''+( rows[index].id)+'\')" class="btn btn-info deleteRoute"><i class="fas fa-trash"></i></button>';
                    var status = '<span class="badge badge-success">Active</span>';
                    if ( rows[index].status == 'D' ) {
                        status = '<span class="badge badge-danger">In Active</span>';
                    }
                    rows[index].status = status;
                }
                return rows;
            },
            error: function(response) {
                toastr.error('System error. Please contact your administrator');
            },
        }
    });
}

function generateColumnTable() {
    var column = [];
    column = new Array(
        'no',
        'name',
        'phone',
        'address',
        'status',
        'action'
    );
    var result = new Array();
    for (var a = 0; a < column.length; a++) {
        var obj = {
            data: column[a]
        };
        result.push(obj);
    }
    return result;
}

function confirmDeleteCustomer(id){
    return alert_confirm('Are you sure want to delete this data ?', function(){deleteCustomer(id)})
}

function deleteCustomer(id){
    $.ajax({
        type: "POST",
        url: "deleteCustomer",
        data: { id: id },
        dataType: "json",
        success: function(response) {
            if ( response.statuscode == 200 ) {
                refreshDatatable('table-customer');
                toastr.success('Delete Customer Success');
            } else {
                toastr.error('Delete Customer Failed');
            }
        },
        error: function(response) {
            toastr.error('System error. Please contact your administrator');
        },
    });
}

function showEidtCustomer(id, name, phone, address, status){
    $("#idCustomer").val(id);
    $("#editName").val(name);
    $("#editPhoneNo").val(phone);
    $("#editAddress").val(address);
    $("#editStatus").val(status);
    $("#modal-edit-customer").modal('show');
};

$('#BtnAddCustomer').click(function() {
    var arrValidate = [];
    arrValidate.push('inpName', 'inpPhoneNo', 'inpAddress');
    if ( isInputValid(arrValidate) ) {
        showLoading('BtnAddCustomer');
        var name    = $("#inpName").val();
        var phoneNo = $("#inpPhoneNo").val();
        var address = $("#inpAddress").val();
        $.ajax({
            type: "POST",
            url: "saveCustomer",
            data: {
                name : name,
                phoneNo : phoneNo,
                address : address
            },
            success: function(response) {
                hideLoading('BtnAddCustomer');
                if (response.statuscode != 200) {
                    toastr.error(response.message);
                    return;
                }
                refreshDatatable('table-customer');
                toastr.success('Customer Added Successfully');
            },
            error: function(response) {
                hideLoading('BtnAddCustomer');
                toastr.error('System error. Please contact your administrator');
            },
        });
    }
});


$('#BtnEditCustomer').click(function() {
    var arrValidate = [];
    arrValidate.push('edit-name', 'edit-phoneNo', 'edit-address');
    if ( isInputValid(arrValidate) ) {
        showLoading('BtnAddCustomer');
        var name = $("#editName").val();
        var phoneNo = $("#editPhoneNo").val();
        var address = $("#editAddress").val();
        var id = $("#idCustomer").val();
        showLoading('BtnEditCustomer');
        $.ajax({
            type: "POST",
            url: "updateCustomer",
            data: {
                id : id,
                name : name,
                phoneNo : phoneNo,
                address : address
            },
            success: function(response) {
                hideLoading('BtnEditCustomer');
                if (response.statuscode != 200) {
                    toastr.error(response.message);
                    return;
                }
                refreshDatatable('table-customer');
                toastr.success('Edit Customer Success');
            },
            error: function(response) {
                hideLoading();
                alert_info('System error. Please contact your administrator');
            },
        });
    }
});
