<?php
defined('BASEPATH') or exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // Load model dan library yang diperlukan
        $this->load->model('user_model');
        $this->load->model('m_model');
        $this->load->model('admin_model');
        $this->load->helper('my_helper');
        $this->load->library('form_validation');
    }

    public function dashboard()
    {
        $user_id = $this->session->userdata('id');
        $data['user'] = $this->admin_model->getUserById($user_id);
        $id_admin = $this->session->userdata('id');
        $data['absen'] = $this->m_model->get_data('absensi')->result();
        $data['pengguna'] = $this->m_model->get_data('user')->num_rows();
        $data['karyawan'] = $this->m_model->get_karyawan_rows();
        $data['absensi_num'] = $this->m_model->get_absensi_count();
        $this->load->view('admin/dashboard', $data);
    }

    public function history_absen()
    {
        $data['absensi'] = $this->m_model->get_data('absensi')->result();
        $this->load->view('admin/history_absen', $data);
    }

    function getIzinData($tanggal) {
        // Di sini, Anda harus menggantinya dengan logika pengambilan data izin dari database
        // Contoh sederhana pengambilan data palsu
        $data_izin = array(
            array('kegiatan' => 'Izin Sakit', 'date' => $tanggal, 'jam_masuk' => '08:00', 'jam_pulang' => '12:00', 'keterangan_izin' => 'Sakit'),
            array('kegiatan' => 'Izin Tidak Masuk', 'date' => $tanggal, 'jam_masuk' => '09:30', 'jam_pulang' => '15:00', 'keterangan_izin' => 'Tidak Masuk'),
        );
        return $data_izin;
    }
    

public function karyawan()
{
$data['absen'] = $this-> admin_model->get_data('absensi')->num_rows();
$data['absensi'] = $this->user_model->getAllKaryawan();
$this->load->view('admin/karyawan', $data);
}




public function export_karyawan()
{
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

$style_col = [
'font' => ['bold' => true],
'alignment' => [
'horizontal' =>
\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
'vertical' =>
\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
],
'borders' => [
'top' => [
'borderStyle' =>
\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
],
'right' => [
'borderStyle' =>
\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
],
'bottom' => [
'borderStyle' =>
\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
],
'left' => [
'borderStyle' =>
\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
],
],
];

$style_row = [
'font' => ['bold' => true],
'alignment' => [
'vertical' =>
\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
],
'borders' => [
'top' => [
'borderStyle' =>
\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
],
'right' => [
'borderStyle' =>
\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
],
'bottom' => [
'borderStyle' =>
\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
],
'left' => [
'borderStyle' =>
\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
],
],
];

$sheet->setCellValue('A1', 'Daftar Karyawan');
$sheet->mergeCells('A1:E1');
$sheet
->getStyle('A1')
->getFont()
->setBold(true);

$sheet->setCellValue('A3', 'No');
$sheet->setCellValue('B3', 'Username');
$sheet->setCellValue('C3', 'Email');


$sheet->getStyle('A3')->applyFromArray($style_col);
$sheet->getStyle('B3')->applyFromArray($style_col);
$sheet->getStyle('C3')->applyFromArray($style_col);


$role = 'karyawan';
$karyawan_data = $this->admin_model->get_data_by_role($role)->result();

$no = 1;
$numrow = 4;
foreach ($karyawan_data as $data) {
$sheet->setCellValue('A' . $numrow, $no);
$sheet->setCellValue('B' . $numrow, $data->username);
$sheet->setCellValue('C' . $numrow, $data->email);


$sheet->getStyle('A' . $numrow)->applyFromArray($style_row);
$sheet->getStyle('B' . $numrow)->applyFromArray($style_row);
$sheet->getStyle('C' . $numrow)->applyFromArray($style_row);


$no++;
$numrow++;
}

$sheet->getColumnDimension('A')->setWidth(5);
$sheet->getColumnDimension('B')->setWidth(25);
$sheet->getColumnDimension('C')->setWidth(25);


$sheet->getDefaultRowDimension()->setRowHeight(-1);

$sheet
->getPageSetup()
->setOrientation(
\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE
);

$sheet->setTitle('Daftar Karyawan');

header(
'Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
);
header('Content-Disposition: attachment; filename="Daftar Karyawan.xlsx"');
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
}

