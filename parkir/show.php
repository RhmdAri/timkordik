<div class="page-heading">
    <h1 class="page-title">Halaman Parkir</h1>
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
                <a href="?page=pembimbingAdd" class="btn btn-outline-success">Tambah</a>
            </div>

            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" id="example-table" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Nama Mahasiswa</th>
                            <th>Institusi Pendidikan</th>
                            <th>Awal Praktik</th>
                            <th>Berakhir Praktik</th>
                            <th>Jenis Kendaraan</th>
                            <th>Nomor Polisi Kendaraan</th>
                            <th>Foto STNK</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="table-body">
                        <?php
                        $result = mysqli_query($con, "SELECT * FROM parkir");
                        while ($data = mysqli_fetch_array($result)) {
                        ?>
                        <tr>
                            <td><?php echo $data['nama']; ?></td>
                            <td><?php echo $data['institusi']; ?></td>
                            <td><?php echo date("Y-m-d", strtotime($data['awal'])); ?></td>
                            <td><?php echo date("Y-m-d", strtotime($data['akhir'])); ?></td>
                            <td><?php echo $data['jenis']; ?></td>
                            <td><?php echo $data['nomor']; ?></td>
                            <td><?php echo $data['stnk'] ? '<a href="../stnk/' . $data['stnk'] . '" target="_blank">Lihat File</a>' : 'Tidak Ada File'; ?></td>
                            <td>
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
                window.location.href = '?page=parkirDelete&id=' + id;
            }
        });
    }
</script>