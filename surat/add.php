<?php
include '../connection.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pengajuan_id = $_POST['pengajuan_id'];
    $user_id = $_POST['user_id'];

    // Mengambil data pengajuan berdasarkan ID
    $query = "SELECT no, dari, perihal FROM pengajuan WHERE id = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $pengajuan_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $dataPengajuan = $result->fetch_assoc();

    if ($dataPengajuan) {
        $no_surat = $dataPengajuan['no'];
        $tujuan = $dataPengajuan['dari'];
        $perihal = $dataPengajuan['perihal'];

        // Menangani upload file
        $balasan = $_FILES['balasan']['name'];
        $tagihan = $_FILES['tagihan']['name'];

        // Menggunakan path absolut
        $target_dir = dirname(__DIR__) . "/uploads/";
        $target_file_balasan = $target_dir . basename($balasan);
        $target_file_tagihan = $target_dir . basename($tagihan);

        // Memindahkan file ke folder uploads
        $upload_balasan = move_uploaded_file($_FILES['balasan']['tmp_name'], $target_file_balasan);
        $upload_tagihan = move_uploaded_file($_FILES['tagihan']['tmp_name'], $target_file_tagihan);

        if ($upload_balasan && $upload_tagihan) {
            // Query untuk menyimpan data ke database
            $insertQuery = "INSERT INTO surat (pengajuan_id, balasan, tagihan, user_id, no_surat, tujuan, perihal) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $insertStmt = $con->prepare($insertQuery);
            $insertStmt->bind_param("ississs", $pengajuan_id, $balasan, $tagihan, $user_id, $no_surat, $tujuan, $perihal);
            $insertStmt->execute();

            // Redirect ke halaman surat
            echo "<script>window.location.href = '?page=surat';</script>";
            exit;
        } else {
            echo "Error saat mengupload file.";
        }
    } else {
        echo "Data pengajuan tidak ditemukan.";
    }
}
?>

<!-- Formulir untuk Admin -->
<div class="ibox mt-4">
    <div class="ibox-head">
        <div class="ibox-title">Tambah Data Surat</div>
        <div class="ibox-tools">
            <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
        </div>
    </div>
    <div class="ibox-body">
        <form class="form-horizontal" id="form-sample-1" method="post" enctype="multipart/form-data">
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Pilih Pengajuan</label>
                <div class="col-sm-10">
                    <select class="form-control" name="pengajuan_id" id="pengajuan_id" onchange="fetchPengajuanData()">
                        <option value="">-- Pilih Pengajuan --</option>
                        <?php
                        $query = "SELECT id, no FROM pengajuan";
                        $result = mysqli_query($con, $query);
                        if ($result) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<option value="' . $row['id'] . '">' . $row['no'] . '</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Pilih Tujuan User</label>
                <div class="col-sm-10">
                    <select class="form-control" name="user_id" id="user_id" required>
                        <option value="">-- Pilih User --</option>
                        <?php
                        $users = mysqli_query($con, "SELECT id, username FROM user WHERE level = 'user'");
                        while ($user = mysqli_fetch_assoc($users)) {
                            echo "<option value='" . $user['id'] . "'>" . $user['username'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">No Surat</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="no_surat" id="no_surat" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Tujuan</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="tujuan" id="tujuan" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Perihal</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="perihal" id="perihal" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">File Surat Balasan</label>
                <div class="col-sm-10">
                    <input class="form-control" type="file" name="balasan" required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">File Surat Tagihan</label>
                <div class="col-sm-10">
                    <input class="form-control" type="file" name="tagihan" required>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-10 ml-sm-auto">
                    <button class="btn btn-info" type="submit">Submit</button>
                    <a class="btn btn-danger" href="?page=surat">Back</a>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
function fetchPengajuanData() {
    var pengajuanId = document.getElementById("pengajuan_id").value;
    if (pengajuanId) {
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "../surat/get_pengajuan_data.php?id=" + pengajuanId, true);
        xhr.onload = function() {
            if (this.status == 200) {
                var data = JSON.parse(this.responseText);
                document.getElementById("no_surat").value = data.no;
                document.getElementById("tujuan").value = data.dari;
                document.getElementById("perihal").value = data.perihal;
            }
        };
        xhr.send();
    } else {
        document.getElementById("no_surat").value = "";
        document.getElementById("tujuan").value = "";
        document.getElementById("perihal").value = "";
    }
}

$(document).ready(function() {
    $('#pengajuan_id').select2({
        placeholder: '-- Pilih Pengajuan --',
        allowClear: true
    });
    $('#user_id').select2({
        placeholder: '-- Pilih User --',
        allowClear: true
    });
});
</script>