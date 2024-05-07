<!-- Modal Invoice -->
<div class="modal fade" id="modal-edit-customer">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Edit Customer</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="editName">Full Name</label>
              <input type="text" id="editName" name="editName" class="form-control">
              <div id="err-editName" style="color: red;" hidden="true">*Code must be fill</div>    
            </div>
            <!-- /.form-group -->
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="editPhoneNo">Phone No</label>
              <input type="text" id="editPhoneNo" name="editPhoneNo" class="form-control">
              <div id="err-editPhoneNo" style="color: red;" hidden="true">*Code must be fill</div>    
            </div>
            <!-- /.form-group -->
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="editAddress">Address</label>
              <textArea id="editAddress" name="editAddress" class="form-control"></textArea>
              <div id="err-editAddress" style="color: red;" hidden="true">*Code must be fill</div>    
            </div>
            <!-- /.form-group -->
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="editStatus">Status</label>
              <select id="editStatus" name="editStatus" class="form-control select2" style="width: 100%;">
              <option value = "A">ACTIVE</option>
              <option value = "D">IN ACTIVE</option>
              </select>
              <div id="err-editStatus" style="color: red;" hidden="true">*Code must be fill</div>    
            </div>
            <!-- /.form-group -->
          </div>
        </div>
        <input type="text" id="idCustomer" name="idCustomer" class="form-control" hidden="true">
      </div>
      <div class="modal-footer">
        <button id="BtnEditCustomer" type="button" class="btn btn-primary float-right" data-dismiss="modal">
        <div id="submitBtnEditCustomer">Submit</div>
        <div id="loadingBtnEditCustomer" hidden="true"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...</div>
        </button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->