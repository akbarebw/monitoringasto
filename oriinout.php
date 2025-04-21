<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REMAN ASTO - In/Out</title>
    <link href="./assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="./assets/css/main.css" rel="stylesheet">
    <script src="./assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="./assets/js/jquery.js"></script>
    <link rel="icon" type="image/x-icon" href="./assets/src/favicon.png">
    <script>
        function selectEgi(value) {
            console.log(value);
            document.getElementById('editEgiBtn').innerText = value;
            document.getElementById('addEgiBtn').innerText = value;
            document.getElementById('selectedEgi').value = value;
        }
    </script>
</head>
<body>
<div class="modal fade" id="insertModal" tabindex="-1" aria-labelledby="insertModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Insert In/Out Data</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <div class="mb-3">
                        <label class="form-label">EGI</label>
                        <button class="btn btn-outline-secondary dropdown-toggle w-100 text-start" type="button" data-bs-toggle="dropdown" aria-expanded="false" id="addEgiBtn">
                            Choose EGI
                        </button>
                        <ul class="dropdown-menu" style="width: calc(100% - 30px)" aria-labelledby="addEgiBtn" id="addEgiDropdown">
                            <li>
                                <input type="text" class="form-control" id="dropdownSearch" onkeyup="filterDropdown(this)" placeholder="Search...">
                            </li>
                            <li><a class="dropdown-item" href="#" onclick="selectEgi('CR0012')">CR0012</a></li>
                            <li><a class="dropdown-item" href="#" onclick="selectEgi('P410XT')">P410XT</a></li>
                            <li><a class="dropdown-item" href="#" onclick="selectEgi('P410')">P410</a></li>
                            <li><a class="dropdown-item" href="#" onclick="selectEgi('P410B6X4')">P410B6X4</a></li>
                            <li><a class="dropdown-item" href="#" onclick="selectEgi('P410B8X4')">P410B8X4</a></li>
                            <li><a class="dropdown-item" href="#" onclick="selectEgi('P460B8X4')">P460B8X4</a></li>
                            <li><a class="dropdown-item" href="#" onclick="selectEgi('P360')">P360</a></li>
                            <li><a class="dropdown-item" href="#" onclick="selectEgi('P360CB6X4')">P360CB6X4</a></li>
                            <li><a class="dropdown-item" href="#" onclick="selectEgi('P360CB6X6')">P360CB6X6</a></li>
                            <li><a class="dropdown-item" href="#" onclick="selectEgi('P380')">P380</a></li>
                            <li><a class="dropdown-item" href="#" onclick="selectEgi('GD 825')">GD 825</a></li>
                            <li><a class="dropdown-item" href="#" onclick="selectEgi('GD 705')">GD 705</a></li>
                            <li><a class="dropdown-item" href="#" onclick="selectEgi('PC 200-8')">PC 200-8</a></li>
                            <li><a class="dropdown-item" href="#" onclick="selectEgi('R140W-9S')">R140W-9S</a></li>
                            <li><a class="dropdown-item" href="#" onclick="selectEgi('WA600-3')">WA600-3</a></li>
                            <li><a class="dropdown-item" href="#" onclick="selectEgi('WATER TRUCK')">WATER TRUCK</a></li>
                            <li><a class="dropdown-item" href="#" onclick="selectEgi('WATER FILL')">WATER FILL</a></li>
                        </ul>
                    </div>
                    <input type="hidden" id="selectedEgi">

                    <div class="mb-3">
                        <label class="form-label">TYPE COMPONENT</label>
                        <input type="text" class="form-control" id="addComponent" placeholder="TYPE COMPONENT...">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">REMOVE FROM</label>
                        <input type="text" class="form-control" id="addExunit" placeholder="REMOVE FROM...">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">DATE REMOVE</label><br/>
                        <div class="mb-2 row">
                            <label class="col">
                                <input type="radio" name="optionR" value="yes" onclick="toggleDateRInput(true)" id="radioRYes"> ALREADY REMOVED
                            </label>
                            <label class="col">
                                <input type="radio" name="optionR" value="no" onclick="toggleDateRInput(false)" id="radioRNo" checked> NOT REMOVED YET
                            </label>
                        </div>
                        <input type="date" class="form-control" id="addDateRemove" disabled>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">PN</label>
                        <input type="text" class="form-control" id="addPN" placeholder="PN...">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">DATE INSTALL</label><br/>
                        <div class="mb-2 row">
                            <label class="col">
                                <input type="radio" name="optionI" value="yes" onclick="toggleDateIInput(true)" id="radioIYes"> ALREADY INSTALLED
                            </label>
                            <label class="col">
                                <input type="radio" name="optionI" value="no" onclick="toggleDateIInput(false)" id="radioINo" checked> NOT INSTALLED YET
                            </label>
                        </div>
                        <input type="date" class="form-control" id="addDateInstall" disabled>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">INSTALL TO</label>
                        <input type="text" class="form-control" id="addInstallTo" placeholder="INSTALL TO...">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">HOUR METER</label>
                        <input type="text" class="form-control" id="addHourMeter" placeholder="HOUR METER...">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">MAN POWER OF OVH</label>
                        <input type="text" class="form-control" id="addMPOVH" placeholder="MAN POWER OF OVH...">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">MAN POWER OF INSTALL</label>
                        <input type="text" class="form-control" id="addMPINS" placeholder="MAN POWER OF INSTALL...">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">REMARKS</label>
                        <input type="text" class="form-control" id="addRemarks" placeholder="REMARKS...">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">STATUS</label>
                        <input type="text" class="form-control" id="addStatus" placeholder="STATUS...">
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
                <h5 class="modal-title" id="editModalLabel">Edit In/Out Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="editId"> <!-- Hidden input untuk menyimpan ID -->
                <div class="mb-3">
                    <label class="form-label">EGI</label>
                    <button class="btn btn-outline-secondary dropdown-toggle w-100 text-start" type="button" data-bs-toggle="dropdown" aria-expanded="false" id="editEgiBtn">
                        Choose EGI
                    </button>
                    <ul class="dropdown-menu" style="width: calc(100% - 30px)" aria-labelledby="editEgiBtn" id="editEgiDropdown">
                        <li>
                            <input type="text" class="form-control" id="dropdownSearchEdit" onkeyup="filterDropdown(this)" placeholder="Search...">
                        </li>
                        <li><a class="dropdown-item" href="#" onclick="selectEgi('CR0012')">CR0012</a></li>
                        <li><a class="dropdown-item" href="#" onclick="selectEgi('P410XT')">P410XT</a></li>
                        <li><a class="dropdown-item" href="#" onclick="selectEgi('P410')">P410</a></li>
                        <li><a class="dropdown-item" href="#" onclick="selectEgi('P410B6X4')">P410B6X4</a></li>
                        <li><a class="dropdown-item" href="#" onclick="selectEgi('P410B8X4')">P410B8X4</a></li>
                        <li><a class="dropdown-item" href="#" onclick="selectEgi('P460B8X4')">P460B8X4</a></li>
                        <li><a class="dropdown-item" href="#" onclick="selectEgi('P360')">P360</a></li>
                        <li><a class="dropdown-item" href="#" onclick="selectEgi('P360CB6X4')">P360CB6X4</a></li>
                        <li><a class="dropdown-item" href="#" onclick="selectEgi('P360CB6X6')">P360CB6X6</a></li>
                        <li><a class="dropdown-item" href="#" onclick="selectEgi('P380')">P380</a></li>
                        <li><a class="dropdown-item" href="#" onclick="selectEgi('GD 825')">GD 825</a></li>
                        <li><a class="dropdown-item" href="#" onclick="selectEgi('GD 705')">GD 705</a></li>
                        <li><a class="dropdown-item" href="#" onclick="selectEgi('PC 200-8')">PC 200-8</a></li>
                        <li><a class="dropdown-item" href="#" onclick="selectEgi('R140W-9S')">R140W-9S</a></li>
                        <li><a class="dropdown-item" href="#" onclick="selectEgi('WA600-3')">WA600-3</a></li>
                        <li><a class="dropdown-item" href="#" onclick="selectEgi('WATER TRUCK')">WATER TRUCK</a></li>
                        <li><a class="dropdown-item" href="#" onclick="selectEgi('WATER FILL')">WATER FILL</a></li>
                    </ul>
                </div>
                <!-- Input Hidden -->
                <input type="hidden" id="selectedEgi">

                <div class="mb-3">
                    <label class="form-label">COMPONENT</label>
                    <input type="text" class="form-control" id="editComponent" placeholder="COMPONENT...">
                </div>
                <div class="mb-3">
                    <label class="form-label">PN</label>
                    <input type="text" class="form-control" id="editPN" placeholder="PN...">
                </div>
                <div class="mb-3">
                    <label class="form-label">QTY</label>
                    <input type="number" class="form-control" id="editQTY" placeholder="QTY...">
                </div>
                <div class="mb-3">
                    <label class="form-label">EX. UNIT</label>
                    <input type="text" class="form-control" id="editEXUnit" placeholder="EX. UNIT...">
                </div>
                <div class="mb-3">
                    <label class="form-label">DATE IN</label>
                    <input type="date" id="editDateIn" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">ALOKASI</label>
                    <input type="text" class="form-control" id="editAlokasi" placeholder="ALOKASI...">
                </div>
                <div class="mb-3">
                    <label class="form-label">DATE OUT</label><br/>
                    <div class="mb-2 row">
                        <label class="col">
                            <input type="radio" name="option" value="yes" id="editRadioYes" onclick="toggleDateInput(true)"> ALREADY OUT
                        </label>
                        <label class="col">
                            <input type="radio" name="option" value="no" id="editRadioNo" onclick="toggleDateInput(false)"> NOT OUT YET
                        </label>
                    </div>
                    <input type="date" class="form-control" id="editDateOut" disabled>
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
<div class="modal fade" id="fotoModal" tabindex="-1" aria-labelledby="fotoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="fotoModalLabel">Foto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="fotoForm" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" id="fotoId" name="id">
                    <div id="fotoPreview" class="mb-3">
                        <!-- Tempat preview gambar -->
                    </div>
                    <label for="foto" class="form-label">Upload Foto</label>
                    <input type="file" id="foto" name="foto" class="form-control" accept=".png, .jpg, .jpeg">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
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
                    <h1 style="font-weight: bold">IN/OUT</h1>
                </div>
                <div class="d-flex flex-row">
                    <div><img src="./assets/src/dinda.jpg" class="me-3" style="width: 50px; height: 50px; border-radius: 100%"></div>
                    <div class="flex-grow-1 d-flex flex-column">
                        <p style="font-weight: bolder">Dinda Ayu
                            <br/>
                            Plant Planner</p>
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
                                    <li><a class="dropdown-item search-item" href="#">PIC</a></li>
                                    <li><a class="dropdown-item search-item" href="#">COMPONENT</a></li>
                                    <li><a class="dropdown-item search-item" href="#">PN</a></li>
                                    <li><a class="dropdown-item search-item" href="#">QTY</a></li>
                                    <li><a class="dropdown-item search-item" href="#">EX. UNIT</a></li>
                                    <li><a class="dropdown-item search-item" href="#">DATE IN</a></li>
                                    <li><a class="dropdown-item search-item" href="#">ALOKASI</a></li>
                                    <li><a class="dropdown-item search-item" href="#">DATE OUT</a></li>
                                </ul>

                                <input type="text" id="myInput" class="form-control" onkeyup="myFunction()" placeholder="Search for PIC..">

                                <button class="btn btn-outline-secondary" type="button" id="refresh-button">REFRESH DATA</button>
                                <button class="btn btn-outline-secondary" type="button" data-bs-toggle="modal" data-bs-target="#insertModal">INSERT DATA</button>

                            </div>

                            <table id="myTable" class="table table-hover">
                                <thead>
                                <tr class="header" valign="middle">
                                    <th style="width:5%;" rowspan="2">NO</th>
                                    <th colspan="2">OVERHAUL COMPONENT</th>
                                    <th rowspan="2">REMOVE FROM</th>
                                    <th rowspan="2">DATE REMOVE</th>
                                    <th rowspan="2">SN/PN</th>
                                    <th rowspan="2">DATE INSTALL</th>
                                    <th rowspan="2">INSTALL TO</th>
                                    <th rowspan="2">HOUR METER</th>
                                    <th rowspan="2">MAN POWER OF OVH</th>
                                    <th rowspan="2">MAN POWER OF INSTALL</th>
                                    <th rowspan="2">REMARKS</th>
                                    <th rowspan="2">STATUS</th>
                                    <th rowspan="2" colspan="3" style="width:10%;">AKSI</th>
                                </tr>
                                <tr class="header" valign="middle">
                                    <th>EGI</th>
                                    <th>TYPE COMPONENT</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>FAID</td>
                                    <td>DIFF RBP900</td>
                                    <td>XXX</td>
                                    <td>1</td>
                                    <td>LD0345</td>
                                    <td>28/12/2024</td>
                                    <td>LD0365</td>
                                    <td>05/02/2025</td>
                                    <td>FOTO</td>
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
                        function toggleDateRInput(enable) {
                            var addDateRemove = document.getElementById("addDateRemove");
                            var editDateRemove = document.getElementById("editDateRemove");
                            if (enable) {
                                addDateRemove.disabled = false;
                                //editDateRemove.disabled = false;
                                addDateRemove.value = '';
                                //editDateRemove.value = '';
                            } else {
                                addDateRemove.disabled = true;
                                //editDateRemove.disabled = true;
                                addDateRemove.value = 0;
                                //editDateRemove.value = 0;
                            }
                        }
                        function toggleDateIInput(enable) {
                            var addDateInstall = document.getElementById("addDateInstall");
                            var editDateInstall = document.getElementById("editDateInstall");
                            if (enable) {
                                addDateInstall.disabled = false;
                                //editDateInstall.disabled = false;
                                addDateInstall.value = '';
                                //editDateInstall.value = '';
                            } else {
                                addDateInstall.disabled = true;
                                //editDateInstall.disabled = true;
                                addDateInstall.value = 0;
                                //editDateInstall.value = 0;
                            }
                        }

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

                                if (selectedColumn === "DATE OUT") {
                                    columnIndex = 8;
                                    placeholder = "Search for DATE OUT...";
                                } else if (selectedColumn === "ALOKASI") {
                                    columnIndex = 7;
                                    placeholder = "Search for ALOKASI...";
                                } else if (selectedColumn === "DATE IN") {
                                    columnIndex = 6;
                                    placeholder = "Search for DATE IN...";
                                } else if (selectedColumn === "EX. UNIT") {
                                    columnIndex = 5;
                                    placeholder = "Search for EX. UNIT...";
                                } else if (selectedColumn === "QTY") {
                                    columnIndex = 4;
                                    placeholder = "Search for QTY...";
                                } else if (selectedColumn === "PN") {
                                    columnIndex = 3;
                                    placeholder = "Search for PN...";
                                } else if (selectedColumn === "COMPONENT") {
                                    columnIndex = 2;
                                    placeholder = "Search for COMPONENT...";
                                } else if (selectedColumn === "PIC") {
                                    columnIndex = 1;
                                    placeholder = "Search for PIC...";
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
                data: { action: 'fetchinout' },
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
        })

        let selectedEGI = "P410XT"; // Variabel untuk menyimpan nilai EGI yang dipilih

        // Event listener untuk dropdown
        $('.egi-item').on('click', function (e) {
            e.preventDefault(); // Hindari reload halaman
            selectedEGI = $(this).text(); // Ambil teks dari item dropdown yang diklik
            loadData(selectedEGI); // Muat ulang data dengan filter EGI
            document.getElementById("label-egi").innerHTML=(selectedEGI);
            document.getElementById("myInput").value="";
        });

        $('#saveData').on('click', function () {
            const egi = $('#selectedEgi').val();  // Get value from the hidden input
            const component = $('#addComponent').val();
            const removefrom = $('#addExunit').val();
            //const dateremove = $('#addDateRemove').val();
            const pn = $('#addPN').val();
            //const dateinstall = $('#addDateInstall').val();
            const installto = $('#addInstallTo').val();
            const hourmeter = $('#addHourMeter').val();
            const mpovh = $('#addMPOVH').val();
            const mpins = $('#addMPINS').val();
            const remarks = $('#addRemarks').val();
            const status = $('#addStatus').val();
            // Cek apakah opsi "ALREADY OUT" dipilih
            const dateremove = document.getElementById("radioRYes").checked
                ? $('#addDateRemove').val() || "1970-01-01" // Jika dipilih, ambil nilai tanggal (null jika kosong)
                : "1970-01-01"; // Jika tidak dipilih, kirim nilai 0
            const dateinstall = document.getElementById("radioIYes").checked
                ? $('#addDateInstall').val() || "1970-01-01" // Jika dipilih, ambil nilai tanggal (null jika kosong)
                : "1970-01-01"; // Jika tidak dipilih, kirim nilai 0

            // Validasi: Jika komponen kosong atau EGI belum dipilih
            if (component === '') {
                alert('Component must be selected!');
                return;  // Hentikan eksekusi jika validasi gagal
            }

            $.ajax({
                url: 'action.php', // URL untuk proses AJAX
                type: 'POST',
                data: {
                    action: 'insertinout',  // Aksi untuk mengidentifikasi permintaan ini
                    egi: egi,
                    component: component,
                    removefrom: removefrom,
                    dateremove: dateremove,
                    pn: pn,
                    dateinstall: dateinstall,
                    installto: installto,
                    hourmeter: hourmeter,
                    mpovh: mpovh,
                    mpins: mpins,
                    remarks: remarks,
                    status: status
                },
                success: function (response) {
                    alert('Data inserted successfully');
                    $('#insertModal').modal('hide');  // Close modal after submit
                    loadData();  // Refresh table or whatever data display you're using
                },
                error: function (xhr, status, error) {
                    alert('Error inserting data: ' + error);
                    console.log(
    "EGI: " + egi + 
    ", Component: " + component + 
    ", Remove From: " + removefrom + 
    ", Date Remove: " + dateremove + 
    ", PN: " + pn + 
    ", Date Install: " + dateinstall + 
    ", Install To: " + installto + 
    ", Hour Meter: " + hourmeter + 
    ", MPOVH: " + mpovh + 
    ", MPINS: " + mpins + 
    ", Remarks: " + remarks + 
    ", Status: " + status
);
                }
            });
        });

        // Tombol Edit
        $(document).on('click', '.edit', function () {
                const id = $(this).data('id');
                const pic = $(this).data('pic');
                const component = $(this).data('component');
                const pn = $(this).data('pn');
                const qty = $(this).data('qty');
                const exunit = $(this).data('exunit');
                const datein = $(this).data('datein');
                const alokasi = $(this).data('alokasi');
                const dateout = $(this).data('dateout');

            var editDate = document.getElementById("editDateOut");
            // Isi nilai ke dalam modal
            $('#editId').val(id);
            $('#editPIC').val(pic);
            $('#editComponent').val(component);
            $('#editPN').val(pn);
            $('#editQTY').val(qty);
            $('#editEXUnit').val(exunit);
            $('#editDateIn').val(datein);
            $('#editAlokasi').val(alokasi);
            // Logika untuk tombol radio dan input dateout
            if (dateout === "0" || dateout === 0 || !dateout || dateout === "1970-01-01") {
                editDate.value=''; // Kosongkan input tanggal
                editDate.disabled=true; // Nonaktifkan input tanggal
                document.getElementById("editRadioNo").checked = true; // Pilih NOT OUT YET
                document.getElementById("editRadioYes").checked = false; // Pastikan ALREADY OUT tidak terpilih
            } else {
                editDate.value=dateout; // Isi input tanggal
                editDate.disabled=false; // Aktifkan input tanggal
                document.getElementById("editRadioYes").checked = true; // Pilih ALREADY OUT
                document.getElementById("editRadioNo").checked = false; // Pastikan NOT OUT YET tidak terpilih
            }

            // Tampilkan modal
            $('#editModal').modal('show');
        });

        // Simpan perubahan pada modal Edit
        $('#saveEditButton').on('click', function () {
            const id = $('#editId').val();
            const pic = $('#editPIC').val();
            const component = $('#editComponent').val();
            const pn = $('#editPN').val();
            const qty = $('#editQTY').val();
            const exunit = $('#editEXUnit').val();
            const datein = $('#editDateIn').val();
            const alokasi = $('#editAlokasi').val();
            const dateout = $('#editDateOut').val();

            // Validasi: Jika komponen kosong atau EGI belum dipilih
            if (component === '') {
                alert('Component must be selected!');
                return;  // Hentikan eksekusi jika validasi gagal
            }

            $.ajax({
                url: 'action.php',
                type: 'POST',
                data: {
                    action: 'editinout',  // Aksi untuk mengidentifikasi permintaan ini
                    id: id,
                    pic: pic,
                    component: component,
                    pn: pn,
                    qty: qty,
                    exunit: exunit,
                    datein: datein,
                    alokasi: alokasi,
                    dateout: dateout
                },
                success: function (response) {
                    console.log(response);
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
                    action: 'deleteinout',
                    id: id
                },
                success: function (response) {
                    alert('Data deleted successfully');
                    $('#deleteModal').modal('hide');
                    loadData(); // Refresh tabel
                }
            });
        });

        $(document).on('click', '.foto', function () {
            const id = $(this).data('id');

            // Buka modal Foto
            $('#fotoModal #fotoId').val(id); // Set ID di hidden input
            $('#fotoModal #foto').val(''); // Reset input file
            $('#fotoModal #fotoPreview').html(''); // Reset preview gambar

            // Fetch foto dari server untuk preview
            $.ajax({
                url: 'action.php',
                type: 'POST',
                data: { action: 'getFotoinout', id: id },
                success: function (response) {
                    if (response) {
                        // Jika respons berisi nama file, tampilkan preview
                        $('#fotoModal #fotoPreview').html(
                            `<img style="max-width: 100%" src="assets/user/inout/${response}" class="img-fluid">`
                        );
                    } else {
                        // Jika tidak ada foto, tampilkan placeholder
                        $('#fotoModal #fotoPreview').html('<p>No photo available</p>');
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Error fetching photo:', error);
                    $('#fotoModal #fotoPreview').html('<p>Error loading photo</p>');
                },
            });

            $('#fotoModal').modal('show');
        });

        $('#fotoForm').on('submit', function (e) {
            e.preventDefault();

            const formData = new FormData(this);
            formData.append('action', 'insertfotoinout'); // Tambahkan action

            $.ajax({
                url: 'action.php',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                beforeSend: function () {
                    console.log('Sending data:', formData); // Debug data yang dikirim
                },
                success: function (response) {
                    console.log(response); // Debug response
                    alert(response); // Beri notifikasi hasil
                    $('#fotoModal').modal('hide');
                    loadData(); // Refresh tabel data
                },
                error: function (xhr, status, error) {
                    console.error('Error:', error);
                    console.log('Response text:', xhr.responseText);
                },
            });
        });
    });
</script>
</body>
</html>
