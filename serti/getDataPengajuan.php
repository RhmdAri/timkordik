<?php
include '../connection.php';

if (isset($_GET['id'])) {
    $pengajuan_id = $_GET['id'];
    
    $query = "
        SELECT k.institusi, b.jurusan, p.awal, p.akhir 
        FROM pengajuan p
        JOIN pks k ON p.idPks = k.id
        JOIN pembimbing b ON p.pembimbing_id = b.id
        WHERE p.id = '$pengajuan_id'
    ";
    
    $result = mysqli_query($con, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);
        echo json_encode($data);
    } else {
        echo json_encode(['error' => 'Data tidak ditemukan']);
    }
} else {
    echo json_encode(['error' => 'ID pengajuan tidak diterima']);
}
?>
