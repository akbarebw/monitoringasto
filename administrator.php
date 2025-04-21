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
    <title>REMAN ASTO - Administrator</title>
    <link href="./assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="./assets/css/main.css" rel="stylesheet">
    <script src="./assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="./assets/js/jquery.js"></script>
    <link rel="icon" type="image/x-icon" href="./assets/src/favicon.png">
</head>
<body>
<div class="modal fade" id="roleModal" tabindex="-1" aria-labelledby="roleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Configure User Role</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="roleId"> <!-- Hidden input untuk menyimpan ID -->
                <div class="mb-3">
                    <label class="form-label">USERNAME</label><br/>
                    <input type="text" class="form-control" id="editUsername" disabled/>
                </div>
                <div class="mb-3">
                    <label class="form-label">Role</label><br/>
                    <select class="form-select" id="editRole">
                        <option value="1" selected>KPP</option>
                        <option value="2">UTVH</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger" id="confirmRoleButton">Change Role</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="resetModal" tabindex="-1" aria-labelledby="resetModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Configure User Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="resetId"> <!-- Hidden input untuk menyimpan ID -->
                <div class="mb-3">
                    <label class="form-label">USERNAME</label><br/>
                    <input type="text" class="form-control" id="resetUsername" disabled/>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger" id="confirmResetButton">Reset</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Configure User Role</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="deleteId"> <!-- Hidden input untuk menyimpan ID -->
                <div class="mb-3">
                    <label class="form-label">USERNAME</label><br/>
                    <input type="text" class="form-control" id="deleteUsername" disabled/>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
                    <h1 style="font-weight: bold">ADMINISTRATOR</h1>
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
                            <div class="accordion" id="accordionExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            Add User
                                        </button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <div class="mb-3">
                                                <label class="form-label">Username</label>
                                                <input type="text" class="form-control" id="addUsername" placeholder="employeename123">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Name</label>
                                                <input type="text" class="form-control" id="addName" placeholder="Employee Name">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Password</label><br/>
                                                <strong class="text-danger">Default password: 123. Change after login</strong>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Role</label><br/>
                                                <select class="form-select" aria-label="Default select example" id="addRole">
                                                    <option value="1" selected>Employee</option>
                                                    <option value="2">Vendor</option>
                                                </select>
                                            </div>
                                            <button class="btn btn-primary" id="submitUser">Add User</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            User Lists
                                        </button>
                                    </h2>
                                    <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <div class="mb-3 input-group">
                                                <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">COLUMN SEARCH</button>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item search-item" href="#">USERNAME</a></li>
                                                    <li><a class="dropdown-item search-item" href="#">NAME</a></li>
                                                    <li><a class="dropdown-item search-item" href="#">ROLE</a></li>
                                                </ul>

                                                <input type="text" id="myInput" class="form-control" onkeyup="myFunction()" placeholder="Search for USERNAME...">

                                                <button class="btn btn-outline-secondary" type="button" id="refresh-button">REFRESH DATA</button>

                                            </div>

                                            <table id="myTable" class="table table-hover">
                                                <thead>
                                                <tr class="header">
                                                    <th style="width:5%;">NO</th>
                                                    <th style="width:30%;">USERNAME</th>
                                                    <th>NAME</th>
                                                    <th>ROLE</th>
                                                    <th colspan="3" style="width:10%;">AKSI</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>Berglunds snabbkop</td>
                                                    <td>Sweden</td>
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
                                                        let placeholder = "Search for USERNAME..";

                                                        if (selectedColumn === "ROLE") {
                                                            columnIndex = 3;
                                                            placeholder = "Search for ROLE...";
                                                        } else if (selectedColumn === "NAME") {
                                                            columnIndex = 2;
                                                            placeholder = "Search for NAME...";
                                                        } else if (selectedColumn === "USERNAME") {
                                                            columnIndex = 1;
                                                            placeholder = "Search for USERNAME...";
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#submitUser').on('click', function () {
            const username = $('#addUsername').val();
            const name = $('#addName').val();
            const role = $('#addRole').val();

            // Validasi: Jika komponen kosong atau EGI belum dipilih
            if (username === '' && name === '') {
                alert('Username and Name must be filled!');
                return;  // Hentikan eksekusi jika validasi gagal
            }

            $.ajax({
                url: 'action.php', // URL untuk proses AJAX
                type: 'POST',
                data: {
                    action: 'insertuser',  // Aksi untuk mengidentifikasi permintaan ini
                    username: username,
                    name: name,
                    role: role
                },
                success: function (response) {
                    alert('Data inserted successfully');
                    loadData();
                    $('#addUsername').val('');
                    $('#addName').val('');
                    $('#addRole').val('');
                },
                error: function (xhr, status, error) {
                    alert('Error inserting data: ' + error);
                }
            });
        });
        function loadData() {
            $.ajax({
                url: 'action.php',
                type: 'POST',
                data: { action: 'fetchuser' },
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

        // Tombol Reset
        $(document).on('click', '.reset', function () {
            const id = $(this).data('id');
            const username = $(this).data('username');

            // Simpan ID ke modal
            $('#resetId').val(id);

            $('#resetUsername').val(username);

            // Tampilkan modal
            $('#resetModal').modal('show');
        });
        // Hapus data pada modal Delete
        $('#confirmResetButton').on('click', function () {
            const id = $('#resetId').val();

            $.ajax({
                url: 'action.php',
                type: 'POST',
                data: {
                    action: 'resetuser',
                    id: id
                },
                success: function (response) {
                    alert('Data deleted successfully');
                    $('#resetModal').modal('hide');
                    loadData(); // Refresh tabel
                }
            });
        });

        // Tombol Delete
        $(document).on('click', '.delete', function () {
            const id = $(this).data('id');
            const username = $(this).data('username');

            // Simpan ID ke modal
            $('#deleteId').val(id);
            $('#deleteUsername').val(username);

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
                    action: 'deleteuser',
                    id: id
                },
                success: function (response) {
                    alert('Data deleted successfully');
                    $('#deleteModal').modal('hide');
                    loadData(); // Refresh tabel
                }
            });
        });

        // Tombol Edit
        $(document).on('click', '.role', function () {
            const id = $(this).data('id');
            const role = $(this).data('role');
            const username = $(this).data('username');
            // Isi nilai ke dalam modal
            $('#resetId').val(id);
            $('#editRole').val(role);
            $('#editUsername').val(username);

            // Tampilkan modal
            $('#roleModal').modal('show');
        });

        // Simpan perubahan pada modal Edit
        $('#confirmRoleButton').on('click', function () {
            const id = $('#resetId').val();
            const role = $('#editRole').val();

            $.ajax({
                url: 'action.php',
                type: 'POST',
                data: {
                    action: 'roleuser',  // Aksi untuk mengidentifikasi permintaan ini
                    id: id,
                    role: role
                },
                success: function (response) {
                    alert('Data updated successfully');
                    $('#roleModal').modal('hide');
                    loadData(); // Refresh tabel
                }
            });
        });
    });
</script>
</body>
</html>