public function export_absen()
{
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

$style_col = [
'font' => ['bold' => true],
'alignment' => [
'horizontal' =>
\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
'vertical' =>
\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
],
'borders' => [
'top' => [
'borderStyle' =>
\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
],
'right' => [
'borderStyle' =>
\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
],
'bottom' => [
'borderStyle' =>
\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
],
'left' => [
'borderStyle' =>
\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
],
],
];

$style_row = [
'font' => ['bold' => true],
'alignment' => [
'vertical' =>
\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
],
'borders' => [
'top' => [
'borderStyle' =>
\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
],
'right' => [
'borderStyle' =>
\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
],
'bottom' => [
'borderStyle' =>
\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
],
'left' => [
'borderStyle' =>
\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
],
],
];

$sheet->setCellValue('A1', 'Daftar Absen Karyawan');
$sheet->mergeCells('A1:G1');
$sheet
->getStyle('A1')
->getFont()
->setBold(true);

$sheet->setCellValue('A3', 'No');
$sheet->setCellValue('B3', 'Nama');
$sheet->setCellValue('C3', 'Kegiatan');
$sheet->setCellValue('D3', 'Tanggal');
$sheet->setCellValue('E3', 'Jam Masuk');
$sheet->setCellValue('F3', 'Jam Pulang');
$sheet->setCellValue('G3', 'Keterangan');

$sheet->getStyle('A3')->applyFromArray($style_col);
$sheet->getStyle('B3')->applyFromArray($style_col);
$sheet->getStyle('C3')->applyFromArray($style_col);
$sheet->getStyle('D3')->applyFromArray($style_col);
$sheet->getStyle('E3')->applyFromArray($style_col);
$sheet->getStyle('F3')->applyFromArray($style_col);
$sheet->getStyle('G3')->applyFromArray($style_col);

$data = $this->admin_model->getDataAbsensi();

$no = 1;
$numrow = 4;
foreach ($data as $data) {
$sheet->setCellValue('A' . $numrow, $no);
$sheet->setCellValue('B' . $numrow, $data->username);
$sheet->setCellValue('C' . $numrow, $data->kegiatan);
$sheet->setCellValue('D' . $numrow, $data->date);
$sheet->setCellValue('E' . $numrow, $data->jam_masuk);
$sheet->setCellValue('F' . $numrow, $data->jam_pulang);
$sheet->setCellValue('G' . $numrow, $data->keterangan_izin);

$sheet->getStyle('A' . $numrow)->applyFromArray($style_row);
$sheet->getStyle('B' . $numrow)->applyFromArray($style_row);
$sheet->getStyle('C' . $numrow)->applyFromArray($style_row);
$sheet->getStyle('D' . $numrow)->applyFromArray($style_row);
$sheet->getStyle('E' . $numrow)->applyFromArray($style_row);
$sheet->getStyle('F' . $numrow)->applyFromArray($style_row);
$sheet->getStyle('G' . $numrow)->applyFromArray($style_row);

$no++;
$numrow++;
}

$sheet->getColumnDimension('A')->setWidth(5);
$sheet->getColumnDimension('B')->setWidth(25);
$sheet->getColumnDimension('C')->setWidth(25);
$sheet->getColumnDimension('D')->setWidth(20);
$sheet->getColumnDimension('E')->setWidth(30);
$sheet->getColumnDimension('F')->setWidth(30);
$sheet->getColumnDimension('G')->setWidth(30);

$sheet->getDefaultRowDimension()->setRowHeight(-1);

$sheet
->getPageSetup()
->setOrientation(
\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE
);

$sheet->setTitle('Daftar Absen Karyawan');

header(
'Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
);
header('Content-Disposition: attachment; filename="Daftar Absen Karyawan.xlsx"');
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
}

