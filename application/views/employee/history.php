<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<style>
.table {
    width: 78%;
    margin-top: 100px;
    margin-left: 280px;
}
</style>

<body>
    <?php $this->load->view('./component/sidebar_karyawan'); ?>
    <table class="table text-center table-hover">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Kegiatan</th>
                <th scope="col">Tanggal</th>
                <th scope="col">Jam Masuk</th>
                <th scope="col">Jam Pulang</th>
                <th scope="col">Keterangan</th>
                <th scope="col">Pulang</th>
                <th scope="col text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            <?php foreach ($absensi as $row): ?>
            <tr>
                <td><span class="number"><?php echo $i; ?></span></td>
                <td><?php echo $row['kegiatan']; ?></td>
                <td><?php echo $row['date']; ?></td>
                <td><?php echo $row['jam_masuk']; ?></td>
                <td>
                    <span id="jam-pulang-<?php echo $i; ?>">
                        <?php echo $row['jam_pulang']; ?>
                    </span>
                </td>
                <td>
                    <?php if (!empty($row['keterangan_izin'])): ?>
                    <p>Izin</p>
                    <?php else: ?>
                    <p>Masuk</p>
                    <?php endif; ?>
                </td>
                <td>
                <td>
                    <?php if (!empty($row['keterangan_izin'])): ?>
                    <p>Izin</p>
                    <?php else: ?>
                    <a href="javascript:pulang(<?php echo $row['id']; ?>);" class="btn btn-warning">
                        <i class="fa-solid fa-house"></i>
                    </a>
                    <?php endif; ?>
                </td>


                </td>

                <td><a href="<?php echo base_url('employee/ubah_absensi/') .
                        $row['id']; ?>" type="button" class="btn btn-primary">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </a>
                    <button onClick="hapus(<?php echo $row['id']; ?>)" type="button" class="btn btn-danger"><i
                            class="fa-solid fa-trash"></i></button>


            </tr>
            <?php $i++; ?>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>
<script>
function pulang(id) {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', '<?php echo base_url("employee/pulang/") ?>' + id, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);

            if (response.status === 'true') {
                // Tombol "Pulang" berubah menjadi "Batal Pulang"
                var pulangButton = document.querySelector('a.btn[data-id="' + id + '"]');
                pulangButton.textContent = 'Batal Pulang';
                pulangButton.className = 'btn btn-danger';
                pulangButton.setAttribute('onclick', 'batalPulang(' + id + ');');

                // Update jam pulang dalam tabel
                var jamPulangCell = document.getElementById('jam-pulang-' + id);
                jamPulangCell.textContent = response.jam_pulang;
            }
        }
    };
    xhr.send();
}

function batalPulang(id) {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', '<?php echo base_url("employee/batal_pulang/") ?>' + id, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);

            if (response.status === 'false') {
                // Tombol "Batal Pulang" berubah kembali menjadi "Pulang"
                var batalPulangButton = document.querySelector('a.btn[data-id="' + id + '"]');
                batalPulangButton.textContent = 'Pulang';
                batalPulangButton.className = 'btn btn-warning';
                batalPulangButton.setAttribute('onclick', 'pulang(' + id + ');');

                // Hapus jam pulang dalam tabel
                var jamPulangCell = document.getElementById('jam-pulang-' + id);
                jamPulangCell.textContent = '';
            }
        }
    };
    xhr.send();
}
</script>


<?php ?>

</html>