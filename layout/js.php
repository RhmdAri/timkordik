<!-- CORE PLUGINS -->
<script src="../assets/vendors/jquery/dist/jquery.min.js" type="text/javascript"></script>
<script src="../assets/vendors/popper.js/dist/umd/popper.min.js" type="text/javascript"></script>
<script src="../assets/vendors/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
<script src="../assets/vendors/metisMenu/dist/metisMenu.min.js" type="text/javascript"></script>
<script src="../assets/vendors/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<!-- PAGE LEVEL PLUGINS -->
<script src="../assets/vendors/select2/dist/js/select2.full.min.js" type="text/javascript"></script>
<script src="../assets/vendors/jquery-knob/dist/jquery.knob.min.js" type="text/javascript"></script>
<script src="../assets/vendors/moment/min/moment.min.js" type="text/javascript"></script>
<script src="../assets/vendors/fullcalendar/dist/fullcalendar.min.js" type="text/javascript"></script>
<script src="../assets/vendors/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
<script src="../assets/vendors/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
<script src="../assets/vendors/bootstrap-timepicker/js/bootstrap-timepicker.min.js" type="text/javascript"></script>
<script src="../assets/vendors/jquery-minicolors/jquery.minicolors.min.js" type="text/javascript"></script>
<script src="../assets/vendors/DataTables/datatables.min.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- CORE SCRIPTS -->
<script src="../assets/js/app.min.js" type="text/javascript"></script>
<!-- PAGE LEVEL SCRIPTS -->
<script src="../assets/js/scripts/form-plugins.js" type="text/javascript"></script>
<script src="../assets/js/scripts/calendar-demo.js" type="text/javascript"></script>
<script>
$(function() {
    $('#example-table').DataTable({ pageLength: 10 });
});

$(document).ready(function() {
        $('.select2').select2({         
        });
    });

document.querySelectorAll('.side-menu a').forEach(function(el) {
    el.addEventListener('mouseover', function() {
        this.style.backgroundColor = '#2ecc71';
        this.style.color = 'white';
        this.querySelectorAll('.sidebar-item-icon, .nav-label').forEach(function(iconText) {
            iconText.style.color = 'white';
        });
    });

    el.addEventListener('mouseout', function() {
        if (!this.classList.contains('active')) {
            this.style.backgroundColor = 'white';
            this.style.color = 'black';
            this.querySelectorAll('.sidebar-item-icon, .nav-label').forEach(function(iconText) {
                iconText.style.color = 'black';
            });
        }
    });

    el.addEventListener('click', function() {
        if (this.nextElementSibling && this.nextElementSibling.classList.contains('nav-2-level')) {
            this.nextElementSibling.classList.toggle('collapse');
            this.nextElementSibling.classList.toggle('show');
        } else {
            document.querySelectorAll('.nav-2-level.show').forEach(function(submenu) {
                submenu.classList.remove('show');
                submenu.classList.add('collapse');
            });
        }
    });
});

document.querySelectorAll('.nav-2-level li a').forEach(function(el) {
    el.addEventListener('click', function() {
        const parentMenu = this.closest('.nav-2-level');
        parentMenu.classList.add('show');
    });
});

document.addEventListener("DOMContentLoaded", function() {
    const form = document.querySelector("form.form-horizontal");
    if (form) {
        const fields = form.querySelectorAll("input, textarea, select");
        fields.forEach(field => {
            field.addEventListener("input", function() {
                if (field.value.trim()) {
                    field.classList.remove("is-invalid");
                    if (field.nextElementSibling && field.nextElementSibling.classList.contains("invalid-feedback")) {
                        field.nextElementSibling.remove();
                    }
                }
            });
        });

        form.addEventListener("submit", function(event) {
            let valid = true;
            fields.forEach(field => {
                if (!field.value.trim()) {
                    valid = false;
                    field.classList.add("is-invalid");
                    if (!field.nextElementSibling || !field.nextElementSibling.classList.contains("invalid-feedback")) {
                        const feedback = document.createElement("div");
                        feedback.className = "invalid-feedback";
                        feedback.textContent = "Harap diisi.";
                        field.parentNode.appendChild(feedback);
                    }
                } else {
                    field.classList.remove("is-invalid");
                    if (field.nextElementSibling && field.nextElementSibling.classList.contains("invalid-feedback")) {
                        field.nextElementSibling.remove();
                    }
                }
            });
            if (!valid) {
                event.preventDefault();
                Swal.fire({
                    icon: 'warning',
                    title: 'Ada Field Kosong',
                    text: 'Harap isi semua field yang wajib.',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK'
                });
            }
        });
    }
});

