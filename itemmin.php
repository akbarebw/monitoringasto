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
    <title>Monitoring Spring</title>
    <link href="./assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="./assets/css/main.css" rel="stylesheet">
    <script src="./assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="./assets/js/jquery.js"></script>
    <link rel="icon" type="image/x-icon" href="./assets/src/favicon.png">
</head>
<body>
<!-- Modal Tambah Spring Type -->
<div class="modal fade" id="modalAddSpringType" tabindex="-1" aria-labelledby="modalAddSpringType" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Tipe Spring</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label class="form-label">Kode Tipe</label>
          <input type="text" class="form-control" id="newSpringType" placeholder="Contoh: SP, SH, SR...">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="saveSpringType">Simpan</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Tambah Komponen -->
<div class="modal fade" id="modalAddComponent" tabindex="-1" aria-labelledby="modalAddComponent" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Komponen</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label class="form-label">Nama Komponen</label>
          <input type="text" class="form-control" id="newComponent" placeholder="Contoh: TRANSMISI, FINAL DRIVE">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="saveComponent">Simpan</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Tambah Brand -->
<div class="modal fade" id="modalAddBrand" tabindex="-1" aria-labelledby="modalAddBrand" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Brand</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label class="form-label">Nama Brand</label>
          <input type="text" class="form-control" id="newBrand" placeholder="Contoh: UT, TRM">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="saveBrand">Simpan</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal: Insert Monitoring Spring -->
<div class="modal fade" id="insertModal" tabindex="-1" aria-labelledby="insertModal" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Insert Monitoring Spring</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="insertForm">
          <div class="row g-2">
            <div class="col-md-4">
              <label class="form-label">Tipe</label>
              <div class="input-group">
                <select class="form-select" id="addSpringType"></select>
                <button class="btn btn-outline-secondary" type="button" data-bs-toggle="modal" data-bs-target="#modalAddSpringType">+</button>
              </div>
            </div>
            <div class="col-md-4">
              <label class="form-label">Komponen</label>
              <div class="input-group">
                <select class="form-select" id="addComponent"></select>
                <button class="btn btn-outline-secondary" type="button" data-bs-toggle="modal" data-bs-target="#modalAddComponent">+</button>
              </div>
            </div>
          </div>

          <hr class="my-3">
          <h6>Detail SC KPP / PN SM / SOH SM</h6>
          <div id="detailRows"></div>
          <button type="button" class="btn btn-outline-primary btn-sm mt-2" onclick="addDetailRow()">+ Tambah Baris</button>

          <hr class="my-3">
          <div class="row g-2">
            <div class="col-md-3"><label>SC UT</label><input type="text" class="form-control" id="addScUt" name="sc_ut"></div>
            <div class="col-md-3"><label>PN UT</label><input type="text" class="form-control" id="addPnUt" name="pn_ut"></div>
            <div class="col-md-3"><label>SOH UT</label><input type="number" class="form-control" id="addSohUt" name="soh_ut" value="0"></div>
            <div class="col-md-3"><label>ITO</label><input type="number" class="form-control" id="addIto" name="ito" value="0"></div>
            <div class="col-md-3"><label>A.Usage</label><input type="number" class="form-control" id="addAUsage" name="a_usage" value="0"></div>
            <div class="col-md-3"><label>Total SOH</label><input type="number" class="form-control" id="totalSoh" readonly></div>
            <div class="col-md-3"><label>Readiness (%)</label><input type="number" class="form-control" id="readiness" readonly></div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="saveDataSpring">Insert Data</button>
      </div>
    </div>
  </div>
</div>



