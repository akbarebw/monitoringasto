<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock Item Data</title>
    <link href="./assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="./assets/css/main.css" rel="stylesheet">
    <script src="./assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="./assets/js/jquery.js"></script>
</head>
<body onload="window.print()">
<div class="container-fluid w-100">
    <table class="table table-bordered w-100 mt-3" id="stockTable">
        <thead>
            <tr>
                <td colspan="4" style="background-color: #A9D08E">
                    <div class="d-flex align-items-center">
                        <div style="width: 100px"><img src="./assets/src/kpp.png" style="max-width: 100%"/></div>
                        <div class="flex-grow-1 text-center text-decoration-underline py-3" style="font-size: x-large; font-weight: bold">UPDATE DAILY COMPONENT</div>
                        <div style="width: 100px"><img src="./assets/src/kanan.png" style="max-width: 100%"/></div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="4" class="text-uppercase" style="font-weight: bold; background-color: #FFD966">
                    DATE: <?php echo date('d F Y', time()) ?>
                </td>
            </tr>
        </thead>
        <!-- Tabel akan diisi oleh JavaScript -->
    </table>
</div>

<script>
    $(document).ready(function () {
        $.ajax({
            url: 'action.php',
            type: 'POST',
            data: { action: 'fetchupdatedailycomponent' },
            success: function (response) {
                const data = JSON.parse(response);
                const stockTable = $('#stockTable');

                let currentEgi = '';
                let rowNumber = 1;

                data.forEach(item => {
                    // Buat id yang aman untuk digunakan di elemen HTML
                    const sanitizedEgi = item.egi.replace(/[^a-zA-Z0-9]/g, '_'); // Ganti karakter non-alfanumerik dengan '_'

                    if (item.egi !== currentEgi) {
                        // Tambahkan Header Baru untuk Setiap EGI
                        currentEgi = item.egi;
                        stockTable.append(`
                            <thead>
                                <tr>
                                    <th colspan="4" style="background-color: #FFFF00">EGI: ${currentEgi}</th>
                                </tr>
                                <tr class="text-center">
                                    <th style="width: 50px">No</th>
                                    <th>Component</th>
                                    <th>PN</th>
                                    <th>RFU</th>
                                </tr>
                            </thead>
                            <tbody id="body-${sanitizedEgi}"></tbody>
                        `);
                                        rowNumber = 1; // Reset nomor untuk setiap EGI
                                    }

                                    // Tambahkan Baris Data ke <tbody> Spesifik
                                    $(`#body-${sanitizedEgi}`).append(`
                        <tr class="text-center">
                            <td>${rowNumber++}</td>
                            <td>${item.component}</td>
                            <td>${item.pn}</td>
                            <td>${item.rfu}</td>
                        </tr>
                    `);
                });
            },
            error: function (xhr, status, error) {
                console.error('Error:', error);
            }
        });
    });
</script>
</body>
</html>
