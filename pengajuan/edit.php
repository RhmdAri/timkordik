<?php
include "../connection.php"; // Pastikan koneksi sudah benar

$id = $_GET['id'];
if (!$id) {
    die("ID pengajuan tidak ditemukan.");
}

// Ambil data dari tabel pengajuan berdasarkan ID
$result = mysqli_query($con, "SELECT * FROM pengajuan WHERE id=$id");

// Cek apakah data pengajuan ditemukan
if (!$result || mysqli_num_rows($result) == 0) {
    die("Data pengajuan tidak ditemukan.");
}

$data = mysqli_fetch_assoc($result);
$no            = $data['no'];
$dari          = $data['dari'];
$perihal       = $data['perihal'];
$kegiatan      = $data['kegiatan'];
$jurusan       = $data['jurusan'];
$idPksTerpilih = $data['idPks'];
$pembimbingTerpilih = $data['pembimbing_id'];
$awal          = $data['awal'];
$akhir         = $data['akhir'];
$jumlah        = $data['jumlah'];

$errorMessage = ""; // Variabel untuk pesan error

// Cek apakah form telah disubmit
if (isset($_POST['submit'])) {
    $no            = $_POST['no'];
    $dari          = $_POST['dari'];
    $perihal       = $_POST['perihal'];
    $kegiatan      = $_POST['kegiatan'];
    $jurusan       = $_POST['jurusan'];
    $idPksTerpilih = $_POST['namaInstitusi'];
    $pembimbingTerpilih = $_POST['pembimbing_id'];
    $awal          = $_POST['awal'];
    $akhir         = $_POST['akhir'];
    $jumlahBaru    = $_POST['jumlah'];

    // Cek kuota pembimbing
    $queryKuota = mysqli_query($con, "SELECT kuota FROM pembimbing WHERE id='$pembimbingTerpilih'");
    $dataKuota = mysqli_fetch_assoc($queryKuota);
    $kuotaTersisa = $dataKuota['kuota'];

    // Hitung selisih jumlah mahasiswa
    $selisih = $jumlahBaru - $jumlah;

    // Validasi jika jumlah melebihi kuota
    if ($selisih > 0 && $selisih > $kuotaTersisa) {
        $errorMessage = "Jumlah mahasiswa yang dimasukkan melebihi kuota yang tersedia (Kuota tersisa: $kuotaTersisa).";
    } else {
        // Update kuota pembimbing
        $updateKuotaQuery = "UPDATE pembimbing SET kuota = kuota - $selisih WHERE id = '$pembimbingTerpilih'";
        $updateKuota = mysqli_query($con, $updateKuotaQuery);
        
        if (!$updateKuota) {
            die("Gagal memperbarui kuota pembimbing: " . mysqli_error($con));
        }

        // Lakukan update data di tabel pengajuan
        $updatePengajuan = mysqli_query($con, "UPDATE pengajuan SET no='$no', dari='$dari', perihal='$perihal', kegiatan='$kegiatan', jurusan='$jurusan', idPks='$idPksTerpilih', pembimbing_id='$pembimbingTerpilih', awal='$awal', akhir='$akhir', jumlah='$jumlahBaru' WHERE id=$id");

        if ($updatePengajuan) {
            echo "<script>window.location.href ='?page=pengajuan';</script>";
        } else {
            die("Error updating pengajuan data: " . mysqli_error($con));
        }
    }
}
?>

<div class="ibox mt-4">
    <div class="ibox-head">
        <div class="ibox-title">Edit Pengajuan</div>
    </div>
    <div class="ibox-body">
        <form class="form-horizontal" method="post">
            <!-- Form fields -->
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">No Surat Masuk</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="no" value="<?php echo $no; ?>">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Dari</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="dari" value="<?php echo $dari; ?>">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Perihal</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="perihal" value="<?php echo $perihal; ?>">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Kegiatan</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="kegiatan" value="<?php echo $kegiatan; ?>">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Pembimbing</label>
                <div class="col-sm-10">
                    <select name="pembimbing_id" id="pembimbingSelect" class="form-control select2">
                        <option value="" selected>- Pilih Pembimbing -</option>
                        <?php
                        $query = mysqli_query($con, "SELECT id, pembimbing, jurusan, kuota FROM pembimbing");
                        while ($data = mysqli_fetch_array($query)) {
                            $selected = ($data['id'] == $pembimbingTerpilih) ? 'selected' : '';
                        ?>
                            <option value="<?php echo $data['id']; ?>" data-kuota="<?php echo $data['kuota']; ?>" data-jurusan="<?php echo $data['jurusan']; ?>" <?php echo $selected; ?>>
                                <?php echo $data['pembimbing'] . " | " . $data['jurusan'] . " | Sisa Kuota: " . $data['kuota']; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Institusi Pendidikan</label>
                <div class="col-sm-10">
                    <select name="namaInstitusi" class="form-control select2">
                        <option value="">- Pilih Institusi -</option>
                        <?php
                        $query = mysqli_query($con, "SELECT id, institusi FROM pks");
                        while ($institusi = mysqli_fetch_assoc($query)) {
                            $selected = ($institusi['id'] == $idPksTerpilih) ? 'selected' : '';
                            echo "<option value=\"{$institusi['id']}\" $selected>{$institusi['institusi']}</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group row" id="date_5">
                <label class="col-sm-2 col-form-label">Periode Kegiatan</label>
                <div class="col-sm-10">
                    <div class="input-daterange input-group" id="datepicker">
                        <input class="input-sm form-control" type="text" name="awal" placeholder="YYYY-MM-DD" value="<?php echo $awal; ?>">
                        <span class="input-group-addon p-l-10 p-r-10">to</span>
                        <input class="input-sm form-control" type="text" name="akhir" placeholder="YYYY-MM-DD" value="<?php echo $akhir; ?>">
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Jumlah Mahasiswa</label>
                <div class="col-sm-10">
                    <input class="form-control <?php echo ($errorMessage ? 'is-invalid' : ''); ?>" type="text" name="jumlah" value="<?php echo $jumlah; ?>">
                    <?php if ($errorMessage) { ?>
                        <div class="invalid-feedback" style="display: block;"><?php echo $errorMessage; ?></div>
                    <?php } ?>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-10 ml-sm-auto">
                    <button name="submit" class="btn btn-info" type="submit">Submit</button>
                    <a href="?page=pengajuan" class="btn btn-danger">Back</a>
                </div>
            </div>
        </form>
    </div>
</div>