public function export_harian()
{
$tanggal = $this->input->get('date');

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

$style_col = [
'font' => ['bold' => true],
'alignment' => [
'horizontal' =>
\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
'vertical' =>
\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
],
'borders' => [
'top' => [
'borderStyle' =>
\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
],
'right' => [
'borderStyle' =>
\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
],
'bottom' => [
'borderStyle' =>
\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
],
'left' => [
'borderStyle' =>
\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
],
],
];

$style_row = [
'font' => ['bold' => true],
'alignment' => [
'vertical' =>
\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
],
'borders' => [
'top' => [
'borderStyle' =>
\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
],
'right' => [
'borderStyle' =>
\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
],
'bottom' => [
'borderStyle' =>
\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
],
'left' => [
'borderStyle' =>
\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
],
],
];

$sheet->setCellValue('A1', 'Rekap Harian');
$sheet->mergeCells('A1:G1');
$sheet
->getStyle('A1')
->getFont()
->setBold(true);

$sheet->setCellValue('A3', 'No');
$sheet->setCellValue('B3', 'Nama');
$sheet->setCellValue('C3', 'Kegiatan');
$sheet->setCellValue('D3', 'Tanggal');
$sheet->setCellValue('E3', 'Jam Masuk');
$sheet->setCellValue('F3', 'Jam Pulang');
$sheet->setCellValue('G3', 'Keterangan');

$sheet->getStyle('A3')->applyFromArray($style_col);
$sheet->getStyle('B3')->applyFromArray($style_col);
$sheet->getStyle('C3')->applyFromArray($style_col);
$sheet->getStyle('D3')->applyFromArray($style_col);
$sheet->getStyle('E3')->applyFromArray($style_col);
$sheet->getStyle('F3')->applyFromArray($style_col);
$sheet->getStyle('G3')->applyFromArray($style_col);

$harian = $this->admin_model->getPerHari($tanggal);

$no = 1;
$numrow = 4;
foreach ($harian as $data) {
$sheet->setCellValue('A' . $numrow, $no);
$sheet->setCellValue('B' . $numrow, $data->username);
$sheet->setCellValue('C' . $numrow, $data->kegiatan);
$sheet->setCellValue('D' . $numrow, $data->date);
$sheet->setCellValue('E' . $numrow, $data->jam_masuk);
$sheet->setCellValue('F' . $numrow, $data->jam_pulang);
$sheet->setCellValue('G' . $numrow, !$data->keterangan_izin ? 'Masuk' : $data->keterangan_izin );

$sheet->getStyle('A' . $numrow)->applyFromArray($style_row);
$sheet->getStyle('B' . $numrow)->applyFromArray($style_row);
$sheet->getStyle('C' . $numrow)->applyFromArray($style_row);
$sheet->getStyle('D' . $numrow)->applyFromArray($style_row);
$sheet->getStyle('E' . $numrow)->applyFromArray($style_row);
$sheet->getStyle('F' . $numrow)->applyFromArray($style_row);
$sheet->getStyle('G' . $numrow)->applyFromArray($style_row);

$no++;
$numrow++;
}

$sheet->getColumnDimension('A')->setWidth(5);
$sheet->getColumnDimension('B')->setWidth(25);
$sheet->getColumnDimension('C')->setWidth(25);
$sheet->getColumnDimension('D')->setWidth(20);
$sheet->getColumnDimension('E')->setWidth(30);
$sheet->getColumnDimension('F')->setWidth(30);
$sheet->getColumnDimension('G')->setWidth(30);

$sheet->getDefaultRowDimension()->setRowHeight(-1);

$sheet
->getPageSetup()
->setOrientation(
\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE
);

$sheet->setTitle('Rekap Harian');

header(
'Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
);
header('Content-Disposition: attachment; filename="Rekap Harian.xlsx"');
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
}

