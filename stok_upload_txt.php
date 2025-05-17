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
    <title>Import Stok Minimum</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
</head>

<body class="p-5">
    <div class="container">
        <h3 class="mb-4">Upload File TXT - Import Stok Minimum</h3>

        <form action="import_stok_process.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <input type="file" name="stok_file" accept=".txt" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Upload dan Import</button>
        </form>
    </div>
</body>

</html>