<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Super.php');

class Hasil_perhitungan extends Super
{

  function __construct()
  {
    parent::__construct();
    $this->language       = 'english';
    /** Indonesian / english **/
    $this->tema           = "flexigrid";
    /** datatables / flexigrid **/
    $this->tabel          = "hasil_perhitungan";
    $this->active_id_menu = "kriteria";
    $this->nama_view      = "Kriteria";
    $this->status         = true;
    $this->field_tambah   = array();
    $this->field_edit     = array();
    $this->field_tampil   = array();
    $this->folder_upload  = 'assets/uploads/files';
    $this->add            = false;
    $this->edit           = true;
    $this->delete         = false;
    $this->crud;
  }

  function index()
  {
    $data = [];
    /** Bagian GROCERY CRUD USER**/


    /** Relasi Antar Tabel 
     * @parameter (nama_field_ditabel_ini, tabel_relasi, field_dari_tabel_relasinya)
     **/
    // $this->crud->set_relation('parent_menu','tjm_menu','nama_menu');
    // $this->crud->set_relation('id_periode', 'periode', 'periode');

    /** Upload **/
    // $this->crud->set_field_upload('nama_field_upload',$this->folder_upload);  

    /** Ubah Nama yang akan ditampilkan**/
    // $this->crud->display_as('nama','Nama Setelah di Edit')
    //     ->display_as('email','Email Setelah di Edit'); 

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
}
