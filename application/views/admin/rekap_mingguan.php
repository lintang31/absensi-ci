<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/responsive.css'); ?>">
</head>
<style>
body {
    font-family: Arial, sans-serif;
    background-color: #f3f3f3;
    margin: 0;
    padding: 0;
    margin-left: 275px;
}

.main {
    background-color: #fff;
    padding: 20px;

}

.card {
    border: 1px solid #ccc;
    margin-top: 90px;
}

.card-header {
    background-color: #f0f0f0;
    padding: 10px;
}

.card-body {
    padding: 20px;

}

.input-group {
    margin-bottom: 10px;
    margin-left: 285px;
}

.btn-success {
    background-color: #28a745;
    color: #fff;

}

.btn-warning {
    background-color: #28a745;
    color: #fff;

}

table {
    width: 100%;
    border-collapse: collapse;

}

th,
td {
    padding: 8px;
    text-align: left;
    border-bottom: 1px solid #ddd;

}

th {
    background-color: #f2f2f2;

}

tr:nth-child(even) {
    background-color: #f2f2f2;
}

.text-center {
    text-align: center;

}
</style>

<body>
    <?php $this->load->view('./component/sidebar_admin'); ?>
    <div class="main m-4">
        <div class="container w-75">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h5>Rekap Mingguan</h5>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('admin/rekapPerMinggu'); ?>" method="get" class="row g-3">
                        <div class="input-group">
                            <span class="input-group-text">Tanggal awal</span>
                            <input type="date" class="form-control" id="start_date" name="start_date"
                                value="<?php echo isset($_GET['start_date']) ? $_GET['start_date'] : ''; ?>">
                        </div>
                        <div class="input-group">
                            <span class="input-group-text">Tanggal akhir</span>
                            <input type="date" class="form-control" id="end_date" name="end_date"
                                value="<?php echo isset($_GET['end_date']) ? $_GET['end_date'] : ''; ?>">
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-success">Filter</button>
                            <button type="submit" name="submit" class="btn btn-sm btn-success"
                                formaction="<?php echo base_url('admin/export_mingguan')?>">Export</button>
                        </div>
                    </form>
                    <br>
                    <hr>
                    <br>
                    <div class="table-responsive">
                        <?php if (empty($perminggu)): ?>
                        <h5 class="text-center">Tidak ada data diminggu ini ini.</h5>
                        <p class="text-center">Silahkan pilih Minggu lain.</p>
                        <?php else: ?>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Kegiatan</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Jam Masuk</th>
                                    <th scope="col">Jam Pulang</th>
                                    <th scope="col">Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no=0; foreach ($perminggu as $rekap): $no++; ?>
                                <tr>
                                    <td><?= $no; ?></td>
                                    <td><?= $rekap->kegiatan; ?></td>
                                    <td><?= $rekap->date; ?></td>
                                    <td><?= $rekap->jam_masuk; ?></td>
                                    <td><?= $rekap->jam_pulang; ?></td>
                                    <td>
                                        <?php if(empty($rekap->keterangan_izin) ): ?>
                                        <span>Masuk</span>
                                        <?php else: ?>
                                        <?= $rekap->keterangan_izin; ?>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>