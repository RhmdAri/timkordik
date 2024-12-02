<?php
include "../connection.php"; // Memasukkan koneksi database

session_start(); // Memastikan session dimulai
$user_id = $_SESSION['user_id']; // Ambil user_id dari session

if (isset($_POST['submit'])) {
    // Mengambil data dari form
    $no             = $_POST['no'] ?? '';
    $dari           = $_POST['dari'] ?? '';
    $perihal        = $_POST['perihal'] ?? '';
    $kegiatan       = $_POST['kegiatan'] ?? '';
    $pembimbing_id  = $_POST['pembimbing_id'] ?? '';
    $awal           = $_POST['awal'] ?? '';
    $akhir          = $_POST['akhir'] ?? '';
    $jumlah         = $_POST['jumlah'] ?? '';
    $idPks          = $_POST['idPks'] ?? ''; // Mengambil idPks dari form

    // Ambil kuota pembimbing dan jurusan dari database
    $queryKuota = mysqli_query($con, "SELECT kuota, jurusan FROM pembimbing WHERE id = '$pembimbing_id'");
    $dataKuota = mysqli_fetch_assoc($queryKuota);
    $kuota = $dataKuota['kuota'];
    $jurusan = $dataKuota['jurusan'];

    // Ambil institusi dari tabel pks berdasarkan idPks
    $queryInstitusi = mysqli_query($con, "SELECT institusi FROM pks WHERE id = '$idPks'");
    $dataInstitusi = mysqli_fetch_assoc($queryInstitusi);
    $institusi = $dataInstitusi['institusi'];

    if ($jumlah > $kuota) {
        echo "<script>alert('Jumlah mahasiswa melebihi kuota pembimbing.');</script>";
    } else {
        // Kurangi kuota pembimbing dengan jumlah mahasiswa yang diajukan
        $newKuota = $kuota - $jumlah;
        mysqli_query($con, "UPDATE pembimbing SET kuota = '$newKuota' WHERE id = '$pembimbing_id'");

        // Query untuk memasukkan data ke dalam tabel pengajuan 
        $result = mysqli_query($con, "INSERT INTO pengajuan(no, dari, perihal, kegiatan, pembimbing_id, jurusan, idPks, awal, akhir, jumlah, user_id) 
            VALUES('$no', '$dari', '$perihal', '$kegiatan', '$pembimbing_id', '$jurusan', '$idPks', '$awal', '$akhir', '$jumlah', '$user_id')");

        if ($result) {
            // Ambil ID terakhir yang dimasukkan ke tabel pengajuan
            $pengajuan_id = mysqli_insert_id($con);
            
            // Menambahkan entri di tabel surat
            $result_surat = mysqli_query($con, "INSERT INTO surat(pengajuan_id, balasan, tagihan) VALUES('$pengajuan_id', '', '')");

            // Menambahkan entri di tabel pertemuan
            $result_pertemuan = mysqli_query($con, "INSERT INTO pertemuan(idPks, jurusan, hari, waktu, tempat, agenda, pengajuan_id) VALUES('$idPks', '$jurusan', '', '', '', '', '$pengajuan_id')");

            if (!$result_surat) {
                echo "<script>alert('Data surat gagal disimpan: " . mysqli_error($con) . "');</script>";
            }

            if (!$result_pertemuan) {
                echo "<script>alert('Data pertemuan gagal disimpan: " . mysqli_error($con) . "');</script>";
            }

            // Redirect ke halaman untuk menampilkan pengajuan
            echo "<script>window.location.href = '?page=pengajuan';</script>";
        } else {
            echo "<script>alert('Data pengajuan gagal disimpan: " . mysqli_error($con) . "');</script>";
        }
    }
}
?>

<!-- Form untuk menambahkan pengajuan -->
<div class="ibox mt-4">
    <div class="ibox-head">
        <div class="ibox-title">Tambah Data Pengajuan</div>
    </div>
    <div class="ibox-body">
        <form class="form-horizontal" method="post">
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">No Surat Masuk</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="no">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Dari</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="dari">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Perihal</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="perihal">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Kegiatan</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="kegiatan">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Pembimbing</label>
                <div class="col-sm-10">
                    <select name="pembimbing_id" id="pembimbingSelect" class="form-control select2" onchange="updateQuotaAndJurusan()">
                        <option value="" selected>- Pilih Pembimbing -</option>
                        <?php
                        // Query untuk mengambil data pembimbing
                        $query = mysqli_query($con, "SELECT id, pembimbing, jurusan, kuota FROM pembimbing");
                        while ($data = mysqli_fetch_array($query)) {
                            // Format yang ditampilkan di dropdown
                            $label = $data['pembimbing'] . " | " . $data['jurusan'] . " | Sisa Kuota: " . $data['kuota'];
                        ?>
                            <option value="<?php echo $data['id']; ?>" data-kuota="<?php echo $data['kuota']; ?>" data-jurusan="<?php echo $data['jurusan']; ?>">
                                <?php echo $label; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Institusi Pendidikan</label>
                <div class="col-sm-10">
                <select name="idPks" id="institusiSelect" class="form-control select2">
                    <option value="" selected>- Pilih Institusi -</option>
                    <?php
                    $queryInstitusi = mysqli_query($con, "SELECT id, institusi FROM pks");
                    while ($data = mysqli_fetch_array($queryInstitusi)) {
                    ?>
                    <option value="<?php echo $data['id']; ?>">
                        <?php echo $data['institusi']; ?>
                    </option>
                    <?php } ?>
                </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Jurusan</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="jurusan" id="jurusanField" readonly>
                </div>
            </div>
            <div class="form-group row" id="date_5">
                <label class="col-sm-2 col-form-label">Periode Kegiatan</label>
                <div class="col-sm-10">
                    <div class="input-daterange input-group" id="datepicker">
                        <input class="input-sm form-control" type="text" name="awal" placeholder="YYYY-MM-DD">
                        <span class="input-group-addon p-l-10 p-r-10">to</span>
                        <input class="input-sm form-control" type="text" name="akhir" placeholder="YYYY-MM-DD">
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Jumlah Mahasiswa</label>
                <div class="col-sm-10">
                    <input class="form-control" type="number" name="jumlah" id="jumlah" placeholder="Masukkan jumlah mahasiswa" oninput="validateQuota()">
                    <div id="quotaMessage" style="color: red; display: none; font-size: 12px;">Kuota tidak mencukupi!</div>
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

<script>
    function updateQuotaAndJurusan() {
    const pembimbingSelect = document.getElementById('pembimbingSelect');
    const selectedOption = pembimbingSelect.options[pembimbingSelect.selectedIndex];
    const kuota = parseInt(selectedOption.getAttribute('data-kuota'));
    const jurusan = selectedOption.getAttribute('data-jurusan');

    // Update jurusan field
    document.getElementById('jurusanField').value = jurusan;

    // Update jumlah mahasiswa field
    const jumlahInput = document.querySelector('input[name="jumlah"]');
    const quotaMessage = document.getElementById('quotaMessage');

    if (kuota > 0) {
        jumlahInput.value = "";
        jumlahInput.placeholder = "Sisa kuota: " + kuota;
        jumlahInput.max = kuota;  // Set batas maksimum input
        jumlahInput.disabled = false;  // Pastikan input bisa diisi

        // Sembunyikan pesan jika kuota tersedia
        quotaMessage.style.display = 'none';
    } else {
        jumlahInput.value = "Pembimbing penuh";
        jumlahInput.disabled = true;  // Nonaktifkan input jika penuh
        quotaMessage.style.display = 'none';
    }
}

function validateQuota() {
    const jumlahInput = document.getElementById('jumlah');
    const pembimbingSelect = document.getElementById('pembimbingSelect');
    const selectedOption = pembimbingSelect.options[pembimbingSelect.selectedIndex];
    const kuota = parseInt(selectedOption.getAttribute('data-kuota'));
    const quotaMessage = document.getElementById('quotaMessage');

    // Jika jumlah lebih besar dari kuota, tampilkan pesan kesalahan
    if (jumlahInput.value > kuota) {
        quotaMessage.style.display = 'block';
    } else {
        quotaMessage.style.display = 'none';
    }
}

</script>
