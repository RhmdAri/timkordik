<?php
$id = $_GET['id'];
$result = mysqli_query($con, "SELECT * FROM pks WHERE id=$id");
while ($data = mysqli_fetch_array($result)) {
  $institusi = $data['institusi'];
  $fakultas  = $data['fakultas'];
  $perihal   = $data['perihal'];  
  $periode   = $data['periode'];
  $mulai     = $data['mulai'];
  $berakhir  = $data['berakhir'];
}

if (isset($_POST['submit'])) {
  $institusi = $_POST['institusi'];
  $fakultas  = $_POST['fakultas'];
  $perihal   = $_POST['perihal'];
  $periode   = $_POST['periode'];
  $mulai     = $_POST['mulai'];
  $berakhir  = $_POST['berakhir'];
  
  $result = mysqli_query($con, 
  "UPDATE pks SET institusi='$institusi', fakultas='$fakultas', perihal='$perihal', periode='$periode', mulai='$mulai', berakhir='$berakhir' WHERE id=$id");
  
  if ($result) {
    echo "<script>window.location.href ='?page=pks';</script>";
  } else {
    echo "Error: " . mysqli_error($con);  // Tampilkan error jika query gagal
  }
}
?>

<div class="ibox mt-4">
    <div class="ibox-head">
        <div class="ibox-title">Basic Validation</div>
        <div class="ibox-tools">
            <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
        </div>
    </div>
    <div class="ibox-body">
        <form class="form-horizontal" id="form-sample-1" method="post" novalidate="novalidate">
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Institusi Pendidikan</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="institusi" value="<?php echo $institusi?>">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Fakultas/Prodi</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="fakultas" value="<?php echo $fakultas?>">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Perihal</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="perihal" value="<?php echo $perihal?>">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Periode Kerjasama</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="periode" value="<?php echo $periode?>">
                </div>
            </div>
            <div class="form-group row" id="date_5">
                <label class="col-sm-2 col-form-label">Periode Kerjasama</label>
                <div class="col-sm-10">
                    <div class="input-daterange input-group" id="datepicker">
                        <input class="input-sm form-control" type="text" name="mulai" placeholder="YYYY-MM-DD" value="<?php echo $mulai?>">
                        <span class="input-group-addon p-l-10 p-r-10">to</span>
                        <input class="input-sm form-control" type="text" name="berakhir" placeholder="YYYY-MM-DD" value="<?php echo $berakhir?>">
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-10 ml-sm-auto">
                    <button name="submit" class="btn btn-info" type="submit">Submit</button>
                    <a href="?page=pks" class="btn btn-danger">Back</a>
                </div>
            </div>
        </form>
    </div>
</div>