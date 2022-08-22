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
    $this->db->limit(1);
    $this->db->order_by('kinerja', 'DESC');
    $getC1 = $this->db->get_where('nilai_karyawan', array('id_periode' => $periode))->row();
    $c1Max = $getC1->kinerja;

    //ambil nilai max c2 / disiplin
    $this->db->limit(1);
    $this->db->order_by('disiplin', 'DESC');
    $getC2 = $this->db->get_where('nilai_karyawan', array('id_periode' => $periode))->row();
    $c2Max = $getC2->disiplin;

    //ambil nilai max c3 / loyalitas
    $this->db->limit(1);
    $this->db->order_by('loyalitas', 'DESC');
    $getC3 = $this->db->get_where('nilai_karyawan', array('id_periode' => $periode))->row();
    $c3Max = $getC3->loyalitas;

    //ambil nilai max c4 / masa_kerja
    $this->db->limit(1);
    $this->db->order_by('masa_kerja', 'DESC');
    $getC4 = $this->db->get_where('nilai_karyawan', array('id_periode' => $periode))->row();
    $c4Max = $getC4->masa_kerja;

    //ambil nilai max c5 / ujian_tes
    $this->db->limit(1);
    $this->db->order_by('ujian_tes', 'DESC');
    $getC5 = $this->db->get_where('nilai_karyawan', array('id_periode' => $periode))->row();
    $c5Max = $getC5->ujian_tes;

    $nilaiKaryawan = $this->db->get_where('nilai_karyawan', array('id_periode' => $periode))->result();

    foreach ($nilaiKaryawan as $key) {
      /**normalisasi**/
      //c1
      $normalisasiC1 = round($key->kinerja / $c1Max, 9);
      //c2
      $normalisasiC2 = round($key->disiplin / $c2Max, 9);
      //c3
      $normalisasiC3 = round($key->loyalitas / $c3Max, 9);
      //c4
      $normalisasiC4 = round($key->masa_kerja / $c4Max, 9);
      //c5
      $normalisasiC5 = round($key->ujian_tes / $c5Max, 9);
      /**normalisasi**/

      /**Hasil Normalisasi */
      /**Hasil Normalisasi */

      // echo 'nama:' . $key->id_karyawan . " c1:" . $normalisasiC1 . " c2:" . $normalisasiC2 . " c3:" . $normalisasiC3 . " c4:" . $normalisasiC4 . " c5:" . $normalisasiC5 . "<br>";
    }
  }
}
