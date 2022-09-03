<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Super.php');

class Perhitungan extends Super
{

  function __construct()
  {
    parent::__construct();
    $this->language       = 'english';
    /** Indonesian / english **/
    $this->tema           = "flexigrid";
    /** datatables / flexigrid **/
    $this->tabel          = "periode";
    $this->active_id_menu = "perhitungan";
    $this->nama_view      = "Perhitungan Nilai Karyawan";
    $this->status         = true;
    $this->field_tambah   = array();
    $this->field_edit     = array();
    $this->field_tampil   = array('judul', 'periode', 'status', 'tanggal_kalkulasi');
    $this->folder_upload  = 'assets/uploads/files';
    $this->add            = true;
    $this->edit           = false;
    $this->delete         = false;
    $this->crud;
  }

  function index()
  {
    $data = [];
    if ($this->crud->getState() == "add")
      redirect(base_url('admin/Perhitungan/addKalkulasi'));
    /** Bagian GROCERY CRUD USER**/


    /** Relasi Antar Tabel 
     * @parameter (nama_field_ditabel_ini, tabel_relasi, field_dari_tabel_relasinya)
     **/
    // $this->crud->set_relation('id_karyawan', 'karyawan', 'nama');

    /** Upload **/
    // $this->crud->set_field_upload('nama_field_upload',$this->folder_upload);  

    /** Ubah Nama yang akan ditampilkan**/
    // $this->crud->display_as('nama','Nama Setelah di Edit')
    //     ->display_as('email','Email Setelah di Edit'); 
    // $this->crud->display_as('id_karyawan', 'Pilih Karyawan');

    /** Akhir Bagian GROCERY CRUD Edit Oleh User**/
    $data = array_merge($data, $this->generateBreadcumbs());
    $data = array_merge($data, $this->generateData());
    $this->generate();
    $data['output'] = $this->crud->render();
    $this->load->view('admin/' . $this->session->userdata('theme') . '/v_index', $data);
  }

  private function generateBreadcumbs()
  {
    $data['breadcumbs'] = array(
      array(
        'nama' => 'Dashboard',
        'icon' => 'fa fa-dashboard',
        'url' => 'admin/dashboard'
      ),
      array(
        'nama' => 'Admin',
        'icon' => 'fa fa-users',
        'url' => 'admin/useradmin'
      ),
    );
    return $data;
  }

  public function addKalkulasi()
  {

    $data = [];
    $data = array_merge($data, $this->generateBreadcumbs());
    $data = array_merge($data, $this->generateData());
    $this->generate();

    $this->db->where('status', 1);
    $this->db->where('tanggal_kalkulasi', null);
    $data['periode'] = $this->db->get('periode')->result();

    $data['page'] = "add-kalkulasi";
    $data['output'] = $this->crud->render();
    $this->load->view('admin/' . $this->session->userdata('theme') . '/v_index', $data);
  }

