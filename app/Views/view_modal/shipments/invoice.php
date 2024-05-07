<!-- Modal Invoice -->
<div class="modal fade" id="modal-invoice">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Shipments Invoice</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style=" position: relative; overflow-y: auto; padding: 15px;">
        <div class="invoice p-3 mb-3">
          <!-- title row -->
          <div class="row">
            <div class="col-12">
              <h4>
                <i class="fas fa-globe"></i> AdminLTE, Inc. <small class="float-right">Date: <?php setlocale(LC_TIME, 'Indonesian'); $dateS = strftime( "%d %B %Y", time()); echo $dateS;  ?> </small>
              </h4>
            </div>
          </div>
          <!-- info row -->
          <div class="row invoice-info">
            <div class="col-sm-4 invoice-col"> From <address>
                <div id="inv-sender"></div>
              </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col"> To <address>
                <div id="inv-receipment"></div>
              </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
              <div id="inv-shipment-id"></div>
              <div id="inv-delivery-area"></div>
              <div id="inv-shipment-cost"></div>
              <div id="inv-shipment-duration"></div>
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
          <!-- Table row -->
          <div class="row mt-4">
            <div class="col-12 table-responsive">
              <table id="table-invoice" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>Item Type</th>
                    <th>Weight</th>
                    <th>Item Name</th>
                    <th>Quantity</th>
                  </tr>
                </thead>
                <tbody></tbody>
              </table>
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
          <br>
          <!-- this row will not appear when printing -->
          <div class="row">
            <!-- accepted payments column -->
            <div class="col-6"></div>
            <!-- /.col -->
            <div class="col-6">
              <div class="table-responsive">
                <table class="table">
                  <tr>
                    <th style="width:50%">Subtotal:</th>
                    <td id="inv-subtotal"></td>
                  </tr>
                  <tr>
                    <th>Shipping:</th>
                    <td id="inv-shippingCost"></td>
                  </tr>
                  <tr>
                    <th>Total:</th>
                    <td id="inv-total"></td>
                  </tr>
                </table>
              </div>
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
          <div class="row no-print">
            <div class="col-12">
              <button id="btnConfirmAddNewShipments" type="button" class="btn btn-success float-right">
                <i class="fas fa-print"></i> Submit </button>
              <!-- <a href="invoice-print.html" target="_blank" class="btn btn-primary float-right" style="margin-right: 5px;" id="btnPrintInvoice"><i class="fas fa-print"></i> Print Invoice </a> -->
              <form id="idFormPrintInvoice" target="_blank" action=" 
										<?=site_url('printInvoice') ?>" method="post" hidden>
                <input id="idShipmentsInvoice" type="hidden" name="idShipmentsInvoice">
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->