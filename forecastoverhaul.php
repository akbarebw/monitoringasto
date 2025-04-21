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
    <title>REMAN ASTO - Forecast Overhaul</title>
    <link href="./assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="./assets/css/main.css" rel="stylesheet">
    <script src="./assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="./assets/js/jquery.js"></script>
    <link rel="icon" type="image/x-icon" href="./assets/src/favicon.png">
    <script>
        function selectEgi(value) {
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
                <h1 class="modal-title fs-5" id="exampleModalLabel">Insert Forecast Overhaul Data</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <div class="mb-3">
                        <label class="form-label">SCHEDULE</label>
                        <input type="text" class="form-control" id="addSchedule" placeholder="SCHEDULE...">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">PERIOD</label>
                        <input type="month" class="form-control" id="addPeriod">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">WORKORDER</label>
                        <input type="text" class="form-control" id="addWorkorder" placeholder="WORKORDER...">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">EGI</label>
                        <button class="btn btn-outline-secondary dropdown-toggle w-100 text-start" type="button" data-bs-toggle="dropdown" aria-expanded="false" id="addEgiBtn">
                            Choose EGI
                        </button>
                        <ul class="dropdown-menu myListEGI" style="width: calc(100% - 30px)" aria-labelledby="addEgiBtn" id="addEgiDropdown">
                        </ul>
                    </div>
                    <input type="hidden" id="selectedEgi">
                    <div class="mb-3">
                        <label class="form-label">CODE NO</label>
                        <input type="text" class="form-control" id="addCodeno" placeholder="CODE NO...">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">SN</label>
                        <input type="number" class="form-control" id="addSN" placeholder="SN...">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">LOKASI</label>
                        <input type="text" class="form-control" id="addLokasi" placeholder="LOKASI...">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">COMPONENT</label>
                        <input type="text" class="form-control" id="addComponent" placeholder="COMPONENT...">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">TYPE</label>
                        <input type="text" class="form-control" id="addType" placeholder="TYPE...">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">PLAN DATE</label>
                        <input type="date" class="form-control" id="addPlandate">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">PLAN HM</label>
                        <input type="number" class="form-control" id="addPlanhm" placeholder="PLAN HM...">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">WR PART OVH/PTA</label>
                        <input type="text" class="form-control" id="addWrpart" placeholder="WR PART OVH/PTA...">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">SUPPLY BY</label>
                        <input type="text" class="form-control" id="addSupplyby" placeholder="SUPPLY BY...">
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
                <h5 class="modal-title" id="editModalLabel">Edit Forecast Overhaul Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <input type="hidden" id="editId"> <!-- Hidden input untuk menyimpan ID -->
                    <div class="mb-3">
                        <label class="form-label">SCHEDULE</label>
                        <input type="text" class="form-control" id="editSchedule" placeholder="SCHEDULE...">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">PERIOD</label>
                        <input type="month" class="form-control" id="editPeriod">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">WORKORDER</label>
                        <input type="text" class="form-control" id="editWorkorder" placeholder="WORKORDER...">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">EGI</label>
                        <button class="btn btn-outline-secondary dropdown-toggle w-100 text-start" type="button" data-bs-toggle="dropdown" aria-expanded="false" id="editEgiBtn">
                            Choose EGI
                        </button>
                        <ul class="dropdown-menu myListEGI" style="width: calc(100% - 30px)" aria-labelledby="editEgiBtn" id="editEgiDropdown">
                        </ul>
                    </div>
                    <!-- Input Hidden -->
                    <input type="hidden" id="selectedEgi">
                    <div class="mb-3">
                        <label class="form-label">CODE NO</label>
                        <input type="text" class="form-control" id="editCodeno" placeholder="CODE NO...">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">SN</label>
                        <input type="number" class="form-control" id="editSN" placeholder="SN...">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">LOKASI</label>
                        <input type="text" class="form-control" id="editLokasi" placeholder="LOKASI...">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">COMPONENT</label>
                        <input type="text" class="form-control" id="editComponent" placeholder="COMPONENT...">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">TYPE</label>
                        <input type="text" class="form-control" id="editType" placeholder="TYPE...">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">PLAN DATE</label>
                        <input type="date" class="form-control" id="editPlandate">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">PLAN HM</label>
                        <input type="number" class="form-control" id="editPlanhm" placeholder="PLAN HM...">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">WR PART OVH/PTA</label>
                        <input type="text" class="form-control" id="editWrpart" placeholder="WR PART OVH/PTA...">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">SUPPLY BY</label>
                        <input type="text" class="form-control" id="editSupplyby" placeholder="SUPPLY BY...">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">STATUS</label>
                        <input type="text" class="form-control" id="editStatus" placeholder="STATUS...">
                    </div>
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
                    <h1 style="font-weight: bold">FORECAST OVERHAUL</h1>
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
                                    <li><a class="dropdown-item search-item" href="#">SCHEDULE</a></li>
                                    <li><a class="dropdown-item search-item" href="#">PERIOD</a></li>
                                    <li><a class="dropdown-item search-item" href="#">WORK ORDER</a></li>
                                    <li><a class="dropdown-item search-item" href="#">EGI</a></li>
                                    <li><a class="dropdown-item search-item" href="#">CODE NO</a></li>
                                    <li><a class="dropdown-item search-item" href="#">SN</a></li>
                                    <li><a class="dropdown-item search-item" href="#">LOKASI</a></li>
                                    <li><a class="dropdown-item search-item" href="#">COMPONENT</a></li>
                                    <li><a class="dropdown-item search-item" href="#">TYPE</a></li>
                                    <li><a class="dropdown-item search-item" href="#">PLAN DATE</a></li>
                                    <li><a class="dropdown-item search-item" href="#">PLAN HM</a></li>
                                    <li><a class="dropdown-item search-item" href="#">WR PART OVH/PTA</a></li>
                                    <li><a class="dropdown-item search-item" href="#">SUPPLY BY</a></li>
                                    <li><a class="dropdown-item search-item" href="#">STATUS</a></li>
                                </ul>

                                <input type="text" id="myInput" class="form-control" onkeyup="myFunction()" placeholder="Search for SCHEDULE..">

                                <button class="btn btn-outline-secondary" type="button" id="refresh-button">REFRESH DATA</button>
                                <button class="btn btn-outline-secondary" type="button" data-bs-toggle="modal" data-bs-target="#insertModal">INSERT DATA</button>

                            </div>

                            <table id="myTable" class="table table-hover">
                                <thead>
                                <tr class="header" valign="middle">
                                    <th style="width:5%;">NO</th>
                                    <th>SCHEDULE</th>
                                    <th>PERIOD</th>
                                    <th>WORK ORDER</th>
                                    <th>EGI</th>
                                    <th>CODE NO</th>
                                    <th>SN</th>
                                    <th>LOKASI</th>
                                    <th>COMPONENT</th>
                                    <th>TYPE</th>
                                    <th>PLAN DATE</th>
                                    <th>PLAN HM</th>
                                    <th>WR PART OVH/PTA</th>
                                    <th>SUPPLY BY</th>
                                    <th>STATUS</th>
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
                        function filterDropdown(input) {
                            // Ambil dropdown yang mengandung input yang diketik
                            var dropdown = input.closest('.dropdown-menu');
                            var items = dropdown.getElementsByTagName("a"); // Ambil semua item di dalam dropdown
                            var filter = input.value.toUpperCase(); // Ambil nilai input pencarian dan ubah menjadi huruf besar

                            // Looping semua item dropdown dan sembunyikan yang tidak sesuai pencarian
                            for (var i = 0; i < items.length; i++) {
                                var txtValue = items[i].textContent || items[i].innerText;
                                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                                    items[i].style.display = ""; // Tampilkan item yang cocok
                                } else {
                                    items[i].style.display = "none"; // Sembunyikan item yang tidak cocok
                                }
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
                                let placeholder = "Search for SCHEDULE..";

                                if (selectedColumn === "STATUS") {
                                    columnIndex = 14;
                                    placeholder = "Search for STATUS...";
                                } else if (selectedColumn === "SUPPLY BY") {
                                    columnIndex = 13;
                                    placeholder = "Search for SUPPLY BY...";
                                } else if (selectedColumn === "WR PART OVH/PTA") {
                                    columnIndex = 12;
                                    placeholder = "Search for WR PART OVH/PTA...";
                                } else if (selectedColumn === "PLAN HM") {
                                    columnIndex = 11;
                                    placeholder = "Search for PLAN HM...";
                                } else if (selectedColumn === "PLAN DATE") {
                                    columnIndex = 10;
                                    placeholder = "Search for PLAN DATE...";
                                } else if (selectedColumn === "TYPE") {
                                    columnIndex = 9;
                                    placeholder = "Search for TYPE...";
                                } else if (selectedColumn === "COMPONENT") {
                                    columnIndex = 8;
                                    placeholder = "Search for COMPONENT...";
                                } else if (selectedColumn === "LOKASI") {
                                    columnIndex = 7;
                                    placeholder = "Search for LOKASI...";
                                } else if (selectedColumn === "SN") {
                                    columnIndex = 6;
                                    placeholder = "Search for SN...";
                                } else if (selectedColumn === "CODE NO") {
                                    columnIndex = 5;
                                    placeholder = "Search for CODE NO...";
                                } else if (selectedColumn === "EGI") {
                                    columnIndex = 4;
                                    placeholder = "Search for EGI...";
                                } else if (selectedColumn === "WORK ORDER") {
                                    columnIndex = 3;
                                    placeholder = "Search for WORK ORDER...";
                                } else if (selectedColumn === "PERIOD") {
                                    columnIndex = 2;
                                    placeholder = "Search for PERIOD...";
                                } else if (selectedColumn === "SCHEDULE") {
                                    columnIndex = 1;
                                    placeholder = "Search for SCHEDULE...";
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
        $('.egi-item').on('click', function (e) {
            e.preventDefault(); // Hindari reload halaman
            selectedEGI = $(this).text(); // Ambil teks dari item dropdown yang diklik
            loadData(selectedEGI); // Muat ulang data dengan filter EGI
            document.getElementById("label-egi").innerHTML=(selectedEGI);
            document.getElementById("myInput").value="";
        });

        function loadData() {
            $.ajax({
                url: 'action.php',
                type: 'POST',
                data: { action: 'fetchforecastoverhaul' },
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
            const schedule = $('#addSchedule').val();
            const period = $('#addPeriod').val();
            const workorder = $('#addWorkorder').val();
            const egi = $('#selectedEgi').val();
            const codeno = $('#addCodeno').val();
            const sn = $('#addSN').val();
            const lokasi = $('#addLokasi').val();
            const component = $('#addComponent').val();
            const type = $('#addType').val();
            const plandate = $('#addPlandate').val();
            const planhm = $('#addPlanhm').val();
            const wrpart = $('#addWrpart').val();
            const supplyby = $('#addSupplyby').val();
            const status = $('#addStatus').val();

            // Validasi: Jika komponen kosong atau EGI belum dipilih
            if (component === '') {
                alert('Component must be selected!');
                return;  // Hentikan eksekusi jika validasi gagal
            }

            $.ajax({
                url: 'action.php', // URL untuk proses AJAX
                type: 'POST',
                data: {
                    action: 'insertforecastoverhaul',  // Aksi untuk mengidentifikasi permintaan ini
                    schedule: schedule,
                    period: period,
                    workorder: workorder,
                    egi: egi,
                    codeno: codeno,
                    sn: sn,
                    lokasi: lokasi,
                    component: component,
                    type: type,
                    plandate: plandate,
                    planhm: planhm,
                    wrpart: wrpart,
                    supplyby: supplyby,
                    status: status
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
            const schedule = $(this).data('schedule');
            const period = $(this).data('period');
            const workorder = $(this).data('workorder');
            const egi = $(this).data('egi');
            const codeno = $(this).data('codeno');
            const sn = $(this).data('sn');
            const lokasi = $(this).data('lokasi');
            const component = $(this).data('component');
            const type = $(this).data('type');
            const plandate = $(this).data('plandate');
            const planhm = $(this).data('planhm');
            const wrpart = $(this).data('wrpart');
            const supplyby = $(this).data('supplyby');
            const status = $(this).data('status');

            // Isi nilai ke dalam modal
            $('#editId').val(id);
            $('#editSchedule').val(schedule);
            $('#editPeriod').val(period);
            $('#editWorkorder').val(workorder);
            // Update button EGI untuk menampilkan nilai yang sudah ada
            $('#editEgiBtn').text(egi || 'Choose EGI'); // Menampilkan teks sesuai dengan EGI yang dipilih

            // Set value pada input hidden untuk EGI
            $('#selectedEgi').val(egi);
            $('#editCodeno').val(codeno);
            $('#editSN').val(sn);
            $('#editLokasi').val(lokasi);
            $('#editComponent').val(component);
            $('#editType').val(type);
            $('#editPlandate').val(plandate);
            $('#editPlanhm').val(planhm);
            $('#editWrpart').val(wrpart);
            $('#editSupplyby').val(supplyby);
            $('#editStatus').val(status);

            // Tampilkan modal
            $('#editModal').modal('show');
        });

        // Simpan perubahan pada modal Edit
        $('#saveEditButton').on('click', function () {
            const id = $('#editId').val();
            const schedule = $('#editSchedule').val();
            const period = $('#editPeriod').val();
            const workorder = $('#editWorkorder').val();
            const egi = $('#selectedEgi').val();
            const codeno = $('#editCodeno').val();
            const sn = $('#editSN').val();
            const lokasi = $('#editLokasi').val();
            const component = $('#editComponent').val();
            const type = $('#editType').val();
            const plandate = $('#editPlandate').val();
            const planhm = $('#editPlanhm').val();
            const wrpart = $('#editWrpart').val();
            const supplyby = $('#editSupplyby').val();
            const status = $('#editStatus').val();

            // Validasi: Jika komponen kosong atau EGI belum dipilih
            if (component === '') {
                alert('Component must be selected!');
                return;  // Hentikan eksekusi jika validasi gagal
            }

            $.ajax({
                url: 'action.php',
                type: 'POST',
                data: {
                    action: 'editforecastoverhaul',
                    id: id,
                    schedule: schedule,
                    period: period,
                    workorder: workorder,
                    egi: egi,
                    codeno: codeno,
                    sn: sn,
                    lokasi: lokasi,
                    component: component,
                    type: type,
                    plandate: plandate,
                    planhm: planhm,
                    wrpart: wrpart,
                    supplyby: supplyby,
                    status: status
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
                    action: 'deleteforecastoverhaul',
                    id: id
                },
                success: function (response) {
                    alert('Data deleted successfully');
                    $('#deleteModal').modal('hide');
                    loadData(); // Refresh tabel
                }
            });
        });
        function loadEGIList() {
            $.ajax({
                url: 'action.php',
                type: 'POST',
                data: { action: 'fetchlistegidropdown' },
                success: function (response) {
                    $('.myListEGI').html(response);
                }
            });
        }
        // Muat data awal
        loadEGIList();
    });
</script>
</body>
</html>
