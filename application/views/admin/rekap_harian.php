<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Harian</title>
    <!-- Tambahkan tag-head Anda di sini, seperti CSS dan JavaScript yang dibutuhkan -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="path/to/your/custom.css">
</head>

<body>
    <?php $this->load->view('components/sidebar_admin'); ?>
    <div class="container-fluid">
        <div class="col-md-9">
            <h2>Rekap Harian</h2>

            <!-- Filter Tanggal -->
            <form action="<?= base_url('admin/rekap_harian'); ?>" method="get">
                <div class="form-group">
                    <label for="tanggal">Pilih Tanggal</label>
                    <input type="date" class="form-control" id="tanggal" name="tanggal">
                </div>
                <button type="submit" class="btn btn-primary">Filter</button>
            </form>

            <!-- Tabel Data Rekap Harian -->
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Karyawan</th>
                        <th>Tanggal</th>
                        <th>Jam Masuk</th>
                        <th>Jam Pulang</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rekap_harian as $rekap): ?>
                    <tr>
                        <td><?= $rekap['id']; ?></td>
                        <td><?= $rekap['nama_karyawan']; ?></td>
                        <td><?= $rekap['tanggal']; ?></td>
                        <td><?= $rekap['jam_masuk']; ?></td>
                        <td><?= $rekap['jam_pulang']; ?></td>
                        <td><?= $rekap['status']; ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- Tambahkan tag-script Anda di sini, seperti JavaScript yang dibutuhkan -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="path/to/your/custom.js"></script>
</body>

</html>