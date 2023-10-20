<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<style>
h2 {
    margin-top: 100px;
    margin-left: 285px;
}

body {
    font-family: Arial, sans-serif;
    background-color: #f3f3f3;
    margin-top: 80px;
    margin-right: 10px;
    padding: 0px;
    margin-left: 275px;
}

form {
    width: 50%;
    margin-left: 285px;
}

.exp {
    margin-top: 8px;
}

.table {
    width: 60%;
    margin-top: 20px;
    margin-left: 285px;
}

@media (max-width: 768px) {
    form {
        margin-left: 10%;
    }

    h2 {
        margin-left: 10%;
    }

    .table {
        margin-left: 10%;
        margin-top: 10px;
    }
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