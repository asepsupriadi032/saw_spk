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
        $this->field_tambah   = array('judul', 'periode', 'jumlah_pengangkatan', 'status_periode', 'tanggal_kalkulasi', 'keterangan');
        $this->field_edit     = array('judul', 'periode', 'jumlah_pengangkatan', 'status_periode', 'tanggal_kalkulasi', 'keterangan');
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
        // redirect(base_url('admin/Perhitungan/delete/' . $this->uri->segment(5)));
        if ($this->crud->getState() == "add")
            redirect(base_url('admin/Periode/addPeriode'));
        if ($this->crud->getState() == "edit")
            redirect(base_url('admin/Periode/editPeriode/' . $this->uri->segment(5)));
        /** Bagian GROCERY CRUD USER**/
        $this->crud->callback_before_update(19, 'update_data');

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

    public function addPeriode()
    {
        $data = [];
        $data = array_merge($data, $this->generateBreadcumbs());
        $data = array_merge($data, $this->generateData());
        $this->generate();


        $data['page'] = "add-periode";
        $data['output'] = $this->crud->render();
        $this->load->view('admin/' . $this->session->userdata('theme') . '/v_index', $data);
    }
    public function editPeriode($id_periode)
    {
        $data = [];
        $data = array_merge($data, $this->generateBreadcumbs());
        $data = array_merge($data, $this->generateData());
        $this->generate();

        $data['periode'] = $this->db->get_where('periode', array('id' => $id_periode))->row();

        $data['page'] = "edit-periode";
        $data['output'] = $this->crud->render();
        $this->load->view('admin/' . $this->session->userdata('theme') . '/v_index', $data);
    }

    public function updateStatus($id_periode)
    {
        try {
            //code...
            var_dump($id_periode);

            redirect(base_url('admin/dashboard'));
        } catch (Exception $e) {
            show_error($e->getMessage());
        }
        if ($id_periode) {
        } else {
        }
        die;
        $this->db->where('id_periode', $id_periode);
        $this->db->delete('hasil_perhitungan');

        $this->db->where('id', $id_periode);
        $this->db->set('tanggal_kalkulasi', null);
        $this->db->update('periode');
    }

    public function insertPeriode()
    {
        $this->db->set('judul', $this->input->post('judul'));
        $this->db->set('jumlah_pengangkatan', $this->input->post('jumlah_pengangkatan'));
        $this->db->set('status_periode', $this->input->post('status_periode'));
        $this->db->set('periode', $this->input->post('periode'));
        $this->db->set('keterangan', $this->input->post('keterangan'));
        $this->db->insert('periode');

        redirect(base_url('admin/Periode'));
    }
    public function updatePeriode($id)
    {
        $this->db->where('id', $id);
        $this->db->set('judul', $this->input->post('judul'));
        $this->db->set('jumlah_pengangkatan', $this->input->post('jumlah_pengangkatan'));
        $this->db->set('status_periode', $this->input->post('status_periode'));
        $this->db->set('periode', $this->input->post('periode'));
        $this->db->set('tanggal_kalkulasi', $this->input->post('tanggal_kalkulasi'));
        if ($this->input->post('tanggal_kalkulasi') == '') {
            $this->db->set('tanggal_kalkulasi', null);
        }
        $this->db->set('keterangan', $this->input->post('keterangan'));
        $this->db->update('periode');

        $this->db->where('id_periode', $id);
        $this->db->delete('normalisasi');

        $this->db->where('id_periode', $id);
        $this->db->delete('hasil_perhitungan');

        redirect(base_url('admin/Periode'));
    }
}
