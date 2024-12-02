<div class="page-heading">
    <h1 class="page-title">Halaman Mahasiswa</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="index.html"><i class="la la-home font-20"></i></a>
        </li>
    </ol>
</div>
<div class="page-content fade-in-up">
    <div class="ibox">
        <div class="ibox-body">
            <h4 class="ibox-title">Data Mahasiswa</h4>
            <hr>
            <table class="table table-striped table-bordered table-hover" id="example-table" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Nama Lengkap Mahasiswa</th>
                        <th>Institusi Pendidikan</th>
                        <th>Prodi/Jurusan</th>
                        <th>Awal Praktik</th>
                        <th>Berakhir Praktik</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="table-body">
                    <?php
                    $result = mysqli_query($con, "SELECT * FROM mhs");
                    while ($data = mysqli_fetch_array($result)) {
                    ?>
                    <tr>
                        <td><?php echo $data['nama']; ?></td>
                        <td><?php echo $data['institusi']; ?></td>
                        <td><?php echo $data['jurusan']; ?></td>
                        <td><?php echo date("Y-m-d", strtotime($data['awal'])); ?></td>
                        <td><?php echo date("Y-m-d", strtotime($data['akhir'])); ?></td>
                        <td>
                            <a data-toggle="tooltip" title="Lihat Detail" 
                            class="btn btn-info btn-sm" 
                            href="javascript:void(0);" 
                            onclick="showDetails(
                                '<?php echo addslashes($data['id']); ?>',
                                '<?php echo addslashes($data['tanggal']); ?>', 
                                '<?php echo addslashes($data['nama']); ?>', 
                                '<?php echo addslashes($data['jekel']); ?>', 
                                '<?php echo addslashes($data['tlahir']); ?>', 
                                '<?php echo addslashes($data['tgllahir']); ?>', 
                                '<?php echo addslashes($data['agama']); ?>', 
                                '<?php echo addslashes($data['status']); ?>', 
                                '<?php echo addslashes($data['negara']); ?>', 
                                '<?php echo addslashes($data['alamat']); ?>', 
                                '<?php echo addslashes($data['telp']); ?>', 
                                '<?php echo addslashes($data['email']); ?>', 
                                '<?php echo addslashes($data['darah']); ?>', 
                                '<?php echo addslashes($data['institusi']); ?>', 
                                '<?php echo addslashes($data['jenjang']); ?>', 
                                '<?php echo addslashes($data['jurusan']); ?>', 
                                '<?php echo addslashes($data['semester']); ?>', 
                                '<?php echo addslashes($data['nim']); ?>', 
                                '<?php echo addslashes($data['orientasi']); ?>', 
                                '<?php echo addslashes($data['awal']); ?>', 
                                '<?php echo addslashes($data['akhir']); ?>', 
                                '<?php echo addslashes($data['hubungan']); ?>', 
                                '<?php echo addslashes($data['namaWali']); ?>', 
                                '<?php echo addslashes($data['jekelWali']); ?>', 
                                '<?php echo addslashes($data['umur']); ?>', 
                                '<?php echo addslashes($data['alamatWali']); ?>', 
                                '<?php echo addslashes($data['pendidikan']); ?>', 
                                '<?php echo addslashes($data['pekerjaan']); ?>', 
                                '<?php echo addslashes($data['telpWali']); ?>', 
                                '<?php echo addslashes($data['foto']); ?>', 
                                '<?php echo addslashes($data['tertib']); ?>', 
                                '<?php echo addslashes($data['persetujuan']); ?>', 
                                '<?php echo addslashes($data['surhat']); ?>'
                            )">
                            <i class="fa fa-eye"></i> Show
                            </a>
                            <a data-toggle="tooltip" title="Lihat Laporan" 
                            class="btn btn-primary btn-sm" 
                            href="?page=report&id=<?php echo $data['id']; ?>">
                                <i class="fa fa-file"></i> Detail
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
                window.location.href = '?page=kategoriDelete&id=' + id;
            }
        });
    }
</script>