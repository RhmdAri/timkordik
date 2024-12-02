<?php
include "../connection.php";

if (isset($_GET['idPks'])) {
    $idPks = $_GET['idPks'];

    // Ambil data institusi berdasarkan idPks
    $query = mysqli_query($con, "SELECT id, institusi FROM pks WHERE id = '$idPks'");

    if ($query) {
        $data = mysqli_fetch_assoc($query);
        echo json_encode($data);
    } else {
        echo json_encode(['error' => 'Data tidak ditemukan']);
    }
}
?>