public function export_mingguan()
{
$raw_start_date = $this->input->get('start_date');
$raw_end_date = $this->input->get('end_date');
$start_date = date('Y-m-d', strtotime($raw_start_date));
$end_date = date('Y-m-d', strtotime($raw_end_date));

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

$style_col = [
'font' => ['bold' => true],
'alignment' => [
'horizontal' =>
\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
'vertical' =>
\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
],
'borders' => [
'top' => [
'borderStyle' =>
\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
],
'right' => [
'borderStyle' =>
\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
],
'bottom' => [
'borderStyle' =>
\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
],
'left' => [
'borderStyle' =>
\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
],
],
];

$style_row = [
'font' => ['bold' => true],
'alignment' => [
'vertical' =>
\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
],
'borders' => [
'top' => [
'borderStyle' =>
\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
],
'right' => [
'borderStyle' =>
\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
],
'bottom' => [
'borderStyle' =>
\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
],
'left' => [
'borderStyle' =>
\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
],
],
];

$sheet->setCellValue('A1', 'Rekap Mingguan');
$sheet->mergeCells('A1:G1');
$sheet
->getStyle('A1')
->getFont()
->setBold(true);

$sheet->setCellValue('A3', 'No');
$sheet->setCellValue('B3', 'Nama');
$sheet->setCellValue('C3', 'Kegiatan');
$sheet->setCellValue('D3', 'Tanggal');
$sheet->setCellValue('E3', 'Jam Masuk');
$sheet->setCellValue('F3', 'Jam Pulang');
$sheet->setCellValue('G3', 'Keterangan');

$sheet->getStyle('A3')->applyFromArray($style_col);
$sheet->getStyle('B3')->applyFromArray($style_col);
$sheet->getStyle('C3')->applyFromArray($style_col);
$sheet->getStyle('D3')->applyFromArray($style_col);
$sheet->getStyle('E3')->applyFromArray($style_col);
$sheet->getStyle('F3')->applyFromArray($style_col);
$sheet->getStyle('G3')->applyFromArray($style_col);

$data = $this->admin_model->getRekapPerMinggu($start_date, $end_date);

$no = 1;
$numrow = 4;
foreach ($data as $row) {
$sheet->setCellValue('A' . $numrow, $no);
$sheet->setCellValue('B' . $numrow, $row->username);
$sheet->setCellValue('C' . $numrow, $row->kegiatan);
$sheet->setCellValue('D' . $numrow, $row->date);
$sheet->setCellValue('E' . $numrow, $row->jam_masuk);
$sheet->setCellValue('F' . $numrow, $row->jam_pulang);
$sheet->setCellValue('G' . $numrow, !$row->keterangan_izin ? 'Masuk' : $row->keterangan_izin );

$sheet->getStyle('A' . $numrow)->applyFromArray($style_row);
$sheet->getStyle('B' . $numrow)->applyFromArray($style_row);
$sheet->getStyle('C' . $numrow)->applyFromArray($style_row);
$sheet->getStyle('D' . $numrow)->applyFromArray($style_row);
$sheet->getStyle('E' . $numrow)->applyFromArray($style_row);
$sheet->getStyle('F' . $numrow)->applyFromArray($style_row);
$sheet->getStyle('G' . $numrow)->applyFromArray($style_row);

$no++;
$numrow++;
}

$sheet->getColumnDimension('A')->setWidth(5);
$sheet->getColumnDimension('B')->setWidth(25);
$sheet->getColumnDimension('C')->setWidth(25);
$sheet->getColumnDimension('D')->setWidth(20);
$sheet->getColumnDimension('E')->setWidth(30);
$sheet->getColumnDimension('F')->setWidth(30);
$sheet->getColumnDimension('G')->setWidth(30);

$sheet->getDefaultRowDimension()->setRowHeight(-1);

$sheet
->getPageSetup()
->setOrientation(
\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE
);

$sheet->setTitle('Rekap Mingguan');

header(
'Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
);
header('Content-Disposition: attachment; filename="Rekap Mingguan.xlsx"');
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
}

