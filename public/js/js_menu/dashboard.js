var tableDashboard = $('#table-dashboard').DataTable();
loadDashboardInfo();
loadDashboardTable();
function loadDashboardInfo() {
    $.ajax({
        type: "GET",
        url: "getDeliveryStatusData",
        dataType: "json",
        success: function(response) {
            if (response.statuscode != 200) {
                toastr.error(response.message);
                return;
            }
            var labels = ['May'];
            var totalShipments = 0;
            var failedShipments = 0;
            var successShipments = 0;
            var onProgressShipments = 0;
            var arrFailDelivery = [0];
            var arrSuccessDelivery = [0];
            var arrOnGoingDelivery = [0];
            var rows = response.object;
            var labelIndex = 0;
            labels.forEach((month) => {
                for (var index = 0; index < rows.length; index++) {
                    if (rows[index].month == month) {
                        if (rows[index].status == 'On Progress') {
                            arrOnGoingDelivery[labelIndex] = Number(rows[index].count);
                            onProgressShipments++;
                        }
                        if (rows[index].status == 'Success') {
                            arrSuccessDelivery[labelIndex] = Number(rows[index].count);
                            successShipments++;
                        }
                        if (rows[index].status == 'Failed') {
                            arrFailDelivery[labelIndex] = Number(rows[index].count);
                            failedShipments++;
                        }
                        totalShipments++;
                    }
                }
                labelIndex++;
            });
            debugger;
            $('.totalShipments').html(totalShipments);
            $('.failedDelivery').html(failedShipments);
            $('.successDelivery').html(successShipments);
            $('.onProcessDelivery').html(onProgressShipments);
            var salesChartCanvas = $('#salesChart').get(0).getContext('2d')
            var salesChartData = {
                labels: labels,
                datasets: [{
                        label: 'Delivery Shipments',
                        backgroundColor: 'rgba(60,141,188,0.9)',
                        borderColor: 'rgba(60,141,188,0.8)',
                        pointRadius: false,
                        pointColor: '#3b8bba',
                        pointStrokeColor: 'rgba(60,141,188,1)',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: 'rgba(60,141,188,1)',
                        data: arrSuccessDelivery
                    },
                    {
                        label: 'Failed Shipments',
                        backgroundColor: 'rgba(210, 214, 222, 1)',
                        borderColor: 'rgba(210, 214, 222, 1)',
                        pointRadius: false,
                        pointColor: 'rgba(210, 214, 222, 1)',
                        pointStrokeColor: '#c1c7d1',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: 'rgba(220,220,220,1)',
                        data: arrFailDelivery
                    },
                ]
            }

            var salesChartOptions = {
                maintainAspectRatio: false,
                responsive: true,
                legend: {
                    display: false
                },
                scales: {
                    xAxes: [{
                        gridLines: {
                            display: false,
                        }
                    }],
                    yAxes: [{
                        gridLines: {
                            display: false,
                        }
                    }]
                }
            }

            // This will get the first returned node in the jQuery collection.
            var salesChart = new Chart(salesChartCanvas, {
                type: 'line',
                data: salesChartData,
                options: salesChartOptions
            })

        },
        error: function(response) {
            toastr.error('System error. Please contact your administrator');
        },
    });
}

function loadDashboardTable() {
    var table = $('#table-dashboard');
    table.dataTable().fnDestroy();
    table.DataTable({
        processing: true,
        columns: generateColumnTable(),
        ajax: {
            type: "GET",
            url: 'getLatestOrder',
            dataSrc: function(data) {
                if (data.statuscode != 200) {
                	toastr.error(data.message);
                    return new Array();
                }
                return data.object;
            },
            error: function(response) {
                toastr.error('System error. Please contact your administrator');
            },
        }
    });
};

function generateColumnTable() {
  var column = [];
  column = new Array(
    'shipmentId',
    'receipmentName',
    'receipmentPhoneNo',
    'deliveryAddress',
    'senderName',
    'senderPhoneNo',
    'senderAddress',
    'status'
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