<?php
include "../connection.php";

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = mysqli_real_escape_string($con, $_GET['id']); // Sanitasi input ID

    // Periksa apakah data dengan ID tersebut ada di tabel pengajuan
    $checkQuery = mysqli_query($con, "SELECT * FROM pengajuan WHERE id='$id'");
    if (mysqli_num_rows($checkQuery) == 0) {
        echo "<script>
            alert('Data tidak ditemukan.');
            window.location.href = '?page=pengajuan';
        </script>";
        exit;
    }

    // Hapus data terkait di tabel serti
    $deleteSerti = mysqli_query($con, "DELETE FROM serti WHERE pengajuan_id='$id'");
    if (!$deleteSerti) {
        die("Gagal menghapus data dari tabel serti: " . mysqli_error($con));
    }

    // Hapus data terkait di tabel pelaksanaan
    $deletePelaksanaan = mysqli_query($con, "DELETE FROM pelaksanaan WHERE pengajuan_id='$id'");
    if (!$deletePelaksanaan) {
        die("Gagal menghapus data dari tabel pelaksanaan: " . mysqli_error($con));
    }

    // Hapus data terkait di tabel surat
    $deleteSurat = mysqli_query($con, "DELETE FROM surat WHERE pengajuan_id='$id'");
    if (!$deleteSurat) {
        die("Gagal menghapus data dari tabel surat: " . mysqli_error($con));
    }

    // Hapus data terkait di tabel pertemuan
    $deletePertemuan = mysqli_query($con, "DELETE FROM pertemuan WHERE pengajuan_id='$id'");
    if (!$deletePertemuan) {
        die("Gagal menghapus data dari tabel pertemuan: " . mysqli_error($con));
    }

    // Hapus data dari tabel pengajuan
    $deletePengajuan = mysqli_query($con, "DELETE FROM pengajuan WHERE id='$id'");
    if ($deletePengajuan) {
        echo "
        <head>
            <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css'>
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            <script src='https://code.jquery.com/jquery-3.6.0.min.js'></script>
        </head>
        <script>
            $(document).ready(function() {
                Swal.fire({
                    title: 'Berhasil!',
                    text: 'Data pengajuan dan terkait berhasil dihapus.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '?page=pengajuan';
                    }
                });
            });
        </script>
        ";
    } else {
        die("Gagal menghapus data dari tabel pengajuan: " . mysqli_error($con));
    }
} else {
    echo "<script>
        alert('Parameter ID tidak valid.');
        window.location.href = '?page=pengajuan';
    </script>";
    exit;
}

// Tutup koneksi database
mysqli_close($con);
?>