<!-- Modal: Edit Spring -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModal" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Monitoring Spring</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" id="editId">
        <form id="editForm">
          <div class="row g-2">
            <div class="col-md-4">
              <label class="form-label">Tipe</label>
              <select class="form-select" id="editSpringType"></select>
            </div>
            <div class="col-md-4">
              <label class="form-label">Komponen</label>
              <select class="form-select" id="editComponent"></select>
            </div>
            <div class="col-md-4">
              <label class="form-label">Brand</label>
              <select class="form-select" id="editBrand"></select>
            </div>
            <div class="col-md-3"><label class="form-label">SC KPP</label><input type="text" class="form-control" id="editScKpp"></div>
            <div class="col-md-3"><label class="form-label">PN SM</label><input type="text" class="form-control" id="editPnSm"></div>
            <div class="col-md-3"><label class="form-label">SC UT</label><input type="text" class="form-control" id="editScUt"></div>
            <div class="col-md-3"><label class="form-label">PN UT</label><input type="text" class="form-control" id="editPnUt"></div>
            <div class="col-md-3"><label class="form-label">SOH SM</label><input type="number" class="form-control" id="editSohSm"></div>
            <div class="col-md-3"><label class="form-label">SOH UT</label><input type="number" class="form-control" id="editSohUt"></div>
            <div class="col-md-3"><label class="form-label">ITO</label><input type="number" class="form-control" id="editIto"></div>
            <div class="col-md-3"><label class="form-label">Jumlah Order</label><input type="number" class="form-control" id="editJumlahOrder"></div>
            <div class="col-md-3"><label class="form-label">MIT</label><input type="number" class="form-control" id="editMit"></div>
            <div class="col-md-3"><label class="form-label">D. OUT</label><input type="number" class="form-control" id="editDOut"></div>
            <div class="col-md-3"><label class="form-label">A.Usage</label><input type="number" class="form-control" id="editAUsage"></div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="saveEditSpring">Save Changes</button>
      </div>
    </div>
  </div>
</div>


<div class="container-fluid">
    <div class="row">
        <div class="col-lg-2 sidebar vh-100 p-3">
            <?php include_once './sidebar.php'?>
        </div>
        <div class="col main p-3">
            <div class="page-header d-flex flex-column">
                <div class="text-uppercase flex-grow-1 align-content-end mb-2">
                    <h1 style="font-weight: bold">MONITORING SPRING</h1>
                </div>
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
                </div>            </div>
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-3 input-group">
                                <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">COLUMN SEARCH</button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item search-item" href="#">Komponen</a></li>
                                    <li><a class="dropdown-item search-item" href="#">PN SM</a></li>
                                    <li><a class="dropdown-item search-item" href="#">SC KPP</a></li>
                                    <li><a class="dropdown-item search-item" href="#">SOH UT</a></li>
                                    <li><a class="dropdown-item search-item" href="#">Brand</a></li>
                                </ul>
                                <input type="text" id="myInput" class="form-control" onkeyup="myFunction()" placeholder="Search for Komponen...">
                                <button class="btn btn-outline-secondary" type="button" id="refresh-button">REFRESH DATA</button>
                                <button class="btn btn-outline-secondary" type="button" data-bs-toggle="modal" data-bs-target="#insertModal">INSERT DATA</button>
                            </div>
                            <table id="myTable" class="table table-hover table-bordered align-middle">
                            <thead class="table-light">
                              <tr>
                                <th style="width:40px">No</th>
                                <th>Tipe</th>
                                <th>Komponen</th>
                                <th>Brand</th>
                                <th>SC KPP</th>
                                <th>PN SM</th>
                                <th>SC UT</th>
                                <th>PN UT</th>
                                <th>SOH SM</th>
                                <th>SOH UT</th>
                                <th>Total SOH</th>
                                <th>ITO</th>
                                <th>Order</th>
                                <th>MIT</th>
                                <th>D.OUT</th>
                                <th>A.Usage</th>
                                <th>Readiness</th>
                                <th colspan="2">Aksi</th>
                              </tr>
                            </thead>
                            <tbody></tbody>
                          </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
  
 let searchColumn = 2;
let placeholderText = "Search for Komponen...";

function changeSearchColumn(columnIndex, placeholder) {
    searchColumn = columnIndex;
    placeholderText = placeholder;
    document.getElementById("myInput").placeholder = placeholderText;
}

