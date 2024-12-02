<?php
require '../connection.php'; 

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $pengajuan_id = $_GET['id'];

    // Query yang disesuaikan untuk mengambil jurusan dari tabel pembimbing
    $query = "
        SELECT 
            pb.jurusan,  -- Mengambil jurusan dari tabel pembimbing
            p.jumlah, 
            p.awal, 
            p.akhir, 
            k.institusi 
        FROM 
            pengajuan p 
        JOIN 
            pks k ON p.idPks = k.id
        JOIN 
            pembimbing pb ON p.pembimbing_id = pb.id  -- Asumsi ada kolom pembimbing_id di pengajuan
        WHERE 
            p.id = '$pengajuan_id'
    ";

    $result = mysqli_query($con, $query);
    
    if ($result) {
        $data = mysqli_fetch_assoc($result);
        if ($data) {
            header('Content-Type: application/json');
            echo json_encode($data);
        } else {
            echo json_encode(['error' => 'No data found']);
        }
    } else {
        echo json_encode(['error' => 'Query failed: ' . mysqli_error($con)]);
    }
} else {
    echo json_encode(['error' => 'Invalid ID']);
}
?>
