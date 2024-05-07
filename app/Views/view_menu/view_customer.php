<?= $this->extend('layout/dashboard'); ?> 
<?= $this->section('content'); ?> 
<div class="row">
    <div class="col-md-12">
        <div class="card card-default">
            <form id="form_add_stock" method="post" enctype="multipart/form-data" class="form-wizard">
                <div class="card-header">
                    <h3 class="card-title">Add New Customer</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                            <label for="inpName">Full Name</label>
                            <input type="text" id="inpName" name="inpName" class="form-control">
                            <div id="err-inpName" style="color: red;" hidden="true">*Name must be fill</div>    
                        </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                            <label for="inpPhoneNo">Phone Number</label>
                            <input type="text" id="inpPhoneNo" name="inpPhoneNo" class="form-control inp-number">
                            <div id="err-inpPhoneNo" style="color: red;" hidden="true">*Phone No must be fill</div>    
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- /.col -->
                        <div class="col-md-12">
                            <div class="form-group">
                            <label for="inpAddress">Address</label>
                            <textArea type="text" id="inpAddress" name="inpAddress" class="form-control"></textArea>
                            <div id="err-inpAddress" style="color: red;" hidden="true">*inpAddress must be fill</div>    
                            </div>
                            <!-- /.form-group -->
                        </div>
                    </div>
                </div>
                <input type="text" id="idCustomer" name="idCustomer" class="form-control" hidden="true">
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                    <button id="BtnAddCustomer" type="button" class="btn btn-primary float-right" >
                    <div id="submitBtnAddCustomer">Submit</div>
                    <div id="loadingBtnAddCustomer" hidden="true"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...</div>
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
        <h3 class="card-title">List Customer</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table id="table-customer" class="table table-bordered table-hover">
          <thead>
            <tr>
              <th>No</th>
              <th>Name</th>
              <th>Phone No</th>
              <th>Address</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </div>
</div>
<?= $this->endSection(); ?>