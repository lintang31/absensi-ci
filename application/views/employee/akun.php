<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akun</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
    body {
        background-color: #f4f4f4;
        font-family: Arial, sans-serif;
    }

    .container {
        background-color: #fff;
        margin-top: 50px;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .form label {
        font-weight: bold;
    }

    .form input[type="text"],
    .form input[type="email"],
    .form input[type="password"],
    .form input[type="file"] {
        width: 100%;
        padding: 10px;
        margin-top: 5px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .form .toggle-password,
    .form .toggle-konfirmasi_password {
        position: absolute;
        right: 10px;
        top: 40px;
        cursor: pointer;
    }

    .form button {
        background-color: #007BFF;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        margin-top: 20px;
        cursor: pointer;
    }

    .form button:hover {
        background-color: #0056b3;
    }

    .register_link {
        text-align: center;
        margin-top: 20px;
    }

    .register_link a {
        color: blue;
        text-decoration: none;
    }

    .register_link a:hover {
        text-decoration: underline;
    }
    </style>
</head>

<body>
    <div class="container">
        <h2 class="text-center mb-3">Ubah Akun</h2>
        <form method="post" action="<?= base_url('employee/aksi_ubah_akun') ?>" enctype="multipart/form-data"
            class="row g-3">
            <div class="col-12">
                <label for="username" class="form-label">Username</label>
                <input type="text" name="username" class="form-control" id="inputAddress" placeholder=""
                    value="<?php echo $user->username; ?>">
            </div>
            <div class="col-md-12">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" id="inputEmail4"
                    value="<?php echo $user->email; ?>">
            </div>
            <div class="col-md-6">
                <label for="password_baru" class="form-label">Password</label>
                <div class="position-relative">
                    <input type="password" placeholder="password_baru" name="password_baru" id="password" required />
                    <span class="fa fa-fw fa-eye-slash field-icon toggle-password" onclick="togglePassword()"></span>
                </div>
            </div>
            <div class="col-md-6">
                <label for="konfirmasi_password" class="form-label">Konfirmasi Password</label>
                <div class="position-relative">
                    <input type="password" placeholder="konfirmasi_password" name="konfirmasi_password"
                        id="konfirmasi_password" required />
                    <span class="fa fa-fw fa-eye-slash field-icon toggle-konfirmasi_password"
                        onclick="toggleKonfirmasiPassword()"></span>
                </div>
            </div>
            <div class="col-md-6">
                <label for="nama_depan" class="form-label">Nama Depan</label>
                <input type="nama_depan" name="nama_depan" class="form-control" id="inputPassword4"
                    value="<?php echo $user->nama_depan; ?>">
            </div>
            <div class="col-md-6">
                <label for="nama_belakang" class="form-label">Nama Belakang</label>
                <input type="nama_belakang" name="nama_belakang" class="form-control" id="inputPassword4"
                    value="<?php echo $user->nama_belakang; ?>">
            </div>
            <div class="col-md-6">
                <label for="foto" class="form-label">Profil</label>
                <input type="file" name="foto" class="form-control" id="foto">
            </div>
        </form>
        <br>
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="<?php echo base_url('admin/profil'); ?>" type="submit" class="btn btn-danger">
                <i class="fa-solid fa-arrow-up-from-bracket"></i>
            </a>
        </div>
    </div>
    <script>
    function togglePassword() {
        var passwordField = document.getElementById("password");
        var icon = document.querySelector(".toggle-password");
        if (passwordField.type === "password") {
            passwordField.type = "text";
            icon.classList.remove("fa-eye-slash");
            icon.classList.add("fa-eye");
        } else {
            passwordField.type = "password";
            icon.classList.remove("fa-eye");
            icon.classList.add("fa-eye-slash");
        }
    }

    function toggleKonfirmasiPassword() {
        var passwordField = document.getElementById("konfirmasi_password");
        var icon = document.querySelector(".toggle-konfirmasi_password");
        if (passwordField.type === "password") {
            passwordField.type = "text";
            icon.classList.remove("fa-eye-slash");
            icon.classList.add("fa-eye");
        } else {
            passwordField.type = "password";
            icon.classList.remove("fa-eye");
            icon.classList.add("fa-eye-slash");
        }
    }
    </script>
</body>

</html>
``