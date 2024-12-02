<?php
if (isset($_POST['submit'])) {
    $no = $_POST['no'];
    $pengajuan_id = $_POST['pengajuan_id'];
    $institusi    = $_POST['institusi'];
    $jurusan      = $_POST['jurusan'];
    $user_id      = $_POST['user_id'];
    $awal         = $_POST['awal'];
    $akhir        = $_POST['akhir'];
    
    // Sertifikat (upload file)
    if (isset($_FILES['sertifikat'])) {
        $file_name = $_FILES['sertifikat']['name'];
        $file_tmp = $_FILES['sertifikat']['tmp_name'];
        $file_error = $_FILES['sertifikat']['error'];
        
        if ($file_error === 0) {
            $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
            $file_new_name = uniqid('', true) . '.' . $file_ext;
            $file_dest = '../sertif/' . $file_new_name; 
            move_uploaded_file($file_tmp, $file_dest);
        } else {
            echo "Error uploading file!";
        }
    }

    // Cek apakah pengajuan_id sudah ada di dalam tabel serti
    $check_query = "SELECT * FROM serti WHERE pengajuan_id = '$pengajuan_id'";
    $check_result = mysqli_query($con, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        // Jika sudah ada, beri pesan atau tangani sesuai kebutuhan
        echo "Pengajuan ID sudah ada dalam tabel serti!";
        exit;
    } else {
        // Insert data ke dalam tabel serti
        $query = "INSERT INTO serti (no, pengajuan_id, institusi, jurusan, user_id, awal, akhir, sertifikat)
                  VALUES ('$no', '$pengajuan_id', '$institusi', '$jurusan', '$user_id', '$awal', '$akhir', '$file_dest')";

        if (mysqli_query($con, $query)) {
            echo "<script>window.location.href = '?page=serti';</script>";
            exit(); // Pastikan script berhenti setelah redirect
        } else {
            echo "Error: " . mysqli_error($con);
        }
    }
}
?>

<div class="ibox mt-4">
    <div class="ibox-head">
        <div class="ibox-title">Tambah Data Sertifikat</div>
    </div>
    <div class="ibox-body">
        <form class="form-horizontal" id="form-serti" method="post" enctype="multipart/form-data">
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">No Sertifikat</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="no" required>
                </div>
            </div>
            <!-- User Selection by Level -->
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Pilih User</label>
                <div class="col-sm-10">
                    <select class="form-control" name="user_id">
                        <option value="">Pilih User</option>
                        <?php
                        // Ambil data user berdasarkan level (level harus "user")
                        $query_user = mysqli_query($con, "SELECT id, username FROM user WHERE level = 'user'");
                        while ($data_user = mysqli_fetch_array($query_user)) {
                            echo "<option value='".$data_user['id']."'>".$data_user['username']."</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Pilih Pengajuan</label>
                <div class="col-sm-10">
                    <select class="form-control" id="pengajuan" name="pengajuan_id" onchange="isiOtomatis()">
                        <option value="">Pilih Pengajuan</option>
                        <?php
                        // Mengambil data dari tabel pengajuan, pks, dan pembimbing
                        $query_pengajuan = mysqli_query($con, "
                            SELECT p.id, p.no, k.institusi, b.jurusan 
                            FROM pengajuan p 
                            JOIN pks k ON p.idPks = k.id 
                            JOIN pembimbing b ON p.pembimbing_id = b.id");

                        while ($data_pengajuan = mysqli_fetch_array($query_pengajuan)) {
                            $selected = ($data_pengajuan['id'] == $pengajuan_id) ? 'selected' : '';
                            echo "<option value='".$data_pengajuan['id']."' $selected>".$data_pengajuan['no']." | ".$data_pengajuan['institusi']." | ".$data_pengajuan['jurusan']."</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Institusi Pendidikan</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="institusi" id="institusi" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Jurusan/Prodi</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="jurusan" id="jurusan" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Periode Praktik</label>
                <div class="col-sm-10">
                    <div class="input-daterange input-group" id="datepicker">
                        <input class="input-sm form-control" type="text" name="awal" id="awal" readonly>
                        <span class="input-group-addon p-l-10 p-r-10">to</span>
                        <input class="input-sm form-control" type="text" name="akhir" id="akhir" readonly>
                    </div>
                </div>
            </div>

            <!-- Sertifikat Upload -->
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Upload Sertifikat</label>
                <div class="col-sm-10">
                    <input class="form-control" type="file" name="sertifikat" accept=".pdf, .jpg, .png">
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-10 ml-sm-auto">
                    <button name="submit" class="btn btn-info" type="submit">Submit</button>
                    <a href="?page=serti" class="btn btn-danger">Back</a>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
function isiOtomatis() {
    var pengajuan_id = document.getElementById("pengajuan").value;

    if (pengajuan_id !== "") {
        fetch('../serti/getDataPengajuan.php?id=' + pengajuan_id)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok: ' + response.statusText);
            }
            return response.json();
        })
        .then(data => {
            if (data.error) {
                alert(data.error);
                return;
            }
            document.getElementById("institusi").value = data.institusi || '';
            document.getElementById("jurusan").value = data.jurusan || '';  
            document.getElementById("awal").value = data.awal || '';
            document.getElementById("akhir").value = data.akhir || '';
        })
        .catch(error => {
            alert('Error fetching data: ' + error.message);
        });
    }
}
</script>
