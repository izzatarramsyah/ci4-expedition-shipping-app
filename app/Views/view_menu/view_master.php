<?= $this->extend('layout/dashboard'); ?> 
<?= $this->section('content'); ?> 
<div class="row">
<div class="col-md-12">
        <div class="card card-default">
            <form id="form_add_stock" method="post" enctype="multipart/form-data" class="form-wizard">
                <div class="card-header">
                    <h3 class="card-title">Data Master</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                            <label for="optDataMasterType">DATA MASTER TYPE</label>
                            <select id="optDataMasterType" name="optDataMasterType" class="form-control select2" style="width: 100%;">
                              <option value="" disabled selected>-- Please Select --</option>
                              <option value="route">SHIPPING ROUTE</option>
                              <option value="weight">WEIGTH RATE</option>
                            </select>
                            <div id="err-optDataMasterType" style="color: red;" hidden="true">*Data Master must be fill</div>    
                        </div>
                      </div>
                    </div>
                    <div class="row inpGroupRoute" hidden="true">
                        <div class="col-md-6">
                            <div class="form-group">
                            <label for="inpShipmentCode">SHIPMENT CODE</label>
                            <input type="text" id="inpShipmentCode" name="inpShipmentCode" class="form-control">
                            <div id="err-inpShipmentCode" style="color: red;" hidden="true">*Code must be fill</div>    
                          </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                            <label for="inpDestination">DESTINATION</label>
                            <input type="text" id="inpDestination" name="inpDestination" class="form-control">
                            <div id="err-inpDestination" style="color: red;" hidden="true">*Area must be fill</div>    
                          </div>
                        </div>
                    </div>
                    <div class="row inpGroupRoute" hidden="true">
                        <div class="col-md-6">
                            <div class="form-group">
                            <label for="inpDuration">DURATION</label>
                            <input type="text" id="inpDuration" name="inpDuration" class="form-control inp-number">
                            <div id="err-inpDuration" style="color: red;" hidden="true">*Duration must be fill</div>    
                          </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                            <label for="inpPrice">PRICE</label>
                            <input type="text" id="inpPrice" name="inpPrice" class="form-control inp-number">
                            <div id="err-inpPrice" style="color: red;" hidden="true">*Price must be fill</div>    
                          </div>
                        </div>
                    </div>
                    <div class="row inpGroupWeightRoute" hidden="true">
                        <div class="col-md-2">
                            <div class="form-group">
                            <label for="inpMinWeight">MIN WEIGHT</label>
                            <input type="text" id="inpMinWeight" name="inpMinWeight" class="form-control">
                            <div id="err-inpMinWeight" style="color: red;" hidden="true">*Min Weight must be fill</div>    
                          </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                            <label for="inpMaxWeight">MAX WEIGHT</label>
                            <input type="text" id="inpMaxWeight" name="inpMaxWeight" class="form-control">
                            <div id="err-inpMaxWeight" style="color: red;" hidden="true">*Max Weight must be fill</div>    
                          </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                            <label for="inpPriceWeight">PRICE</label>
                            <input type="text" id="inpPriceWeight" name="inpPriceWeight" class="form-control">
                            <div id="err-inpPriceWeight" style="color: red;" hidden="true">*Price must be fill</div>    
                          </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                    <button id="BtnAddWeight" type="button" class="btn btn-primary float-right"> 
                      <div id="submitBtnAddWeight">Submit</div>
                      <div id="loadingBtnAddWeight" hidden="true"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...</div>
                    </button>
                </div>
            </form>
        </div>
    <!-- /.card -->
    </div>
</div>
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Detail Data Master</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <div class = "tblRoute" hidden="true">
          <table id="table-route" class="table table-bordered table-hover" width="100%">
            <thead>
              <tr>
                <th>NO</th>
                <th>CODE</th>
                <th>AREA</th>
                <th>Est DURATION</th>
                <th>PRICE</th>
                <th>ACTION</th>
              </tr>
            </thead>
          </table>
        </div>
        <div class = "tblWeight" hidden="true">
          <table id="table-weight" class="table table-bordered table-hover" width="100%">
            <thead>
              <tr>
                <th>NO</th>
                <th style="display: none">ID</th>
                <th>MIN WEIGHT</th>
                <th>MAX WEIGHT</th>
                <th>PRICE</th>
                <th>ACTION</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection(); ?>