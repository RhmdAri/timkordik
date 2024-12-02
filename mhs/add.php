<?php
session_start();
include '../connection.php';

if (isset($_POST['submit'])) {
    $nama       = $_POST['nama'];
    $jekel      = $_POST['jekel'];
    $tlahir     = $_POST['tlahir'];
    $tgllahir   = $_POST['tgllahir'];
    $agama      = $_POST['agama'];
    $status     = $_POST['status'];
    $negara     = $_POST['negara'];
    $alamat     = $_POST['alamat'];
    $telp       = $_POST['telp'];
    $email      = $_POST['email'];
    $darah      = $_POST['darah'];
    $institusi  = $_POST['institusi'];
    $jenjang    = $_POST['jenjang'];
    $jurusan    = $_POST['jurusan'];
    $semester   = $_POST['semester'];
    $nim        = $_POST['nim'];
    $orientasi  = $_POST['orientasi'];
    $awal       = $_POST['awal'];
    $akhir      = $_POST['akhir'];
    $hubungan   = $_POST['hubungan'];
    $namaWal    = $_POST['namaWali'];
    $jekelWali  = $_POST['jekelWali'];
    $umur       = $_POST['umur'];
    $alamatWali = $_POST['alamatWali'];
    $pendidikan = $_POST['pendidikan'];
    $pekerjaan  = $_POST['pekerjaan'];
    $telpWali   = $_POST['telpWali'];

    function uploadFile($file, $folder) {
        $targetDir = dirname(__DIR__) . "/$folder/";
        $fileName = basename($file['name']);
        $targetFilePath = $targetDir . $fileName;
        
        if ($file['size'] > 2000000) {
            return null; 
        }

        $allowedTypes = array('jpg', 'jpeg', 'png', 'pdf');
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
        if (!in_array($fileType, $allowedTypes)) {
            return null;
        }

        if (move_uploaded_file($file['tmp_name'], $targetFilePath)) {
            return $fileName;
        }
        return null;
    }

    $foto       = uploadFile($_FILES['foto'], "foto");
    $tertib     = uploadFile($_FILES['tertib'], "tertib");
    $persetujuan= uploadFile($_FILES['persetujuan'], "persetujuan");
    $surhat     = uploadFile($_FILES['surhat'], "surhat");

    if (empty($foto) || empty($tertib) || empty($persetujuan) || empty($surhat)) {
        echo "<script>alert('Gagal mengupload salah satu file.');</script>";
        exit;
    }

    $sql = "INSERT INTO mhs (nama, jekel, tlahir, tgllahir, agama, status, negara, alamat, telp, email, darah, institusi, jenjang, jurusan, semester, nim, orientasi, awal, akhir, hubungan, namaWali, jekelWali, umur, alamatWali, pendidikan, pekerjaan, telpWali, foto, tertib, persetujuan, surhat) 
            VALUES (''$nama', '$jekel', '$tlahir', '$tgllahir', '$agama', '$status', '$negara', '$alamat', '$telp', '$email', '$darah', '$institusi', '$jenjang', '$jurusan', '$semester', '$nim', '$orientasi', '$awal', '$akhir', '$hubungan', '$namaWal', '$jekelWali', '$umur', '$alamatWali', '$pendidikan', '$pekerjaan', '$telpWali', '$foto', '$tertib', '$persetujuan', '$surhat')";

    if (mysqli_query($con, $sql)) {
        echo "<script>
                function showSuccessNotification() {
                    $('.select2').select2('close');

                    Swal.fire({
                        icon: 'success',
                        title: 'Data Berhasil Ditambahkan!',
                        showConfirmButton: true,
                        confirmButtonText: 'OK',
                    });
                }

                $('#submitButton').on('click', function(e) {
                    e.preventDefault();
                    showSuccessNotification();
                });
              </script>";
    } else {
        echo "<script>alert('Data gagal disimpan: " . mysqli_error($con) . "');</script>";
    }    
    mysqli_close($con);
}
?>

<div class="ibox mt-4">
    <div class="ibox-head">
        <div class="ibox-title">Form Tambah Data Mahasiswa</div>
        <div class="ibox-tools">
            <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
        </div>
    </div>
    <div class="ibox-body">
        <p style="font-size: small;">
            <a href="https://drive.google.com/drive/folders/1nbcrLKdMKvDsiVvlXeVkUYO3ZDFSRBnx" target="_blank" download>Surat Pernyataan & Persetujuan Orang Tua</a>
        </p>
        <hr>
        <form class="form-horizontal" method="post" enctype="multipart/form-data" novalidate="novalidate">
            <hr>
            <h6><b>Data Mahasiswa :</b></h6>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Nama Lengkap</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="nama" placeholder>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Jenis Kelamin</label>
                <div class="col-sm-10">
                    <div>
                        <input type="radio" name="jekel" value="Laki-laki" placeholder> Laki-laki
                    </div>
                    <div>
                        <input type="radio" name="jekel" value="Perempuan" placeholder> Perempuan
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Tempat Lahir</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="tlahir" placeholder>
                </div>
            </div>
            <div class="form-group row" id="date_1">
                <label class="col-sm-2 col-form-label">Tanggal Lahir</label>
                <div class="col-sm-10">
                    <div class="input-group date">
                        <span class="input-group-addon bg-white"><i class="fa fa-calendar"></i></span>
                        <input class="form-control" type="text" name="tgllahir" placeholder>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Agama</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="agama" placeholder>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Status</label>
                <div class="col-sm-10">
                    <div>
                        <input type="radio" name="status" value="Belum Menikah" placeholder> Belum Menikah
                    </div>
                    <div>
                        <input type="radio" name="status" value="Sudah Menikah" placeholder> Sudah Menikah
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Status Warga Negara</label>
                <div class="col-sm-10">
                    <div>
                        <input type="radio" name="negara" value="WNI" placeholder> Warga Negara Indonesia
                    </div>
                    <div>
                        <input type="radio" name="negara" value="WNA" placeholder> Warga Negara Asing
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Alamat Lengkap</label>
                <div class="col-sm-10">
                    <textarea class="form-control" name="alamat" placeholder></textarea>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Telepon</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="telp" placeholder>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Alamat Email</label>
                <div class="col-sm-10">
                    <input class="form-control" type="email" name="email" placeholder>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Golongan Darah</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="darah" placeholder>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Institusi Pendidikan</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="institusi" placeholder>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Jenjang</label>
                <div class="col-sm-10">
                    <select class="form-control" name="jenjang" placeholder>
                        <option value="" disabled selected>Pilih Jenjang Pendidikan</option>
                        <option value="SMK">SMA/SMK Sederajat</option>
                        <option value="D3">DIII</option>
                        <option value="D4">DIV</option>
                        <option value="S1">Strata 1</option>
                        <option value="S2">Strata 2</option>
                        <option value="S3">Strata 3</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Program Studi</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="jurusan" placeholder>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Semester</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="semester" placeholder>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">NIM</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="nim" placeholder>
                </div>
            </div>
            <div class="form-group row" id="date_1">
                <label class="col-sm-2 col-form-label">Tanggal Orientasi</label>
                <div class="col-sm-10">
                    <div class="input-group date">
                        <span class="input-group-addon bg-white"><i class="fa fa-calendar"></i></span>
                        <input class="form-control" type="text" name="orientasi" placeholder>
                    </div>
                </div>
            </div>
            <div class="form-group row" id="date_5">
                <label class="col-sm-2 col-form-label">Periode PKL</label>
                <div class="col-sm-10">
                    <div class="input-daterange input-group" id="datepicker">
                        <input class="input-sm form-control" type="text" name="awal" placeholder="Mulai">
                        <span class="input-group-addon p-l-10 p-r-10">to</span>
                        <input class="input-sm form-control" type="text" name="akhir" placeholder="Berakhir">
                    </div>
                </div>
            </div>
            <hr>
            <h6><b>Data Wali :</b></h6>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Hubungan dengan Wali</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="hubungan" placeholder>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Nama Orang Tua/Wali</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="namaWali" placeholder>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Jenis Kelamin</label>
                <div class="col-sm-10">
                    <div>
                        <input type="radio" name="jekelWali" value="Laki-laki" placeholder> Laki-laki
                    </div>
                    <div>
                        <input type="radio" name="jekelWali" value="Perempuan" placeholder> Perempuan
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Umur</label>
                <div class="col-sm-10">
                    <input class="form-control" type="number" name="umur" placeholder>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Alamat Lengkap</label>
                <div class="col-sm-10">
                    <textarea class="form-control" name="alamatWali" placeholder></textarea>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Pendidikan Terakhir</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="pendidikan" placeholder>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Pekerjaan</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="pekerjaan" placeholder>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Telepon</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="telpWali" placeholder>
                </div>
            </div>
            <hr>
            <h6><b>Unggah Berkas :</b></h6>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Foto</label>
                <div class="col-sm-10">
                    <input type="file" name="foto" accept=".jpg,.jpeg,.png">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Surat Tertib</label>
                <div class="col-sm-10">
                    <input type="file" name="tertib" accept=".jpg,.jpeg,.png" placeholder>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Persetujuan Orang Tua</label>
                <div class="col-sm-10">
                    <input type="file" name="persetujuan" accept=".jpg,.jpeg,.png" placeholder>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Surat Keterangan</label>
                <div class="col-sm-10">
                    <input type="file" name="surhat" accept=".jpg,.jpeg,.png" placeholder>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-10 offset-sm-2">
                    <button name="submit" class="btn btn-info" type="submit">Submit</button>
                    <a href="?page=mhs" class="btn btn-danger">Kembali</a>
                </div>
            </div>
        </form>
    </div>
</div>