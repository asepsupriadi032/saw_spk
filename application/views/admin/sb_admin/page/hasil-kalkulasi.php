<!-- Morris Charts CSS -->
<!-- <link href="css/bootstrap.min.css" rel="stylesheet"> -->
<link href="css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="css/plugins/morris.css" rel="stylesheet">
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-info">
      <div class="panel-heading">
        <!--  -->
        <h4>Nilai Karyawan</h4>
        <!--  -->
      </div>
      <div class="panel-body">
        <!-- tabel -->
        <table id="nilai" class="table table-striped table-bordered" style="width:100%">
          <thead>
            <tr>
              <th>No</th>
              <th>NIP</th>
              <th>Nama</th>
              <th>Jenis Kelamin</th>
              <th>Kinerja</th>
              <th>Disiplin</th>
              <th>Loyalitas</th>
              <th>Masa Kerja</th>
              <th>Ujian Tes</th>
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
                <td><?= $key->kinerja ?></td>
                <td><?= $key->disiplin ?></td>
                <td><?= $key->loyalitas ?></td>
                <td><?= $key->masa_kerja ?></td>
                <td><?= $key->ujian_tes ?></td>
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
    <div class="panel panel-danger">
      <div class="panel-heading">
        <!--  -->
        <h4>Nilai Akhir</h4>
        <!--  -->
      </div>
      <div class="panel-body">
        <!-- tabel -->
        <table id="hasil" class="table table-striped table-bordered" style="width:100%">
          <thead>
            <tr>
              <th>No</th>
              <th>NIP</th>
              <th>Nama</th>
              <th>Jenis Kelamin</th>
              <th>(C1) Kinerja </th>
              <th>(C2) Disiplin </th>
              <th>(C3) Loyalitas </th>
              <th>(C4) Masa Kerja </th>
              <th>(C5) Ujian Tes </th>
              <th>Nilai Akhir</th>
              <th>Rangking</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <?php $no = 1;
            foreach ($normalisasi as $key) { ?>
              <tr>
                <td><?= $no ?></td>
                <td><?= $key->nip ?></td>
                <td><?= $key->nama ?></td>
                <td><?= $key->jenis_kelamin ?></td>
                <td><?= $key->c1 ?></td>
                <td><?= $key->c2 ?></td>
                <td><?= $key->c3 ?></td>
                <td><?= $key->c4 ?></td>
                <td><?= $key->c5 ?></td>
                <td><?= $key->nilai_akhir ?></td>
                <td><?= $key->rangking ?></td>
                <td><?= $key->status ?></td>
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