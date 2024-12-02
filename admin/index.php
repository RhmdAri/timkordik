<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIM-KORDIK RSISA</title>
    <link rel="icon" href="../assets/img/rsi.png" type="image/png" sizes="32x32">
    <link href="../assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <link href="../assets/vendors/themify-icons/css/themify-icons.css" rel="stylesheet" />
    <link href="../assets/vendors/select2/dist/css/select2.min.css" rel="stylesheet" />
    <link href="../assets/vendors/bootstrap-datepicker/dist/css/bootstrap-datepicker3.min.css" rel="stylesheet" />
    <link href="../assets/vendors/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" />
    <link href="../assets/vendors/jquery-minicolors/jquery.minicolors.css" rel="stylesheet" />
    <link href="../assets/vendors/DataTables/datatables.min.css" rel="stylesheet" />
    <link href="../assets/vendors/fullcalendar/dist/fullcalendar.min.css" rel="stylesheet" />
    <link href="../assets/vendors/fullcalendar/dist/fullcalendar.print.min.css" rel="stylesheet" media="print" />
    <link href="../assets/css/main.min.css" rel="stylesheet" />
    <style>
        .swal2-container {
            z-index: 1051 !important;
        }
        .side-menu a.active {
            background-color: #2ecc71 !important;
            color: white !important;
        }
        .swal2-popup {
            background-color: #f9f9f9;
            border: 2px solid #28a745;
            border-radius: 10px;
            width: 90%;
            max-width: 800px;
            padding: 20px;
        }
        .swal2-title {
            color: #28a745;
            font-size: 1.5em;
            margin-bottom: 20px;
        }
        .swal2-content {
            color: #333;
            font-size: 1.1em;
        }
        .btn-secondary {
            background-color: #28a745;
            color: white;
            border: none;
        }
        .btn-secondary:hover {
            background-color: #218838;
        }
        img {
            max-width: 100px;
            border-radius: 5px;
        }
        #external-events .ex-event {
            color: white;
        }
        .nav-2-level.collapse {
    display: none; /* Menyembunyikan submenu ketika collapsible */
}

.nav-2-level.show {
    display: block; /* Menampilkan submenu ketika dalam keadaan terbuka */
}

    </style>
</head>

<body class="fixed-navbar">
    <div class="page-wrapper">
        <?php 
        include_once '../logincheck.php'; 
        include_once '../layout/navbar.php';
        include_once '../layout/menu.php';
        ?>

        <div class="content-wrapper">
            <div class="container-fluid">
                <?php
                    include_once '../connection.php';
                    error_reporting(0);
                    switch ($_GET['page']) {
                        default:
                            include "dashboard.php";
                            break;

                        case "dashboard":
                            $title = 'Dashboard';
                            include 'dashboard.php';
                            break;

                        case "pembimbing":
                            $title = 'Data PKS';
                            include '../pembimbing/show.php';
                            break;

                        case "pembimbingAdd":
                            $title = 'Data pembimbing';
                            include '../pembimbing/add.php';
                            break;

                        case "pembimbingEdit":
                            $title = 'Data pembimbing';
                            include '../pembimbing/edit.php';
                            break;

                        case "pembimbingDelete":
                            $title = 'Data pembimbing';
                            include '../pembimbing/delete.php';
                            break;
                        
                        case "pks":
                            $title = 'Data PKS';
                            include '../pks/show.php';
                            break;

                        case "pksAdd":
                            $title = 'Tambah Data PKS';
                            include '../pks/add.php';
                            break;

                        case "pksEdit":
                            $title = 'Edit Data PKS';
                            include '../pks/edit.php';
                            break;

                        case "pksDelete":
                            $title = 'Hapus Data PKS';
                            include '../pks/delete.php';
                            break;

                        case "pengajuan":
                            $title = 'Data Pengajuan';
                            include '../pengajuan/show.php';
                            break;

                        case "pengajuanAdd":
                            $title = 'Tambah Data Pengajuan';
                            include '../pengajuan/add.php';
                            break;

                        case "pengajuanEdit":
                            $title = 'Tambah Data Pengajuan';
                            include '../pengajuan/edit.php';
                            break;

                        case "pengajuanDelete":
                            $title = 'Tambah Data Pengajuan';
                            include '../pengajuan/delete.php';
                            break;

                        case "surat":
                            $title = 'Data Surat';
                            include '../surat/show.php';
                            break;

                        case "suratAdd":
                            $title = 'Tambah Surat Pengajuan';
                            include '../surat/add.php';
                            break;

                        case "suratEdit":
                            $title = 'Edit Surat Pengajuan';
                            include '../surat/edit.php';
                            break;

                        case "suratDelete":
                            $title = 'Edit Surat Pengajuan';
                            include '../surat/delete.php';
                            break;

                        case "pertemuan":
                            $title = 'Data Pertemuan';
                            include '../pertemuan/show.php';
                            break;

                        case "pertemuanAdd":
                            $title = 'Tambah Data Pertemuan';
                            include '../pertemuan/add.php';
                            break;

                        case "pertemuanEdit":
                            $title = 'Edit Data Pertemuan';
                            include '../pertemuan/edit.php';
                            break;

                        case "pertemuanDelete":
                            $title = 'Edit Data Pertemuan';
                            include '../pertemuan/delete.php';
                            break;

                        case "pelaksanaan":
                            $title = 'Data Pelaksanaan';
                            include '../pelaksanaan/show.php';
                            break;

                        case "pelaksanaanAdd":
                            $title = 'Tambah Data Pelaksanaan';
                            include '../pelaksanaan/add.php';
                            break;

                        case "pelaksanaanEdit":
                            $title = 'Tambah Data Pelaksanaan';
                            include '../pelaksanaan/edit.php';
                            break;

                        case "pelaksanaanDelete":
                            $title = 'Tambah Data Pelaksanaan';
                            include '../pelaksanaan/delete.php';
                            break;

                        case "updateKuota":
                            $title = 'Tambah Data Pelaksanaan';
                            include '../pelaksanaan/updateKuota.php';
                            break;

                        case "serti":
                            $title = 'Data Serti';
                            include '../serti/show.php';
                            break;

                        case "sertiAdd":
                            $title = 'Tambah Data Serti';
                            include '../serti/add.php';
                            break;

                        case "sertiEdit":
                            $title = 'Tambah Data Serti';
                            include '../serti/edit.php';
                            break;

                        case "sertiDelete":
                            $title = 'Tambah Data Serti';
                            include '../serti/delete.php';
                            break;

                        case "parkir":
                            $title = 'Data Parkir';
                            include '../parkir/show.php';
                            break;

                        case "parkirDelete":
                            $title = 'Data Parkir';
                            include '../parkir/delete.php';
                            break;

                        case "mhs":
                            $title = 'Data Mahasiswa';
                            include '../mhs/show.php';
                            break;

                        case "mhsAdd":
                            $title = 'Tambah Data Mahasiswa';
                            include '../mhs/add.php';
                            break;

                        case "report":
                            $title = 'Laporan Data Mahasiswa';
                            include '../mhs/report.php';
                            break;
                    }
                ?>
            </div>
            <?php include_once '../layout/footer.php'; ?>
        </div>
    </div>
    <div class="sidenav-backdrop backdrop"></div>
    <div class="preloader-backdrop">
        <div class="page-preloader">Loading</div>
    </div>
    <?php include_once '../layout/js.php'; ?>
</body>

</html>
