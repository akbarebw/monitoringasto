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
  <title>REMAN ASTO - Stok Minimum</title>
  <link href="./assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="./assets/css/main.css" rel="stylesheet">
  <script src="./assets/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="./assets/js/jquery.js"></script>
  <link rel="icon" type="image/x-icon" href="./assets/src/favicon.png">
</head>

<body>
  <div class="modal fade" id="insertModal" tabindex="-1" aria-labelledby="insertModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Insert Stok Minimum</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row g-3">
            <h6 class="text-uppercase text-muted">Informasi Item</h6>
            <?php
            $infoFields = ['mnemonic', 'old_sc', 'old_pn', 'new_pn', 'description'];
            foreach ($infoFields as $f) {
              echo "<div class='col-md-6'>
              <label class='form-label text-uppercase'>" . strtoupper($f) . "</label>
              <input type='text' class='form-control' id='add_{$f}' placeholder='{$f}'>
            </div>";
            }
            ?>

            <hr class="my-2">
            <h6 class="text-uppercase text-muted">Level Stok</h6>
            <?php
            $stokFields = ['min_stock', 'max_stock', 'oh_skk'];
            foreach ($stokFields as $f) {
              echo "<div class='col-md-4'>
              <label class='form-label text-uppercase'>" . strtoupper($f) . "</label>
              <input type='number' class='form-control' id='add_{$f}' placeholder='{$f}'>
            </div>";
            }
            ?>

            <hr class="my-2">
            <h6 class="text-uppercase text-muted">Informasi PO</h6>
            <?php
            $poFields = ['total_po', 'incoming', 'eta'];
            foreach ($poFields as $f) {
              $type = ($f === 'eta') ? 'date' : 'number';
              echo "<div class='col-md-4'>
              <label class='form-label text-uppercase'>" . strtoupper($f) . "</label>
              <input type='{$type}' class='form-control' id='add_{$f}' placeholder='{$f}'>
            </div>";
            }
            ?>

            <hr class="my-2">
            <h6 class="text-uppercase text-muted">Status & Keterangan</h6>
            <?php
            $metaFields = ['status', 'remark'];
            foreach ($metaFields as $f) {
              echo "<div class='col-md-4'>
              <label class='form-label text-uppercase'>" . strtoupper($f) . "</label>
              <input type='text' class='form-control' id='add_{$f}' placeholder='{$f}'>
            </div>";
            }
            ?>
          </div>
        </div>

        <div class="modal-footer">
          <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button class="btn btn-primary" id="saveData">Insert</button>
        </div>
      </div>
    </div>
  </div>
  <!-- modal update -->
  <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Stok Minimum</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <input type="hidden" id="edit_id">
          <div class="row g-3">
            <h6 class="text-uppercase text-muted">Informasi Item</h6>
            <?php
            $infoFields = ['mnemonic', 'old_sc', 'old_pn', 'new_pn', 'description'];
            foreach ($infoFields as $f) {
              echo "<div class='col-md-6'>
              <label class='form-label text-uppercase'>" . strtoupper($f) . "</label>
              <input type='text' class='form-control' id='edit_{$f}' placeholder='{$f}'>
            </div>";
            }
            ?>

            <hr class="my-2">
            <h6 class="text-uppercase text-muted">Level Stok</h6>
            <?php
            $stokFields = ['min_stock', 'max_stock', 'oh_skk'];
            foreach ($stokFields as $f) {
              echo "<div class='col-md-4'>
              <label class='form-label text-uppercase'>" . strtoupper($f) . "</label>
              <input type='number' class='form-control' id='edit_{$f}' placeholder='{$f}'>
            </div>";
            }
            ?>

            <hr class="my-2">
            <h6 class="text-uppercase text-muted">Informasi PO</h6>
            <?php
            $poFields = ['total_po', 'incoming', 'eta'];
            foreach ($poFields as $f) {
              $type = ($f === 'eta') ? 'date' : 'number';
              echo "<div class='col-md-4'>
              <label class='form-label text-uppercase'>" . strtoupper($f) . "</label>
              <input type='{$type}' class='form-control' id='edit_{$f}' placeholder='{$f}'>
            </div>";
            }
            ?>

            <hr class="my-2">
            <h6 class="text-uppercase text-muted">Status & Keterangan</h6>
            <?php
            $metaFields = ['status', 'remark'];
            foreach ($metaFields as $f) {
              echo "<div class='col-md-4'>
              <label class='form-label text-uppercase'>" . strtoupper($f) . "</label>
              <input type='text' class='form-control' id='edit_{$f}' placeholder='{$f}'>
            </div>";
            }
            ?>
          </div>
        </div>

        <div class="modal-footer">
          <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button class="btn btn-primary" id="updateData">Update</button>
        </div>
      </div>
    </div>
  </div>

  <!-- modal upload txt -->
  <div class="modal fade" id="uploadTxtModal" tabindex="-1" aria-labelledby="uploadTxtModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Upload File TXT - Import Stok Minimum</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="uploadTxtForm" enctype="multipart/form-data">
          <div class="modal-body">
            <div class="mb-3">
              <input type="file" name="stok_file" id="stok_file" accept=".txt" class="form-control" required>
            </div>
            <div id="uploadTxtFeedback"></div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Upload dan Import</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-2 sidebar vh-100 p-3">
        <?php include_once './sidebar.php' ?>
      </div>
      <div class="col main p-3">
        <div class="page-header d-flex flex-column">
          <div class="text-uppercase flex-grow-1 align-content-end mb-2">
            <h1 style="font-weight: bold">STOK MINIMUM</h1>
          </div>
          <div class="profile-wrapper">
            <div class="d-flex flex-row mb-3">
              <div><img src="./assets/src/dinda.jpg" class="me-3" style="width: 50px; height: 50px; border-radius: 100%"></div>
              <div class="flex-grow-1 d-flex flex-column">
                <p style="font-weight: bolder">Dinda Ayu<br />Plant Planner</p>
              </div>
            </div>
            <div class="profile-card card">
              <div class="d-flex flex-row">
                <div><img src="./assets/src/dinda.jpg" class="me-3" style="width: 50px; height: 50px; border-radius: 100%"></div>
                <div class="flex-grow-1 d-flex flex-column">
                  <p style="font-size: large; font-weight: 600">Dinda Ayu Amalia<br /><span style="font-size: smaller; font-weight: 400">Plant Planner</span></p>
                </div>
              </div>
              <div class="d-flex flex-row align-items-center align-content-center">
                <a class="d-flex flex-row align-items-center text-decoration-none text-black me-3" href="mailto:dinda.amalia@kppmining.com">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#000" height="20px" class="me-1">
                    <path d="M3 3H21C21.5523 3 22 3.44772 22 4V20C22 20.5523 21.5523 21 21 21H3C2.44772 21 2 20.5523 2 20V4C2 3.44772 2.44772 3 3 3ZM20 7.23792L12.0718 14.338L4 7.21594V19H20V7.23792ZM4.51146 5L12.0619 11.662L19.501 5H4.51146Z"></path>
                  </svg> <span style="font-size: large">Send email</span>
                </a>
                <a href="https://www.linkedin.com/in/dinda-ayu-amalia-ba70a622a">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" height="24px" fill="#0a53be">
                    <path d="M18.3362 18.339H15.6707V14.1622C15.6707 13.1662 15.6505 11.8845 14.2817 11.8845C12.892 11.8845 12.6797 12.9683 12.6797 14.0887V18.339H10.0142V9.75H12.5747V10.9207H12.6092C12.967 10.2457 13.837 9.53325 15.1367 9.53325C17.8375 9.53325 18.337 11.3108 18.337 13.6245V18.339H18.3362Z"></path>
                  </svg>
                </a>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <div class="card">

              <div class="card-body">

                <div class="mb-3 input-group">
                  <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">COLUMN SEARCH</button>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item search-item" href="#">MNEMONIC</a></li>
                    <li><a class="dropdown-item search-item" href="#">DESCRIPTION</a></li>
                    <li><a class="dropdown-item search-item" href="#">STATUS</a></li>
                  </ul>
                  <input type="text" id="myInput" class="form-control" onkeyup="myFunction()" placeholder="Search for MNEMONIC..">
                  <button class="btn btn-outline-secondary" id="refresh-button">REFRESH DATA</button>
                  <button class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#insertModal">INSERT DATA</button>
                  <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#uploadTxtModal">UPLOAD TXT</button>

                </div>

                <table id="stokTable" class="table table-hover">
                  <thead>
                    <tr>
                      <th>NO</th>
                      <th>MNEMONIC</th>
                      <th>OLD SC</th>
                      <th>OLD PN</th>
                      <th>NEW PN</th>
                      <th>DESCRIPTION</th>
                      <th>MIN</th>
                      <th>MAX</th>
                      <th>OH SKK</th>
                      <th>PO</th>
                      <th>INCOMING</th>
                      <th>ETA</th>
                      <th>STATUS CLASS</th>

                      <th>REMARK</th>
                      <th colspan="2">AKSI</th>
                    </tr>
                  </thead>
                  <tbody></tbody>
                </table>
              </div>
            </div>
            <script>
              let searchColumn = 1;

              function loadData() {
                $.post('action.php', {
                  action: 'fetchstokminimum'
                }, function(response) {
                  $('#stokTable tbody').html(response);
                  $('#stokTable tbody tr').each(function(i, row) {
                    $(row).find('td:first').text(i + 1);
                  });
                });
              }

              function myFunction() {
                let input = document.getElementById("myInput");
                let filter = input.value.toUpperCase();
                let table = document.getElementById("stokTable");
                let tr = table.getElementsByTagName("tr");

                for (let i = 1; i < tr.length; i++) {
                  let td = tr[i].getElementsByTagName("td")[searchColumn];
                  if (td) {
                    let txtValue = td.textContent || td.innerText;
                    tr[i].style.display = txtValue.toUpperCase().includes(filter) ? "" : "none";
                  }
                }
              }

              document.querySelectorAll('.search-item').forEach(item => {
                item.addEventListener('click', function(e) {
                  let selected = e.target.textContent;
                  let index = 1;
                  if (selected === "DESCRIPTION") index = 5;
                  else if (selected === "STATUS") index = 12;
                  searchColumn = index;
                  document.getElementById("myInput").placeholder = `Search for ${selected}...`;
                });
              });

              $(document).ready(function() {
                loadData();

                $('#refresh-button').click(loadData);

                $('#saveData').click(function() {
                  let data = {
                    action: 'insertstokminimum'
                  };
                  const fields = [
                    'mnemonic', 'old_sc', 'old_pn', 'new_pn', 'description',
                    'min_stock', 'max_stock', 'oh_skk', 'total_po', 'incoming',
                    'eta', 'status', 'remark'
                  ];
                  fields.forEach(f => data[f] = $('#add_' + f).val() || "");

                  $.ajax({
                    url: 'action.php',
                    type: 'POST',
                    data: data,
                    success: function(response) {
                      if (response.toLowerCase().includes("error")) {
                        alert("Terjadi masalah saat insert:\n" + response);
                      } else {
                        alert('Data inserted successfully');
                        $('#insertModal').modal('hide');
                        setTimeout(loadData, 300); // Delay to ensure modal transition
                      }
                    },
                    error: function(xhr, status, error) {
                      alert("AJAX Error:\nStatus: " + status + "\nMessage: " + error + "\nResponse: " + xhr.responseText);
                    }
                  });
                });

                // Tombol Edit
                $(document).on('click', '.edit', function() {
                  const row = $(this).closest('tr');
                  const id = $(this).data('id');

                  $('#edit_id').val(id);
                  $('#edit_mnemonic').val(row.find('td').eq(1).text());
                  $('#edit_old_sc').val(row.find('td').eq(2).text());
                  $('#edit_old_pn').val(row.find('td').eq(3).text());
                  $('#edit_new_pn').val(row.find('td').eq(4).text());
                  $('#edit_description').val(row.find('td').eq(5).text());
                  $('#edit_min_stock').val(row.find('td').eq(6).text());
                  $('#edit_max_stock').val(row.find('td').eq(7).text());
                  $('#edit_oh_skk').val(row.find('td').eq(8).text());
                  $('#edit_total_po').val(row.find('td').eq(9).text());
                  $('#edit_incoming').val(row.find('td').eq(10).text());

                  const etaRaw = row.find('td').eq(11).text().trim();
                  $('#edit_eta').val(etaRaw !== '-' ? etaRaw.split('/').reverse().join('-') : '');

                  $('#edit_status').val(row.find('td').eq(12).text());
                  $('#edit_remark').val(row.find('td').eq(13).text());

                  $('#editModal').modal('show');
                });

                // Tombol Update
                $('#updateData').click(function() {
                  let data = {
                    action: 'updatestokminimum',
                    id: $('#edit_id').val()
                  };
                  const fields = ['mnemonic', 'old_sc', 'old_pn', 'new_pn', 'description',
                    'min_stock', 'max_stock', 'oh_skk', 'total_po', 'incoming', 'eta', 'status', 'remark'
                  ];
                  fields.forEach(f => data[f] = $('#edit_' + f).val() || "");

                  $.post('action.php', data, function(res) {
                    alert("Update berhasil");
                    $('#editModal').modal('hide');
                    setTimeout(loadData, 300);
                  }).fail(function(xhr) {
                    alert("Gagal update:\n" + xhr.responseText);
                  });
                });

                // Tombol Delete
                $(document).on('click', '.delete', function() {
                  const id = $(this).data('id');
                  if (confirm('Yakin ingin menghapus data ini?')) {
                    $.post('action.php', {
                      action: 'deletestokminimum',
                      id: id
                    }, function(res) {
                      alert("Data berhasil dihapus");
                      setTimeout(loadData, 300);
                    }).fail(function(xhr) {
                      alert("Gagal hapus:\n" + xhr.responseText);
                    });
                  }
                });
              });
              $(document).ready(function() {
                $('#uploadTxtForm').on('submit', function(e) {
                  e.preventDefault();
                  var formData = new FormData(this);

                  $.ajax({
                    url: 'import_stok_process.php',
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                      $('#uploadTxtFeedback').html('<div class="alert alert-info">' + response + '</div>');
                      setTimeout(function() {
                        $('#uploadTxtModal').modal('hide');
                        loadData();
                      }, 2000);
                    },
                    error: function(xhr, status, error) {
                      $('#uploadTxtFeedback').html('<div class="alert alert-danger">Upload gagal: ' + error + '</div>');
                    }
                  });
                });
              });
            </script>

          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>