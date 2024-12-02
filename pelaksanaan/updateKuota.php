<?php
include '../connection.php';

// Memulai transaksi untuk memastikan integritas data
if (!mysqli_begin_transaction($con)) {
    die("Error: Transaction failed to start");
}

try {
    // Query untuk memeriksa pelaksanaan yang sudah benar-benar berakhir (tanggal saat ini melewati tanggal akhir)
    $query = mysqli_query($con, "
        SELECT pelaksanaan.id, pelaksanaan.pengajuan_id, pengajuan.jumlah, pengajuan.pembimbing_id 
        FROM pelaksanaan 
        JOIN pengajuan ON pelaksanaan.pengajuan_id = pengajuan.id 
        WHERE pelaksanaan.status = 0 AND CURDATE() > pengajuan.akhir
    ");

    // Pastikan ada hasil dari query
    if (mysqli_num_rows($query) > 0) {
        while ($data = mysqli_fetch_assoc($query)) {
            $pelaksanaan_id = $data['id'];
            $jumlah_peserta = $data['jumlah'];
            $pembimbing_id = $data['pembimbing_id'];

            // Ambil kuota pembimbing yang ada
            $stmtPembimbing = $con->prepare("SELECT kuota FROM pembimbing WHERE id = ?");
            $stmtPembimbing->bind_param("i", $pembimbing_id);
            $stmtPembimbing->execute();
            $resultPembimbing = $stmtPembimbing->get_result();
            $dataPembimbing = $resultPembimbing->fetch_assoc();

            if ($dataPembimbing) {
                $kuotaLama = $dataPembimbing['kuota'];

                // Tambahkan kuota pembimbing dengan jumlah peserta
                $newKuota = $kuotaLama + $jumlah_peserta;

                // Update kuota pembimbing
                $stmtUpdateKuota = $con->prepare("UPDATE pembimbing SET kuota = ? WHERE id = ?");
                $stmtUpdateKuota->bind_param("ii", $newKuota, $pembimbing_id);
                $stmtUpdateKuota->execute();

                // Update status pelaksanaan menjadi selesai (status = 1)
                $stmtUpdateStatus = $con->prepare("UPDATE pelaksanaan SET status = 1 WHERE id = ?");
                $stmtUpdateStatus->bind_param("i", $pelaksanaan_id);
                $stmtUpdateStatus->execute();
            } else {
                // Pembimbing tidak ditemukan
                throw new Exception("Pembimbing tidak ditemukan untuk ID: $pembimbing_id");
            }
        }

        // Commit transaksi jika semua query berhasil
        if (!mysqli_commit($con)) {
            throw new Exception("Error: Commit transaction failed");
        }

        echo "<script>alert('Kuota pembimbing otomatis diperbarui!'); window.location.href='?page=pelaksanaan';</script>";
    } else {
        echo "<script>alert('Tidak ada pelaksanaan yang berakhir.'); window.location.href='?page=pelaksanaan';</script>";
    }
} catch (Exception $e) {
    // Jika terjadi kesalahan, rollback transaksi
    mysqli_rollback($con);
    echo "<script>alert('Terjadi kesalahan: " . $e->getMessage() . "'); window.location.href='?page=pelaksanaan';</script>";
}
?>
