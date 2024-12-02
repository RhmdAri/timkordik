<div class="page-heading">
    <h1 class="page-title">Halaman PKS</h1>
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
            <h4 class="ibox-title"><?php echo $title ?></h4>
            <hr>
            <div class="mb-3">
                <a href="?page=pksAdd" class="btn btn-outline-success">Tambah</a>
            </div>

            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" id="example-table" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Institusi Pendidikan</th>
                            <th>Fakultas/Prodi</th>
                            <th>Perihal</th>
                            <th>Periode Kerjasama</th>
                            <th>Mulai</th>
                            <th>Berakhir</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="table-body">
                        <?php
                        // Query untuk mengambil semua data dari tabel pks
                        $result = mysqli_query($con, "SELECT * FROM pks");

                        // Tampilkan hasil query dalam tabel
                        while ($data = mysqli_fetch_array($result)) {
                            // Ambil tanggal berakhir
                            $tanggalBerakhir = $data['berakhir'];
                        ?>
                        <tr class="pks-row" data-berakhir="<?php echo $tanggalBerakhir; ?>">
                            <td><?php echo htmlspecialchars($data['institusi']); ?></td>
                            <td><?php echo htmlspecialchars($data['fakultas']); ?></td>
                            <td><?php echo htmlspecialchars($data['perihal']); ?></td>
                            <td><?php echo htmlspecialchars($data['periode']); ?></td>
                            <td><?php echo date("Y-m-d", strtotime($data['mulai'])); ?></td>
                            <td class="tanggal-berakhir"><?php echo date("Y-m-d", strtotime($tanggalBerakhir)); ?></td>
                            <td>
                                <a data-toggle="tooltip" data-placement="top" title="Edit Data" class="btn waves-effect waves-dark btn-success btn-outline-success btn-sm" href="?page=pksEdit&id=<?php echo $data['id']; ?>">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <a data-toggle="tooltip" data-placement="top" title="Hapus Data" class="btn waves-effect waves-dark btn-danger btn-outline-danger btn-sm" href="#" onclick="confirmDelete(<?php echo $data['id']; ?>)">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    // Fungsi konfirmasi penghapusan
    function confirmDelete(id) {
        Swal.fire({
            title: 'Anda yakin?',
            text: 'Data ini akan dihapus dan tidak dapat dipulihkan!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '?page=pksDelete&id=' + id;
            }
        });
    }

    // Menambahkan notifikasi jika tanggal berakhir kurang dari 2 hari lagi
    document.addEventListener("DOMContentLoaded", function() {
        var rows = document.querySelectorAll(".pks-row");

        // Ambil tanggal hari ini
        var today = new Date();
        today.setHours(0, 0, 0, 0); // Set waktu ke tengah malam untuk perbandingan

        rows.forEach(function(row) {
            var akhirDateString = row.getAttribute("data-berakhir");
            var akhirDate = new Date(akhirDateString);

            // Hitung selisih hari
            var timeDiff = akhirDate - today;
            var dayDiff = timeDiff / (1000 * 3600 * 24); // Konversi ke hari

            // Jika tanggal akhir kurang dari atau sama dengan 2 hari
            if (dayDiff <= 2 && dayDiff >= 0) {
                // Tandai baris dengan peringatan
                row.classList.add("warning-row");

                // Tambahkan notifikasi (opsional, dapat menggunakan SweetAlert atau alert)
                Swal.fire({
                    icon: 'warning',
                    title: 'PKS Akan Berakhir!',
                    text: 'PKS ini akan berakhir pada ' + akhirDate.toLocaleDateString(),
                    showConfirmButton: false,
                    timer: 3000
                });
            }
        });
    });
</script>

<style>
    .warning-row {
        background-color: #f8d7da !important;
    }
</style>
