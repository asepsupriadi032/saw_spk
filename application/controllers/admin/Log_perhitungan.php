<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Super.php');

class Log_perhitungan extends Super
{

  function __construct()
  {
    parent::__construct();
    $this->language       = 'english';
    /** Indonesian / english **/
    $this->tema           = "flexigrid";
    /** datatables / flexigrid **/
    $this->tabel          = "hasil_perhitungan";
    $this->active_id_menu = "log_perhitungan";
    $this->nama_view      = "Log Perhitungan Nilai Karyawan";
    $this->status         = true;
    $this->field_tambah   = array();
    $this->field_edit     = array();
    $this->field_tampil   = array('periode', 'rangking', 'nip', 'nama', 'jenis_kelamin', 'status', 'tanggal_kalkulasi', 'c1', 'c2', 'c3', 'c4', 'c5', 'nilai_akhir');
    $this->folder_upload  = 'assets/uploads/files';
    $this->add            = false;
    $this->edit           = false;
    $this->delete         = false;
    $this->crud;
  }

  function index()
  {
    $data = [];
    if ($this->crud->getState() == "read")
      redirect(base_url('admin/Log_perhitungan/hasil/' . $this->uri->segment(5)));
    /** Bagian GROCERY CRUD USER**/


    /** Relasi Antar Tabel 
     * @parameter (nama_field_ditabel_ini, tabel_relasi, field_dari_tabel_relasinya)
     **/
    // $this->crud->set_relation('parent_menu','tjm_menu','nama_menu');
    // $this->crud->set_relation('id_periode', 'periode', 'periode');
    // $this->crud->set_relation('id_peri', 'periode', 'periode');

    /** Upload **/
    // $this->crud->set_field_upload('nama_field_upload',$this->folder_upload);  

    /** Ubah Nama yang akan ditampilkan**/
    // $this->crud->display_as('nama','Nama Setelah di Edit')
    //     ->display_as('email','Email Setelah di Edit'); 

    $this->crud->display_as('c1', 'Kinerja');
    $this->crud->display_as('c2', 'Disiplin');
    $this->crud->display_as('c3', 'Loyalitas');
    $this->crud->display_as('c4', 'Masa Kerja');
    $this->crud->display_as('c5', 'Tes Ujian');

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
        'nama' => '',
        'icon' => 'fa fa-users',
        'url' => 'admin/useradmin'
      ),
    );
    return $data;
  }

  public function hasil($id)
  {
    $getKaryawan = $this->db->get_where('hasil_perhitungan', array('id' => $id))->row();
    $id_periode = $getKaryawan->id_periode;
    $id_karyawan = $getKaryawan->id_karyawan;
    $data = [];
    $data = array_merge($data, $this->generateBreadcumbs());
    $data = array_merge($data, $this->generateData());
    $this->generate();

    $this->db->where('normalisasi.id_periode', $id_periode);
    $this->db->where('normalisasi.id_karyawan', $id_karyawan);
    $this->db->join('nilai_karyawan', 'nilai_karyawan.id=normalisasi.id_karyawan');
    $data['normalisasi'] = $this->db->get('normalisasi')->row();

    $this->db->where('normalisasi.id_periode', $id_periode);
    $this->db->where('normalisasi.id_karyawan', $id_karyawan);
    $this->db->join('karyawan', 'normalisasi.id_karyawan=karyawan.id');
    $data['karyawan'] = $this->db->get('normalisasi')->row();

    $data['periode'] = $this->db->get_where('periode', array('id' => $id_periode))->row();

    $data['page'] = "log-kalkulasi";
    $data['output'] = $this->crud->render();
    $this->load->view('admin/' . $this->session->userdata('theme') . '/v_index', $data);
  }
}
