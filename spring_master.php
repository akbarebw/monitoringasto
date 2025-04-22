<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}
include_once "./notification.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Master Data Spring</title>
    <link href="./assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="./assets/css/main.css" rel="stylesheet">
    <script src="./assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="./assets/js/jquery.js"></script>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-2 sidebar vh-100 p-3">
            <?php include_once './sidebar.php'?>
        </div>
        <div class="col main p-3">
            <div class="page-header d-flex flex-column">
                <div class="text-uppercase flex-grow-1 align-content-end mb-2">
                    <h1 style="font-weight: bold">MASTER DATA SPRING</h1>
                </div>
                <!-- Profile Tetap -->
                <div class="profile-wrapper">
                    <div class="d-flex flex-row mb-3">
                        <div><img src="./assets/src/dinda.jpg" class="me-3" style="width: 50px; height: 50px; border-radius: 100%"></div>
                        <div class="flex-grow-1 d-flex flex-column">
                            <p style="font-weight: bolder">Dinda Ayu
                                <br/>
                                Plant Planner</p>
                        </div>
                    </div>
                    <div class="profile-card card">
                        <div class="d-flex flex-row">
                            <div><img src="./assets/src/dinda.jpg" class="me-3" style="width: 50px; height: 50px; border-radius: 100%"></div>
                            <div class="flex-grow-1 d-flex flex-column">
                                <p style="font-size: large; font-weight: 600">Dinda Ayu Amalia
                                    <br/>
                                    <span style="font-size: smaller; font-weight: 400">Plant Planner</span></p>
                            </div>
                        </div>
                        <div class="d-flex flex-row align-items-center align-content-center">
                            <a class="d-flex flex-row align-items-center text-decoration-none text-black me-3" href="mailto:dinda.amalia@kppmining.com"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#000" height="20px" class="me-1"><path d="M3 3H21C21.5523 3 22 3.44772 22 4V20C22 20.5523 21.5523 21 21 21H3C2.44772 21 2 20.5523 2 20V4C2 3.44772 2.44772 3 3 3ZM20 7.23792L12.0718 14.338L4 7.21594V19H20V7.23792ZM4.51146 5L12.0619 11.662L19.501 5H4.51146Z"></path></svg> <span style="font-size: large">Send email</span></a>
                            <a href="https://www.linkedin.com/in/dinda-ayu-amalia-ba70a622a"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" height="24px" fill="#0a53be"><path d="M18.3362 18.339H15.6707V14.1622C15.6707 13.1662 15.6505 11.8845 14.2817 11.8845C12.892 11.8845 12.6797 12.9683 12.6797 14.0887V18.339H10.0142V9.75H12.5747V10.9207H12.6092C12.967 10.2457 13.837 9.53325 15.1367 9.53325C17.8375 9.53325 18.337 11.3108 18.337 13.6245V18.339H18.3362ZM7.00373 8.57475C6.14573 8.57475 5.45648 7.88025 5.45648 7.026C5.45648 6.1725 6.14648 5.47875 7.00373 5.47875C7.85873 5.47875 8.55173 6.1725 8.55173 7.026C8.55173 7.88025 7.85798 8.57475 7.00373 8.57475ZM8.34023 18.339H5.66723V9.75H8.34023V18.339ZM19.6697 3H4.32923C3.59498 3 3.00098 3.5805 3.00098 4.29675V19.7033C3.00098 20.4202 3.59498 21 4.32923 21H19.6675C20.401 21 21.001 20.4202 21.001 19.7033V4.29675C21.001 3.5805 20.401 3 19.6675 3H19.6697Z"></path></svg></a>
                        </div>
                        <hr/>
                        <h4>Contact</h4>
                        <div class="d-flex flex-column gap-1">
                            <a class="d-flex flex-row align-items-center text-decoration-none" href="mailto:dinda.amalia@kppmining.com"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#000" height="20px" class="me-1"><path d="M3 3H21C21.5523 3 22 3.44772 22 4V20C22 20.5523 21.5523 21 21 21H3C2.44772 21 2 20.5523 2 20V4C2 3.44772 2.44772 3 3 3ZM20 7.23792L12.0718 14.338L4 7.21594V19H20V7.23792ZM4.51146 5L12.0619 11.662L19.501 5H4.51146Z"></path></svg> <span>dinda.amalia@kppmining.com</span></a>
                            <a href="https://www.linkedin.com/in/dinda-ayu-amalia-ba70a622a" class="text-decoration-none text-black d-flex flex-row align-items-center"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" height="23px" fill="#0a53be"><path d="M18.3362 18.339H15.6707V14.1622C15.6707 13.1662 15.6505 11.8845 14.2817 11.8845C12.892 11.8845 12.6797 12.9683 12.6797 14.0887V18.339H10.0142V9.75H12.5747V10.9207H12.6092C12.967 10.2457 13.837 9.53325 15.1367 9.53325C17.8375 9.53325 18.337 11.3108 18.337 13.6245V18.339H18.3362ZM7.00373 8.57475C6.14573 8.57475 5.45648 7.88025 5.45648 7.026C5.45648 6.1725 6.14648 5.47875 7.00373 5.47875C7.85873 5.47875 8.55173 6.1725 8.55173 7.026C8.55173 7.88025 7.85798 8.57475 7.00373 8.57475ZM8.34023 18.339H5.66723V9.75H8.34023V18.339ZM19.6697 3H4.32923C3.59498 3 3.00098 3.5805 3.00098 4.29675V19.7033C3.00098 20.4202 3.59498 21 4.32923 21H19.6675C20.401 21 21.001 20.4202 21.001 19.7033V4.29675C21.001 3.5805 20.401 3 19.6675 3H19.6697Z"></path></svg> <span>Dinda Ayu Amalia</span></a>
                        </div>
                    </div>
                </div>  
            </div>

            <ul class="nav nav-tabs" id="springTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active text-dark fw-bold" id="brand-tab" data-bs-toggle="tab" data-bs-target="#brand" type="button" role="tab" aria-controls="brand" aria-selected="true">Brand</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link text-white" id="springtype-tab" data-bs-toggle="tab" data-bs-target="#springtype" type="button" role="tab" aria-controls="springtype" aria-selected="false">Spring Type</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link text-white" id="component-tab" data-bs-toggle="tab" data-bs-target="#component" type="button" role="tab" aria-controls="component" aria-selected="false">Component</button>
                </li>
            </ul>


            <div class="tab-content" id="springTabContent">
                <!-- BRAND TAB -->
                <div class="tab-pane fade show active p-3" id="brand" role="tabpanel">
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-3 input-group">
                                <input type="text" id="searchBrand" class="form-control" placeholder="Search for Brand...">
                                <button class="btn btn-outline-secondary" type="button" id="refreshBrand">REFRESH DATA</button>
                                <button class="btn btn-outline-secondary" type="button" data-bs-toggle="modal" data-bs-target="#modalAddBrand">INSERT DATA</button>
                            </div>
                            <table id="tableBrand" class="table table-hover">
                                <thead><tr><th>No</th><th>Nama Brand</th><th>Aksi</th></tr></thead>
                                <tbody id="brandTableBody"></tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- SPRING TYPE TAB -->
                <div class="tab-pane fade p-3" id="springtype" role="tabpanel">
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-3 input-group">
                                <input type="text" id="searchSpringType" class="form-control" placeholder="Search for Spring Type...">
                                <button class="btn btn-outline-secondary" type="button" id="refreshSpringType">REFRESH DATA</button>
                                <button class="btn btn-outline-secondary" type="button" data-bs-toggle="modal" data-bs-target="#modalAddSpringType">INSERT DATA</button>
                            </div>
                            <table id="tableSpringType" class="table table-hover">
                                <thead><tr><th>No</th><th>Kode Tipe</th><th>Aksi</th></tr></thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- COMPONENT TAB -->
                <div class="tab-pane fade p-3" id="component" role="tabpanel">
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-3 input-group">
                                <input type="text" id="searchComponent" class="form-control" placeholder="Search for Component...">
                                <button class="btn btn-outline-secondary" type="button" id="refreshComponent">REFRESH DATA</button>
                                <button class="btn btn-outline-secondary" type="button" data-bs-toggle="modal" data-bs-target="#modalAddComponent">INSERT DATA</button>
                            </div>
                            <table id="tableComponent" class="table table-hover">
                                <thead><tr><th>No</th><th>Nama Komponen</th><th>Aksi</th></tr></thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Modal Tambah Brand -->
