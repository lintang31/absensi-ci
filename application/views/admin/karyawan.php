<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="path/to/your/custom.css">
</head>
<style>
h2 {
    margin-top: 10%;
    margin-left: 29%;
}

.exp {
    margin-left: 29%;
}

table {
    margin-top: 1%;
    margin-left: 29%;
}

.btn-success {
    background-color: #28a745;
    color: #fff;
}

@media (max-width: 768px) {
    h2 {
        margin-top: 80px;
        margin-left: 10%;
    }

    .table {
        margin-left: 10%;
    }

    @media screen and (max-width: 1225px) and (min-width: 1045px) {
        .priority-5 {
            display: none;
        }
    }

    @media screen and (max-width: 1045px) and (min-width: 835px) {
        .priority-5 {
            display: none;
        }

        .priority-4 {
            display: none;
        }
    }

    @media screen and (max-width: 565px) and (min-width: 300px) {
        .priority-5 {
            display: none;
        }

        .priority-4 {
            display: none;
        }

        .priority-3 {
            display: none;
        }
    }

    @media screen and (max-width: 300px) {
        .priority-5 {
            display: none;
        }

        .priority-4 {
            display: none;
        }

        .priority-3 {
            display: none;
        }

        .priority-2 {
            display: none;
        }

    }
}
</style>

<body>
    <?php $this->load->view('./component/sidebar_admin'); ?>
    <div class="comtainer-fluid">
        <div class="col-md-9">
            <h2>Daftar Karyawan</h2>

            <table class="table" cellspacing="0" width="100%">
                <thead>
                    <th>
                        <a href="<?php echo base_url('admin/export_karyawan')?>"><button type="submit"
                                class="btn btn-success">export</button></a>
                    </th>

                    <tr>
                        <th class="ID" width="15%">No</th>
                        <th class="Nama" width="15%">Nama</th>
                        <th class="Email" width="15%">Email</th>

                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($absensi as $row): ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $row->username; ?></td>
                        <td><?php echo $row->email; ?></td>
                    </tr>
                    <?php $i++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>


        </div>
    </div>
    <!-- Tambahkan tag-script Anda di sini, seperti JavaScript yang dibutuhkan -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="path/to/your/custom.js"></script>
</body>

</html>