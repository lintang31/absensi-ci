<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Employee extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // Load model dan library yang diperlukan
        $this->load->model('Absensi_model');
        $this->load->library('form_validation');
        // if($this->session->userdata('logged_in')!=true || $this->session->userdata('role') != 'karyawan') {
        //     redirect(base_url().'auth');
        // }
    }

    public function karyawan()
    {
        $this->load->view('employee/karyawan');
    }

    public function dashboard()
    {
        $this->load->view('employee/dashboard');
    }

    public function tambah_absen()
    {
        $this->load->view('employee/tambah_absen');
    }
    
    public function profil()
    {
        $this->load->view('employee/profil');
    }

    public function save_absensi()
    {
        date_default_timezone_set('Asia/Jakarta');
        $current_datetime = date('Y-m-d H:i:s');

        $data = [
            'kegiatan' => $this->input->post('kegiatan'),
            'date' => $current_datetime,
            'jam_masuk' => $current_datetime,
            'jam_pulang' => $current_datetime,
        ];

        $this->load->model('Absensi_model');
        $this->Absensi_model->createAbsensi($data);

        redirect('employee/history');
    }

    // public function ubah_absensi()
    // {
    //     $this->load->view('employee/ubah_absensi');
    // }

    public function ubah_absensi($id)
    {
        // Ambil data absensi berdasarkan ID atau cara lain sesuai dengan logika aplikasi Anda
        $data['absen'] = $this->Absensi_model->getAbsensiById($id); // Gantilah dengan logika yang sesuai

        // Muat tampilan dan teruskan variabel $data
        $this->load->view('employee/ubah_absensi', $data);
    }

    public function aksi_ubah_absensi()
    {
        $id_karyawan = $this->session->userdata('id');
		$data = [
			'kegiatan' => $this->input->post('kegiatan'),
		];
		$eksekusi=$this->Absensi_model->update_data
        ('absensi', $data, array('id'=>$this->input->post('id')));
        if($eksekusi)
        {
            $this->session->set_flashdata('berhasil_update', 'Berhasil mengubah kegiatan');
            redirect(base_url('employee/history'));
        }
        else
        {
            redirect(base_url('employee/ubah_absensi/'.$this->input->post('id')));
        }
    }
    
    

    
    public function izin()
    {
        $this->load->view('employee/izin');
    }

    public function simpan_izin()
    {
        $keterangan_izin = $this->input->post('keterangan');

        $this->load->model('Izin_model');

        $data = [
            'id_karyawan' => $id_karyawan,
            'kegiatan' => '-',
            'status' => 'true',
            'keterangan_izin' => $this->input->post('keterangan_izin'),
            'jam_masuk' => '00:00:00', // Mengosongkan jam_masuk
            'jam_pulang' => '00:00:00', // Mengosongkan jam_pulang
        ];

        $this->Izin_model->simpanIzin($data);

        redirect('employee/history');
    }

    public function pulang($id) {
        $absensi = $this->Absensi_model->getAbsensiById($id);
    
        if ($absensi['status'] == 'false') {
            date_default_timezone_set('Asia/Jakarta');
            $data = array(
                'jam_pulang' => date('Y-m-d H:i:s'),
                'status' => 'true'
            );
        }
    
        $this->Absensi_model->updateStatusPulang($id, $data);
    
        // Kirim respons JSON untuk menampilkan status dan jam pulang
        $response = array(
            'status' => $data['status'],
            'jam_pulang' => $data['jam_pulang']
        );
    
        echo json_encode($response);
    }
    
    
    

    public function history()
    {
        $this->load->model('Absensi_model');
        $data['absensi'] = $this->Absensi_model->getAbsensi();
        $this->load->view('employee/history', $data);
    }

    public function hapus($id) {
        $this->load->model('Absensi_model');
    
        // Hapus data berdasarkan ID
        $this->Absensi_model->deleteAbsensi($id);
    
        // Setelah menghapus data, arahkan kembali ke halaman "history"
        redirect('employee/history');
    }
    
}