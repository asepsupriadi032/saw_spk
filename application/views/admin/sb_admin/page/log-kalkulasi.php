<!-- Morris Charts CSS -->
<!-- <link href="css/bootstrap.min.css" rel="stylesheet"> -->
<link href="css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="css/plugins/morris.css" rel="stylesheet">
<div class="row">
  <div class="col-md-6">
    <div class="panel panel-default">
      <div class="panel-heading">
        <!--  -->
        <h4>Data Karyawan</h4>
        <!--  -->
      </div>
      <div class="panel-body">
        <!-- tabel -->
        <table class="table table-striped">
          <tr>
            <th>NIP</th>
            <td><?= $karyawan->nip ?? '' ?></td>
          </tr>
          <tr>
            <th>Nama</th>
            <td><?= $karyawan->nama ?? '' ?></td>
          </tr>
          <tr>
            <th>Jenis Kelamin</th>
            <td><?= $karyawan->jenis_kelamin ?? '' ?></td>
          </tr>
          <tr>
            <th>Alamat</th>
            <td><?= $karyawan->alamat ?? '' ?></td>
          </tr>
          <tr>
            <th>Status Karyawan</th>
            <?php $karyawan_status = $karyawan ?? ''; ?>
            <td><?= $karyawan_status ?? '' ?></td>
          </tr>
          <?php if ($karyawan_status == "Tetap") { ?>
            <tr>
              <th>Tanggal Pengangkatan</th>
              <td><?= $karyawan->tanggal_pengangkatan ?></td>
            </tr>
          <?php } ?>
        </table>
        <!-- tabel -->
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="panel panel-default">
      <div class="panel-heading">
        <!--  -->
        <h4>Periode</h4>
        <!--  -->
      </div>
      <div class="panel-body">
        <!-- tabel -->
        <table class="table table-striped">
          <tr>
            <th>Periode</th>
            <td><?= $periode->periode ?? '' ?></td>
          </tr>
          <tr>
            <th>Judul</th>
            <td><?= $periode->judul ?? '' ?></td>
          </tr>
          <tr>
            <th>Tanggal Kalkulasi</th>
            <td><?= $periode->tanggal_kalkulasi ?? '' ?></td>
          </tr>
        </table>
        <!-- tabel -->
      </div>
    </div>

  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-info">
      <div class="panel-heading">
        <!--  -->
        <h4>Nilai Awal Karyawan</h4>
        <!--  -->
      </div>
      <div class="panel-body">
        <!-- tabel -->
        <table class="table table-striped">
          <tr>
            <th>Kinerja</th>
            <th>Disiplin</th>
            <th>Loyalitas</th>
            <th>Masa Kerja</th>
            <th>Ujian Tes</th>
          </tr>
          <tr>
            <td><?= $nilai_karyawan->kinerja ?? '';  ?></td>
            <td><?= $nilai_karyawan->disiplin ?? ''; ?></td>
            <td><?= $nilai_karyawan->loyalitas ?? ''; ?></td>
            <td><?= $nilai_karyawan->masa_kerja ?? ''; ?></td>
            <td><?= $nilai_karyawan->ujian_tes ?? ''; ?></td>
          </tr>
        </table>
        <!-- tabel -->
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-warning">
      <div class="panel-heading">
        <!--  -->
        <h4>Nilai Normalisasi</h4>
        <!--  -->
      </div>
      <div class="panel-body">
        <!-- tabel -->
        <table class="table table-striped">
          <tr>
            <th>C1</th>
            <th>C2</th>
            <th>C3</th>
            <th>C4</th>
            <th>C5</th>
          </tr>
          <tr>
            <td><?= $normalisasi->c1; ?></td>
            <td><?= $normalisasi->c2; ?></td>
            <td><?= $normalisasi->c3; ?></td>
            <td><?= $normalisasi->c4; ?></td>
            <td><?= $normalisasi->c5; ?></td>
          </tr>
        </table>
        <!-- tabel -->
      </div>
    </div>
  </div>

</div>
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-success">
      <div class="panel-heading">
        <!--  -->
        <h4>Nilai Akhir</h4>
        <!--  -->
      </div>
      <div class="panel-body">
        <!-- tabel -->
        <table class="table table-striped">
          <tr>
            <th>Hasil</th>
            <th>Rangking</th>
          </tr>
          <tr>
            <td><?= $normalisasi->nilai_akhir; ?></td>
            <td><?= $normalisasi->rangking; ?></td>
          </tr>
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