public function export_all()
{
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

$style_col = [
'font' => ['bold' => true],
'alignment' => [
'horizontal' =>
\PhpOffice\PhpSpreadsheet\style\Alignment::HORIZONTAL_CENTER,
'vertical' =>
\PhpOffice\PhpSpreadsheet\style\Alignment::VERTICAL_CENTER,
],
'borders' => [
'top' => [
'borderstyle' =>
\PhpOffice\PhpSpreadsheet\style\Border::BORDER_THIN,
],
'right' => [
'borderStyle' =>
\PhpOffice\PhpSpreadsheet\style\Border::BORDER_THIN,
],
'bottom' => [
'borderStyle' =>
\PhpOffice\PhpSpreadsheet\style\Border::BORDER_THIN,
],
'left' => [
'borderStyle' =>
\PhpOffice\PhpSpreadsheet\style\Border::BORDER_THIN,
],
],
];

$style_row = [
'alignment' => [
'vertical' =>
\PhpOffice\PhpSpreadsheet\style\Alignment::VERTICAL_CENTER,
],
'borders' => [
'top' => [
'borderstyle' =>
\PhpOffice\PhpSpreadsheet\style\Border::BORDER_THIN,
],
'right' => [
'borderStyle' =>
\PhpOffice\PhpSpreadsheet\style\Border::BORDER_THIN,
],
'bottom' => [
'borderStyle' =>
\PhpOffice\PhpSpreadsheet\style\Border::BORDER_THIN,
],
'left' => [
'borderStyle' =>
\PhpOffice\PhpSpreadsheet\style\Border::BORDER_THIN,
],
],
];

// set judul
$sheet->setCellValue('A1', 'DATA ABSESNI KARYAWAN');
$sheet->mergeCells('A1:E1');
$sheet
->getStyle('A1')
->getFont()
->setBold(true);
// set thead
$sheet->setCellValue('A3', 'No');
$sheet->setCellValue('B3', 'NAMA KARYAWAN');
$sheet->setCellValue('C3', 'KEGIATAN');
$sheet->setCellValue('D3', 'TANGGAL');
$sheet->setCellValue('E3', 'JAM MASUK');
$sheet->setCellValue('F3', 'JAM PULANG');
$sheet->setCellValue('G3', 'STATUS');

// mengaplikasikan style thead
$sheet->getStyle('A3')->applyFromArray($style_col);
$sheet->getStyle('B3')->applyFromArray($style_col);
$sheet->getStyle('C3')->applyFromArray($style_col);
$sheet->getStyle('D3')->applyFromArray($style_col);
$sheet->getStyle('E3')->applyFromArray($style_col);
$sheet->getStyle('F3')->applyFromArray($style_col);
$sheet->getStyle('G3')->applyFromArray($style_col);

// get dari database
$data_siswa = $this->admin_model->getExportKaryawan();

$no = 1;
$numrow = 4;
foreach ($data_siswa as $data) {
$sheet->setCellValue('A' . $numrow, $no);
$sheet->setCellValue('B' . $numrow, $data->username);
$sheet->setCellValue('C' . $numrow, $data->kegiatan);
$sheet->setCellValue('D' . $numrow, $data->date);
$sheet->setCellValue('E' . $numrow, $data->jam_masuk);
$sheet->setCellValue('F' . $numrow, $data->jam_pulang);
$sheet->setCellValue('G' . $numrow, $data->status);

$sheet->getStyle('A' . $numrow)->applyFromArray($style_row);
$sheet->getStyle('B' . $numrow)->applyFromArray($style_row);
$sheet->getStyle('C' . $numrow)->applyFromArray($style_row);
$sheet->getStyle('D' . $numrow)->applyFromArray($style_row);
$sheet->getStyle('E' . $numrow)->applyFromArray($style_row);
$sheet->getStyle('F' . $numrow)->applyFromArray($style_row);
$sheet->getStyle('G' . $numrow)->applyFromArray($style_row);

$no++;
$numrow++;
}

// set panjang column
$sheet->getColumnDimension('A')->setWidth(5);
$sheet->getColumnDimension('B')->setWidth(25);
$sheet->getColumnDimension('C')->setWidth(25);
$sheet->getColumnDimension('D')->setWidth(25);
$sheet->getColumnDimension('E')->setWidth(30);
$sheet->getColumnDimension('F')->setWidth(30);
$sheet->getColumnDimension('G')->setWidth(25);

$sheet->getDefaultRowDimension()->setRowHeight(-1);

$sheet
->getPageSetup()
->setOrientation(
\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE
);

// set nama file saat di export
$sheet->setTitle('LAPORAN DATA PEMBAYARAN');
header(
'Content-Type: aplication/vnd.openxmlformants-officedocument.spreadsheetml.sheet'
);
header(
'Content-Disposition: attachment; filename="ABSEN KARYAWAN.xlsx"'
);
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
}

