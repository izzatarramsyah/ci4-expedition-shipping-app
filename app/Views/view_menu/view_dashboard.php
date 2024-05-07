<?= $this->extend('layout/dashboard'); ?> <?= $this->section('content'); ?> <div class="row">
  <div class="col-12 col-sm-6 col-md-3">
    <div class="info-box">
      <span class="info-box-icon bg-info elevation-1">
        <i class="fas fa-shipping-fast"></i>
      </span>
      <div class="info-box-content">
        <span class="info-box-text">Total Shipments</span>
        <span class="info-box-number totalShipments"></span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->
  <div class="col-12 col-sm-6 col-md-3">
    <div class="info-box mb-3">
      <span class="info-box-icon bg-danger elevation-1">
        <i class="fas fa-shipping-fast"></i>
      </span>
      <div class="info-box-content">
        <span class="info-box-text">Failed Delivery</span>
        <span class="info-box-number failedDelivery"></span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->
  <!-- fix for small devices only -->
  <div class="clearfix hidden-md-up"></div>
  <div class="col-12 col-sm-6 col-md-3">
    <div class="info-box mb-3">
      <span class="info-box-icon bg-success elevation-1">
        <i class="fas fa-shipping-fast"></i>
      </span>
      <div class="info-box-content">
        <span class="info-box-text">Success Delivery</span>
        <span class="info-box-number successDelivery"></span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->
  <div class="col-12 col-sm-6 col-md-3">
    <div class="info-box mb-3">
      <span class="info-box-icon bg-warning elevation-1">
        <i class="fas fa-shipping-fast"></i>
      </span>
      <div class="info-box-content">
        <span class="info-box-text">On Going Delivery</span>
        <span class="info-box-number onProcessDelivery"></span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->
</div>
<!-- /.row -->
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h5 class="card-title">Monthly Recap Report</h5>
        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse">
            <i class="fas fa-minus"></i>
          </button>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <div class="row">
          <div class="col-md-12">
            <p class="text-center">
              <strong>Shipments: Jan, 2024 - May, 2024</strong>
            </p>
            <div class="chart">
              <!-- Sales Chart Canvas -->
              <canvas id="salesChart" height="180" style="height: 180px;"></canvas>
            </div>
            <!-- /.chart-responsive -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- ./card-body -->
      <!-- /.card-footer -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.col -->
</div>
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Latest Order</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table id="table-dashboard" class="table table-bordered table-hover">
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
</div>
<!-- /.row --></div><?= $this->endSection(); ?>