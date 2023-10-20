<!-- application/views/login.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <!-- Tambahkan link ke Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css">

    <style>
    body {
        /* background-image: url('https://wallpapercave.com/wp/wp12064884.jpg'); */
        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: fixed;
        background: rgb(37, 26, 31);
        background: -moz-radial-gradient(circle, rgba(37, 26, 31, 1) 0%, rgba(235, 235, 235, 1) 100%);
        background: -webkit-radial-gradient(circle, rgba(37, 26, 31, 1) 0%, rgba(235, 235, 235, 1) 100%);
        background: radial-gradient(circle, rgba(37, 26, 31, 1) 0%, rgba(235, 235, 235, 1) 100%);
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#251a1f", endColorstr="#ebebeb", GradientType=1);
    }

    .card-title {
        color: #fff;
    }

    .card {
        background-color: rgba(0, 0, 0, 0.2);
        padding: 20px;
    }

    .logo {
        max-width: 300px;
        height: auto;
        display: block;
        margin: 0 auto 40px;
    }

    .custom-button {
        font-size: 10px;
        width: 150px
    }

    .footer {
        background-color: rgba(0, 0, 0, 0.7);
        padding: 10px;
        color: #fff;
    }
    </style>
</head>

<body>
    <div class="min-vh-100 d-flex align-items-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="">
                        <div class="container">
                            <img src="https://cdn.pixabay.com/photo/2020/03/19/18/41/office-4948345_960_720.png"
                                alt="Logo" class="mb-4 logo">
                            <hr class="text-light">
                            <div class="d-flex justify-content-center">
                                <div class="text-center mx-1">
                                    <a href="<?php echo base_url('auth/register_karyawan'); ?>" type="submit"
                                        class="btn btn-success custom-button">Daftar Karyawan</a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="footer text-center mt-5">
        <p>&copy; <?php echo date('Y'); ?> SMK Bina Nusantara Demak</p>
    </footer>
</body>

</html>