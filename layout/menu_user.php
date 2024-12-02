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
                <a href="?page=dashboard" class="<?php if ($_GET['page'] == 'menu') { echo 'active'; } ?>" 
                   style="<?php if ($_GET['page'] == 'menu') { echo 'background-color: #2ecc71; color: white;'; } else { echo 'background-color: white; color: black;'; } ?>">
                    <i class="sidebar-item-icon fa fa-th-large"></i>
                    <span class="nav-label">Dashboard</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
<!-- END SIDEBAR-->
