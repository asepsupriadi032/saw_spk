<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('login_admin')) {
            redirect('admin/login');
        }
    }

    function index()
    {
        $data['active']     = 'dash';
        $data['judul_1']    = 'Admin - ' . $this->session->userdata('nama');
        $data['judul_2']    = 'Selamat Datang';
        $data['page']       = 'v_dashboard';
        $data['menu']       = $this->Menus->generateMenu();
        $data['breadcumbs'] = array(
            array(
                'nama' => 'Dashboard',
                'icon' => 'fa fa-dashboard',
                'url' => 'admin/dashboard'
            ),
        );

        //ambil semua data karyawan
        $this->db->order_by('nama', 'asc');
        $data['karyawan'] = $this->db->get('karyawan')->result();
        //ambil data karyawan kontrak
        $this->db->where('status_karyawan', 'Kontrak');
        $data['kontrak'] = $this->db->get('karyawan')->num_rows();
        //ambil data karyawan tetap
        $this->db->where('status_karyawan', 'Tetap');
        $data['tetap'] = $this->db->get('karyawan')->num_rows();

        $this->db->where('tanggal_kalkulasi is NOT NULL');
        $this->db->order_by('tanggal_kalkulasi', 'DESC');
        $data['periode'] = $this->db->get('periode')->result();

        $this->load->view('admin/' . $this->session->userdata('theme') . '/v_index', $data);
    }
}
