<?php
session_start();
include '../connection.php';

// Pastikan hanya admin yang bisa mengakses halaman ini
if ($_SESSION['level'] != 'admin') {
    header('Location: login.php'); // Arahkan jika bukan admin
    exit();
}

// Cek apakah ID sertifikat ada di URL
if (isset($_GET['id'])) {
    $sertifikat_id = $_GET['id'];

    // Ambil data sertifikat dari database
    $query = "SELECT * FROM serti WHERE id = '$sertifikat_id'";
    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $sertifikat = mysqli_fetch_assoc($result);
    } else {
        die("Sertifikat tidak ditemukan.");
    }
} else {
    die("ID sertifikat tidak ada.");
}

// Proses jika form disubmit
if (isset($_POST['submit'])) {
    $no = $_POST['no'];
    $pengajuan_id = $_POST['pengajuan_id'];
    $institusi = $_POST['institusi'];
    $jurusan = $_POST['jurusan'];
    $user_id = $_POST['user_id'];
    $awal = $_POST['awal'];
    $akhir = $_POST['akhir'];
    $sertifikat_file = $sertifikat['sertifikat']; // Mengambil nama file sertifikat lama

    // Cek apakah ada file sertifikat baru yang diupload
    if (isset($_FILES['sertifikat'])) {
        $file_name = $_FILES['sertifikat']['name'];
        $file_tmp = $_FILES['sertifikat']['tmp_name'];
        $file_error = $_FILES['sertifikat']['error'];

        if ($file_error === 0) {
            $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
            $file_new_name = uniqid('', true) . '.' . $file_ext;
            $file_dest = '../sertif/' . $file_new_name;

            // Hapus file sertifikat lama jika ada
            if (file_exists($sertifikat['sertifikat'])) {
                unlink($sertifikat['sertifikat']);
            }

            // Pindahkan file sertifikat baru
            move_uploaded_file($file_tmp, $file_dest);
            $sertifikat_file = $file_dest; // Update nama file sertifikat
        } else {
            echo "Error uploading file!";
        }
    }

    // Query untuk update data sertifikat
    $query_update = "UPDATE serti SET
        no = '$no',
        pengajuan_id = '$pengajuan_id',
        institusi = '$institusi',
        jurusan = '$jurusan',
        user_id = '$user_id',
        awal = '$awal',
        akhir = '$akhir',
        sertifikat = '$sertifikat_file'
        WHERE id = '$sertifikat_id'";

    if (mysqli_query($con, $query_update)) {
        echo "<script>window.location.href = '?page=serti';</script>";
        exit();
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
?>

<div class="ibox mt-4">
    <div class="ibox-head">
        <div class="ibox-title">Edit Sertifikat</div>
    </div>
    <div class="ibox-body">
        <form class="form-horizontal" id="form-serti" method="post" enctype="multipart/form-data">
            <!-- Pilih Pengajuan -->
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Pilih Pengajuan</label>
                <div class="col-sm-10">
                    <select class="form-control" id="pengajuan" name="pengajuan_id" onchange="isiOtomatis()">
                        <option value="">Pilih Pengajuan</option>
                        <?php
                        // Query untuk mengambil data pengajuan yang ada
                        $query_pengajuan = mysqli_query($con, "SELECT p.*, k.institusi, p.jurusan FROM pengajuan p JOIN pks k ON p.idPks = k.id");
                        while ($data_pengajuan = mysqli_fetch_array($query_pengajuan)) {
                            $selected = ($data_pengajuan['id'] == $sertifikat['pengajuan_id']) ? 'selected' : '';
                            echo "<option value='".$data_pengajuan['id']."' $selected>".$data_pengajuan['no']." | ".$data_pengajuan['institusi']." | ".$data_pengajuan['jurusan']."</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>

            <!-- Pilih User -->
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Pilih User</label>
                <div class="col-sm-10">
                    <select class="form-control" name="user_id">
                        <option value="">Pilih User</option>
                        <?php
                        // Query untuk mengambil data user
                        $query_user = mysqli_query($con, "SELECT id, username FROM user WHERE level = 'user'");
                        while ($data_user = mysqli_fetch_array($query_user)) {
                            $selected = ($data_user['id'] == $sertifikat['user_id']) ? 'selected' : '';
                            echo "<option value='".$data_user['id']."' $selected>".$data_user['username']."</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>

            <!-- No Sertifikat -->
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">No Sertifikat</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="no" value="<?php echo $sertifikat['no']; ?>" required>
                </div>
            </div>

            <!-- Institusi Pendidikan -->
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Institusi Pendidikan</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="institusi" id="institusi" value="<?php echo $sertifikat['institusi']; ?>" readonly>
                </div>
            </div>

            <!-- Jurusan/Prodi -->
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Jurusan/Prodi</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="jurusan" id="jurusan" value="<?php echo $sertifikat['jurusan']; ?>" readonly>
                </div>
            </div>

            <!-- Periode Praktik -->
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Periode Praktik</label>
                <div class="col-sm-10">
                    <div class="input-daterange input-group" id="datepicker">
                        <input class="input-sm form-control" type="text" name="awal" value="<?php echo $sertifikat['awal']; ?>" readonly>
                        <span class="input-group-addon p-l-10 p-r-10">to</span>
                        <input class="input-sm form-control" type="text" name="akhir" value="<?php echo $sertifikat['akhir']; ?>" readonly>
                    </div>
                </div>
            </div>

            <!-- Sertifikat Upload -->
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Upload Sertifikat</label>
                <div class="col-sm-10">
                    <input class="form-control" type="file" name="sertifikat" accept=".pdf, .jpg, .png">
                    <small>Leave blank if you do not want to change the file</small>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-10 ml-sm-auto">
                    <button name="submit" class="btn btn-info" type="submit">Update</button>
                    <a href="?page=serti" class="btn btn-danger">Back</a>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
function isiOtomatis() {
    var pengajuan_id = document.getElementById("pengajuan").value;
    if (pengajuan_id !== "") {
        fetch('../serti/getDataPengajuan.php?id=' + pengajuan_id)
        .then(response => response.json())
        .then(data => {
            document.getElementById("institusi").value = data.institusi;
            document.getElementById("jurusan").value = data.jurusan;
        });
    }
}
</script>
