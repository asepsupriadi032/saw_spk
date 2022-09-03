<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Super.php');

class Normalisasi extends Super
{

  function __construct()
  {
    parent::__construct();
    $this->language       = 'english';
    /** Indonesian / english **/
    $this->tema           = "flexigrid";
    /** datatables / flexigrid **/
    $this->tabel          = "normalisasi";
    $this->active_id_menu = "normalisasi";
    $this->nama_view      = "Nilai Karayawan";
    $this->status         = true;
    $this->field_tambah   = array();
    $this->field_edit     = array();
    $this->field_tampil   = array('id_karyawan', 'id_periode', 'nilai_akhir');
    $this->folder_upload  = 'assets/uploads/files';
    $this->delete         = false;
    $this->crud;
  }

  function index($id_periode = null)
  {
    $data = [];
    /** Bagian GROCERY CRUD USER**/
    if ($this->crud->getState() == "edit")
      redirect(base_url('admin/Normalisasi/updateStatus/' . $this->uri->segment(4) . '/' . $this->uri->segment(6)));

    /** Relasi Antar Tabel 
     * @parameter (nama_field_ditabel_ini, tabel_relasi, field_dari_tabel_relasinya)
     **/
    $this->crud->set_relation('id_karyawan', 'karyawan', 'nama');
    $this->crud->set_relation('id_periode', 'periode', 'periode');

    /** Upload **/
    // $this->crud->set_field_upload('nama_field_upload',$this->folder_upload);  

    /** Ubah Nama yang akan ditampilkan**/
    // $this->crud->display_as('nama','Nama Setelah di Edit')
    //     ->display_as('email','Email Setelah di Edit'); 
    $this->crud->display_as('id_karyawan', 'Karyawan');
    $this->crud->display_as('id_periode', 'Periode');

    /** Akhir Bagian GROCERY CRUD Edit Oleh User**/
    if (!empty($id_periode)) {
      $this->crud->where('normalisasi.id_periode', $id_periode);
      $this->add            = false;
      $this->edit           = true;
    }
    $this->crud->order_by('normalisasi.nilai_akhir', 'desc');
    $this->crud->where('status_karyawan', 'Kontrak');
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

  public function updateStatus($id_periode, $id_normalisasi)
  {
    $this->db->where('id_normalisasi', $id_normalisasi);
    $getKaryawan = $this->db->get('normalisasi')->row();
    $id_karyawan = $getKaryawan->id_karyawan;

    $this->db->where('id', $id_karyawan);
    $this->db->set('status_karyawan', 'Tetap');
    $this->db->update('karyawan');
    redirect('admin/Normalisasi/Index/' . $id_periode);
  }
}
