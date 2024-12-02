<?php
include "../connection.php";

$id = $_GET['id'];
$result = mysqli_query($con, "SELECT * FROM pelaksanaan WHERE id=$id");

if (!$result) {
    die("Error: " . mysqli_error($con));
}

$data = mysqli_fetch_array($result);
if (!$data) {
    die("Data tidak ditemukan");
}

$pengajuan_id = $data['pengajuan_id'];
$institusi    = $data['institusi'];
$jurusan      = $data['jurusan'];
$awal         = $data['awal'];
$akhir        = $data['akhir'];
$jumlah       = $data['jumlah'];

if (isset($_POST['submit'])) {
    $pengajuan_id = $_POST['pengajuan_id'];
    $institusi    = $_POST['institusi'];
    $jurusan      = $_POST['jurusan'];
    $awal         = $_POST['awal'];
    $akhir        = $_POST['akhir'];
    $jumlah       = $_POST['jumlah'];

    // Perbaiki query UPDATE
    $result = mysqli_query($con, 
    "UPDATE pelaksanaan SET pengajuan_id='$pengajuan_id', institusi='$institusi', jurusan='$jurusan', awal='$awal', akhir='$akhir', jumlah='$jumlah' WHERE id=$id");
  
    if ($result) {
        echo "<script>window.location.href ='?page=pelaksanaan';</script>";
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
?>

<div class="ibox mt-4">
    <div class="ibox-head">
        <div class="ibox-title">Edit Data Pelaksanaan</div>
    </div>
    <div class="ibox-body">
        <form class="form-horizontal" id="form-pelaksanaan" method="post">
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Pilih Pengajuan</label>
                <div class="col-sm-10">
                    <select class="form-control" id="pengajuan" name="pengajuan_id" onchange="isiOtomatis()">
                        <option value="">Pilih Pengajuan</option>
                        <?php
                        // Mengambil data dari tabel pengajuan dan pks
                        $query_pengajuan = mysqli_query($con, "
                            SELECT p.*, k.institusi, p.jurusan 
                            FROM pengajuan p 
                            JOIN pks k ON p.idPks = k.id");
                            
                        while ($data_pengajuan = mysqli_fetch_array($query_pengajuan)) {
                            $selected = ($data_pengajuan['id'] == $pengajuan_id) ? 'selected' : '';
                            echo "<option value='".$data_pengajuan['id']."' $selected>".$data_pengajuan['no']." | ".$data_pengajuan['institusi']." | ".$data_pengajuan['jurusan']."</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Institusi Pendidikan</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="institusi" id="institusi" value="<?php echo $institusi; ?>" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Jurusan/Prodi</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="jurusan" id="jurusan" value="<?php echo $jurusan; ?>" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Periode Praktik</label>
                <div class="col-sm-10">
                    <div class="input-daterange input-group" id="datepicker">
                        <input class="input-sm form-control" type="text" name="awal" id="awal" value="<?php echo $awal; ?>" readonly>
                        <span class="input-group-addon p-l-10 p-r-10">to</span>
                        <input class="input-sm form-control" type="text" name="akhir" id="akhir" value="<?php echo $akhir; ?>" readonly>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Jumlah Peserta</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="jumlah" id="jumlah" value="<?php echo $jumlah; ?>" readonly>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-10 ml-sm-auto">
                    <button name="submit" class="btn btn-info" type="submit">Update</button>
                    <a href="?page=pelaksanaan" class="btn btn-danger">Back</a>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
function isiOtomatis() {
    var pengajuan_id = document.getElementById("pengajuan").value;

    if (pengajuan_id !== "") {
        console.log('Fetching data for ID:', pengajuan_id); // Debug log
        fetch('../pelaksanaan/getDataPengajuan.php?id=' + pengajuan_id)
        .then(response => {
            console.log('Response status:', response.status); // Cek status respons
            if (!response.ok) {
                throw new Error('Network response was not ok: ' + response.statusText);
            }
            return response.json();
        })
        .then(data => {
            console.log('Data received:', data);
            if (data.error) {
                console.error(data.error);
                alert(data.error);
                return;
            }
            document.getElementById("institusi").value = data.institusi || '';
            document.getElementById("jurusan").value = data.jurusan || '';
            document.getElementById("awal").value = data.awal || '';
            document.getElementById("akhir").value = data.akhir || '';
            document.getElementById("jumlah").value = data.jumlah || '';
        })
        .catch(error => {
            console.error('Fetch error:', error);
            alert('Fetch error: ' + error.message); // Menampilkan pesan error
        });
    }
}
</script>