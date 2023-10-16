<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // Load model dan library yang diperlukan
        $this->load->model('user_model');
        $this->load->library('form_validation');
    }

    public function index() {
        // Tampilkan halaman dashboard admin di sini
        $this->load->view('admin/karyawan');
    }

    public function export_karyawan() {
        // Ambil data karyawan untuk diekspor
        $data['karyawan'] = $this->admin_model->exportKaryawan();

        // Lakukan proses ekspor data karyawan di sini (contoh: export ke Excel atau CSV)
        // ...

        // Redirect kembali ke halaman daftar karyawan setelah selesai ekspor
        redirect('admin/karyawan');
    }
    public function rekap_harian($tanggal) {
        // Ambil data rekap harian berdasarkan tanggal
        $data['rekap_harian'] = $this->admin_model->getRekapHarian($tanggal);

        // Tampilkan halaman rekap harian dengan data
        $this->load->view('admin/rekap_harian', $data);
    }

    public function rekap_mingguan($tanggal_awal, $tanggal_akhir) {
        // Ambil data rekap mingguan berdasarkan tanggal awal dan akhir
        $data['rekap_mingguan'] = $this->admin_model->getRekapMingguan($tanggal_awal, $tanggal_akhir);

        // Tampilkan halaman rekap mingguan dengan data
        $this->load->view('admin/rekap_mingguan', $data);
    }

    public function rekap_bulanan($bulan, $tahun) {
        // Ambil data rekap bulanan berdasarkan bulan dan tahun
        $data['rekap_bulanan'] = $this->admin_model->getRekapBulanan($bulan, $tahun);

        // Tampilkan halaman rekap bulanan dengan data
        $this->load->view('admin/rekap_bulanan', $data);
    }
}