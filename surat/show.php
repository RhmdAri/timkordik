<div class="page-heading">
    <h1 class="page-title">Halaman Surat</h1>
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
            <h4 class="ibox-title">Data Surat</h4>
            <hr>
            <div class="mb-3">
                <a href="?page=suratAdd" class="btn btn-outline-success">Tambah</a>
            </div>

            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" id="example-table" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>No Surat</th>
                        <th>Tujuan</th>
                        <th>Perihal</th>
                        <th>Mahasiswa</th> 
                        <th>File Surat Balasan</th>
                        <th>File Surat Tagihan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                    <tbody>
                    <?php
                        include '../connection.php';

                        // Query untuk mengambil data dari tabel surat, pengajuan, dan user
                        $result = mysqli_query($con, "
                            SELECT surat.*, 
                            pengajuan.no AS no_pengajuan, 
                            pengajuan.dari, 
                            pengajuan.perihal, 
                            user.username 
                        FROM surat
                        LEFT JOIN pengajuan ON surat.pengajuan_id = pengajuan.id
                        LEFT JOIN user ON surat.user_id = user.id;
                        ");

                        if (!$result) {
                            die("Query gagal: " . mysqli_error($con));
                        }

                        if (mysqli_num_rows($result) > 0) {
                            while ($data = mysqli_fetch_array($result)) {
                        ?>
                        <tr>
                            <td><?php echo $data['no_pengajuan']; ?></td>
                            <td><?php echo $data['dari']; ?></td>
                            <td><?php echo $data['perihal']; ?></td>
                            <td><?php echo $data['username']; ?></td>
                            <td><?php echo $data['balasan'] ? '<a href="../uploads/' . $data['balasan'] . '" target="_blank">Lihat File</a>' : 'Tidak Ada File'; ?></td>
                            <td><?php echo $data['tagihan'] ? '<a href="../uploads/' . $data['tagihan'] . '" target="_blank">Lihat File</a>' : 'Tidak Ada File'; ?></td>
                            <td>
                                <a data-toggle="tooltip" data-placement="top" title="Edit Data" class="btn btn-outline-success btn-sm" href="?page=suratEdit&id=<?php echo $data['id']; ?>">
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
                            echo "<tr><td colspan='7'>Tidak ada data yang ditemukan.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function confirmDelete(id) {
        // Menampilkan notifikasi konfirmasi menggunakan SweetAlert
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
                // Jika konfirmasi, arahkan ke halaman penghapusan
                window.location.href = '?page=suratDelete&id=' + id;
            }
        });
    }
</script>