public function export_bulanan()
{
$bulan = $this->input->get('bulan');
$absensi = $this->admin_model->GetBulanan($bulan);

$spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

$style_col = [
'font' => ['bold' => true],
'alignment' => [
'horizontal' =>
\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
'vertical' =>
\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
],
'borders' => [
'top' => [
'borderStyle' =>
\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
],
'right' => [
'borderStyle' =>
\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
],
'bottom' => [
'borderStyle' =>
\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
],
'left' => [
'borderStyle' =>
\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
],
],
];

$style_row = [
'font' => ['bold' => true],
'alignment' => [
'vertical' =>
\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
],
'borders' => [
'top' => [
'borderStyle' =>
\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
],
'right' => [
'borderStyle' =>
\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
],
'bottom' => [
'borderStyle' =>
\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
],
'left' => [
'borderStyle' =>
\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
],
],
];

$sheet->setCellValue('A1', 'Rekap Bulanan');
$sheet->mergeCells('A1:G1');
$sheet
->getStyle('A1')
->getFont()
->setBold(true);

$sheet->setCellValue('A3', 'no');
$sheet->setCellValue('B3', 'kegiatan');
$sheet->setCellValue('C3', 'date');
$sheet->setCellValue('D3', 'Jam_masuk');
$sheet->setCellValue('E3', 'Jam_Pulang');
$sheet->setCellValue('F3', 'Keterangan_izin');

$sheet->getStyle('A3')->applyFromArray($style_col);
$sheet->getStyle('B3')->applyFromArray($style_col);
$sheet->getStyle('C3')->applyFromArray($style_col);
$sheet->getStyle('D3')->applyFromArray($style_col);
$sheet->getStyle('E3')->applyFromArray($style_col);
$sheet->getStyle('F3')->applyFromArray($style_col);

$bulanan = $this->admin_model->getBulanan($bulan);

$no = 1;
$numrow = 4;
foreach($bulanan as $data) {
$sheet->setCellValue('A' . $numrow, $no);
$sheet->setCellValue('B' . $numrow, $data->kegiatan);
$sheet->setCellValue('C' . $numrow, $data->date);
$sheet->setCellValue('D' . $numrow, $data->jam_masuk);
$sheet->setCellValue('E' . $numrow, $data->jam_pulang);
$sheet->setCellValue('F' . $numrow, !$data->keterangan_izin ? 'Masuk' : $data->keterangan_izin );

$sheet->getStyle('A' . $numrow)->applyFromArray($style_row);
$sheet->getStyle('B' . $numrow)->applyFromArray($style_row);
$sheet->getStyle('C' . $numrow)->applyFromArray($style_row);
$sheet->getStyle('D' . $numrow)->applyFromArray($style_row);
$sheet->getStyle('E' . $numrow)->applyFromArray($style_row);
$sheet->getStyle('F' . $numrow)->applyFromArray($style_row);

$no++;
$numrow++;
}

$sheet->getColumnDimension('A')->setWidth(5);
$sheet->getColumnDimension('B')->setWidth(25);
$sheet->getColumnDimension('C')->setWidth(25);
$sheet->getColumnDimension('D')->setWidth(20);
$sheet->getColumnDimension('E')->setWidth(30);
$sheet->getColumnDimension('F')->setWidth(30);

$sheet->getDefaultRowDimension()->setRowHeight(-1);

$sheet
->getPageSetup()
->setOrientation(
\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE
);

$sheet->setTitle('Rekap Bulanan');

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="Rekap Bulanan.xlsx"');
header('Cache-Control: max-age=0');

$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
$writer->save('php://output');
}

