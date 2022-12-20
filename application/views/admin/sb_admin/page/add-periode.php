<!-- Morris Charts CSS -->
<!-- <link href="css/bootstrap.min.css" rel="stylesheet"> -->
<link href="css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="css/plugins/morris.css" rel="stylesheet">
<style>
  .row {
    margin-bottom: 5px !important;
  }
</style>
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Tambah Periode</h3>
  </div>
  <div class="panel-body">
    <form action="<?php echo base_url('admin/Periode/insertPeriode') ?>" method="post">
      <div class="row">
        <div class="col-md-2">Judul</div>
        <div class="col-md-3">
          <input type="text" name="judul" id="judul" class="form-control">
        </div>
      </div>
      <div class="row">
        <div class="col-md-2">Periode</div>
        <div class="col-md-3">
          <input type="date" name="periode" id="periode" class="form-control">
        </div>
      </div>
      <div class="row">
        <div class="col-md-2">Jumlah Pengangkatan</div>
        <div class="col-md-3">
          <input type="number" name="jumlah_pengangkatan" id="jumlah_pengangkatan" class="form-control">
        </div>
      </div>
      <div class="row">
        <div class="col-md-2">Status Periode</div>
        <div class="col-md-3">
          <select name="status_periode" id="" class="form-control">
            <option value="Aktif">Aktif</option>
            <option value="Tidak Aktif">Tidak Aktif</option>
          </select>
        </div>
      </div>
      <div class="row">
        <div class="col-md-2">Keterangan</div>
        <div class="col-md-5">
          <textarea name="keterangan" id="keterangan" cols="50" rows="5" class="form-control"></textarea>
        </div>
      </div>
      <div class="row">
        <div class="col-md-7">
          <button type="submit" class="btn btn-primary">Save</button>
          <button type="Reset" class="btn btn-default">Reset</button>
        </div>
      </div>
    </form>
  </div>
</div>
<!-- /.row -->

<!-- /.row -->
<script src="js/jquery-3.5.1.js"></script>
<script src="js/dataTables.bootstrap.min.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
<script>
  $(document).ready(function() {
    $('#nilai').DataTable();
  });
  $(document).ready(function() {
    $('#hasil').DataTable();
  });
</script>


<!-- Morris Charts JavaScript -->
<!-- <script src="js/plugins/morris/raphael.min.js"></script>
<script src="js/plugins/morris/morris.min.js"></script>
<script src="js/plugins/morris/morris-data.js"></script> -->