<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<?php
$id = $_GET['id'];

// Query untuk menghapus data dari database
$result = mysqli_query($con, "DELETE FROM parkir WHERE id=$id");

if ($result) {
    // Jika penghapusan berhasil, tampilkan notifikasi dengan SweetAlert
    echo "
    <script>
        $(document).ready(function() {
            // Nonaktifkan Select2 sebelum menampilkan SweetAlert
            $('select').prop('disabled', true); 
            Swal.fire({
                title: 'Berhasil!',
                text: 'Data parkir berhasil dihapus.',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '?page=parkir'; // Arahkan kembali ke halaman daftar parkir
                }
            }).finally(function() {
                // Aktifkan kembali Select2 setelah SweetAlert ditutup
                $('select').prop('disabled', false); 
            });
        });
    </script>
    ";
} else {
    // Jika ada kesalahan saat menghapus data
    echo "
    <script>
        $(document).ready(function() {
            // Nonaktifkan Select2 sebelum menampilkan SweetAlert
            $('select').prop('disabled', true); 
            Swal.fire({
                title: 'Gagal!',
                text: 'Terjadi kesalahan saat menghapus data.',
                icon: 'error',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '?page=parkir'; // Arahkan kembali ke halaman daftar parkir
                }
            }).finally(function() {
                // Aktifkan kembali Select2 setelah SweetAlert ditutup
                $('select').prop('disabled', false); 
            });
        });
    </script>
    ";
}
?>
