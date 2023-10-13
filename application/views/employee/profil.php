<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>
<style>
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

header {
    background-color: #333;
    color: #fff;
    text-align: center;
    padding: 10px;
}

.container {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
    background-color: #fff;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
}

.profile {
    text-align: center;
}

.profile img {
    max-width: 150px;
    border-radius: 50%;
    margin: 0 auto;
    display: block;
}

.details h3 {
    font-size: 20px;
}

.details ul {
    list-style: none;
    padding: 0;
}

.details li {
    margin: 10px 0;
}

@media (max-width: 768px) {
    .container {
        padding: 10px;
    }

    .profile img {
        max-width: 100px;
    }
}
</style>

<body>
    <?php $this->load->view('components/sidebar_karyawan');?>
    <div class="d-flex align-items-center">
        <div class="card w-75 m-auto p-3 text-dark">
            <h3 class="text-center p-3">Akun</h3>
            <form action="<?php echo base_url('karyawan/aksi_ubah_akun')?>" method="post" class="row"
                enctype="multipart/form-data">
                <div class="mb-3 col-6">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" value="<?php echo $user->email ?>" class="form-control" id="email" name="email">
                </div>
                <div class="mb-3 col-6">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" value="<?php echo $user->username?>" id="username"
                        name="username">
                </div>
                <div class="mb-3 col-6">
                    <label for="first_name" class="form-label">First Name</label>
                    <input type="text" class="form-control" value="<?php echo $user->first_name?>" id="first_name"
                        name="first_name">
                </div>
                <div class="mb-3 col-6">
                    <label for="last_name" class="form-label">Last Name</label>
                    <input type="text" class="form-control" value="<?php echo $user->last_name?>" id="last_name"
                        name="last_name">
                </div>
                <div class="mb-3 col-6">
                    <label for="password_baru" class="form-label">Password Baru</label>
                    <input type="text" class="form-control" id="password_baru" name="password_baru">
                </div>
                <div class="mb-3 col-6">
                    <label for="konfirmasi_password" class="form-label">Konfirmasi Password Baru</label>
                    <input type="text" class="form-control" id="konfirmasi_password" name="konfirmasi_password">
                </div>
                <div class="mb-3 col-12">
                    <label for="kelas" class="form-label">Foto</label>
                    <input type="file" class="form-control" id="foto" name="foto">
                </div>
                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
            </form>
        </div>
    </div>
</body>

</html>