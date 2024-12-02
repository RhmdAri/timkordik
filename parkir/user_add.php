<?php
include '../connection.php';

if (isset($_POST['submit'])) {
    $nama       = $_POST['nama'];
    $institusi  = $_POST['institusi'];
    $awal       = $_POST['awal'];
    $akhir      = $_POST['akhir'];
    $jenis      = $_POST['jenis'];    
    $nomor      = $_POST['nomor'];

    $targetDir = dirname(__DIR__) . "/stnk/";
    $stnkFile = $_FILES['stnk']['name'];
    $targetFilePath = $targetDir . basename($stnkFile);
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    $allowedTypes = ['jpg', 'jpeg', 'png', 'pdf'];

    if (in_array(strtolower($fileType), $allowedTypes)) {
        if ($_FILES['stnk']['error'] === UPLOAD_ERR_OK) {
            if (move_uploaded_file($_FILES['stnk']['tmp_name'], $targetFilePath)) {
                $result = mysqli_query($con, "INSERT INTO parkir(nama, institusi, awal, akhir, jenis, nomor, stnk) VALUES('$nama', '$institusi', '$awal', '$akhir', '$jenis', '$nomor', '$stnkFile')");
                if ($result) {
                    echo "
                    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@10'></script>
                    <script>
                        Swal.fire({
                            title: 'Terima kasih!',
                            text: 'Data berhasil ditambahkan.',
                            icon: 'success',
                            confirmButtonText: 'Selesai',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = '?page=menu';
                            }
                        });
                    </script>";
                } else {
                    echo "<script>
                            Swal.fire({
                                title: 'Error!',
                                text: 'Data gagal disimpan: " . mysqli_error($con) . "',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                          </script>";
                }
            } else {
                echo "<script>
                        Swal.fire({
                            title: 'Error!',
                            text: 'Kesalahan saat mengupload file STNK.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                      </script>";
            }
        } else {
            switch ($_FILES['stnk']['error']) {
                case UPLOAD_ERR_INI_SIZE:
                case UPLOAD_ERR_FORM_SIZE:
                    echo "<script>
                            Swal.fire({
                                title: 'Error!',
                                text: 'File terlalu besar.',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                          </script>";
                    break;
                case UPLOAD_ERR_PARTIAL:
                    echo "<script>
                            Swal.fire({
                                title: 'Error!',
                                text: 'File hanya terupload sebagian.',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                          </script>";
                    break;
                case UPLOAD_ERR_NO_FILE:
                    echo "<script>
                            Swal.fire({
                                title: 'Error!',
                                text: 'Tidak ada file yang diupload.',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                          </script>";
                    break;
                default:
                    echo "<script>
                            Swal.fire({
                                title: 'Error!',
                                text: 'Kesalahan tidak terduga saat mengupload file.',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                          </script>";
                    break;
            }
        }
    } else {
        echo "<script>
                Swal.fire({
                    title: 'Error!',
                    text: 'Format file tidak diperbolehkan. Hanya file JPG, JPEG, PNG, atau PDF yang diperbolehkan.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
              </script>";
    }
}
?>

<div class="ibox mt-4">
    <div class="ibox-head">
        <div class="ibox-title">Form Tambah Data Parkir</div>
        <div class="ibox-tools">
            <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
        </div>
    </div>
    <div class="ibox-body">
        <form class="form-horizontal" id="form-sample-1" method="post" enctype="multipart/form-data" novalidate="novalidate">
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Nama Lengkap Mahasiswa</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="nama" required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Institusi Pendidikan</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="institusi" required>
                </div>
            </div>
            <div class="form-group row" id="date_5">
                <label class="col-sm-2 col-form-label">Periode Kegiatan</label>
                <div class="col-sm-10">
                    <div class="input-daterange input-group" id="datepicker">
                        <input class="input-sm form-control" type="text" name="awal" placeholder="YYYY-MM-DD" required>
                        <span class="input-group-addon p-l-10 p-r-10">to</span>
                        <input class="input-sm form-control" type="text" name="akhir" placeholder="YYYY-MM-DD" required>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Jenis Kendaraan</label>
                <div class="col-sm-10">
                    <select class="form-control" name="jenis" required>
                        <option value="" disabled selected>Pilih Jenis Kendaraan</option>
                        <option value="Mobil">Mobil (Rp60.000/bulan)</option>
                        <option value="Motor">Sepeda Motor (Rp30.000/bulan)</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Nomor Polisi Kendaraan</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="nomor" required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Foto STNK</label>
                <div class="col-sm-10">
                    <input class="form-control" type="file" name="stnk" accept="image/*" required>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-10 ml-sm-auto">
                    <button name="submit" class="btn btn-info" type="submit">Submit</button>
                    <a href="?page=menu" class="btn btn-danger">Kembali</a>
                </div>
            </div>
        </form>
    </div>
</div>
