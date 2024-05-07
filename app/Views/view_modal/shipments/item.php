<!-- Modal Invoice -->
<div class="modal fade" id="modal-input-shipments">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Shipments Item</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <button style="margin-bottom:10px" class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseinputItem" aria-expanded="false" aria-controls="collapseinputItem">
          <i class="fas fa-plus"></i> Add New Shipments Item </button>
        <div class="collapse" id="collapseinputItem">
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label for="item-type">Item Type</label>
                <select id="item-type" name="item-type" class="form-control select2" style="width: 100%;">
                  <option selected="selected" disabled value=''>-- Please Select --</option>
                  <option>Document</option>
                  <option>Electronic</option>
                  <option>Dangerous Products</option>
                  <option>Food</option>
                  <option>Light Goods</option>
                  <option>Heavy Goods</option>
                </select>
                <div id="err-item-type" style="color: red;" hidden="true">*Item Type must be fill</div>    
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="item-name">Item Name</label>
                <input type="text" id="item-name" name="item-name" class="form-control">
                <div id="err-item-name" style="color: red;" hidden="true">*Item Name must be fill</div>    
              </div>
              <!-- /.form-group -->
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label for="item-weight">Item Weight</label>
                <input type="text" id="item-weight" name="item-weight" class="form-control inp-decimal">
                <div id="err-item-weight" style="color: red;" hidden="true">*Item Weight must be fill</div>    
              </div>
              <!-- /.form-group -->
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label for="item-quantity">Item Quantity</label>
                <input type="text" id="item-quantity" name="item-quantity" class="form-control inp-number">
                <div id="err-item-quantity" style="color: red;" hidden="true">*Item Quantity must be fill</div>    
              </div>
              <!-- /.form-group -->
            </div>
            <div class="col-md-2">
              <label style="margin-top:45px;"></label>
              <button id="btnAddItemShipments" type="button" class="btn btn-primary">
                <i class="fas fa-save"></i> Add Item </button>
            </div>
          </div>
        </div>
        <br>
        <h4>LIST ITEM</h4>
        <div class="row">
          <div class="col-md-12">
            <table id="table-item-shipments" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Type</th>
                  <th>Weight</th>
                  <th>Quantity</th>
                  <th>Action</th>
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