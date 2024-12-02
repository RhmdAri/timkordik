<div class="page-heading">
    <h1 class="page-title">Halaman pembimbing</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="index.html"><i class="la la-home font-20"></i></a>
        </li>
    </ol>
</div>

<div class="page-content fade-in-up">
    <div class="ibox">
        <div class="ibox-body">
            <h4 class="ibox-title">Data Pembimbing</h4>
            <hr>
            <div class="mb-3">
                <a href="?page=pembimbingAdd" class="btn btn-outline-success">Tambah</a>
            </div>

            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" id="example-table" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Jurusan</th>
                            <th>Pembimbing</th>
                            <th>Kuota</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="table-body">
                        <?php
                        // Query untuk mengambil semua data dari tabel pembimbing
                        $result = mysqli_query($con, "SELECT * FROM pembimbing");

                        // Tampilkan hasil query dalam tabel
                        while ($data = mysqli_fetch_array($result)) {
                            // Ambil tanggal berakhir
                            $tanggalBerakhir = $data['berakhir'];
                        ?>
                        <tr class="pembimbing-row" data-berakhir="<?php echo $tanggalBerakhir; ?>">
                            <td><?php echo htmlspecialchars($data['jurusan']); ?></td>
                            <td><?php echo htmlspecialchars($data['pembimbing']); ?></td>
                            <td><?php echo htmlspecialchars($data['kuota']); ?></td>
                            <td>
                                <a data-toggle="tooltip" data-placement="top" title="Edit Data" class="btn waves-effect waves-dark btn-success btn-outline-success btn-sm" href="?page=pembimbingEdit&id=<?php echo $data['id']; ?>">
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
<script>
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
                window.location.href = '?page=pembimbingDelete&id=' + id;
            }
        });
    }
</script>