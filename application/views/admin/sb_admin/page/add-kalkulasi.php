<style>
  .center {
    margin-left: auto;
    margin-right: auto;
    width: 50%;
    border: 1px solid #73AD21;
    padding: 10px;
  }
</style>
<form action="<?php echo base_url('admin/Perhitungan/insertKalkulasi') ?>" method="post">
  <?php if (!empty($this->session->flashdata('pesan'))) { ?>
    <div class="col-md-12">
      <div class="alert alert-warning alert-dismissible" role="alert">
        <strong>Peringatan!</strong> <?php echo $this->session->flashdata('pesan'); ?>
      </div>
    </div>
  <?php } ?>
  <div class="col-md-5 center">
    <div class="row">
      <div class="col-md-3">
        <div class="form-group">
          <label for="exampleInputName2">Pilih Periode</label>
        </div>
      </div>
      <div class="col-md-9">
        <select name="periode" id="" class="form-control">
          <option value="0">--- Periode Penilaian ---</option>
          <?php foreach ($periode as $row) { ?>
            <option value="<?php echo $row->id; ?>"><?php echo $row->periode; ?></option>
          <?php } ?>
        </select>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12" style="text-align: right;">
        <input type="submit" value="Hitung" class="btn btn-primary">
      </div>
    </div>
  </div>
</form>