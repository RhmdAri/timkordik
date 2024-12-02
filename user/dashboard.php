<div class="container text-center mt-5">
    <!-- Logo -->
    <div class="my-4">
        <img src="../assets/img/rsi.png" alt="Logo RSI Sultan Agung" style="width: 150px;">
    </div>
    <h5 class="font-weight-bold text-success title-text">Tim Koordinasi Pendidikan RSIS</h5>
    <p class="sub-title-text">Informasi terkait Pelaksanaan PKL di RSI Sultan Agung Banjarbaru</p>
    
    <!-- Card Menu -->
    <div class="row">
        <!-- Menu Input Data Mahasiswa -->
        <div class="col-md-3">
            <div class="card shadow-lg border-0 rounded-lg mb-4" style="background-color: #E6F4E4;">
                <div class="card-body">
                    <div class="mb-3">
                        <i class="ti-user icon-style"></i>
                    </div>
                    <h5 class="card-title font-weight-bold">Input Data Mahasiswa</h5>
                    <p class="card-text">Tambah Data mahasiswa.</p>
                    <a href="?page=mhsUser" class="btn btn-outline-success btn-sm">Masuk</a>
                </div>
            </div>
        </div>

        <!-- Menu Surat Menyurat -->
        <div class="col-md-3">
            <div class="card shadow-lg border-0 rounded-lg mb-4" style="background-color: #E6F4E4;">
                <div class="card-body">
                    <div class="mb-3">
                        <i class="ti-email icon-style"></i>
                    </div>
                    <h5 class="card-title font-weight-bold">Surat Menyurat</h5>
                    <p class="card-text">Kelola surat menyurat.</p>
                    <a href="?page=suratUser" class="btn btn-outline-success btn-sm">Masuk</a>
                </div>
            </div>
        </div>

        <!-- Menu Sertifikat -->
        <div class="col-md-3">
            <div class="card shadow-lg border-0 rounded-lg mb-4" style="background-color: #E6F4E4;">
                <div class="card-body">
                    <div class="mb-3">
                        <i class="ti-medall icon-style"></i>
                    </div>
                    <h5 class="card-title font-weight-bold">Sertifikat</h5>
                    <p class="card-text">Kelola sertifikat.</p>
                    <a href="?page=sertiUser" class="btn btn-outline-success btn-sm">Masuk</a>
                </div>
            </div>
        </div>

        <!-- Menu Parkir -->
        <div class="col-md-3">
            <div class="card shadow-lg border-0 rounded-lg mb-4" style="background-color: #E6F4E4;">
                <div class="card-body">
                    <div class="mb-3">
                        <i class="ti-car icon-style"></i>
                    </div>
                    <h5 class="card-title font-weight-bold">Parkir</h5>
                    <p class="card-text">Atur akses parkir di lingkungan RSI.</p>
                    <a href="?page=parkirAdd" class="btn btn-outline-success btn-sm">Masuk</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- CSS untuk responsif -->
<style>
    .title-text {
        font-family: 'Times New Roman', Times, serif;
        font-size: 32px;
    }
    .sub-title-text {
        font-size: 18px;
    }
    .icon-style {
        font-size: 40px;
        color: #28a745;
    }

    /* Responsif untuk layar kecil (ponsel) */
    @media (max-width: 768px) {
        .title-text {
            font-size: 24px;
        }
        .sub-title-text {
            font-size: 16px;
        }
        .icon-style {
            font-size: 30px;
        }
    }

    /* Responsif untuk layar sangat kecil */
    @media (max-width: 576px) {
        .title-text {
            font-size: 25px;
        }
        .sub-title-text {
            font-size: 14px;
        }
        .icon-style {
            font-size: 25px;
        }
    }
</style>
