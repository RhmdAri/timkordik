<?php
include '../connection.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Ambil pengajuan_id yang sudah ada, misalnya dari URL
if (isset($_GET['id'])) {
    $surat_id = $_GET['id'];

    // Mengambil data surat berdasarkan ID
    $query = "SELECT * FROM surat WHERE id = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $surat_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $dataSurat = $result->fetch_assoc();

    if (!$dataSurat) {
        echo "Data surat tidak ditemukan.";
        exit;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pengajuan_id = $_POST['pengajuan_id']; // Ambil dari form
    $user_id = $_POST['user_id']; // Hanya satu user_id

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
        // Query untuk memperbarui data surat
        $updateQuery = "UPDATE surat SET balasan = ?, tagihan = ?, user_id = ? WHERE id = ?";
        $updateStmt = $con->prepare($updateQuery);
        $updateStmt->bind_param("ssii", $balasan, $tagihan, $user_id, $surat_id);
        $updateStmt->execute();

        // Redirect ke halaman lain setelah berhasil
        echo "<script>window.location.href = '?page=surat';</script>";
        exit;
    } else {
        echo "Error saat mengupload file.";
    }
}
?>

<!-- Formulir untuk Admin -->
<div class="ibox mt-4">
    <div class="ibox-head">
        <div class="ibox-title">Edit Surat</div>
        <div class="ibox-tools">
            <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
        </div>
    </div>
    <div class="ibox-body">
        <form class="form-horizontal" id="form-sample-1" method="post" enctype="multipart/form-data">
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Pilih Tujuan User</label>
                <div class="col-sm-10">
                    <select class="form-control" name="user_id" id="user_id" required>
                        <option value="">-- Pilih User --</option>
                        <?php
                        // Ambil data user untuk tujuan
                        $userQuery = "SELECT id, username FROM user WHERE level = 'user'";
                        $userResult = mysqli_query($con, $userQuery);

                        if ($userResult) {
                            while ($user = mysqli_fetch_assoc($userResult)) {
                                // Cek apakah user_id sudah ada di data surat
                                $selected = ($dataSurat['user_id'] == $user['id']) ? 'selected' : '';
                                echo '<option value="' . $user['id'] . '" ' . $selected . '>' . $user['username'] . '</option>';
                            }
                        }
                        ?>
                    </select>
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
                    <button class="btn btn-info" type="submit">Update</button>
                    <a class="btn btn-danger" href="?page=surat">Back</a>
                </div>
            </div>
        </form>
    </div>
</div>