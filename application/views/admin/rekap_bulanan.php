<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<style>
.table {
    width: 100%;
    margin-top: 40px;
    margin-left: 30px;
}

body {
    font-family: Arial, sans-serif;
    background-color: #f3f3f3;
    margin-top: 80px;
    margin-right: 10px;
    padding: 0px;
    margin-left: 130px;
}

h2 {
    margin-top: 100px;
    margin-left: 30px;
}

form {
    width: 50%;
    margin-left: 200px;
}


.isi {
    margin-left: 60px;
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
        <div class="container w-75">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5>Rekap Bulanan</h5>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('admin/rekapPerBulan'); ?>" method="get">
                        <div class="d-flex justify-content-between">
                            <select class="form-control" id="bulan" name="bulan">
                                <option>Pilih Bulan</option>
                                <option value="1"
                                    <?php if(isset($_GET['bulan']) && $_GET['bulan'] == '1') echo 'selected'; ?>>Januari
                                </option>
                                <option value="2"
                                    <?php if(isset($_GET['bulan']) && $_GET['bulan'] == '2') echo 'selected'; ?>>
                                    Februari</option>
                                <option value="3"
                                    <?php if(isset($_GET['bulan']) && $_GET['bulan'] == '3') echo 'selected'; ?>>Maret
                                </option>
                                <option value="4"
                                    <?php if(isset($_GET['bulan']) && $_GET['bulan'] == '4') echo 'selected'; ?>>April
                                </option>
                                <option value="5"
                                    <?php if(isset($_GET['bulan']) && $_GET['bulan'] == '5') echo 'selected'; ?>>Mei
                                </option>
                                <option value="6"
                                    <?php if(isset($_GET['bulan']) && $_GET['bulan'] == '6') echo 'selected'; ?>>Juni
                                </option>
                                <option value="7"
                                    <?php if(isset($_GET['bulan']) && $_GET['bulan'] == '7') echo 'selected'; ?>>Juli
                                </option>
                                <option value="8"
                                    <?php if(isset($_GET['bulan']) && $_GET['bulan'] == '8') echo 'selected'; ?>>Agustus
                                </option>
                                <option value="9"
                                    <?php if(isset($_GET['bulan']) && $_GET['bulan'] == '9') echo 'selected'; ?>>
                                    September</option>
                                <option value="10"
                                    <?php if(isset($_GET['bulan']) && $_GET['bulan'] == '10') echo 'selected'; ?>>
                                    Oktober</option>
                                <option value="11"
                                    <?php if(isset($_GET['bulan']) && $_GET['bulan'] == '11') echo 'selected'; ?>>
                                    November</option>
                                <option value="12"
                                    <?php if(isset($_GET['bulan']) && $_GET['bulan'] == '12') echo 'selected'; ?>>
                                    Desember</option>
                            </select>

                            <button type="submit" class="btn btn-success mx-2">Filter</button>
                            <button type="submit" name="submit" class="btn btn-sm btn-success"
                                formaction="<?php echo base_url('admin/export_bulanan')?>">Export</button>
                        </div>
                    </form>
                    <br>
                    <hr>
                    <br>
                    <div class="table-responsive">
                        <?php if (empty($rekap_harian)): ?>
                        <h5 class="text-center">Tidak ada data dibulan ini.</h5>
                        <p class="text-center">Silahkan pilih Bulan lain.</p>
                        <?php else: ?>
                        <?php foreach ($rekap_bulanan as $data): ?>
                        <table class="table" data-month="<?= $data['bulan'] ?>">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Tanggal</th>
                                    <th>Masuk</th>
                                    <th>Pulang</th>
                                    <th>Keterangan Izin</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $data_found = false; ?>
                                <?php foreach ($rekap_harian as $rekap_harian): ?>
                                <?php if (date('n', strtotime($rekap_harian['date'])) == $data['bulan']): ?>
                                <?php $data_found = true; ?>
                                <tr>
                                    <td><?= $rekap_harian['id']; ?></td>
                                    <td><?= $rekap_harian['kegiatan']; ?></td>
                                    <td><?= $rekap_harian['date']; ?></td>
                                    <td><?= $rekap_harian['jam_masuk']; ?></td>
                                    <td><?= $rekap_harian['jam_pulang']; ?></td>
                                    <td>
                                        <?php if(empty($rekap['keterangan_izin']) ): ?>
                                        <span>Masuk</span>
                                        <?php else: ?>
                                        <?= $rekap['keterangan_izin']; ?>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endif; ?>
                                <?php endforeach; ?>
                                <?php if (!$data_found): ?>
                                <tr>
                                    <td colspan="7">Tidak ada data untuk bulan ini.</td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>