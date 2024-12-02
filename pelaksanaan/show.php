<div class="page-heading">
    <h1 class="page-title">Halaman Pelaksanaan & Presentasi</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="index.html"><i class="la la-home font-20"></i></a>
        </li>
    </ol>
</div>

<div class="page-content fade-in-up">
    <div class="ibox">
        <div class="ibox-body">
            <!-- Judul Data Table -->
            <h4 class="ibox-title">Data Pelaksanaan</h4>
            <hr>
            <div class="mb-3">
                <a href="?page=pelaksanaanAdd" class="btn btn-outline-success">Tambah</a>
            </div>

            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" id="example-table" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>No Pengajuan</th>
                            <th>Institusi</th>
                            <th>Jurusan/Prodi</th>
                            <th>Awal Mulai</th>
                            <th>Berakhir</th>
                            <th>Jumlah Peserta</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        include '../connection.php';

                        // Mendapatkan tanggal saat ini dalam format Y-m-d
                        $today = date('Y-m-d');

                        // Query untuk mengambil data dari tabel pelaksanaan, pengajuan, pembimbing, dan pks
                        $result = mysqli_query($con, "
                            SELECT 
                                pelaksanaan.id, 
                                pengajuan.no AS no_pengajuan, 
                                pembimbing.jurusan,  -- Mengambil jurusan dari tabel pembimbing
                                pengajuan.awal AS awal, 
                                pengajuan.akhir AS akhir, 
                                pengajuan.jumlah AS jumlah_peserta,
                                pks.institusi,
                                pelaksanaan.status,
                                pengajuan.pembimbing_id
                            FROM 
                                pelaksanaan
                            JOIN 
                                pengajuan ON pelaksanaan.pengajuan_id = pengajuan.id
                            JOIN 
                                pks ON pengajuan.idPks = pks.id
                            JOIN 
                                pembimbing ON pengajuan.pembimbing_id = pembimbing.id
                        ");

                        if (mysqli_num_rows($result) > 0) {
                            while ($data = mysqli_fetch_array($result)) {
                                // Konversi tanggal akhir ke format Y-m-d untuk memastikan konsistensi format
                                $akhir = date('Y-m-d', strtotime($data['akhir']));
                                $status = $data['status'];
                                $pembimbing_id = $data['pembimbing_id'];
                                $jumlah_peserta = $data['jumlah_peserta'];

                                // Cek apakah tanggal hari ini telah melewati tanggal akhir dan status belum selesai
                                if ($today > $akhir && $status != 1) {
                                    // Update status menjadi selesai
                                    mysqli_query($con, "UPDATE pelaksanaan SET status = 1 WHERE id = '" . $data['id'] . "'");

                                    // Ambil kuota pembimbing
                                    $queryPembimbing = mysqli_query($con, "SELECT kuota FROM pembimbing WHERE id = '$pembimbing_id'");
                                    $dataPembimbing = mysqli_fetch_assoc($queryPembimbing);

                                    if ($dataPembimbing) {
                                        // Menambahkan kuota pembimbing
                                        $kuotaLama = $dataPembimbing['kuota'];
                                        $newKuota = $kuotaLama + $jumlah_peserta;

                                        // Update kuota pembimbing
                                        mysqli_query($con, "UPDATE pembimbing SET kuota = '$newKuota' WHERE id = '$pembimbing_id'");
                                    }
                                }

                                // Tentukan status tampil berdasarkan nilai status
                                $statusTampil = $status == 1 ? 'Selesai' : 'Sedang Berlangsung';
                        ?>
                                <tr class="pelaksanaan-row" data-akhir="<?php echo $akhir; ?>">
                                    <td><?php echo $data['no_pengajuan']; ?></td>
                                    <td><?php echo $data['institusi']; ?></td>
                                    <td><?php echo $data['jurusan']; ?></td>
                                    <td><?php echo date('Y-m-d', strtotime($data['awal'])); ?></td>
                                    <td class="tanggal-berakhir"><?php echo date('Y-m-d', strtotime($akhir)); ?></td>
                                    <td><?php echo $data['jumlah_peserta']; ?></td>
                                    <td><?php echo $statusTampil; ?></td>
                                    <td>
                                        <a data-toggle="tooltip" data-placement="top" title="Edit Data" class="btn btn-outline-success btn-sm" href="?page=pelaksanaanEdit&id=<?php echo $data['id']; ?>">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <a data-toggle="tooltip" data-placement="top" title="Hapus Data" class="btn btn-outline-danger btn-sm" href="#" onclick="confirmDelete(<?php echo $data['id']; ?>)">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                        <?php
                            }
                        } else {
                            echo "<tr><td colspan='8'>Tidak ada data yang ditemukan.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
   document.addEventListener("DOMContentLoaded", function () {
    var rows = document.querySelectorAll(".pelaksanaan-row");
    var today = new Date();
    today.setHours(0, 0, 0, 0); // Set waktu ke tengah malam untuk perbandingan
    var notifiedRows = []; // Untuk mencegah notifikasi ulang

    rows.forEach(function (row) {
        var akhirDateString = row.getAttribute("data-akhir");
        if (!akhirDateString) return; // Lewati jika atribut tidak ditemukan

        var akhirDate = new Date(akhirDateString);
        var timeDiff = akhirDate - today;
        var dayDiff = timeDiff / (1000 * 3600 * 24); // Konversi ke hari

        if (dayDiff <= 3 && dayDiff >= 0 && !notifiedRows.includes(akhirDateString)) {
            // Tambahkan ke daftar yang sudah diproses
            notifiedRows.push(akhirDateString);

            // Tambahkan kelas peringatan
            row.classList.add("warning-row");

            // Tampilkan notifikasi
            Swal.fire({
                icon: "warning",
                title: "PKL Akan Segera Berakhir!",
                text: "PKL ini akan berakhir pada " + akhirDate.toLocaleDateString(),
                showConfirmButton: false,
                timer: 3000,
            });
        }

        // Tambahkan logika untuk memeriksa status yang sudah selesai
        if (timeDiff < 0) {
            row.classList.remove("warning-row"); // Hapus peringatan jika sudah lewat
        }
    });
});

</script>

<style>
    .warning-row {
        background-color: #f8d7da !important;
    }
</style>
