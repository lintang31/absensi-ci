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

                    <a href="javascript:setHomeTime(<?php echo $i; ?>);" class="btn btn-warning <?php echo !empty(
                                $row['keterangan_izin']
                            )
                                ? 'disabled'
                                : ''; ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-bicycle" viewBox="0 0 16 16">
                            <path
                                d="M4 4.5a.5.5 0 0 1 .5-.5H6a.5.5 0 0 1 0 1v.5h4.14l.386-1.158A.5.5 0 0 1 11 4h1a.5.5 0 0 1 0 1h-.64l-.311.935.807 1.29a3 3 0 1 1-.848.53l-.508-.812-2.076 3.322A.5.5 0 0 1 8 10.5H5.959a3 3 0 1 1-1.815-3.274L5 5.856V5h-.5a.5.5 0 0 1-.5-.5zm1.5 2.443-.508.814c.5.444.85 1.054.967 1.743h1.139L5.5 6.943zM8 9.057 9.598 6.5H6.402L8 9.057zM4.937 9.5a1.997 1.997 0 0 0-.487-.877l-.548.877h1.035zM3.603 8.092A2 2 0 1 0 4.937 10.5H3a.5.5 0 0 1-.424-.765l1.027-1.643zm7.947.53a2 2 0 1 0 .848-.53l1.026 1.643a.5.5 0 1 1-.848.53L11.55 8.623z" />
                        </svg>
                    </a>
                </td>

                <td><a href="<?php echo base_url('employee/ubah_absensi/') .
                        $row['id']; ?>" type="button" class="btn btn-success">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-calendar-heart" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v11a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4V.5ZM1 14V4h14v10a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1Zm7-6.507c1.664-1.711 5.825 1.283 0 5.132-5.825-3.85-1.664-6.843 0-5.132Z" />
                        </svg> </a>
                    <button onClick="hapus(<?php echo $row['id']; ?>)" type="button" class="btn btn-danger">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-clipboard-x-fill" viewBox="0 0 16 16">
                            <path
                                d="M6.5 0A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3Zm3 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3Z" />
                            <path
                                d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1A2.5 2.5 0 0 1 9.5 5h-3A2.5 2.5 0 0 1 4 2.5v-1Zm4 7.793 1.146-1.147a.5.5 0 1 1 .708.708L8.707 10l1.147 1.146a.5.5 0 0 1-.708.708L8 10.707l-1.146 1.147a.5.5 0 0 1-.708-.708L7.293 10 6.146 8.854a.5.5 0 1 1 .708-.708L8 9.293Z" />
                        </svg>
                    </button>

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