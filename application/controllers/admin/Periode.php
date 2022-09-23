<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Super.php');

class Periode extends Super
{

    function __construct()
    {
        parent::__construct();
        $this->language       = 'english';
        /** Indonesian / english **/
        $this->tema           = "flexigrid";
        /** datatables / flexigrid'judul', 'periode', 'jumlah_pengangkatan', 'status_periode', 'keterangan' **/
        $this->tabel          = "periode";
        $this->active_id_menu = "periode";
        $this->nama_view      = "Periode";
        $this->status         = true;
        $this->field_tambah   = array('judul', 'periode', 'jumlah_pengangkatan', 'status_periode', 'keterangan');
        $this->field_edit     = array('judul', 'periode', 'jumlah_pengangkatan', 'status_periode', 'keterangan');
        $this->field_tampil   = array();
        $this->folder_upload  = 'assets/uploads/files';
        $this->add            = true;
        $this->edit           = true;
        $this->delete         = true;
        $this->crud;
    }

    function index()
    {
        $data = [];
        /** Bagian GROCERY CRUD USER**/


        /** Relasi Antar Tabel 
         * @parameter (nama_field_ditabel_ini, tabel_relasi, field_dari_tabel_relasinya)
         **/
        // $this->crud->set_relation('parent_menu', 'tjm_menu', 'nama_menu');

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
                'nama' => '', //buat tambah breadcrumb
                'icon' => 'fa fa-users',
                'url' => 'admin/useradmin'
            ),
        );
        return $data;
    }
}
