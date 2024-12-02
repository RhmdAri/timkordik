<?php
if (isset($_POST['submit'])) {
    $tujuan    = $_POST['tujuan'];
    $hari      = $_POST['hari'];
    $waktu     = $_POST['waktu'];
    $tempat    = $_POST['tempat'];
    $agenda    = $_POST['agenda'];

    // Query untuk memasukkan data ke dalam tabel pks
    $result = mysqli_query($con, "INSERT INTO pertemuan(tujuan, hari, waktu, tempat, agenda) VALUES('$tujuan', '$hari', '$waktu', '$tempat', '$agenda')");

    if ($result) {
        echo "<script>window.location.href = '?page=pertemuan';</script>";
    } else {
        echo "<script>alert('Data gagal disimpan');</script>";
    }
}
?>

<div class="ibox mt-4">
    <div class="ibox-head">
        <div class="ibox-title">Tambah Data Pertemuan</div>
        <div class="ibox-tools">
            <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
        </div>
    </div>
    <div class="ibox-body">
        <form class="form-horizontal" id="form-sample-1" method="post" novalidate="novalidate">
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Tujuan Undangan</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="tujuan">
                </div>
            </div>
            <div class="form-group row" id="date_1">
                <label class="col-sm-2 col-form-label">Tanggal Pertemuan</label>
                <div class="col-sm-10">
                    <div class="input-group date">
                        <span class="input-group-addon bg-white"><i class="fa fa-calendar"></i></span>
                        <input class="form-control" type="text" name="hari" value="YYYY/DD/MM">
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Waktu</label>
                <div class="col-sm-10">
                    <input class="form-control" type="time" name="waktu">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Tempat Kegiatan/Link Zoom Meeting</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="tempat">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Agenda</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="agenda">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-10 ml-sm-auto">
                    <button name="submit" class="btn btn-info" type="submit">Submit</button>
                    <a href="?page=pertemuan" class="btn btn-danger">Back</a>
                </div>
            </div>
        </form>
    </div>
</div>
