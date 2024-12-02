<div class="page-heading">
    <h1 class="page-title">Halaman Sertifikat</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="index.html"><i class="la la-home font-20"></i></a>
        </li>
    </ol>
</div>

<div class="page-content fade-in-up">
    <div class="ibox">
        <div class="ibox-body">
            <h4 class="ibox-title">Data Sertifikat</h4>
            <hr>
            <div class="mb-3">
                <a href="?page=sertiAdd" class="btn btn-outline-success">Tambah</a>
            </div>

            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" id="example-table" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>No Sertifikat</th>
                            <th>Nama Institusi</th>
                            <th>Jurusan/Prodi</th>
                            <th>Username</th>
                            <th>Mulai</th>
                            <th>Berakhir</th>
                            <th>File Sertifikat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include '../connection.php';

                        // Query untuk mengambil data dari tabel serti, pengajuan, pks, pembimbing, dan user
                        $query = "
                            SELECT s.id, s.no, k.institusi, b.jurusan, u.username, s.awal, s.akhir, s.sertifikat
                            FROM serti s
                            JOIN pengajuan p ON s.pengajuan_id = p.id
                            JOIN pks k ON p.idPks = k.id   -- Join with pks to get 'institusi'
                            JOIN user u ON s.user_id = u.id
                            JOIN pembimbing b ON p.pembimbing_id = b.id  -- Join with pembimbing to get 'jurusan' from pembimbing
                        ";

                        $result = mysqli_query($con, $query);

                        if (mysqli_num_rows($result) > 0) {
                            // Loop untuk menampilkan data dalam tabel
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<tr>';
                                echo '<td>' . $row['no'] . '</td>';
                                echo '<td>' . $row['institusi'] . '</td>';
                                echo '<td>' . $row['jurusan'] . '</td>';  // Menampilkan jurusan dari pembimbing
                                echo '<td>' . $row['username'] . '</td>';
                                echo '<td>' . $row['awal'] . '</td>';
                                echo '<td>' . $row['akhir'] . '</td>';
                                echo '<td><a href="' . $row['sertifikat'] . '" target="_blank">Lihat Sertifikat</a></td>';
                                echo '<td>
                                        <a href="?page=sertiEdit&id=' . $row['id'] . '" class="btn btn-primary btn-sm">Edit</a> 
                                        <button onclick="confirmDelete(' . $row['id'] . ')" class="btn btn-danger btn-sm">Delete</button>
                                    </td>';
                                echo '</tr>';
                            }
                        } else {
                            // If no results are found
                            echo '<tr><td colspan="8">No records found.</td></tr>';
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
                window.location.href = '?page=sertiDelete&id=' + id;
            }
        });
    }
</script>
