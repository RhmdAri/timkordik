<!-- START SIDEBAR-->
<nav class="page-sidebar bg-white" id="sidebar">
    <div id="sidebar-collapse">
        <div class="admin-block d-flex">
            <div>
                <img src="../assets/img/rsi.png" width="45px" />
            </div>
            <div class="admin-info text-dark">
                <div class="font-strong">RSI SULTAN AGUNG</div>
                <small class="text-dark">Tim Koordinasi Pendidikan</small>
            </div>
        </div>
        <hr>
        <ul class="side-menu metismenu">
            <li class="heading text-dark" style="border-bottom: 1px solid #ddd;"><b>MENU UTAMA</b></li>
            <li style="border-bottom: 1px solid #ddd;">
                <a href="?page=dashboard" class="<?php if ($_GET['page'] == 'dashboard') { echo 'active'; } ?>" 
                   style="<?php if ($_GET['page'] == 'dashboard') { echo 'background-color: #2ecc71; color: white;'; } else { echo 'background-color: white; color: black;'; } ?>">
                    <i class="sidebar-item-icon fa fa-th-large"></i>
                    <span class="nav-label">Dashboard</span>
                </a>
            </li>
            <li>
    <a href="javascript:;" class="<?php if ($_GET['page'] == 'master' || $_GET['page'] == 'parkir' || $_GET['page'] == 'mhs') { echo 'active'; } ?>" style="background-color: white; color: black;">
        <i class="sidebar-item-icon fa fa-table"></i>
        <span class="nav-label">Master</span>
        <i class="fa fa-angle-left arrow"></i>
    </a>
    <ul class="nav-2-level collapse <?php if ($_GET['page'] == 'parkir' || $_GET['page'] == 'mhs' || $_GET['page'] == 'pembimbing') { echo 'show'; } ?>">
        <li>
            <a href="?page=parkir" class="<?php if ($_GET['page'] == 'parkir') { echo 'active'; } ?>" style="background-color: white; color: black;">Data Parkir</a>
        </li>
        <li>
            <a href="?page=mhs" class="<?php if ($_GET['page'] == 'mhs') { echo 'active'; } ?>" style="background-color: white; color: black;">Data Mahasiswa</a>
        </li>
        <li>
            <a href="?page=pembimbing" class="<?php if ($_GET['page'] == 'pembimbing') { echo 'active'; } ?>" style="background-color: white; color: black;">Pembimbing</a>
        </li>
    </ul>
</li>

            <li style="border-bottom: 1px solid #ddd;">
                <a href="?page=pks" class="<?php if ($_GET['page'] == 'pks') { echo 'active'; } ?>" 
                   style="<?php if ($_GET['page'] == 'pks') { echo 'background-color: #2ecc71; color: white;'; } else { echo 'background-color: white; color: black;'; } ?>">
                    <i class="sidebar-item-icon ti-briefcase"></i>
                    <span class="nav-label">Data PKS</span>
                </a>
            </li>
            <br>
            <li class="heading text-dark" style="border-bottom: 1px solid #ddd;"><b>FEATURES</b></li>
            <li style="border-bottom: 1px solid #ddd;">
                <a href="?page=pengajuan" class="<?php if ($_GET['page'] == 'pengajuan') { echo 'active'; } ?>" 
                   style="<?php if ($_GET['page'] == 'pengajuan') { echo 'background-color: #2ecc71; color: white;'; } else { echo 'background-color: white; color: black;'; } ?>">
                    <i class="sidebar-item-icon ti-write"></i>
                    <span class="nav-label">Pengajuan</span>
                </a>
            </li>
            <li style="border-bottom: 1px solid #ddd;">
                <a href="?page=surat" class="<?php if ($_GET['page'] == 'surat') { echo 'active'; } ?>" 
                   style="<?php if ($_GET['page'] == 'surat') { echo 'background-color: #2ecc71; color: white;'; } else { echo 'background-color: white; color: black;'; } ?>">
                    <i class="sidebar-item-icon fa  fa-envelope-o"></i>
                    <span class="nav-label">Surat Surat</span>
                </a>
            </li>
            <li style="border-bottom: 1px solid #ddd;">
                <a href="?page=pertemuan" class="<?php if ($_GET['page'] == 'pertemuan') { echo 'active'; } ?>" 
                   style="<?php if ($_GET['page'] == 'pertemuan') { echo 'background-color: #2ecc71; color: white;'; } else { echo 'background-color: white; color: black;'; } ?>">
                    <i class="sidebar-item-icon fa ti-agenda"></i>
                    <span class="nav-label">Agenda Pertemuan</span>
                </a>
            </li>
            <li style="border-bottom: 1px solid #ddd;">
                <a href="?page=pelaksanaan" class="<?php if ($_GET['page'] == 'pelaksanaan') { echo 'active'; } ?>" 
                   style="<?php if ($_GET['page'] == 'pelaksanaan') { echo 'background-color: #2ecc71; color: white;'; } else { echo 'background-color: white; color: black;'; } ?>">
                    <i class="sidebar-item-icon fa ti-calendar"></i>
                    <span class="nav-label">Pelaksanaan & Presentasi</span>
                </a>
            </li>
            <li style="border-bottom: 1px solid #ddd;">
                <a href="?page=serti" class="<?php if ($_GET['page'] == 'serti') { echo 'active'; } ?>" 
                   style="<?php if ($_GET['page'] == 'serti') { echo 'background-color: #2ecc71; color: white;'; } else { echo 'background-color: white; color: black;'; } ?>">
                    <i class="sidebar-item-icon fa ti-receipt"></i>
                    <span class="nav-label">Sertifikat</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
<!-- END SIDEBAR-->
<script>
    $(document).ready(function() {
    // Menangani klik pada item menu
    $('.sidebar-item > a').on('click', function() {
        var submenu = $(this).next('.nav-2-level'); // Menemukan <ul> setelah <a>
        
        // Toggle kelas 'collapse' dan 'show'
        submenu.collapse('toggle');
    });
});

</script>