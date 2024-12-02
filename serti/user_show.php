<?php
session_start(); // Pastikan session sudah dimulai
include '../connection.php';

// Cek apakah session user_id sudah ada
if (!isset($_SESSION['user_id'])) {
    // Jika tidak ada session user_id, redirect ke halaman login
    header('Location: login.php');
    exit();
}

// Ambil user_id dan level dari session
$user_id = $_SESSION['user_id'];
$user_level = $_SESSION['user_level']; // Pastikan session level user diambil dari session yang benar
?>

<div class="page-heading">
    <h1 class="page-title">Sertifikat Saya</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="index.html"><i class="la la-home font-20"></i></a>
        </li>
        <li class="breadcrumb-item">Sertifikat Saya</li>
    </ol>
</div>

<div class="page-content fade-in-up">
    <div class="ibox">
        <div class="ibox-body">
            <h4 class="ibox-title">Data Sertifikat</h4>
            <hr>

            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" id="example-table" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>No Sertifikat</th>
                            <th>Nama Institusi</th>
                            <th>Jurusan/Prodi</th>
                            <th>Mulai</th>
                            <th>Berakhir</th>
                            <th>File Sertifikat</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Jika user adalah admin, tampilkan semua sertifikat
                        if ($user_level == 'admin') {
                            $query = "
                                SELECT s.no, k.institusi, b.jurusan, u.username, s.awal, s.akhir, s.sertifikat
                                FROM serti s
                                JOIN pengajuan p ON s.pengajuan_id = p.id
                                JOIN pks k ON p.idPks = k.id
                                JOIN user u ON s.user_id = u.id
                                JOIN pembimbing b ON p.pembimbing_id = b.id  -- Mengambil jurusan dari tabel pembimbing
                            ";
                        } else {
                            // Jika user adalah user biasa, tampilkan hanya sertifikat miliknya
                            $query = "
                                SELECT s.no, k.institusi, b.jurusan, s.awal, s.akhir, s.sertifikat
                                FROM serti s
                                JOIN pengajuan p ON s.pengajuan_id = p.id
                                JOIN pks k ON p.idPks = k.id
                                JOIN pembimbing b ON p.pembimbing_id = b.id
                                WHERE s.user_id = ?  -- Menggunakan parameter untuk menghindari SQL Injection
                            ";
                        }

                        // Menjalankan query dengan prepared statement untuk keamanan
                        if ($stmt = mysqli_prepare($con, $query)) {
                            // Jika user adalah user biasa, bind parameter user_id
                            if ($user_level != 'admin') {
                                mysqli_stmt_bind_param($stmt, "i", $user_id);
                            }

                            // Menjalankan query
                            mysqli_stmt_execute($stmt);
                            $result = mysqli_stmt_get_result($stmt);

                            if (mysqli_num_rows($result) > 0) {
                                // Loop untuk menampilkan data dalam tabel
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo '<tr>';
                                    echo '<td>' . $row['no'] . '</td>';
                                    echo '<td>' . $row['institusi'] . '</td>';
                                    echo '<td>' . $row['jurusan'] . '</td>';
                                    echo '<td>' . $row['awal'] . '</td>';
                                    echo '<td>' . $row['akhir'] . '</td>';
                                    echo '<td><a href="../sertif/' . $row['sertifikat'] . '" target="_blank">Lihat Sertifikat</a></td>';
                                    echo '</tr>';
                                }
                            } else {
                                echo '<tr><td colspan="6">Tidak ada data sertifikat yang ditemukan.</td></tr>';
                            }

                            // Menutup prepared statement
                            mysqli_stmt_close($stmt);
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
