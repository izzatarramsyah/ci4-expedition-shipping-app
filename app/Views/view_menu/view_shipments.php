<?= $this->extend('layout/dashboard'); ?> 
<?= $this->section('content'); ?> 
<div class="row">
    <div class="col-md-12">
        <div class="card card-default">
            <form id="form_add_stock" method="post" enctype="multipart/form-data" class="form-wizard">
                <div class="card-header">
                    <h3 class="card-title">Create Shipment Order</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="itemCount"><i class="fas fa-times"></i></button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                            <label for="sender-name">Sender Name</label>
                            <input type="text" id="sender-name" name="sender-name" class="form-control">
                            <div id="err-sender-name" style="color: red;" hidden="true">*Sender Name must be fill</div>    
                        </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                            <label for="sender-phone-no">Sender Phone Number</label>
                            <input type="text" id="sender-phone-no" name="sender-phone-no" class="form-control inp-number" maxlength="13">
                            <div id="err-sender-phone-no" style="color: red;" hidden="true">*Sender Phone No must be fill</div>    
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- /.col -->
                        <div class="col-md-12">
                            <div class="form-group">
                            <label for="sender-address">Sender Address</label>
                            <textArea type="text" id="sender-address" name="sender-address" class="form-control"></textArea>
                            <div id="err-sender-address" style="color: red;" hidden="true">*Sender Address must be fill</div>    
                            </div>
                            <!-- /.form-group -->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                            <label for="rec-name">Receipment Name</label>
                            <input type="text" id="rec-name" name="rec-name" class="form-control">
                            <div id="err-rec-name" style="color: red;" hidden="true">*Receipment Name must be fill</div>    
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                            <label for="rec-phone-no">Receipment Phone No</label>
                            <input type="text" id="rec-phone-no" name="rec-phone-no" class="form-control inp-number" maxlength="13">
                            <div id="err-rec-phone-no" style="color: red;" hidden="true">*Receipment Phone No must be fill</div>    
                            </div>
                            <!-- /.form-group -->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                            <label for="deliv-area">Develiery Area</label>
                            <select id="deliv-area" name="deliv-area" class="form-control select2" style="width: 100%;">
                            </select>
                            <div id="err-deliv-area" style="color: red;" hidden="true">*Delivery Area must be fill</div>    
                            </div>
                            <!-- /.form-group -->
                        </div>
                    </div>    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                            <label for="deliv-address">Develiery Address</label>
                            <textArea type="text" id="deliv-address" name="deliv-address" class="form-control"></textArea>
                            <div id="err-deliv-address" style="color: red;" hidden="true">*Delivery Address must be fill</div>    
                            </div>
                            <!-- /.form-group -->
                        </div>
                    </div>                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                    <button id="btnAddDataShipments" type="button" class="btn btn-primary float-right" >Submit</button>
                </div>
            </form>
        </div>
    <!-- /.card -->
  </div>
</div>
<?= $this->endSection(); ?>