<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Employee extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // Load model dan library yang diperlukan
        $this->load->model('Absensi_model');
        $this->load->model('m_model');
        $this->load->model('User_model');
        $this->load->library('upload');
        $this->load->library('form_validation');
        // if($this->session->userdata('logged_in')!=true || $this->session->userdata('role') != 'karyawan') {
        //     redirect(base_url().'auth');
        // }
    }

    public function upload_img($value)
    {
        $kode = round(microtime(true) * 1000);
        $config['upload_path'] = './images/siswa/';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size'] = '3000';
        $config['fle_name'] = $kode;
        $this->upload->initialize($config);
        if (!$this->upload->do_upload($value)) {
            return [false, ''];
        } else {
            $fn = $this->upload->data();
            $nama = $fn['file_name'];
            return [true, $nama];
        }
    }

    public function upload_image_karyawan($value)
    {
        $kode = round(microtime(true) * 1000);
        $config['upload_path'] = './images/karyawan/';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size'] = 30000;
        $config['file_name'] = $kode;
        $this->upload->initialize($config);
        if (!$this->upload->do_upload($value)) {
            return [false, ''];
        } else {
            $fn = $this->upload->data();
            $nama = $fn['file_name'];
            return [true, $nama];
        }
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
        if ($this->session->userdata('id')) {
            $user_id = $this->session->userdata('id');
            $data['user'] = $this->User_model->getUserById($user_id);

            $this->load->view('employee/profil', $data);
        } else {
            redirect('auth/register');
        }
    }

    

    public function save_absensi()
    {
        $id_karyawan = $this->session->userdata('id');
        date_default_timezone_set('Asia/Jakarta');
        $current_date = date('Y-m-d');
        $current_time = date('H:i:s');

        $data = [
            'id_karyawan' => $id_karyawan,
            'kegiatan' => $this->input->post('kegiatan'),
            'date' => $current_date,
            'jam_masuk' => $current_time,
            'jam_pulang' => '00:00:00',
        ];

        $this->load->model('Absensi_model');
        $this->Absensi_model->createAbsensi($data);

        redirect('employee/history');
    }

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
        $id_karyawan = $this->session->userdata('id');
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
                'jam_pulang' => date('H:i:s'),
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

   
public function hapus($id)
{
    $this->m_model->delete('absensi', 'id', $id);
    $this->session->set_flashdata(
        'berhasil_menghapus',
        'Data berhasil dihapus.'
    );
    redirect(base_url('employee/history'));
}

public function akun()
    {
        if ($this->session->userdata('id')) {
            $user_id = $this->session->userdata('id');
            $data['user'] = $this->User_model->getUserById($user_id);

            $this->load->view('employee/akun', $data);
        } else {
            redirect('auth/login');
        }
    }

    public function aksi_ubah_akun()
    {
        $foto = $this->upload_image_karyawan('foto');
        if ($foto[0] == false) {
            $password_baru = $this->input->post('password_baru');
            $konfirmasi_password = $this->input->post('konfirmasi_password');
            $email = $this->input->post('email');
            $nama_depan = $this->input->post('nama_depan');
            $nama_belakang = $this->input->post('nama_belakang');
            $username = $this->input->post('username');
            $data = [
                'foto' => 'User.png',
                'email' => $email,
                'nama_depan' => $nama_depan,
                'nama_belakang' => $nama_belakang,
                'username' => $username,
            ];
            if (!empty($password_baru)) {
                if ($password_baru === $konfirmasi_password) {
                    $data['password'] = md5($password_baru);
                } else {
                    $this->session->set_flashdata(
                        'message',
                        'Password baru dan Konfirmasi password harus sama'
                    );
                    redirect(base_url('employee/profil'));
                }
            }
            $this->session->set_userdata($data);
            $update_result = $this->m_model->update('user', $data, [
                'id' => $this->session->userdata('id'),
            ]);

            if ($update_result) {
                redirect(base_url('employee/profil'));
            } else {
                redirect(base_url('employee/profil'));
            }
        } else {
            $password_baru = $this->input->post('password_baru');
            $konfirmasi_password = $this->input->post('konfirmasi_password');
            $email = $this->input->post('email');
            $username = $this->input->post('username');
            $data = [
                'foto' => $foto[1],
                'email' => $email,
                'username' => $username,
            ];
            if (!empty($password_baru)) {
                if ($password_baru === $konfirmasi_password) {
                    $data['password'] = md5($password_baru);
                } else {
                    $this->session->set_flashdata(
                        'message',
                        'Password baru dan Konfirmasi password harus sama'
                    );
                    redirect(base_url('admin/profil'));
                }
            }
            $this->session->set_userdata($data);
            $update_result = $this->m_model->update('user', $data, [
                'id' => $this->session->userdata('id'),
            ]);

            if ($update_result) {
                redirect(base_url('employee/profil'));
            } else {
                redirect(base_url('employee/profil'));
            }
        }
    }

    
}