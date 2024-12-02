<div class="page-heading">
    <h1 class="page-title">Halaman Pertemuan</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="index.html"><i class="la la-home font-20"></i></a>
        </li>
    </ol>
</div>
<div class="page-content fade-in-up">
    <div class="ibox">
        <div class="ibox-body">
            <h4 class="ibox-title">Data Pertemuan</h4>
            <hr>


            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" id="example-table" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Institusi Pendidikan</th> 
                            <th>Jurusan</th> 
                            <th>Hari</th>
                            <th>Waktu</th>
                            <th>Tempat Kegiatan / Link Zoom Meeting</th>
                            <th>Agenda</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        // Query untuk mengambil semua data dari tabel pertemuan
                        $result = mysqli_query($con, "
                            SELECT p.*, pk.institusi, pb.jurusan 
                            FROM pertemuan p 
                            JOIN pengajuan pg ON p.pengajuan_id = pg.id
                            JOIN pks pk ON pg.idPks = pk.id
                            JOIN pembimbing pb ON pg.pembimbing_id = pb.id
                        ");

                        // Tampilkan hasil query dalam tabel
                        while ($data = mysqli_fetch_array($result)) {
                        ?>
                        <tr>
                            <td><?php echo $data['institusi']; ?></td>
                            <td><?php echo $data['jurusan']; ?></td>  
                            <td><?php echo $data['hari']; ?></td>
                            <td><?php echo date('h:i A', strtotime($data['waktu'])); ?></td>
                            <td><?php echo $data['tempat']; ?></td>
                            <td><?php echo $data['agenda']; ?></td>
                            <td>
                                <a data-toggle="tooltip" data-placement="top" title="Edit Data" class="btn waves-effect waves-dark btn-success btn-outline-success btn-sm" href="?page=pertemuanEdit&id=<?php echo $data['id']; ?>">
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
                window.location.href = '?page=pertemuanDelete&id=' + id;
            }
        });
    }
</script>
