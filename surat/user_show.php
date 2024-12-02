<?php
include '../connection.php';
session_start();

// Mendapatkan ID pengguna yang sedang login dari sesi
$user_id = $_SESSION['user_id'];

// Menggunakan prepared statement untuk menghindari SQL injection
$query = "SELECT surat.*, pengajuan.no AS no_pengajuan, pengajuan.dari, pengajuan.perihal
          FROM surat
          JOIN pengajuan ON surat.pengajuan_id = pengajuan.id
          WHERE surat.user_id = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

?>

<div class="page-heading">
    <h1 class="page-title">Data Surat</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="index.html"><i class="la la-home font-20"></i></a>
        </li>
        <li class="breadcrumb-item">Data Surat</li>
    </ol>
</div>
<div class="page-content fade-in-up">
    <div class="ibox">
        <div class="ibox-body">
            <h4 class="ibox-title">Data Surat</h4>
            <hr>
            
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" id="example-table" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>No Surat</th>
                            <th>Tujuan</th>
                            <th>Perihal</th>
                            <th>File Surat Balasan</th>
                            <th>File Surat Tagihan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result->num_rows > 0) {
                            while ($data = $result->fetch_assoc()) {
                        ?>
                        <tr>
                            <td><?php echo $data['no_pengajuan']; ?></td>
                            <td><?php echo $data['dari']; ?></td>
                            <td><?php echo $data['perihal']; ?></td>
                            <td><?php echo $data['balasan'] ? '<a href="../uploads/' . htmlspecialchars($data['balasan']) . '" target="_blank">Lihat File</a>' : 'Tidak Ada File'; ?></td>
                            <td><?php echo $data['tagihan'] ? '<a href="../uploads/' . htmlspecialchars($data['tagihan']) . '" target="_blank">Lihat File</a>' : 'Tidak Ada File'; ?></td>
                        </tr>
                        <?php
                            }
                        } else {
                            echo "<tr><td colspan='5'>Tidak ada data yang ditemukan.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
