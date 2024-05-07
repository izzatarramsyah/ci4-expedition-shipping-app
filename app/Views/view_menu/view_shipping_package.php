<?= $this->extend('layout/dashboard'); ?> <?= $this->section('content'); ?> <div class="row">
  <div class="col-md-12">
    <div class="card card-default">
      <form id="form_add_stock" method="post" enctype="multipart/form-data" class="form-wizard">
        <div class="card-header">
          <h3 class="card-title">Shipping Package Status Update</h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="sender-name">Shipping Route</label>
                <select id="optRoute" name="optRoute" class="form-control select2" style="width: 100%;">
                </select>
                <div id="err-sender-name" style="color: red;" hidden="true">*Shipments ID must be fill</div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Date Range</label>
                <div class="form-group">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                    </div>
                    <input type="text" id="inpDateRange" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask>
                  </div>
                </div>
              </div>
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
          </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer clearfix">
          <button id="btnSearcShipping" onClick="getDeliveryStatus()" type="button" class="btn btn-primary float-right">Search</button>
        </div>
      </form>
    </div>
    <!-- /.card -->
  </div>
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Shipping Package</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <button style="margin-bottom:10px" onClick="updateDeliveryStatus()" class="btn btn-primary float-right" type="button" data-toggle="collapse" >
          <i class="fas fa-edit"></i> Update Status </button><br><br>
        <table id="table-shipping-package" class="table table-bordered table-hover">
          <thead>
            <tr>
              <th style="width:5%">No</th>
              <th style="width:15%">Shipments ID</th>
              <th style="width:10%">Status</th>
              <th style="width:10%">Action</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </div>
</div> <?= $this->endSection(); ?>