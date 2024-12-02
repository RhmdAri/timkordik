<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <title>SIM-KORDIK RSISA</title>
    <link rel="icon" href="../assets/img/rsi.png" type="image/png" sizes="32x32">
    <!-- GLOBAL MAINLY STYLES-->
    <link href="../assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <link href="../assets/vendors/themify-icons/css/themify-icons.css" rel="stylesheet" />
    <!-- PLUGINS STYLES-->
    <link href="../assets/vendors/select2/dist/css/select2.min.css" rel="stylesheet" />
    <link href="../assets/vendors/bootstrap-datepicker/dist/css/bootstrap-datepicker3.min.css" rel="stylesheet" />
    <link href="../assets/vendors/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" >
    <link href="../assets/vendors/jquery-minicolors/jquery.minicolors.css" rel="stylesheet" />
    <link href="../assets/vendors/DataTables/datatables.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="../assets/vendors/fullcalendar/dist/fullcalendar.min.css" rel="stylesheet" />
    <link href="../assets/vendors/fullcalendar/dist/fullcalendar.print.min.css" rel="stylesheet" media="print" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- THEME STYLES-->
    <link href="../assets/css/main.min.css" rel="stylesheet" />
    <style>
    .side-menu a.active {
        background-color: #2ecc71 !important;
        color: white !important;
    }
    </style>
</head>


<body class="fixed-navbar">
    <div class="page-wrapper">
    <?php include_once '../logincheck.php';?>
        <!-- START HEADER-->
        <?php include_once '../layout/navbar_user.php' ?>
        <!-- END HEADER-->
        <?php include_once '../layout/menu_user.php' ?>

        <div class="content-wrapper">
            <!-- DASHBOARD -->
            <div class="container-fluid">
                <?php
                    include_once '../connection.php';
                    error_reporting(0); 
                    switch ($_GET['page']) {
                        default:
                        include "dashboard.php"; 
                        break;
                        
                        case "menu";
                        $title = 'Dashboard';
                        include 'dashboard.php'; 
                        break;     

                        case "parkirAdd";
                        $title = 'Tambah Data PKS';
                        include '../parkir/user_add.php'; 
                        break;

                        case "mhsUser";
                        $title = 'Data Mahasiswa';
                        include '../mhs/user_show.php'; 
                        break;

                        case "mhsAdd";
                        $title = 'Tambah Data Mahasiswa';
                        include '../mhs/user_add.php'; 
                        break;

                        case "mhsEdit";
                        $title = 'Tambah Data Mahasiswa';
                        include '../mhs/user_edit.php'; 
                        break;

                        case "sertiUser";
                        $title = 'Tambah Data Mahasiswa';
                        include '../serti/user_show.php'; 
                        break;

                        case "suratUser";
                        $title = 'Data surat';
                        include '../surat/user_show.php'; 
                        break;

                    }
                ?>
                                   
                </div>
            <!-- END PAGE CONTENT-->
             <!--FOOTER-->
             <?php include_once '../layout/footer.php' ?>
        </div>
    </div>
    <!-- END THEME CONFIG PANEL-->
    <!-- BEGIN PAGA BACKDROPS-->
    <div class="sidenav-backdrop backdrop"></div>
    <div class="preloader-backdrop">
        <div class="page-preloader">Loading</div>
    </div>
    <!-- END PAGA BACKDROPS-->
    <?php include_once '../layout/js.php' ?>
</body>

</html>