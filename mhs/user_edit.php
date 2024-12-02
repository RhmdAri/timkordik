<?php
session_start();
include '../connection.php';

// Pastikan session user_id ada
if (!isset($_SESSION['user_id'])) {
    // Jika tidak ada session user_id, redirect ke halaman login
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id']; // Mendapatkan user_id dari session

// Ambil data user berdasarkan user_id
$sql = "SELECT * FROM mhs WHERE user_id = '$user_id'";
$result = mysqli_query($con, $sql);

// Jika user ditemukan
if ($result && mysqli_num_rows($result) > 0) {
    $data = mysqli_fetch_assoc($result);
} else {
    // Jika data user tidak ditemukan
    echo "<script>alert('Data tidak ditemukan');</script>";
    exit;
}

// Proses ketika form disubmit untuk update data
if (isset($_POST['submit'])) {
    // Ambil data dari form
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

    // Update data ke database
    $sql_update = "UPDATE mhs SET 
        nama = '$nama', jekel = '$jekel', tlahir = '$tlahir', tgllahir = '$tgllahir', 
        agama = '$agama', status = '$status', negara = '$negara', alamat = '$alamat', 
        telp = '$telp', email = '$email', darah = '$darah', institusi = '$institusi', 
        jenjang = '$jenjang', jurusan = '$jurusan', semester = '$semester', nim = '$nim', 
        orientasi = '$orientasi', awal = '$awal', akhir = '$akhir', hubungan = '$hubungan', 
        namaWali = '$namaWal', jekelWali = '$jekelWali', umur = '$umur', alamatWali = '$alamatWali', 
        pendidikan = '$pendidikan', pekerjaan = '$pekerjaan', telpWali = '$telpWali' 
        WHERE user_id = '$user_id'";

    if (mysqli_query($con, $sql_update)) {
        echo "<script>alert('Data berhasil diperbarui'); window.location = 'show.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui data');</script>";
    }
}

mysqli_close($con);
?>

<div class="ibox mt-4">
    <div class="ibox-head">
        <div class="ibox-title">Edit Data Mahasiswa</div>
        <div class="ibox-tools">
            <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
        </div>
    </div>
    <div class="ibox-body">
        <form class="form-horizontal" method="post" enctype="multipart/form-data" novalidate="novalidate">
            <hr>
            <h6><b>Data Mahasiswa :</b></h6>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Nama Lengkap</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="nama" value="<?= $data['nama'] ?>" required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Jenis Kelamin</label>
                <div class="col-sm-10">
                    <div>
                        <input type="radio" name="jekel" value="Laki-laki" <?= ($data['jekel'] == 'Laki-laki') ? 'checked' : '' ?> required> Laki-laki
                    </div>
                    <div>
                        <input type="radio" name="jekel" value="Perempuan" <?= ($data['jekel'] == 'Perempuan') ? 'checked' : '' ?> required> Perempuan
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Tempat Lahir</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="tlahir" value="<?= $data['nama'] ?>" placeholder>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Tanggal Lahir</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="tgllahir" value="<?= $data['tgllahir'] ?>" required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Agama</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="agama" placeholder value="<?= $data['agama'] ?>">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Status</label>
                <div class="col-sm-10">
                    <div>
                        <input type="radio" name="status" value="Belum Menikah" <?= ($data['status'] == 'Belum Menikah') ? 'checked' : '' ?> placeholder> Belum Menikah
                    </div>
                    <div>
                        <input type="radio" name="status" value="Sudah Menikah" <?= ($data['status'] == 'Sudah Menikah') ? 'checked' : '' ?> placeholder> Sudah Menikah
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Status Warga Negara</label>
                <div class="col-sm-10">
                    <div>
                        <input type="radio" name="negara" value="WNI" <?= ($data['negara'] == 'WNI') ? 'checked' : '' ?> placeholder> Warga Negara Indonesia
                    </div>
                    <div>
                        <input type="radio" name="negara" value="WNA" <?= ($data['negara'] == 'WNA') ? 'checked' : '' ?> placeholder> Warga Negara Asing
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Alamat Lengkap</label>
                <div class="col-sm-10">
                    <textarea class="form-control" name="alamat" placeholder="Masukkan alamat lengkap"><?= htmlspecialchars($data['alamat']) ?></textarea>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Telepon</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="telp" value="<?= $data['telp'] ?>"placeholder>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Alamat Email</label>
                <div class="col-sm-10">
                    <input class="form-control" type="email" name="email" value="<?= $data['email'] ?>" placeholder>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Golongan Darah</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="darah" value="<?= $data['darah'] ?>"placeholder>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Institusi Pendidikan</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="institusi" value="<?= $data['institusi'] ?>" placeholder>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Jenjang</label>
                <div class="col-sm-10">
                    <select class="form-control" name="jenjang" required>
                        <option value="" disabled selected>Pilih Jenjang Pendidikan</option>
                        <option value="SMK" <?php if ($data['jenjang'] == 'SMK') echo 'selected'; ?>>SMA/SMK Sederajat</option>
                        <option value="D3" <?php if ($data['jenjang'] == 'D3') echo 'selected'; ?>>DIII</option>
                        <option value="D4" <?php if ($data['jenjang'] == 'D4') echo 'selected'; ?>>DIV</option>
                        <option value="S1" <?php if ($data['jenjang'] == 'S1') echo 'selected'; ?>>Strata 1</option>
                        <option value="S2" <?php if ($data['jenjang'] == 'S2') echo 'selected'; ?>>Strata 2</option>
                        <option value="S3" <?php if ($data['jenjang'] == 'S3') echo 'selected'; ?>>Strata 3</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Program Studi</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="jurusan" value="<?= $data['jurusan'] ?>" placeholder>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Semester</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="semester" value="<?= $data['semester'] ?>" placeholder>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">NIM</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="nim" value="<?= $data['nim'] ?>" placeholder>
                </div>
            </div>
            <div class="form-group row" id="date_1">
                <label class="col-sm-2 col-form-label">Tanggal Orientasi</label>
                <div class="col-sm-10">
                    <div class="input-group date">
                        <span class="input-group-addon bg-white"><i class="fa fa-calendar"></i></span>
                        <input class="form-control" type="text" name="orientasi" value="<?= $data['orientasi'] ?>" placeholder>
                    </div>
                </div>
            </div>
            <div class="form-group row" id="date_5">
                <label class="col-sm-2 col-form-label">Periode PKL</label>
                <div class="col-sm-10">
                    <div class="input-daterange input-group" id="datepicker">
                        <input class="input-sm form-control" type="text" name="awal" placeholder="Mulai" value="<?= $data['awal'] ?>">
                        <span class="input-group-addon p-l-10 p-r-10">to</span>
                        <input class="input-sm form-control" type="text" name="akhir" placeholder="Berakhir" value="<?= $data['akhir'] ?>">
                    </div>
                </div>
            </div>
            <hr>
            <h6><b>Data Wali :</b></h6>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Hubungan dengan Wali</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="hubungan" placeholder value="<?= $data['hubungan'] ?>">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Nama Orang Tua/Wali</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="namaWali" placeholder value="<?= $data['namaWali'] ?>">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Jenis Kelamin</label>
                <div class="col-sm-10">
                    <div>
                        <input type="radio" name="jekelWali" value="Laki-laki" <?= ($data['jekelWali'] == 'Laki-laki') ? 'checked' : '' ?> placeholder> Laki-laki
                    </div>
                    <div>
                        <input type="radio" name="jekelWali" value="Perempuan" <?= ($data['jekelWali'] == 'Perempuan') ? 'checked' : '' ?> placeholder> Perempuan
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Umur</label>
                <div class="col-sm-10">
                    <input class="form-control" type="number" name="umur" value="<?= $data['umur'] ?>" placeholder>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Alamat Lengkap</label>
                <div class="col-sm-10">
                    <textarea class="form-control" name="alamatWali" placeholder="Masukkan alamat wali"><?= htmlspecialchars($data['alamatWali']) ?></textarea>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Pendidikan Terakhir</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="pendidikan" value="<?= $data['pendidikan'] ?>" placeholder>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Pekerjaan</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="pekerjaan" value="<?= $data['pekerjaan'] ?>" placeholder>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Telepon</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="telpWali" value="<?= $data['telpWali'] ?>" placeholder>
                </div>
            </div>
            <hr>
            <h6><b>Unggah Berkas :</b></h6>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Foto</label>
                <div class="col-sm-10">
                    <input type="file" name="foto" accept=".jpg,.jpeg,.png">
                    <?php if (!empty($data['foto'])): ?>
                        <br><small>Foto saat ini: <a href="../foto/<?php echo $data['foto']; ?>" target="_blank">Lihat Foto</a></small>
                    <?php endif; ?>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Surat Tertib</label>
                <div class="col-sm-10">
                    <input type="file" name="tertib" accept=".jpg,.jpeg,.png,.pdf">
                    <?php if (!empty($data['tertib'])): ?>
                        <br><small>Surat Tertib saat ini: <a href="../tertib/<?php echo $data['tertib']; ?>" target="_blank">Lihat Surat</a></small>
                    <?php endif; ?>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Persetujuan Orang Tua</label>
                <div class="col-sm-10">
                    <input type="file" name="persetujuan" accept=".jpg,.jpeg,.png,.pdf">
                    <?php if (!empty($data['persetujuan'])): ?>
                        <br><small>Persetujuan Orang Tua saat ini: <a href="../persetujuan/<?php echo $data['persetujuan']; ?>" target="_blank">Lihat Surat</a></small>
                    <?php endif; ?>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Surat Keterangan Sehat</label>
                <div class="col-sm-10">
                    <input type="file" name="surhat" accept=".jpg,.jpeg,.png,.pdf">
                    <?php if (!empty($data['surhat'])): ?>
                        <br><small>Surat Keterangan saat ini: <a href="../surhat/<?php echo $data['surhat']; ?>" target="_blank">Lihat Surat</a></small>
                    <?php endif; ?>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-10 offset-sm-2">
                    <button name="submit" class="btn btn-info" type="submit">Update</button>
                    <a href="?page=mhsUser" class="btn btn-danger">Kembali</a>
                </div>
            </div>
        </form>
    </div>
</div>
