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
    <title>REMAN ASTO - Dashboard</title>
    <link href="./assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="./assets/css/main.css" rel="stylesheet">
    <script src="./assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="./assets/js/chart.js"></script>
    <script src="./assets/js/jquery.js"></script>
    <link rel="icon" type="image/x-icon" href="./assets/src/favicon.png">
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-2 sidebar vh-100 p-3">
                <?php include_once './sidebar.php'?>
            </div>
            <div class="col main p-3" style="min-height: 100%">
                <div class="dashboard-header d-flex flex-column">
                    <div class="text-uppercase flex-grow-1 align-content-end mb-2">
                        <h1 style="font-weight: bold">PLANT DIRECTORATE</h1>
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
                    <div class="fst-italic header-tagline">
                        To Be The Best Product Support with High Availability, Best Performance & Lowest Possible Realible Cost.
                    </div>
                </div>
                <div class="d-flex flex-row gap-3">
                    <div class="card w-100">
                        <div class="card-body">
                            <h5>Jumlah Barang: <span id="totalComponent"></span></h5>
                        </div>
                    </div>
                    <div class="card w-100">
                        <div class="card-body">
                            <h5>Komponen Masuk: <span id="componentIn"></span></h5>
                        </div>
                    </div>
                    <div class="card w-100">
                        <div class="card-body">
                            <h5>Komponen Keluar: <span id="componentOut"></span></h5>
                        </div>
                    </div>
                </div>
                <div class="d-flex flex-row gap-3 mt-3">
                    <div class="card flex-grow-1">
                        <div class="card-body">
                            <canvas id="myChart" style="max-width:100%"></canvas>
                        </div>
                    </div>
                    <div class="d-flex flex-column gap-3">
                        <div class="card">
                        <div class="card-header">
                            <div class="card-title text-center" style="font-weight: bold">WELCOME TO REMAN ASTO DASHBOARD</div>
                        </div>
                            <div class="card-body" style="max-width: 400px">
                                <div style="text-align: left;">Hello!<br/>
Insan Plant KPP Job Site ASTO yang tercinta, Dashboard ini digunakan untuk memonitoring atas proses yang kita kerjakan. Jika ada saran atas dashboard ini bisa diinformasikan
</div>
                            </div>
                        </div>
                        <div class="card">
                        <div class="card-header">
                            <div class="card-title text-center" style="font-weight: bold">USER SEDANG LOGIN</div>
                        </div>
                            <div class="card-body">
                                <h6>NAMA: <?= $_SESSION['name'] ?></h6>
                                <h6>USERNAME: <?= $_SESSION['username'] ?></h6>
                                <h6>ROLE: <?php
                                    switch($_SESSION['role']){
                                        case 0:
                                            echo 'Administrator';
                                            break;
                                        case 1:
                                            echo 'KPP';
                                            break;
                                        case 2:
                                            echo 'UTVH';
                                            break;
                                    }
                                    ?></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script>
    $(document).ready(function () {
        // Panggil jumlah barang
        $.ajax({
            url: 'action.php', // Ganti dengan path file PHP Anda
            type: 'POST',
            data: { action: 'fetchjumlahbarang' },
            success: function (response) {
                // Tampilkan hasil di elemen dengan ID totalComponent
                $('#totalComponent').text(response);
            },
            error: function () {
                console.error('Gagal memuat data total barang');
            }
        });
        $.ajax({
            url: 'action.php', // Ganti dengan path file PHP Anda
            type: 'POST',
            data: { action: 'fetchkomponenmasuk' },
            success: function (response) {
                // Tampilkan hasil di elemen dengan ID totalComponent
                $('#componentIn').text(response);
            },
            error: function () {
                console.error('Gagal memuat data total barang');
            }
        });
        $.ajax({
            url: 'action.php', // Ganti dengan path file PHP Anda
            type: 'POST',
            data: { action: 'fetchkomponenkeluar' },
            success: function (response) {
                // Tampilkan hasil di elemen dengan ID totalComponent
                $('#componentOut').text(response);
            },
            error: function () {
                console.error('Gagal memuat data total barang');
            }
        });
        $.ajax({
            url: 'action.php', // Ganti dengan path file PHP Anda
            type: 'POST',
            data: { action: 'fetchChartData' }, // Aksi untuk mengenali permintaan
            success: function (response) {
                console.log(response);
                // Parse JSON yang diterima dari backend
                const chartData = JSON.parse(response);

                // Labels (xValues) dan Data (yValues) dari respons backend
                const xValues = chartData.labels;
                const yValues = chartData.values;

                // Warna bar untuk tiap elemen
                const barColors = ["red", "green", "blue", "orange", "brown", "red", "green", "blue", "orange"];

                // Render chart
                new Chart("myChart", {
                    type: "bar",
                    data: {
                        labels: xValues,
                        datasets: [{
                            backgroundColor: barColors,
                            data: yValues
                        }]
                    },
                    options: {
                        legend: { display: false },
                        title: {
                            display: true,
                            text: "JUMLAH STOK"
                        }
                    }
                });
            },
            error: function () {
                console.error('Gagal memuat data chart');
            }
        });
    });
</script>
</body>
</html>
