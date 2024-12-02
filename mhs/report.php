<?php
include '../connection.php';

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

$id = $_GET['id'];
$result = mysqli_query($con, "SELECT * FROM mhs WHERE id = '$id'");
$mhs = mysqli_fetch_assoc($result);
if (!$mhs) {
    echo "Data tidak ditemukan.";
    exit;
}
?>

        <div class="page-heading">
            <h1 class="page-title">Laporan Data Mahasiswa</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="index.html"><i class="la la-home font-20"></i></a>
                </li>
                <li class="breadcrumb-item">Laporan</li>
            </ol>
        </div>
        <div class="page-content fade-in-up">
            <div class="ibox invoice">
            <div class="text-center">
                <div class="student-photo">
                    <img src="../foto/<?php echo $mhs['foto']; ?>" alt="Foto Mahasiswa" class="img-fluid" style="width: 4cm; height: 4cm; object-fit: cover; border-radius: 5px;">
                </div>
                <h2 class="font-bold">Data Mahasiswa</h2>
            </div>
                <div class="invoice-body">
                    <div class="row">
                        <div class="col-12">
                            <h4 class="section-title">Informasi Pribadi</h4>
                        </div>
                        <div class="col-6">
                            <ul class="list-unstyled">
                                <li><strong>Nama:</strong> <?php echo $mhs['nama']; ?></li>
                                <li><strong>Jenis Kelamin:</strong> <?php echo $mhs['jekel']; ?></li>
                                <li><strong>Agama:</strong> <?php echo $mhs['agama']; ?></li>
                                <li><strong>Tempat Lahir:</strong> <?php echo $mhs['tlahir']; ?></li>
                                <li><strong>Tanggal Lahir:</strong> <?php echo date("Y-m-d", strtotime($mhs['tgllahir'])); ?></li>
                            </ul>
                        </div>
                        <div class="col-6">
                            <ul class="list-unstyled">
                                <li><strong>Status:</strong> <?php echo $mhs['status']; ?></li>
                                <li><strong>Negara:</strong> <?php echo $mhs['negara']; ?></li>
                                <li><strong>Alamat:</strong> <?php echo $mhs['alamat']; ?></li>
                                <li><strong>Telepon:</strong> <?php echo $mhs['telp']; ?></li>
                                <li><strong>Email:</strong> <?php echo $mhs['email']; ?></li>
                            </ul>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <h4 class="section-title">Informasi Pendidikan</h4>
                        </div>
                        <div class="col-6">
                            <ul class="list-unstyled">
                                <li><strong>Institusi:</strong> <?php echo $mhs['institusi']; ?></li>
                                <li><strong>Jenjang:</strong> <?php echo $mhs['jenjang']; ?></li>
                                <li><strong>Jurusan:</strong> <?php echo $mhs['jurusan']; ?></li>
                            </ul>
                        </div>
                        <div class="col-6">
                            <ul class="list-unstyled">
                                <li><strong>NIM:</strong> <?php echo $mhs['nim']; ?></li>
                                <li><strong>Semester:</strong> <?php echo $mhs['semester']; ?></li>
                                <li><strong>Orientasi:</strong> <?php echo $mhs['orientasi']; ?></li>
                            </ul>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <h4 class="section-title">Informasi Wali</h4>
                        </div>
                        <div class="col-6">
                            <ul class="list-unstyled">
                                <li><strong>Nama Wali:</strong> <?php echo $mhs['namaWali']; ?></li>
                                <li><strong>Jenis Kelamin Wali:</strong> <?php echo $mhs['jekelWali']; ?></li>
                                <li><strong>Umur Wali:</strong> <?php echo $mhs['umur']; ?></li>
                            </ul>
                        </div>
                        <div class="col-6">
                            <ul class="list-unstyled">
                                <li><strong>Pendidikan Wali:</strong> <?php echo $mhs['pendidikan']; ?></li>
                                <li><strong>Pekerjaan Wali:</strong> <?php echo $mhs['pekerjaan']; ?></li>
                                <li><strong>Telepon Wali:</strong> <?php echo $mhs['telpWali']; ?></li>
                            </ul>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <h4 class="section-title">Informasi Tambahan</h4>
                        </div>
                        <div class="col-6">
                            <ul class="list-unstyled">
                                <li><strong>Tertib:</strong> 
                                    <a href="../tertib/<?php echo $mhs['tertib']; ?>" target="_blank">
                                        Lihat Tertib
                                    </a>
                                </li>
                                <li><strong>Persetujuan:</strong> 
                                    <a href="../persetujuan/<?php echo $mhs['persetujuan']; ?>" target="_blank">
                                        Lihat Persetujuan
                                    </a>
                                </li>
                                <li><strong>Surat Sehat:</strong> 
                                    <a href="../surhat/<?php echo $mhs['surhat']; ?>" target="_blank">
                                        Lihat Surat Sehat
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-6">
                            <ul class="list-unstyled">
                                <li><strong>Timestamp:</strong> <?php echo date("Y-m-d H:i:s"); ?></li>
                                <li><strong>Golongan Darah:</strong> <?php echo $mhs['darah']; ?></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

                <div class="text-right">
                <a class="btn btn-info" href="?page=mhs">
                    <i class="fa fa-arrow-left"></i> Kembali
                </a>
            </div>
            </div>
        </div>

        <style>
            .invoice {
                padding: 20px;
                background-color: #ffffff;
                border: 1px solid #ddd;
                border-radius: 10px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }

            .invoice-header {
                margin-bottom: 20px;
            }

            .student-photo img {
                width: 100px;
                height: 100px;
                border-radius: 50%;
                border: 3px solid #4CAF50;
                margin: 10px 0;
            }

            .invoice-body {
                margin: 20px 0;
            }

            .section-title {
                border-bottom: 2px solid #4CAF50;
                padding-bottom: 5px;
                color: #4CAF50;
                margin: 20px 0;
                font-weight: bold;
            }

            .list-unstyled li {
                margin-bottom: 10px;
                font-size: 14px;
            }

            h1.page-title {
                color: #4CAF50;
                font-weight: bold;
            }

            .btn-info {
                background-color: #4CAF50;
                border-color: #4CAF50;
            }
        </style>
<?php
mysqli_close($con);
?>