<div class="modal fade" id="modalAddBrand" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Brand</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <input type="text" id="newBrand" class="form-control" placeholder="Contoh: UT, TRM">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveBrand">Simpan</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Spring Type -->
<div class="modal fade" id="modalAddSpringType" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Spring Type</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <input type="text" id="newSpringType" class="form-control" placeholder="Contoh: SP, SH, SR...">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveSpringType">Simpan</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Komponen -->
<div class="modal fade" id="modalAddComponent" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Komponen</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <input type="text" id="newComponent" class="form-control" placeholder="Contoh: TRANSMISI, FINAL DRIVE">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveComponent">Simpan</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal Edit Brand -->
<div class="modal fade" id="modalBrand" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="formBrand">
        <div class="modal-header">
          <h5 class="modal-title">Edit Brand</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" id="brandId">
          <input type="text" id="brandName" class="form-control" placeholder="Nama Brand">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Modal Edit Komponen -->
<div class="modal fade" id="modalEditComponent" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="formEditComponent">
        <div class="modal-header">
          <h5 class="modal-title">Edit Komponen</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" id="editComponentId">
          <input type="text" id="editComponentName" class="form-control" placeholder="Nama Komponen">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Edit Spring Type -->
<div class="modal fade" id="modalEditSpringType" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="formEditSpringType">
        <div class="modal-header">
          <h5 class="modal-title">Edit Spring Type</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" id="editSpringTypeId">
          <input type="text" id="editSpringTypeName" class="form-control" placeholder="Kode Tipe Spring">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </div>
      </form>
    </div>
  </div>