public function rekapPerHari() {
$date = $this->input->get('date');
$data['perhari'] = $this->admin_model->getPerHari($date);
$this->load->view('admin/rekap_harian', $data);
}

public function rekapPerMinggu() {
$start_date = $this->input->get('start_date');
$end_date = $this->input->get('end_date');

if ($start_date && $end_date) {
$data['perminggu'] = $this->admin_model->getRekapPerMinggu($start_date, $end_date);
} else {
$data['perminggu'] = []; // Atau lakukan sesuai dengan kebutuhan logika Anda jika tanggal tidak ada
}

$this->load->view('admin/rekap_mingguan', $data);
// $data['absensi'] = $this->m_model->getPerMinggu();
}

public function rekapPerBulan() {
$bulan = $this->input->get('bulan'); // Ambil bulan dari parameter GET
$data['rekap_bulanan'] = $this->admin_model->getRekapPerBulan($bulan);
$data['rekap_harian'] = $this->admin_model->getRekapHarianByBulan($bulan);
$this->load->view('admin/rekap_bulanan', $data);
}

public function profil()
{
if ($this->session->userdata('id')) {
$user_id = $this->session->userdata('id');
$data['user'] = $this->admin_model->getUserById($user_id);

$this->load->view('Admin/profil', $data);
} else {
redirect('auth/register');
}
}


public function akun()
{
if ($this->session->userdata('id')) {
$user_id = $this->session->userdata('id');
$data['user'] = $this->user_model->getUserById($user_id);

$this->load->view('admin/akun', $data);
} else {
redirect('auth/login');
}
}

public function aksi_ubah_akun()
{
$foto = $this->upload_image_admin('foto');
if ($foto[0] == false) {
$password_baru = $this->input->post('password_baru');
$konfirmasi_password = $this->input->post('konfirmasi_password');
$email = $this->input->post('email');
$username = $this->input->post('username');
$data = [
'foto' => 'User.png',
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
redirect(base_url('admin/akun'));
}
}
$this->session->set_userdata($data);
$update_result = $this->m_model->update('user', $data, [
'id' => $this->session->userdata('id'),
]);

if ($update_result) {
redirect(base_url('admin/akun'));
} else {
redirect(base_url('admin/akun'));
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
redirect(base_url('admin/akun'));
}
}
$this->session->set_userdata($data);
$update_result = $this->m_model->update('user', $data, [
'id' => $this->session->userdata('id'),
]);

if ($update_result) {
redirect(base_url('employee/akun'));
} else {
redirect(base_url('employee/akun'));
}
}
}

public function hapus($id)
    {
        $this->m_model->delete('absensi', 'id', $id);
        $this->session->set_flashdata(
            'berhasil_menghapus',
            'Data berhasil dihapus.'
        );
        redirect(base_url('admin/history_absen'));
    }
    
    public function hapusKaryawan($id)
    {
        // Hapus semua catatan terkait dari tabel 'absensi'
        $this->db->where('id_karyawan', $id);
        $this->db->delete('absensi');

        // Hapus pengguna dari tabel 'user'
        $this->db->where('id', $id);
        $this->db->delete('user');

        // Setelah penghapusan berhasil, Anda dapat mengirim respons sukses atau melakukan pengalihan ke halaman lain.
        redirect('admin/karyawan'); // Contoh pengalihan ke halaman daftar karyawan
    }
}