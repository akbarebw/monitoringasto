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
    <title>REMAN ASTO - Out of Stock</title>
    <link href="./assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="./assets/css/main.css" rel="stylesheet">
    <script src="./assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="./assets/js/jquery.js"></script>
    <link rel="icon" type="image/x-icon" href="./assets/src/favicon.png">
</head>
<body>
<div class="modal fade" id="insertModal" tabindex="-1" aria-labelledby="insertModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Insert Out of Stock Data</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <div class="mb-3">
                        <label class="form-label">COMPONENT</label>
                        <input type="text" class="form-control" id="addComponent" placeholder="COMPONENT...">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">PN</label>
                        <input type="text" class="form-control" id="addPN" placeholder="PN...">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">APL</label>
                        <input type="text" class="form-control" id="addAPL" placeholder="APL...">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">QTY</label>
                        <input type="number" class="form-control" id="addQTY" placeholder="QTY...">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">STOCK KPP</label>
                        <input type="number" class="form-control" id="addStokKPP" placeholder="STOCK KPP...">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">FEEDBACK UT</label>
                        <input type="number" class="form-control" id="addFeedbackUT" placeholder="FEEDBACK UT...">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">WR</label>
                        <input type="text" class="form-control" id="addWR" placeholder="WR...">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">ETA</label>
                        <input type="date" class="form-control" id="addETA">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">REMARK</label>
                        <input type="text" class="form-control" id="addRemark" placeholder="REMARK...">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">STATUS</label>
                        <select class="form-select" id="addStatus">
                            <option value="OPEN" selected>OPEN</option>
                            <option value="BLANK">BLANK</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveData">Insert Data</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Out of Stock Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="editId"> <!-- Hidden input untuk menyimpan ID -->
                <div class="mb-3">
                    <label class="form-label">COMPONENT</label>
                    <input type="text" class="form-control" id="editComponent" placeholder="COMPONENT...">
                </div>
                <div class="mb-3">
                    <label class="form-label">PN</label>
                    <input type="text" class="form-control" id="editPN" placeholder="PN...">
                </div>
                <div class="mb-3">
                    <label class="form-label">APL</label>
                    <input type="text" class="form-control" id="editAPL" placeholder="APL...">
                </div>
                <div class="mb-3">
                    <label class="form-label">QTY</label>
                    <input type="number" class="form-control" id="editQTY" placeholder="QTY...">
                </div>
                <div class="mb-3">
                    <label class="form-label">STOCK KPP</label>
                    <input type="number" class="form-control" id="editStokKPP" placeholder="STOCK KPP...">
                </div>
                <div class="mb-3">
                    <label class="form-label">FEEDBACK UT</label>
                    <input type="number" class="form-control" id="editFeedbackUT" placeholder="FEEDBACK UT...">
                </div>
                <div class="mb-3">
                    <label class="form-label">WR</label>
                    <input type="text" class="form-control" id="editWR" placeholder="WR...">
                </div>
                <div class="mb-3">
                    <label class="form-label">ETA</label>
                    <input type="date" class="form-control" id="editETA">
                </div>
                <div class="mb-3">
                    <label class="form-label">REMARK</label>
                    <input type="text" class="form-control" id="editRemark" placeholder="REMARK...">
                </div>
                <div class="mb-3">
                    <label class="form-label">STATUS</label>
                    <select class="form-select" id="editStatus">
                        <option value="OPEN" id="editOPEN">OPEN</option>
                        <option value="BLANK" id="editBLANK">BLANK</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveEditButton">Save Changes</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Delete Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this item?</p>
                <input type="hidden" id="deleteId"> <!-- Hidden input untuk menyimpan ID -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteButton">Delete</button>
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
                    <h1 style="font-weight: bold">OUT OF STOCK</h1>
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
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-3 input-group">
                                <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">COLUMN SEARCH</button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item search-item" href="#">COMPONENT</a></li>
                                    <li><a class="dropdown-item search-item" href="#">PN</a></li>
                                    <li><a class="dropdown-item search-item" href="#">APL</a></li>
                                    <li><a class="dropdown-item search-item" href="#">QTY</a></li>
                                    <li><a class="dropdown-item search-item" href="#">STOK KPP</a></li>
                                    <li><a class="dropdown-item search-item" href="#">FEEDBACK UT</a></li>
                                    <li><a class="dropdown-item search-item" href="#">WR</a></li>
                                    <li><a class="dropdown-item search-item" href="#">ETA</a></li>
                                    <li><a class="dropdown-item search-item" href="#">STATUS</a></li>
                                </ul>

                                <input type="text" id="myInput" class="form-control" onkeyup="myFunction()" placeholder="Search for COMPONENT..">

                                <button class="btn btn-outline-secondary" type="button" id="refresh-button">REFRESH DATA</button>
                                <button class="btn btn-outline-secondary" type="button" data-bs-toggle="modal" data-bs-target="#insertModal">INSERT DATA</button>

                            </div>

                            <table id="myTable" class="table table-hover">
                                <thead>
                                <tr class="header" valign="middle">
                                    <th style="width:5%;">NO</th>
                                    <th style="width:40%;">COMPONENT</th>
                                    <th>PN</th>
                                    <th>APL</th>
                                    <th>QTY</th>
                                    <th>STOK KPP</th>
                                    <th>FEEDBACK UT</th>
                                    <th>WR</th>
                                    <th>ETA</th>
                                    <th>STATUS</th>
                                    <th>REMARK</th>
                                    <th colspan="2">AKSI</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>TRANSMISI GRS0935</td>
                                    <td>XXX</td>
                                    <td>XXX</td>
                                    <td>4</td>
                                    <td>2</td>
                                    <td>6</td>
                                    <td>F28298</td>
                                    <td>02/12/2024</td>
                                    <td>OPEN</td>
                                    <td>EDIT</td>
                                </tr>
                                <tr>
                                    <td>Berglunds snabbkop</td>
                                    <td>Sweden</td>
                                </tr>
                                <tr>
                                    <td>Island Trading</td>
                                    <td>UK</td>
                                </tr>
                                <tr>
                                    <td>Koniglich Essen</td>
                                    <td>Germany</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <script>
                        let searchColumn = 1; // Defaultnya kolom kedua (COMPONENT)
                        let placeholderText = "Search for components.."; // Placeholder awal

                        function changeSearchColumn(columnIndex, placeholder) {
                            searchColumn = columnIndex; // Mengubah indeks kolom
                            placeholderText = placeholder; // Mengubah placeholder
                            document.getElementById("myInput").placeholder = placeholderText; // Update placeholder input
                        }

                        function myFunction() {
                            // Declare variables
                            var input, filter, table, tr, td, i, txtValue;
                            input = document.getElementById("myInput");
                            filter = input.value.toUpperCase();
                            table = document.getElementById("myTable");
                            tr = table.getElementsByTagName("tr");

                            // Loop through all table rows, and hide those who don't match the search query
                            for (i = 0; i < tr.length; i++) {
                                td = tr[i].getElementsByTagName("td")[searchColumn];
                                if (td) {
                                    txtValue = td.textContent || td.innerText;
                                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                                        tr[i].style.display = "";
                                    } else {
                                        tr[i].style.display = "none";
                                    }
                                }
                            }
                        }

                        document.querySelectorAll('.search-item').forEach(item => {
                            item.addEventListener('click', function(e) {
                                let selectedColumn = e.target.textContent; // Ambil teks pilihan
                                let columnIndex = 1;
                                let placeholder = "Search for components..";

                                if (selectedColumn === "REMARK") {
                                    columnIndex = 10;
                                    placeholder = "Search for REMARK...";
                                }
                                else if (selectedColumn === "STATUS") {
                                    columnIndex = 9;
                                    placeholder = "Search for STATUS...";
                                } else if (selectedColumn === "ETA") {
                                    columnIndex = 8;
                                    placeholder = "Search for ETA...";
                                } else if (selectedColumn === "WR") {
                                    columnIndex = 7;
                                    placeholder = "Search for WR...";
                                } else if (selectedColumn === "FEEDBACK UT") {
                                    columnIndex = 6;
                                    placeholder = "Search for FEEDBACK UT...";
                                } else if (selectedColumn === "STOK KPP") {
                                    columnIndex = 5;
                                    placeholder = "Search for STOK KPP...";
                                } else if (selectedColumn === "QTY") {
                                    columnIndex = 4;
                                    placeholder = "Search for QTY...";
                                } else if (selectedColumn === "APL") {
                                    columnIndex = 3;
                                    placeholder = "Search for APL...";
                                } else if (selectedColumn === "PN") {
                                    columnIndex = 2;
                                    placeholder = "Search for PN...";
                                } else if (selectedColumn === "COMPONENT") {
                                    columnIndex = 1;
                                    placeholder = "Search for COMPONENT...";
                                }

                                changeSearchColumn(columnIndex, placeholder); // Ubah pencarian
                            });
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {

        function loadData() {
            $.ajax({
                url: 'action.php',
                type: 'POST',
                data: { action: 'fetchoutofstock' },
                success: function (response) {
                    $('#myTable tbody').html(response);

                    let rows = $('#myTable tbody tr');
                    rows.sort(function (a, b) {
                        return $(a).data('id') - $(b).data('id'); // Urutkan berdasarkan id
                    });
                    rows.each(function (index, row) {
                        $(row).find('.row-number').text(index + 1); // Tambahkan nomor urut
                    });
                }
            });
        }
        // Muat data awal
        loadData();

        $('#refresh-button').on('click', function () {
            loadData(); // Muat ulang data dengan filter terakhir digunakan
        });

        $('#saveData').on('click', function () {
            const component = $('#addComponent').val();
            const pn = $('#addPN').val();
            const apl = $('#addAPL').val();
            const qty = $('#addQTY').val();
            const stokkpp = $('#addStokKPP').val();
            const feedbackut = $('#addFeedbackUT').val();
            const wr = $('#addWR').val();
            const eta = $('#addETA').val();
            const status = $('#addStatus').val();
            const remark = $('#addRemark').val();

            // Validasi: Jika komponen kosong atau EGI belum dipilih
            if (component === '') {
                alert('Component must be selected!');
                return;  // Hentikan eksekusi jika validasi gagal
            }

            $.ajax({
                url: 'action.php', // URL untuk proses AJAX
                type: 'POST',
                data: {
                    action: 'insertoutofstock',  // Aksi untuk mengidentifikasi permintaan ini
                    component: component,
                    pn: pn,
                    apl: apl,
                    qty: qty,
                    stokkpp: stokkpp,
                    feedbackut: feedbackut,
                    wr: wr,
                    eta: eta,
                    status: status,
                    remark: remark
                },
                success: function (response) {
                    alert('Data inserted successfully');
                    $('#insertModal').modal('hide');  // Close modal after submit
                    loadData();  // Refresh table or whatever data display you're using
                },
                error: function (xhr, status, error) {
                    alert('Error inserting data: ' + error);
                }
            });
        });

        // Tombol Edit
        $(document).on('click', '.edit', function () {
            const id = $(this).data('id');
            const component = $(this).data('component');
            const pn = $(this).data('pn');
            const apl = $(this).data('apl');
            const qty = $(this).data('qty');
            const stokkpp = $(this).data('stokkpp');
            const feedbackut = $(this).data('feedbackut');
            const wr = $(this).data('wr');
            const eta = $(this).data('eta');
            const remark = $(this).data('remark');
            const status = $(this).data('status');
            document.getElementById('editStatus').value = $(this).data('status');

            // Isi nilai ke dalam modal
            $('#editId').val(id);
            $('#editComponent').val(component);
            $('#editPN').val(pn);
            $('#editAPL').val(apl);
            $('#editQTY').val(qty);
            $('#editStokKPP').val(stokkpp);
            $('#editFeedbackUT').val(feedbackut);
            $('#editWR').val(wr);
            $('#editETA').val(eta);
            $('#editStatus').val(status);
            $('#editRemark').val(remark);

            // Tampilkan modal
            $('#editModal').modal('show');
        });

        // Simpan perubahan pada modal Edit
        $('#saveEditButton').on('click', function () {
            const id = $('#editId').val();
            const component = $('#editComponent').val();
            const pn = $('#editPN').val();
            const apl = $('#editAPL').val();
            const qty = $('#editQTY').val();
            const stokkpp = $('#editStokKPP').val();
            const feedbackut = $('#editFeedbackUT').val();
            const wr = $('#editWR').val();
            const eta = $('#editETA').val();
            const status = $('#editStatus').val();
            const remark = $('#editRemark').val();

            // Validasi: Jika komponen kosong atau EGI belum dipilih
            if (component === '') {
                alert('Component must be selected!');
                return;  // Hentikan eksekusi jika validasi gagal
            }

            $.ajax({
                url: 'action.php',
                type: 'POST',
                data: {
                    action: 'editoutofstock',
                    id: id,
                    component: component,
                    pn: pn,
                    apl: apl,
                    qty: qty,
                    stokkpp: stokkpp,
                    feedbackut: feedbackut,
                    wr: wr,
                    eta: eta,
                    status: status,
                    remark: remark
                },
                success: function (response) {
                    alert('Data updated successfully');
                    $('#editModal').modal('hide');
                    loadData(); // Refresh tabel
                }
            });
        });
        // Tombol Delete
        $(document).on('click', '.delete', function () {
            const id = $(this).data('id');

            // Simpan ID ke modal
            $('#deleteId').val(id);

            // Tampilkan modal
            $('#deleteModal').modal('show');
        });
        // Hapus data pada modal Delete
        $('#confirmDeleteButton').on('click', function () {
            const id = $('#deleteId').val();

            $.ajax({
                url: 'action.php',
                type: 'POST',
                data: {
                    action: 'deleteoutofstock',
                    id: id
                },
                success: function (response) {
                    alert('Data deleted successfully');
                    $('#deleteModal').modal('hide');
                    loadData(); // Refresh tabel
                }
            });
        });
    });
</script>
</body>
</html>
