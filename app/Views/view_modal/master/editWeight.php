<!-- Modal Invoice -->
<div class="modal fade" id="modal-edit-weight">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Edit Weight</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="editMinWeight">MIN WEIGHT</label>
              <input type="text" id="editMinWeight" name="editMinWeight" class="form-control">
              <div id="err-editMinWeight" style="color: red;" hidden="true">*Min Weight must be fill</div>    
            </div>
            <!-- /.form-group -->
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="editMaxWeight">MAX WEIGHT</label>
              <input type="text" id="editMaxWeight" name="editMaxWeight" class="form-control">
              <div id="err-editMaxWeight" style="color: red;" hidden="true">*Max Weight must be fill</div>    
            </div>
            <!-- /.form-group -->
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="editPriceWeight">PRICE</label>
              <input id="editPriceWeight" name="editPriceWeight" class="form-control">  
              <div id="err-editPriceWeight" style="color: red;" hidden="true">*Price must be fill</div>    
            </div>
            <!-- /.form-group -->
          </div>
        </div>
        <input type="text" id="idWeight" name="idWeight" class="form-control" hidden="true">
      </div>
      <div class="modal-footer">
        <button id="BtnSubmitEditWeight" type="button" class="btn btn-primary float-right" data-dismiss="modal">
        <div id="submitBtnSubmitEditWeight">Submit</div>
        <div id="loadingBtnSubmitEditWeight" hidden="true"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...</div>
        </button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->