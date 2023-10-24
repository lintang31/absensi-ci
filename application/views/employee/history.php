<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
    margin-left: 270px;
}

@media (max-width: 768px) {


    .table {
        margin-left: 10%;
    }
}
</style>
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
                    <?php if ($row['status'] !== 'true'): ?>
                    <a href="<?php echo base_url(
                    'employee/aksi_pulang/' . $row['id']
                      ); ?>" class="btn btn-warning">
                        <i class="fa-solid fa-person-biking"></i>
                    </a>
                    <?php else: ?>
                    <button type="button" class="btn btn-secondary" disabled>
                        <i class="fa-solid fa-house"></i>
                    </button>
                    <?php endif; ?>
                </td>

                <td><a href="<?php echo base_url('employee/ubah_absensi/') .
                        $row['id']; ?>" type="button" class="btn btn-success">
                        <i class="fa-solid fa-file-pen"></i></a>

            </tr>
            <?php $i++; ?>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>
<script>
function setHomeTime(row) {
    var jamPulangElement = document.getElementById('jam-pulang-' + row);
    var pulangButton = document.getElementById('pulangBtn-' + row);

    var currentTime = new Date();
    var hours = currentTime.getHours();
    var minutes = currentTime.getMinutes();
    var seconds = currentTime.getSeconds();
    var formattedTime = (hours < 10 ? "0" : "") + hours + ":" + (minutes < 10 ? "0" : "") + minutes + ":" + (
        seconds < 10 ? "0" : "") + seconds;

    jamPulangElement.textContent = formattedTime;

    // Simpan waktu di localStorage
    localStorage.setItem('jamPulang-' + row, formattedTime);

    // Nonaktifkan tombol home setelah ditekan
    var homeButton = document.querySelector('a[href="javascript:setHomeTime(' + row + ');"]');
    homeButton.classList.add('disabled');

    // Nonaktifkan tombol "Pulang" setelah tombol "Home" ditekan
    pulangButton.classList.add('disabled');
    pulangButton.onclick = null;
}

// Cek apakah waktu tersimpan di localStorage saat halaman dimuat
window.addEventListener('load', function() {
    var rows = document.querySelectorAll('[id^=jam-pulang-]');

    rows.forEach(function(jamPulangElement) {
        var row = jamPulangElement.getAttribute('id').replace('jam-pulang-', '');
        var storedTime = localStorage.getItem('jamPulang-' + row);

        if (storedTime) {
            jamPulangElement.textContent = storedTime;

            // Nonaktifkan tombol "Pulang" jika tombol "Home" sudah ditekan
            var pulangButton = document.getElementById('pulangBtn-' + row);
            pulangButton.classList.add('disabled');
            pulangButton.onclick = null;

            // Nonaktifkan tombol "Home" jika tombol "Home" sudah ditekan
            var homeButton = document.querySelector('a[href="javascript:setHomeTime(' + row +
                ');"]');
            homeButton.classList.add('disabled');
            homeButton.onclick = null;
        }
    });
});
</script>
<script>
function hapus(id) {
    if (confirm('Yakin Di Hapus?Di Hapus Tenan kiii!')) {
        // Jika pengguna mengonfirmasi, maka akan menjalankan perintah hapus
        window.location.href = "<?php echo base_url('employee/hapus/'); ?>" + id;
    }
}
</script>

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