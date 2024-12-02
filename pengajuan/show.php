<div class="page-heading">
    <h1 class="page-title">Halaman Pengajuan</h1>
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
            <h4 class="ibox-title">Data Pengajuan</h4>
            <hr>
            <div class="mb-3">
                <a href="?page=pengajuanAdd" class="btn btn-outline-success">Tambah</a>
            </div>

            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" id="example-table" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>No Surat Masuk</th>
                            <th>Dari</th>
                            <th>Perihal</th>
                            <th>Kegiatan</th>
                            <th>Jurusan / Prodi</th>
                            <th>Institusi Pendidikan</th>
                            <th>Pembimbing</th>
                            <th>Awal Mulai</th>
                            <th>Berakhir</th>
                            <th>Jumlah Mahasiswa</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="table-body">
                        <?php
                        // Query untuk mengambil semua data dari tabel pengajuan dengan inner join ke pks dan pembimbing
                        $result = mysqli_query($con,
                        "SELECT 
                            pengajuan.id, pengajuan.no, pengajuan.dari, pengajuan.perihal, pengajuan.kegiatan, pengajuan.awal, pengajuan.akhir, pengajuan.jumlah,
                            pks.institusi as namaInstitusi,
                            pembimbing.jurusan as jurusan,
                            pembimbing.pembimbing as namaPembimbing
                        FROM pengajuan
                        INNER JOIN pks ON pengajuan.idPks = pks.id
                        INNER JOIN pembimbing ON pengajuan.pembimbing_id = pembimbing.id
                        ORDER BY pks.institusi ASC");

                        // Tampilkan hasil query dalam tabel
                        while ($data = mysqli_fetch_array($result)) {
                        ?>
                        <tr>
                            <td><?php echo $data['no']; ?></td>
                            <td><?php echo $data['dari']; ?></td>
                            <td><?php echo $data['perihal']; ?></td>
                            <td><?php echo $data['kegiatan']; ?></td>
                            <td><?php echo $data['jurusan']; ?></td>
                            <td><?php echo $data['namaInstitusi']; ?></td>
                            <td><?php echo $data['namaPembimbing']; ?></td>
                            <td><?php echo date("Y-m-d", strtotime($data['awal'])); ?></td>
                            <td><?php echo date("Y-m-d", strtotime($data['akhir'])); ?></td>
                            <td><?php echo $data['jumlah']; ?></td>
                            <td>
                                <a data-toggle="tooltip" data-placement="top" title="Edit Data" class="btn waves-effect waves-dark btn-success btn-outline-success btn-sm" href="?page=pengajuanEdit&id=<?php echo $data['id']; ?>">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <a data-toggle="tooltip" data-placement="top" title="Hapus Data" class="btn waves-effect waves-dark btn-danger btn-outline-danger btn-sm" href="#" onclick="confirmDelete(<?php echo $data['id']; ?>)">
                                    <i class="fa fa-trash"></i>
                                </a>

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
                                                window.location.href = '?page=pengajuanDelete&id=' + id;
                                            }
                                        });
                                    }
                                </script>
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
