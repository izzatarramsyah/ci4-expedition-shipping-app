<?php 
  $dt = new DateTime("now", new DateTimeZone('Asia/Jakarta'));
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | Invoice Print</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap 4 -->
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../../dist/css/adminlte.min.css">

  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body>
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-12">
        <h2 class="page-header">
          <i class="fas fa-globe"></i> AdminLTE, Inc.
          <small class="float-right">Date: <?php echo $dt->format("d F Y"); ?></small>
        </h2>
      </div>
      <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
      <div class="col-sm-4 invoice-col">
        From
        <address>
          <strong><?php echo $customer[0]->name; ?></strong><br>
          <?php echo $customer[0]->address; ?><br>
          Phone: <?php echo $customer[0]->phone; ?><br>
        </address>
      </div>
      <!-- /.col -->
      <br>
      <div class="col-sm-4 invoice-col">
        To
        <address>
          <strong><?php echo $shipments[0]->receipment_name; ?></strong><br>
          <?php echo $shipments[0]->delivery_address; ?><br>
          Phone: <?php echo $shipments[0]->receipment_phone_no; ?><br>
        </address>
      </div>
      <!-- /.col -->
      <br>
      <div class="col-sm-4 invoice-col">
        <b>Shipment ID :</b> <?php echo $shipments[0]->id; ?><br>
        <b>Delivery Area :</b> <?php echo $route[0]->destination; ?><br>
        <b>Shipment Cost :</b> Rp. <?php echo $route[0]->price; ?><br>
        <b>Shipment Duration :</b> <?php echo $route[0]->duration; ?><br>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
    <br>
    <!-- Table row -->
    <div class="row">
      <div class="col-12 table-responsive">
        <table class="table table-striped">
          <thead>
          <tr>
            <th>Item Name</th>
            <th>Item Type</th>
            <th>Quantity</th>
            <th>Weight</th>
          </tr>
          </thead>
          <tbody>
          <?php for ($i = 0; $i < count($shipments_detail); $i++) { ?>
            <tr>
              <td ><?php echo $shipments_detail[$i]->item_name; ?></td>
              <td ><?php echo $shipments_detail[$i]->item_type; ?></td>
              <td ><?php echo $shipments_detail[$i]->quantity; ?></td>
              <td ><?php echo $shipments_detail[$i]->weight; ?></td>
            </tr> 
          <?php } ?>
          </tbody>
        </table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
    <br>
    <div class="row">
      <!-- accepted payments column -->
      <div class="col-6"> </div>
      <!-- /.col -->
      <div class="col-6">
        <div class="table-responsive">
          <table class="table">
            <tr>
              <th style="width:50%">Subtotal:</th>
              <td>Rp. <?php echo $subTotal; ?></td>
            </tr>
            <tr>
              <th>Shipping:</th>
              <td>Rp. <?php echo $route[0]->price; ?></td>
            </tr>
            <tr>
              <th>Total:</th>
              <td>Rp. <?php echo $total; ?></td>
            </tr>
          </table>
        </div>
      </div>
      <!-- /.col -->
    </div>
  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
</body>
<script type="text/javascript"> 
  window.addEventListener("load", window.print());
</script>
</html>
