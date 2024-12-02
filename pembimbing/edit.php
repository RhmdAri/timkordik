<?php
// Sambungkan ke database
include 'koneksi.php'; // Pastikan file koneksi ini benar

// Dapatkan ID dari URL
$id = isset($_GET['id']) ? $_GET['id'] : 0;

// Ambil data pembimbing berdasarkan ID
$query = mysqli_query($con, "SELECT * FROM pembimbing WHERE id = '$id'");
$data = mysqli_fetch_array($query);

if (!$data) {
    echo "<script>alert('Data tidak ditemukan');window.location.href = '?page=pembimbing';</script>";
    exit;
}

// Proses update data jika form disubmit
if (isset($_POST['submit'])) {
    $jurusan       = $_POST['jurusan'];
    $pembimbing    = $_POST['pembimbing'];
    $kuota         = $_POST['kuota'];

    // Query untuk memperbarui data
    $result = mysqli_query($con, "UPDATE pembimbing SET jurusan = '$jurusan', pembimbing = '$pembimbing', kuota = '$kuota' WHERE id = '$id'");

    if ($result) {
        echo "<script>window.location.href = '?page=pembimbing';</script>";
    } else {
        echo "<script>alert('Data gagal diperbarui');</script>";
    }
}
?>

<div class="ibox mt-4">
    <div class="ibox-head">
        <div class="ibox-title">Edit Data Pembimbing</div>
        <div class="ibox-tools">
            <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
        </div>
    </div>
    <div class="ibox-body">
        <form class="form-horizontal" method="post">
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Jurusan Pendidikan</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="jurusan" value="<?php echo $data['jurusan']; ?>" required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Pembimbing</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="pembimbing" value="<?php echo $data['pembimbing']; ?>" required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Kuota</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="kuota" value="<?php echo $data['kuota']; ?>" required>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-10 ml-sm-auto">
                    <button name="submit" class="btn btn-info" type="submit">Update</button>
                    <a href="?page=pembimbing" class="btn btn-danger">Back</a>
                </div>
            </div>
        </form>
    </div>
</div>
