<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REMAN ASTO - Login</title>
    <link href="./assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="./assets/css/main.css" rel="stylesheet">
    <script src="./assets/js/jquery.js"></script>
    <link rel="icon" type="image/x-icon" href="./assets/src/favicon.png">
</head>
<body>
<div class="container-fluid main vh-100 d-flex justify-content-center align-items-center flex-column">
    <div class="mb-5">
        <img src="./assets/src/kpp.png" width="200px"/>
    </div>
    <div class="card w-25">
        <div class="card-header">
            <h5>Login</h5>
        </div>
        <div class="card-body">
            <form id="loginForm">
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                    <strong class="text-danger" id="message"></strong>
                </div>
                <button class="btn btn-primary" type="submit">Login</button>
            </form>
        </div>
    </div>
</div>

<script>
    $('#loginForm').on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            url: 'action.php',
            type: 'POST',
            data: {
                action: 'login',
                username: $('#username').val(),
                password: $('#password').val()
            },
            success: function(response) {
                console.log(response);
                if (response === 'success') {
                    window.location.href = './dashboard.php';
                } else {
                    $('#message').text('Invalid username or password.');
                }
            }
        });
    });
</script>
</body>
</html>
