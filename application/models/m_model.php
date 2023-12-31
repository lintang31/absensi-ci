<?php

class M_model extends CI_Model
{
    function get_data($table)
    {
        return $this->db->get($table);
    }

    function getwhere($table,$data){
        return $this->db->get_where($table,$data);
    }

    public function delete($table, $field, $id)
    {
        $data = $this->db->delete($table, [$field => $id]);
        return $data;
    }

    public function tambah_data($table, $data)
    {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }
    public function get_by_id($table, $id_column, $id)
    {
        $data = $this->db->where($id_column, $id)->get($table);
        return $data;
    }

    public function update($table, $data, $where)
    {
        $data = $this->db->update($table, $data, $where);
        return $this->db->affected_rows();
    }

    public function ubah_data($table, $data, $where)
    {
        $data = $this->db->update($table, $data, $where);
        return $this->db->affected_rows();
    }

    function get_absensi_by_karyawan($id_karyawan)
    {
        $this->db->where('id_karyawan', $id_karyawan);
        return $this->db->get('absensi')->result();
    }

    function get_absen($table, $id_karyawan)
    {
        return $this->db
            ->where('id_karyawan', $id_karyawan)
            ->where('keterangan_izin', 'masuk')
            ->get($table);
    }

    function get_izin($table, $id_karyawan)
    {
        return $this->db
            ->where('id_karyawan', $id_karyawan)
            ->where('kegiatan', '-')
            ->get($table);
    }


    public function get_karyawan_rows()
    {
        return $this->db->get_where('user', ['role' => 'karyawan'])->num_rows();
    }

    public function get_absensi_count()
    {
        return $this->db->count_all_results('absensi');
    }

    public function get_siswa_foto_by_id($id_siswa)
    {
        $this->db->select('foto');
        $this->db->from('siswa');
        $this->db->where('id_siswa', $id_siswa);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $result = $query->row();
            return $result->foto;
        } else {
            return false;
        }
    }

    public function getDataPembayaran()
    {
        $this->db->select(
            'pembayaran.id, pembayaran.jenis_pembayaran, pembayaran.total_pembayaran, siswa.nama_siswa, kelas.tingkat_kelas, kelas.jurusan_kelas'
        );
        $this->db->from('pembayaran');
        $this->db->join(
            'siswa',
            'siswa.id_siswa = pembayaran.id_siswa',
            'left'
        );
        $this->db->join('kelas', 'siswa.id_kelas = kelas.id', 'left');
        $query = $this->db->get();

        return $query->result();
    }
    public function getDataSiswa()
    {
        $this->db->select(
            'siswa.id_siswa, siswa.foto, siswa.nama_siswa, siswa.nisn, siswa.gender, kelas.tingkat_kelas, kelas.jurusan_kelas'
        );
        $this->db->from('siswa');
        $this->db->join('kelas', 'siswa.id_kelas = kelas.id', 'left');
        $query = $this->db->get();

        return $query->result();
    }

    public function get_by_nisn($nisn)
    {
        $this->db->select('id_siswa');
        $this->db->from('siswa');
        $this->db->where('nisn', $nisn);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $result = $query->row();
            return $result->id_siswa;
        } else {
            return false;
        }
    }

    public function getKelasByTingkatJurusan($tingkat_kelas, $jurusan_kelas)
    {
        $this->db->select('id');
        $this->db->where('tingkat_kelas', $tingkat_kelas);
        $this->db->where('jurusan_kelas', $jurusan_kelas);
        $query = $this->db->get('kelas');

        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row->id;
        } else {
            return false;
        }
    }

    // Fungsi untuk mengambil nama mapel berdasarkan id_mapel
    public function get_mapel_by_id($id_mapel)
    {
        // Gantilah 'mapel' dengan nama tabel mapel Anda
        $this->db->select('nama_mapel');
        $this->db->where('id', $id_mapel);
        $query = $this->db->get('mapel');

        // Periksa apakah query berhasil
        if ($query->num_rows() > 0) {
            return $query->row(); // Mengembalikan hasil query
        } else {
            return null; // Jika tidak ada data yang ditemukan
        }
    }

    public function updateStatusPulang($id) {
        date_default_timezone_set('Asia/Jakarta');
        $data = array(
            'jam_pulang' => date('Y-m-d H:i:s'),
            'status' => 'true'
        );

        // Dapatkan data jam masuk sebelum memperbarui
        $this->db->select('jam_masuk');
        $this->db->where('id', $id);
        $query = $this->db->get('absensi');
        $row = $query->row();
        $jam_masuk = $row->jam_masuk; // Dapatkan nilai jam masuk sebelum memperbarui

        // Tetapkan nilai jam masuk yang sama ke dalam data sebelum memperbarui
        $data['jam_masuk'] = $jam_masuk;

        // Lakukan pembaruan data dengan tetap mempertahankan jam masuk yang sama
        $this->db->where('id', $id);
        $this->db->update('absensi', $data);
    }

    
}

?>