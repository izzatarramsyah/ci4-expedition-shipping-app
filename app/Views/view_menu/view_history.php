<?= $this->extend('layout/dashboard'); ?> <?= $this->section('content'); ?> <div class="row">
  <div class="col-md-12">
    <div class="card card-default">
      <form id="form_add_stock" method="post" enctype="multipart/form-data" class="form-wizard">
        <div class="card-header">
          <h3 class="card-title">Check Shipments History</h3>
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
                <label for="sender-name">Shipments ID</label>
                <input type="text" id="inpShipmentsId" name="inpShipmentsId" class="form-control">
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
          <button id="btnSearchHistory" type="button" class="btn btn-primary float-right">Search</button>
        </div>
      </form>
    </div>
    <!-- /.card -->
  </div>
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">History Shipments</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table id="table-history" class="table table-bordered table-hover">
          <thead>
            <tr>
              <th style="width:15%">Shipments ID</th>
              <th style="width:15%">Sender Name</th>
              <th style="width:15%">Sender Address</th>
              <th style="width:15%">Sender Phone No</th>
              <th style="width:15%">Receipment Name</th>
              <th style="width:15%">Receipment Address</th>
              <th style="width:15%">Receipment Phone No</th>
              <th style="width:10%">Status</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </div>
</div> <?= $this->endSection(); ?>