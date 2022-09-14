<!-- Morris Charts CSS -->
<!-- <link href="css/bootstrap.min.css" rel="stylesheet"> -->
<link href="css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="css/plugins/morris.css" rel="stylesheet">
<div class="row">
  <div class="col-md-6">
    <div class="panel panel-default">
      <div class="panel-heading">
        <!--  -->
        <div class="row">
          <div class="col-lg-6 col-md-6">
            <div class="panel panel-yellow">
              <div class="panel-heading">
                <div class="row">
                  <div class="col-xs-3">
                    <i class="fa fa-user fa-5x"></i>
                  </div>
                  <div class="col-xs-9 text-right">
                    <div class="huge"><?= $kontrak ?></div>
                    <div>Karyawan Kontrak</div>
                  </div>
                </div>
              </div>
              <!-- <a href="#">
        <div class="panel-footer">
          <span class="pull-left">View Details</span>
          <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
          <div class="clearfix"></div>
        </div>
      </a> -->
            </div>
          </div>
          <div class="col-lg-6 col-md-6">
            <div class="panel panel-green">
              <div class="panel-heading">
                <div class="row">
                  <div class="col-xs-3">
                    <i class="fa fa-user fa-5x"></i>
                  </div>
                  <div class="col-xs-9 text-right">
                    <div class="huge"><?= $tetap ?></div>
                    <div>Karyawan Tetap</div>
                  </div>
                </div>
              </div>
              <!-- <a href="#">
        <div class="panel-footer">
          <span class="pull-left">View Details</span>
          <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
          <div class="clearfix"></div>
        </div>
      </a> -->
            </div>
          </div>
        </div>
        <!--  -->
      </div>
      <div class="panel-body">
        <!-- tabel -->
        <table id="example" class="table table-striped table-bordered" style="width:100%">
          <thead>
            <tr>
              <th>No</th>
              <th>NIP</th>
              <th>Nama</th>
              <th>Jenis Kelamin</th>
              <th>Status</th>
              <th>Tanggal Pengangkatan</th>
            </tr>
          </thead>
          <tbody>
            <?php $no = 1;
            foreach ($karyawan as $key) { ?>
              <tr>
                <td><?= $no ?></td>
                <td><?= $key->nip ?></td>
                <td><?= $key->nama ?></td>
                <td><?= $key->jenis_kelamin ?></td>
                <td><?= $key->status_karyawan ?></td>
                <td><?= $key->tanggal_pengangkatan ?></td>
              </tr>
            <?php $no++;
            } ?>
            <!-- <tfoot>
            <tr>
              <th>Name</th>
              <th>Position</th>
              <th>Office</th>
              <th>Age</th>
              <th>Start date</th>
              <th>Salary</th>
            </tr>
          </tfoot> -->
        </table>
        <!-- tabel -->
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="panel panel-default">
      <div class="panel-body">
        Basic panel example
      </div>
    </div>
  </div>
</div>
<!-- /.row -->

<!-- /.row -->
<script src="js/jquery-3.5.1.js"></script>
<script src="js/dataTables.bootstrap.min.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
<script>
  $(document).ready(function() {
    $('#example').DataTable();
  });
</script>


<!-- Morris Charts JavaScript -->
<!-- <script src="js/plugins/morris/raphael.min.js"></script>
<script src="js/plugins/morris/morris.min.js"></script>
<script src="js/plugins/morris/morris-data.js"></script> -->