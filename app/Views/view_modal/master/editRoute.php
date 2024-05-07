<!-- Modal Invoice -->
<div class="modal fade" id="modal-edit-route">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Edit Route</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="editShipmentCode">SHIPMENT CODE</label>
              <input type="text" id="editShipmentCode" name="editShipmentCode" class="form-control" disabled>
              <div id="err-editShipmentCode" style="color: red;" hidden="true">*Code must be fill</div>    
            </div>
            <!-- /.form-group -->
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="editDestination">Destination</label>
              <input type="text" id="editDestination" name="editDestination" class="form-control">
              <div id="err-editDestination" style="color: red;" hidden="true">*Code must be fill</div>    
            </div>
            <!-- /.form-group -->
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="editDuration">Est Duration</label>
              <input id="editDuration" name="editDuration" class="form-control">  
              <div id="err-editDuration" style="color: red;" hidden="true">*Code must be fill</div>    
            </div>
            <!-- /.form-group -->
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="editPrice">Price</label>
              <input id="editPrice" name="editPrice" class="form-control">
              <div id="err-editPrice" style="color: red;" hidden="true">*Code must be fill</div>    
            </div>
            <!-- /.form-group -->
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button id="BtnSubmitEditRoute" type="button" class="btn btn-primary float-right" data-dismiss="modal">
        <div id="submitBtnSubmitEditRoute">Submit</div>
        <div id="loadingBtnSubmitEditRoute" hidden="true"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...</div>
        </button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->