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
        <div class="container   ">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5>Rekap Harian</h5>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('admin/rekapPerHari'); ?>" method="get">
                        <div class="d-flex justify-content-between">
                            <input type="date" class="form-control" id="date" name="date"
                                value="<?php echo isset($_GET['date']) ? $_GET['date'] : ''; ?>">
                            <button type="submit" name="submit" class="btn btn-sm btn-success"
                                formaction="<?php echo base_url('admin/export_harian')?>">Export</button>
                            <button type="submit" class="btn btn-success">Filter</button>
                        </div>
                    </form>
                    <br>
                    <hr>
                    <br>
                    <div class="table-responsive">
                        <?php if(!empty($perhari)): ?>
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
                                <?php $no=0;foreach ($perhari as $rekap): $no++ ?>
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
                        <?php else: ?>
                        <h5 class="text-center">Tidak ada data untuk tanggal ini.</h5>
                        <p class="text-center">Silahkan pilih tanggal lain.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>