function myFunction() {
    let input = document.getElementById("myInput");
    let filter = input.value.toUpperCase();
    let table = document.getElementById("myTable");
    let tr = table.getElementsByTagName("tr");

    for (let i = 0; i < tr.length; i++) {
        let td = tr[i].getElementsByTagName("td")[searchColumn];
        if (td) {
            let txtValue = td.textContent || td.innerText;
            tr[i].style.display = txtValue.toUpperCase().indexOf(filter) > -1 ? "" : "none";
        }
    }
}

document.querySelectorAll('.search-item').forEach(item => {
    item.addEventListener('click', function(e) {
        const selectedColumn = e.target.textContent;
        let columnIndex = 2;
        let placeholder = "Search for Komponen...";

        if (selectedColumn === "Brand") {
            columnIndex = 3;
            placeholder = "Search for Brand...";
        } else if (selectedColumn === "SC KPP") {
            columnIndex = 4;
            placeholder = "Search for SC KPP...";
        } else if (selectedColumn === "PN SM") {
            columnIndex = 5;
            placeholder = "Search for PN SM...";
        } else if (selectedColumn === "SOH UT") {
            columnIndex = 9;
            placeholder = "Search for SOH UT...";
        }

        changeSearchColumn(columnIndex, placeholder);
    });
});

function hitungTotalSOH() {
  let totalSm = 0;
  document.querySelectorAll('input[name^="details"][name$="[soh_sm]"]').forEach(el => {
    totalSm += parseInt(el.value || 0);
  });
  const sohUt = parseInt(document.getElementById('addSohUt')?.value || 0);
  const total = totalSm + sohUt;
  document.getElementById('totalSoh').value = total;

  // Readiness = jika total_soh >= (soh_sm + soh_ut), maka 100, else 0
  const readiness = (total >= totalSm + sohUt) ? 100 : 0;
  document.getElementById('readiness').value = readiness;
}
function refreshDropdown(target, action) {
    $.ajax({
      url: 'action.php',
      type: 'POST',
      data: { action: action },
      success: function (response) {
        $(target).html(response);
      }
    });
  }

$(document).ready(function () {
  function loadData() {
    $.ajax({
      url: 'action.php',
      type: 'POST',
      data: { action: 'fetchspringitems' },
      success: function (response) {
        $('#myTable tbody').html(response);
        $('#myTable tbody tr').each(function (index, row) {
          $(row).find('td:first').text(index + 1);
        });
      }
    });
  }

  $('#refresh-button').on('click', loadData);
  loadData();



  refreshDropdown('#addSpringType', 'fetchSpringTypes');
  refreshDropdown('#editSpringType', 'fetchSpringTypes');
  refreshDropdown('#addComponent', 'fetchComponents');
  refreshDropdown('#editComponent', 'fetchComponents');
  refreshDropdown('#addBrand', 'fetchBrands');
  refreshDropdown('#editBrand', 'fetchBrands');

  $('#saveSpringType').click(function () {
    const value = $('#newSpringType').val();
    if (!value) return alert('Isi tipe terlebih dahulu');
    $.post('action.php', { action: 'insertSpringType', name: value }, function () {
      alert('Spring type ditambahkan');
      $('#modalAddSpringType').modal('hide');
      $('#newSpringType').val('');
      refreshDropdown('#addSpringType', 'fetchSpringTypes');
      refreshDropdown('#editSpringType', 'fetchSpringTypes');
    });
  });

  $('#saveComponent').click(function () {
    const value = $('#newComponent').val();
    if (!value) return alert('Isi nama komponen terlebih dahulu');
    $.post('action.php', { action: 'insertComponent', name: value }, function () {
      alert('Komponen ditambahkan');
      $('#modalAddComponent').modal('hide');
      $('#newComponent').val('');
      refreshDropdown('#addComponent', 'fetchComponents');
      refreshDropdown('#editComponent', 'fetchComponents');
    });
  });

  $('#saveBrand').click(function () {
    const value = $('#newBrand').val();
    if (!value) return alert('Isi nama brand terlebih dahulu');
    $.post('action.php', { action: 'insertBrand', name: value }, function () {
      alert('Brand ditambahkan');
      $('#modalAddBrand').modal('hide');
      $('#newBrand').val('');
      refreshDropdown('#addBrand', 'fetchBrands');
      refreshDropdown('#editBrand', 'fetchBrands');
    });
  });

  $('#insertModal').on('shown.bs.modal', function () {
    if ($('#detailRows .row').length === 0) {
      addDetailRow();
    }
  });
});