  public function insertKalkulasi()
  {
    $periode = $this->input->post('periode');
    if ($periode < 1) {
      $this->session->set_flashdata('pesan', 'Silahkan pilih periode.');
      redirect(base_url('admin/Perhitungan/addKalkulasi'));
    }
    //ambil periode penilaian
    $now = date('Y-m-d H:i:s');
    $this->db->where('id', $periode);
    $this->db->set('tanggal_kalkulasi', $now);
    $this->db->update('periode');

    //ambil nilai max c1 / kinerja
    $this->db->select_max('kinerja');
    $getC1Max = $this->db->get_where('nilai_karyawan', array('id_periode' => $periode))->row();
    $c1Max = $getC1Max->kinerja;
    $this->db->select_min('kinerja');
    $getC1Min = $this->db->get_where('nilai_karyawan', array('id_periode' => $periode))->row();
    $c1Min = $getC1Min->kinerja;

    //ambil nilai max c2 / disiplin
    $this->db->select_max('disiplin');
    $getC2Max = $this->db->get_where('nilai_karyawan', array('id_periode' => $periode))->row();
    $c2Max = $getC2Max->disiplin;
    $this->db->select_min('disiplin');
    $getC2Min = $this->db->get_where('nilai_karyawan', array('id_periode' => $periode))->row();
    $c2Min = $getC2Min->disiplin;

    //ambil nilai max c3 / loyalitas
    $this->db->select_max('loyalitas');
    $getC3Max = $this->db->get_where('nilai_karyawan', array('id_periode' => $periode))->row();
    $c3Max = $getC3Max->loyalitas;
    $this->db->select_min('loyalitas');
    $getC3Min = $this->db->get_where('nilai_karyawan', array('id_periode' => $periode))->row();
    $c3Min = $getC3Min->loyalitas;

    //ambil nilai max c4 / masa_kerja
    $this->db->select_max('masa_kerja');
    $getC4Max = $this->db->get_where('nilai_karyawan', array('id_periode' => $periode))->row();
    $c4Max = $getC4Max->masa_kerja;
    $this->db->select_min('masa_kerja');
    $getC4Min = $this->db->get_where('nilai_karyawan', array('id_periode' => $periode))->row();
    $c4Min = $getC4Min->masa_kerja;

    //ambil nilai max c5 / ujian_tes
    $this->db->select_max('ujian_tes');
    $getC5Max = $this->db->get_where('nilai_karyawan', array('id_periode' => $periode))->row();
    $c5Max = $getC5Max->ujian_tes;
    $this->db->select_min('ujian_tes');
    $getC5Min = $this->db->get_where('nilai_karyawan', array('id_periode' => $periode))->row();
    $c5Min = $getC5Min->ujian_tes;

    $this->db->where('karyawan.status_karyawan', 'Kontrak');
    $this->db->join('karyawan', 'karyawan.id=nilai_karyawan.id_karyawan');
    $nilaiKaryawan = $this->db->get_where('nilai_karyawan', array('id_periode' => $periode))->result();

    foreach ($nilaiKaryawan as $key) {
      /**normalisasi**/
      //jika kriteria adalah benefit maka nilai kriteria dibagi nilai tertinggi
      //jika kriteria adalah cost maka nilai terendah dibagi kriteria

      $nilaiKinerja = $key->kinerja;
      $nilaiDisiplin = $key->disiplin;
      $nilaiLoyalitas = $key->loyalitas;
      $nilaiMasaKerja = $key->masa_kerja;
      $nilaiUjianTes = $key->ujian_tes;

      //c1
      $getC1 = $this->db->get_where('kriteria', array('kode' => 'c1'))->row();
      $bobotC1 = $getC1->bobot;
      if ($getC1->jenis == "benefit") {
        $nilaiC1 = $nilaiKinerja / $c1Max;
      } else {
        $nilaiC1 = $c1Min / $nilaiKinerja;
      }

      //c2
      $getC2 = $this->db->get_where('kriteria', array('kode' => 'c2'))->row();
      $bobotC2 = $getC2->bobot;
      if ($getC2->jenis == "benefit") {
        $nilaiC2 = $nilaiDisiplin / $c2Max;
      } else {
        $nilaiC2 = $c2Min / $nilaiDisiplin;
      }

      //c3
      $getC3 = $this->db->get_where('kriteria', array('kode' => 'c3'))->row();
      $bobotC3 = $getC3->bobot;
      if ($getC3->jenis == "benefit") {
        $nilaiC3 = $nilaiLoyalitas / $c3Max;
      } else {
        $nilaiC3 = $c3Min / $nilaiLoyalitas;
      }

      //c4
      $getC4 = $this->db->get_where('kriteria', array('kode' => 'c4'))->row();
      $bobotC4 = $getC4->bobot;
      if ($getC4->jenis == "benefit") {
        $nilaiC4 = $nilaiMasaKerja / $c4Max;
      } else {
        $nilaiC4 = $c4Min / $nilaiMasaKerja;
      }

      //c5
      $getC5 = $this->db->get_where('kriteria', array('kode' => 'c5'))->row();
      $bobotC5 = $getC5->bobot;
      if ($getC5->jenis == "benefit") {
        $nilaiC5 = $nilaiUjianTes / $c5Max;
      } else {
        $nilaiC5 = $c5Min / $nilaiUjianTes;
      }

      //Perhitungan dengan bobot
      $nilaiAkhir = ($nilaiC1 * $bobotC1 / 100) + ($nilaiC2 * $bobotC2 / 100) + ($nilaiC3 * $bobotC3 / 100) + ($nilaiC4 * $bobotC4 / 100) + ($nilaiC5 * $bobotC5 / 100);

      /**cek apakah data karyawan dengan periode yg sama sudah ada atau blm**/
      $this->db->where('id_karyawan', $key->id_karyawan);
      $this->db->where('id_periode', $key->id_periode);
      $getNormalisai = $this->db->get('normalisasi')->row();

      if (!empty($getNormalisai)) {
        //jika ada data, maka update
        $this->db->where('id_karyawan', $key->id_karyawan);
        $this->db->where('id_periode', $key->id_periode);
        $this->db->set('c1', $nilaiC1);
        $this->db->set('c2', $nilaiC2);
        $this->db->set('c3', $nilaiC3);
        $this->db->set('c4', $nilaiC4);
        $this->db->set('c5', $nilaiC5);
        $this->db->set('nilai_akhir', $nilaiAkhir);
        $this->db->update('normalisasi');
      } else {
        //jika tidak ada, maka insert
        $this->db->set('id_karyawan', $key->id_karyawan);
        $this->db->set('id_periode', $key->id_periode);
        $this->db->set('c1', $nilaiC1);
        $this->db->set('c2', $nilaiC2);
        $this->db->set('c3', $nilaiC3);
        $this->db->set('c4', $nilaiC4);
        $this->db->set('c5', $nilaiC5);
        $this->db->set('nilai_akhir', $nilaiAkhir);
        $this->db->insert('normalisasi');
      }

      var_dump('asd');


      /**normalisasi**/

      /**Hasil Normalisasi */
      /**Hasil Normalisasi */

      // echo 'nama:' . $key->id_karyawan . " c1:" . $normalisasiC1 . " c2:" . $normalisasiC2 . " c3:" . $normalisasiC3 . " c4:" . $normalisasiC4 . " c5:" . $normalisasiC5 . "<br>";
    }

    redirect('admin/Normalisasi/index/' . $periode);
  }
}
