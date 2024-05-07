$('.inp-number').on('keydown', function(e) {
    var charCode = (e.which) ? e.which : e.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
});

$('.inp-decimal').on('keydown', function(e) {
    $(this).val($(this).val().replace(/[^0-9.]/g, ''));
    // Remove leading zeros
    if ($(this).val().charAt(0) === '0' && $(this).val().length > 1) {
        $(this).val($(this).val().substring(1));
    }
    // Remove multiple decimal points
    if ($(this).val().split('.').length > 2) {
        $(this).val($(this).val().substring(0, $(this).val().lastIndexOf('.')));
    }
});

var Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
});

function refreshDatatable(elementId){
    var table = $('#'+elementId).DataTable();
    table.ajax.reload();
}

function setDateRangePicker(elementName) {
    $('#'+elementName+'').daterangepicker();
} 

// function
function alert_warning(message, callback) {
    $('html, body').animate({scrollTop:20}, 'slow');
    $('#modal-alert').modal('show');
    $('#modal-alert-title').html('Warnings');
    $('#btn-no').html('OK');
    $('#btn-yes').hide();
    $('#modal-alert-message').html(message);
    $('#btn-no').trigger('focus');
    $('#btn-no').off('click').on('click', function () {
        $('#modal-alert').modal('hide');
        if (typeof callback === 'function') {
            callback();
        }
    });
}

function alert_info(message, callback) {
    $('html, body').animate({scrollTop:20}, 'slow');
    $('#modal-alert').modal('show');
    $('#modal-alert-title').html('Information');
    $('#btn-no').html('OK');
    $('#btn-yes').hide();
    $('#modal-alert-message').html(message);
    $('#btn-no').trigger('focus');
    $('#btn-no').off('click').on('click', function () {
        $('#modal-alert').modal('hide');
        if (typeof callback === 'function') {
            callback();
        }
    });
}

function alert_confirm(message, callback) {
    $('html, body').animate({scrollTop:20}, 'slow');
    $('#modal-alert').modal('show');
    $('#modal-alert-title').html('Confirmation');
    $('#btn-yes').show();
    $('#btn-no').html('No');
    $('#modal-alert-message').html(message);
    $('#btn-yes').trigger('focus');
    $('#btn-yes').off('click').on('click', function () {
        $('#modal-alert').modal('hide');
        if (typeof callback === 'function') {
            callback();
        }
    });
    $('#btn-no').off('click').on('click', function () {
        $('#modal-alert').modal('hide');
    });
}

function formatRupiah(angka) {
    var number_string = angka.replace(/[^,\d]/g, '').toString(),
    split   		= number_string.split(','),
    sisa     		= split[0].length % 3,
    rupiah     		= split[0].substr(0, sisa),
    ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);
    if(ribuan){
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }
    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    return rupiah;
}

function isInputValid (elementsId) {
    var isInputValid = true;
    for ( var i = 0; i < elementsId.length; i++) {
        var value = $('#'+elementsId[i]).val();
        if ( value == '' || value == null ) {
            isInputValid = false;
            $('#err-'+elementsId[i]).prop("hidden", false);
        } else {
            $('#err-'+elementsId[i]).prop("hidden", true);
        }
    }
    return isInputValid;
}

function showLoading (elementsId) {
    $('#'+elementsId).prop('disabled',true);
    $('#submit'+elementsId).prop('hidden',true);
    $('#loading'+elementsId).prop('hidden',false);
}

function hideLoading (elementsId) {
    $('#'+elementsId).prop('disabled',false);
    $('#submit'+elementsId).prop('hidden',false);
    $('#loading'+elementsId).prop('hidden',true);
}