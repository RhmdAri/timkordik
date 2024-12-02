<?php
include "../connection.php"; // Pastikan koneksi sudah benar

$id = $_GET['id'];
$result = mysqli_query($con, "SELECT * FROM pertemuan WHERE id=$id");

if (!$result) {
    die("Error: " . mysqli_error($con));
}

while ($data = mysqli_fetch_array($result)) {
    $hari   = $data['hari'];
    $waktu  = $data['waktu'];
    $tempat = $data['tempat'];  
    $agenda = $data['agenda'];
}

if (isset($_POST['submit'])) {
    $hari   = $_POST['hari'];
    $waktu  = $_POST['waktu'];
    $tempat = $_POST['tempat'];
    $agenda = $_POST['agenda'];

    // Perbaiki query UPDATE
    $result = mysqli_query($con, 
    "UPDATE pertemuan SET hari='$hari', waktu='$waktu', tempat='$tempat', agenda='$agenda' WHERE id=$id");
  
    if ($result) {
        echo "<script>window.location.href ='?page=pertemuan';</script>";
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
?>

<div class="ibox mt-4">
    <div class="ibox-head">
        <div class="ibox-title">Tambah Data Pertemaun</div>
        <div class="ibox-tools">
            <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
        </div>
    </div>
    <div class="ibox-body">
        <form class="form-horizontal" id="form-sample-1" method="post" novalidate="novalidate">
            <div class="form-group row" id="date_1">
                <label class="col-sm-2 col-form-label">Tanggal Pertemuan</label>
                <div class="col-sm-10">
                    <div class="input-group date">
                        <span class="input-group-addon bg-white"><i class="fa fa-calendar"></i></span>
                        <input class="form-control" type="text" name="hari" value="<?php echo $hari; ?>">
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Waktu</label>
                <div class="col-sm-10">
                    <input class="form-control" type="time" name="waktu" value="<?php echo $waktu; ?>">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Tempat Kegiatan/Link Zoom Meeting</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="tempat" value="<?php echo $tempat; ?>">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Agenda</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="agenda" value="<?php echo $agenda; ?>">
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