function showDetails(id, tanggal, nama, jekel, tlahir, tgllahir, agama, status, negara, alamat, telp, email, darah, institusi, jenjang, jurusan, semester, nim, orientasi, awal, akhir, hubungan, namaWali, jekelWali, umur, alamatWali, pendidikan, pekerjaan, telpWali, foto, tertib, persetujuan, surhat) {
    const modalContent = `
        <div class="modal-header">
            <h5 class="modal-title">Detail Data Mahasiswa</h5>
            <button type="button" class="close" onclick="Swal.close()">
                <span>&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <table class="table table-bordered">
                <tr><th>ID</th><td>${id}</td></tr>
                <tr><th>Tanggal</th><td>${tanggal}</td></tr>
                <tr><th>Nama</th><td>${nama}</td></tr>
                <tr><th>Jenis Kelamin</th><td>${jekel}</td></tr>
                <tr><th>Tempat Lahir</th><td>${tlahir}</td></tr>
                <tr><th>Tanggal Lahir</th><td>${tgllahir}</td></tr>
                <tr><th>Agama</th><td>${agama}</td></tr>
                <tr><th>Status</th><td>${status}</td></tr>
                <tr><th>Negara</th><td>${negara}</td></tr>
                <tr><th>Alamat</th><td>${alamat}</td></tr>
                <tr><th>Telepon</th><td>${telp}</td></tr>
                <tr><th>Email</th><td>${email}</td></tr>
                <tr><th>Golongan Darah</th><td>${darah}</td></tr>
                <tr><th>Institusi</th><td>${institusi}</td></tr>
                <tr><th>Jenjang</th><td>${jenjang}</td></tr>
                <tr><th>Jurusan</th><td>${jurusan}</td></tr>
                <tr><th>Semester</th><td>${semester}</td></tr>
                <tr><th>NIM</th><td>${nim}</td></tr>
                <tr><th>Orientasi</th><td>${orientasi}</td></tr>
                <tr><th>Awal Praktik</th><td>${awal}</td></tr>
                <tr><th>Akhir Praktik</th><td>${akhir}</td></tr>
                <tr><th>Hubungan</th><td>${hubungan}</td></tr>
                <tr><th>Nama Wali</th><td>${namaWali}</td></tr>
                <tr><th>Jenis Kelamin Wali</th><td>${jekelWali}</td></tr>
                <tr><th>Umur Wali</th><td>${umur}</td></tr>
                <tr><th>Alamat Wali</th><td>${alamatWali}</td></tr>
                <tr><th>Pendidikan Wali</th><td>${pendidikan}</td></tr>
                <tr><th>Pekerjaan Wali</th><td>${pekerjaan}</td></tr>
                <tr><th>Telepon Wali</th><td>${telpWali}</td></tr>
                <tr><th>Foto</th><td><img src="${foto}" alt="Foto"></td></tr>
                <tr><th>Tertib</th><td>${tertib}</td></tr>
                <tr><th>Persetujuan</th><td>${persetujuan}</td></tr>
                <tr><th>Surat Hat</th><td>${surhat}</td></tr>
            </table>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" onclick="Swal.close()">Tutup</button>
        </div>
    `;
    Swal.fire({
        html: modalContent,
        showCloseButton: true,
        focusConfirm: false,
        confirmButtonText: 'OK',
        customClass: { popup: 'swal2-popup' },
        width: '80%'
    });
}
</script>
 