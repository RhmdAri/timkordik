<?php
if (isset($_POST['submit'])) {
    $jurusan       = $_POST['jurusan'];
    $pembimbing    = $_POST['pembimbing'];
    $kuota         = $_POST['kuota'];

    // Query untuk memasukkan data ke dalam tabel pembimbing
    $result = mysqli_query($con, "INSERT INTO pembimbing(jurusan, pembimbing, kuota) VALUES('$jurusan', '$pembimbing', '$kuota')");

    if ($result) {
        echo "<script>window.location.href = '?page=pembimbing';</script>";
    } else {
        echo "<script>alert('Data gagal disimpan');</script>";
    }
}
?>

<div class="ibox mt-4">
    <div class="ibox-head">
        <div class="ibox-title">Tambah Data Pembimbing</div>
        <div class="ibox-tools">
            <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
        </div>
    </div>
    <div class="ibox-body">
        <form class="form-horizontal" id="form-sample-1" method="post" novalidate="novalidate">
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Jurusan Pendidikan</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="jurusan">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Pembimbing</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="pembimbing">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Kuota</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="kuota">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-10 ml-sm-auto">
                    <button name="submit" class="btn btn-info" type="submit">Submit</button>
                    <a href="?page=pembimbing" class="btn btn-danger">Back</a>
                </div>
            </div>
        </form>
    </div>
</div>