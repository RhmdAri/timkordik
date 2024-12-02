<?php
if (isset($_POST['submit'])) {
    $pengajuan_id = $_POST['pengajuan_id'];
    $institusi    = $_POST['institusi'];
    $jurusan      = $_POST['jurusan'];
    $awal         = $_POST['awal'];
    $akhir        = $_POST['akhir'];
    $jumlah       = $_POST['jumlah'];

    $query = "INSERT INTO pelaksanaan (pengajuan_id, institusi, jurusan, awal, akhir, jumlah)
              VALUES ('$pengajuan_id', '$institusi', '$jurusan', '$awal', '$akhir', '$jumlah')";

    if (mysqli_query($con, $query)) {
        echo "<script>window.location.href = '?page=pelaksanaan';</script>";
        exit();
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
?>

<div class="ibox mt-4">
    <div class="ibox-head">
        <div class="ibox-title">Tambah Data Pelaksanaan</div>
    </div>
    <div class="ibox-body">
        <form class="form-horizontal" id="form-pelaksanaan" method="post">
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Pilih Pengajuan</label>
                <div class="col-sm-10">
                    <select class="form-control" id="pengajuan" name="pengajuan_id" onchange="isiOtomatis()">
                        <option value="">Pilih Pengajuan</option>
                        <?php
                        // Mengambil data dari tabel pengajuan dan pks, serta menggabungkannya dengan tabel pembimbing untuk mengambil jurusan
                        $query_pengajuan = mysqli_query($con, "
                            SELECT p.id, p.no, k.institusi, pb.jurusan 
                            FROM pengajuan p 
                            JOIN pks k ON p.idPks = k.id
                            JOIN pembimbing pb ON p.pembimbing_id = pb.id");

                        while ($data_pengajuan = mysqli_fetch_array($query_pengajuan)) {
                            echo "<option value='".$data_pengajuan['id']."'>".$data_pengajuan['no']." | ".$data_pengajuan['institusi']." | ".$data_pengajuan['jurusan']."</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Institusi Pendidikan</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="institusi" id="institusi" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Jurusan/Prodi</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="jurusan" id="jurusan" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Periode Praktik</label>
                <div class="col-sm-10">
                    <div class="input-daterange input-group" id="datepicker">
                        <input class="input-sm form-control" type="text" name="awal" id="awal" readonly>
                        <span class="input-group-addon p-l-10 p-r-10">to</span>
                        <input class="input-sm form-control" type="text" name="akhir" id="akhir" readonly>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Jumlah Peserta</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="jumlah" id="jumlah" readonly>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-10 ml-sm-auto">
                    <button name="submit" class="btn btn-info" type="submit">Submit</button>
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
        fetch('../pelaksanaan/getDataPengajuan.php?id=' + pengajuan_id)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.error) {
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
            alert('Fetch error: ' + error.message);
        });
    }
}
</script>