$('#saveDataSpring').on('click', function () {
  const detailRows = [];
  $('#detailRows .row').each(function () {
    const sc_kpp = $(this).find('input[name*="[sc_kpp]"]').val();
    const pn_sm = $(this).find('input[name*="[pn_sm]"]').val();
    const soh_sm = parseInt($(this).find('input[name*="[soh_sm]"]').val() || 0);
    const jumlah_order = parseInt($(this).find('input[name*="[jumlah_order]"]').val() || 0);
    const mit = parseInt($(this).find('input[name*="[mit]"]').val() || 0);
    const d_out = parseInt($(this).find('input[name*="[d_out]"]').val() || 0);
    const brand_id = $(this).find('select[name*="[brand_id]"]').val(); // ← FIX di sini
    detailRows.push({ sc_kpp, pn_sm, soh_sm, jumlah_order, mit, d_out, brand_id });
  });

  const data = {
    action: 'insertspringitem',
    spring_type_id: $('#addSpringType').val(),
    component_id: $('#addComponent').val(),
    sc_ut: $('#addScUt').val(),
    pn_ut: $('#addPnUt').val(),
    soh_ut: parseInt($('#addSohUt').val()) || 0,
    ito: parseInt($('#addIto').val()) || 0,
    a_usage: parseInt($('#addAUsage').val()) || 0,
    details: detailRows
  };

  $.post('action.php', data, function (res) {
    if (res === 'Success') {
      alert('Data berhasil ditambahkan!');
      $('#insertModal').modal('hide');
      $('#insertForm')[0].reset();
      $('#refresh-button').click();
      $('#detailRows').html('');
      rowIndex = 0;
      addDetailRow();
    } else {
      alert('Gagal menambahkan data!');
      console.log(res);
    }
  });
});



document.addEventListener('input', function (e) {
  if (
    e.target.matches('input[name^="details"][name$="[soh_sm]"]') ||
    e.target.id === 'addSohUt'
  ) {
    hitungTotalSOH();
  }
});

let rowIndex = 0;
function addDetailRow() {
  const row = document.createElement('div');
  row.classList.add('row', 'g-2', 'mb-2');
  row.innerHTML = `
    <div class="col-md-2">
      <label>SC KPP</label>
      <input type="text" class="form-control" name="details[${rowIndex}][sc_kpp]" required>
    </div>
    <div class="col-md-2">
      <label>PN SM</label>
      <input type="text" class="form-control" name="details[${rowIndex}][pn_sm]" required>
    </div>
    <div class="col-md-2">
      <label>SOH SM</label>
      <input type="number" class="form-control" name="details[${rowIndex}][soh_sm]" value="0" required>
    </div>
    <div class="col-md-2">
      <label>Jumlah Order</label>
      <input type="number" class="form-control" name="details[${rowIndex}][jumlah_order]" value="0">
    </div>
    <div class="col-md-2">
      <label>MIT</label>
      <input type="number" class="form-control" name="details[${rowIndex}][mit]" value="0">
    </div>
    <div class="col-md-2">
      <label>D.OUT</label>
      <input type="number" class="form-control" name="details[${rowIndex}][d_out]" value="0">
    </div>
    <div class="col-md-3">
      <label>Brand</label>
      <div class="input-group">
        <select class="form-select brand-select" name="details[${rowIndex}][brand_id]" id="addBrand" required></select>
        <button class="btn btn-outline-secondary" type="button" data-bs-toggle="modal" data-bs-target="#modalAddBrand">+</button>
      </div>
    </div>
    <div class="col-md-1">
      <label>&nbsp;</label>
      <button type="button" class="btn btn-danger w-100" onclick="this.closest('.row').remove(); hitungTotalSOH();">×</button>
    </div>
  `;
  document.getElementById('detailRows').appendChild(row);
  refreshDropdown($(row).find('.brand-select'), 'fetchBrands');
  rowIndex++;
}

</script>
</body>
</html>