<!-- Modal Invoice -->
<div class="modal fade" id="modal-process-update">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Update Process</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="optStatusDelivery">Status Shipping</label>
                <select id="optStatusDelivery" name="optStatusDelivery" class="form-control select2" style="width: 100%;">
                    <option value="" disabled selected>-- Please Select --</option>
                    <option value="Shipped">Shipped</option>
                    <option value="Delayed">Delayed</option>
                    <option value="Out Of Delivery">Out Of Delivery</option>
                    <option value="Returned">Returned</option>
                    <option value="Package Received">Package Received</option>
                </select>
                <div id="err-optStatusDelivery" style="color: red;" hidden="true">*Status Delivery must be fill</div>    
              </div>
            </div>
          </div>
        <br>
        <div class="row">
          <div class="col-md-12">
            <table id="table-shipping-update" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Shippment ID</th>
                </tr>
              </thead>
              <tbody></tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="modal-footer">
       <button id="btnSubmitAddItemShipments" type="button" class="btn btn-primary float-right" data-dismiss="modal" >Submit</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->