</div>


<script>
// Edit button
$(document).on('click', '.btn-edit-brand', function () {
  const id = $(this).data('id');
  const name = $(this).data('name');

  $('#brandId').val(id);
  $('#brandName').val(name);
  $('#modalBrand').modal('show');
});

$('#formBrand').off('submit').on('submit', function (e) {
  e.preventDefault();
  const id = $('#brandId').val();
  const name = $('#brandName').val();
  const action = id ? 'updateBrand' : 'insertBrand';

  if (!name.trim()) {
    alert('Nama brand tidak boleh kosong.');
    return;
  }

  $.post('action.php', { action, id, name }, function (res) {
    if (res.trim() === 'Success') {
      alert('Berhasil disimpan!');
      $('#modalBrand').modal('hide');
      $('#formBrand')[0].reset();
      loadBrands();
    } else if (res.trim() === 'Duplicate') {
      alert('Nama brand sudah ada!');
    } else {
      alert('Gagal menyimpan data. Server response: ' + res);
    }
  });
});

    function loadBrands() {
  $.post('action.php', { action: 'fetchBrandsTable' }, function (res) {
    $('#brandTableBody').html(res);
  });
}

$('#refreshBrand').click(loadBrands);
loadBrands();

// Filter Brand
$('#searchBrand').on('keyup', function () {
  const keyword = $(this).val().toLowerCase();
  $('#brandTableBody tr').filter(function () {
    $(this).toggle($(this).text().toLowerCase().indexOf(keyword) > -1);
  });
});

// Edit button
$(document).on('click', '.btn-edit-brand', function () {
  const id = $(this).data('id');
  const name = $(this).data('name');
  $('#brandId').val(id);
  $('#brandName').val(name);
  $('#modalBrand').modal('show');
});

// Delete button
$(document).on('click', '.btn-delete-brand', function () {
  const id = $(this).data('id');
  console.log("ID brand yang mau dihapus:", id); // Tambahkan ini dulu
  if (confirm('Hapus brand ini?')) {
    $.post('action.php', { action: 'deleteBrand', id }, function (res) {
      console.log("Response dari delete:", res); // Cek hasil dari PHP
      if (res.trim() === 'Success') {
        alert('Berhasil dihapus!');
        loadBrands();
        } else if (res.trim() === 'Duplicate') {
        alert('Brand sudah ada!');
        } else {
        alert('Gagal hapus data! Server response: ' + res);
        }

    });
  }
});


document.querySelectorAll('#springTab .nav-link').forEach(btn => {
    btn.addEventListener('show.bs.tab', function () {
      document.querySelectorAll('#springTab .nav-link').forEach(el => {
        el.classList.remove('text-dark', 'fw-bold');
        el.classList.add('text-white');
      });
      this.classList.add('text-dark', 'fw-bold');
      this.classList.remove('text-white');
    });
  });
$(document).ready(function () {
    function loadBrandData() {
        $.post('action.php', { action: 'fetchBrandsTable' }, function (res) {
            $('#tableBrand tbody').html(res);
        });
    }

    $('#refreshBrand').on('click', loadBrandData);
    loadBrandData();

    $('#saveBrand').on('click', function () {
        const value = $('#newBrand').val();
        if (!value) return alert('Isi nama brand terlebih dahulu');

        $.post('action.php', { action: 'insertBrand', name: value }, function (res) {
            alert('Brand ditambahkan');
            $('#modalAddBrand').modal('hide');
            $('#newBrand').val('');
            loadBrandData();
        });
    });
});
function loadComponents() {
  $.post('action.php', { action: 'fetchComponentsTable' }, function (res) {
    $('#tableComponent tbody').html(res);
  });
}

function loadComponents() {
  $.post('action.php', { action: 'fetchComponentsForTable' }, function (res) {
    $('#tableComponent tbody').html(res);
  });
}

$('#refreshComponent').click(loadComponents);
loadComponents();

// Filter Komponen
$('#searchComponent').on('keyup', function () {
  const keyword = $(this).val().toLowerCase();
  $('#tableComponent tbody tr').filter(function () {
    $(this).toggle($(this).text().toLowerCase().indexOf(keyword) > -1);
  });
});

// Tambah komponen
$('#saveComponent').on('click', function () {
  const name = $('#newComponent').val();
  if (!name.trim()) return alert('Nama komponen tidak boleh kosong.');

  $.post('action.php', { action: 'insertComponentWithValidation', name }, function (res) {
    if (res.trim() === 'Success') {
      alert('Komponen ditambahkan!');
      $('#modalAddComponent').modal('hide');
      $('#newComponent').val('');
      loadComponents();
    } else if (res.trim() === 'Duplicate') {
      alert('Komponen sudah ada!');
    } else {
      alert('Gagal menambahkan komponen. Server: ' + res);
    }
  });
});

// Hapus komponen
$(document).on('click', '.btn-delete-component', function () {
  const id = $(this).data('id');
  if (confirm('Yakin ingin hapus komponen ini?')) {
    $.post('action.php', { action: 'deleteComponent', id }, function (res) {
      if (res.trim() === 'Success') {
        alert('Komponen berhasil dihapus!');
        loadComponents();
      } else {
        alert('Gagal menghapus komponen: ' + res);
      }
    });
  }
});
// Tombol edit komponen
$(document).on('click', '.btn-edit-component', function () {
  const id = $(this).data('id');
  const name = $(this).data('name');

  $('#editComponentId').val(id);
  $('#editComponentName').val(name);
  $('#modalEditComponent').modal('show');
});

// Submit form edit
$('#formEditComponent').on('submit', function (e) {
  e.preventDefault();
  const id = $('#editComponentId').val();
  const name = $('#editComponentName').val().trim();

  if (!name) {
    alert('Nama komponen tidak boleh kosong.');
    return;
  }

  $.post('action.php', { action: 'updateComponentWithValidation', id, name }, function (res) {
    if (res.trim() === 'Success') {
      alert('Komponen berhasil diubah!');
      $('#modalEditComponent').modal('hide');
      $('#formEditComponent')[0].reset();
      loadComponents();
    } else if (res.trim() === 'Duplicate') {
      alert('Nama komponen sudah ada!');
    } else {
      alert('Gagal mengubah komponen: ' + res);
    }
  });
});
function loadSpringTypes() {
  $.post('action.php', { action: 'fetchSpringTypesTable' }, function (res) {
    $('#tableSpringType tbody').html(res);
  });
}

$('#refreshSpringType').click(loadSpringTypes);
loadSpringTypes();

// Filter Spring Type
$('#searchSpringType').on('keyup', function () {
  const keyword = $(this).val().toLowerCase();
  $('#tableSpringType tbody tr').filter(function () {
    $(this).toggle($(this).text().toLowerCase().indexOf(keyword) > -1);
  });
});

// Tambah Spring Type
$('#saveSpringType').on('click', function () {
  const name = $('#newSpringType').val().trim();
  if (!name) return alert('Kode tipe tidak boleh kosong.');

  $.post('action.php', { action: 'insertSpringTypeWithValidation', name }, function (res) {
    if (res.trim() === 'Success') {
      alert('Spring type ditambahkan!');
      $('#modalAddSpringType').modal('hide');
      $('#newSpringType').val('');
      loadSpringTypes();
    } else if (res.trim() === 'Duplicate') {
      alert('Kode tipe sudah ada!');
    } else {
      alert('Gagal menambahkan spring type: ' + res);
    }
  });
});

// Edit Spring Type
$(document).on('click', '.btn-edit-springtype', function () {
  const id = $(this).data('id');
  const name = $(this).data('name');

  $('#editSpringTypeId').val(id);
  $('#editSpringTypeName').val(name);
  $('#modalEditSpringType').modal('show');
});

$('#formEditSpringType').on('submit', function (e) {
  e.preventDefault();
  const id = $('#editSpringTypeId').val();
  const name = $('#editSpringTypeName').val().trim();

  if (!name) {
    alert('Kode tidak boleh kosong.');
    return;
  }

  $.post('action.php', { action: 'updateSpringTypeWithValidation', id, name }, function (res) {
    if (res.trim() === 'Success') {
      alert('Spring type berhasil diubah!');
      $('#modalEditSpringType').modal('hide');
      $('#formEditSpringType')[0].reset();
      loadSpringTypes();
    } else if (res.trim() === 'Duplicate') {
      alert('Kode sudah ada!');
    } else {
      alert('Gagal mengubah data: ' + res);
    }
  });
});

// Delete Spring Type
$(document).on('click', '.btn-delete-springtype', function () {
  const id = $(this).data('id');
  if (confirm('Yakin ingin hapus spring type ini?')) {
    $.post('action.php', { action: 'deleteSpringType', id }, function (res) {
      if (res.trim() === 'Success') {
        alert('Spring type berhasil dihapus!');
        loadSpringTypes();
      } else {
        alert('Gagal menghapus: ' + res);
      }
    });
  }
});


</script>
</body>
</html>