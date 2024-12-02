<?php
include 'connection.php';

$error = false;
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $result = mysqli_query($con, "SELECT * FROM user WHERE username='$username'");
    $cek = mysqli_num_rows($result);

    if ($cek != 0) {
        $row = mysqli_fetch_assoc($result);

        if (password_verify($password, $row['password'])) {
            session_start();
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['level'] = $row['level'];
            $_SESSION['status'] = 'login';

            if ($row['level'] === 'admin') {
                header('Location: admin/?page=dashboard');
            } else {
                header('Location: user/?page=dashboard');
            }
            exit();
        } else {
            $error = true;
        }
    } else {
        $error = true;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" href="assets/img/rsi.png" type="image/png" sizes="32x32">
    <link href="./assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="./assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <link href="./assets/vendors/themify-icons/css/themify-icons.css" rel="stylesheet" />
    <link href="assets/css/main.css" rel="stylesheet" />
    <link href="./assets/css/pages/auth-light.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            background-color: #e9f5e9;
        }
        .content {
            max-width: 400px;
            margin: 100px auto;
            padding: 20px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
        .brand {
            text-align: center;
            margin-bottom: 20px;
        }
        .brand a {
            font-size: 24px;
            color: #28a745;
            font-weight: bold;
            text-decoration: none;
        }
        .login-title {
            text-align: center;
            color: #28a745;
            margin-bottom: 20px;
        }
        .btn-info {
            background-color: #28a745;
            border: none;
        }
        .alert {
            margin-bottom: 15px;
        }
        .input-group-icon {
            position: relative;
        }
        .input-icon {
            position: absolute;
            top: 10px;
            left: 10px;
            color: #28a745;
        }
        @media (max-width: 400px) {
            .brand img {
                max-height: 100px;
                object-fit: contain;
            }
        }
    </style>
</head>
<body>
    <div class="content">
    <div class="brand">
        <div style="width: 100%; height: auto; overflow: hidden; border: 2px solid #28a745; border-radius: 5px; display: flex; align-items: center; justify-content: center; background-color: white;">
            <img src="assets/img/rsisa.png" alt="Logo" style="max-width: 100%; max-height: 150px; height: auto; object-fit: contain;">
        </div>
    </div>
        <form id="login-form" action="" method="post">
            <h2 class="login-title">Log in</h2>

            <?php if ($error): ?>
                <div class="alert alert-danger">Username atau password salah.</div>
            <?php endif; ?>

            <div class="form-group">
                <div class="input-group-icon right">
                    <div class="input-icon"><i class="fa fa-user"></i></div>
                    <input class="form-control" type="text" name="username" placeholder="Username" autocomplete="off" required>
                </div>
            </div>
            <div class="form-group">
                <div class="input-group-icon right">
                    <div class="input-icon"><i class="fa fa-lock font-16"></i></div>
                    <input class="form-control" type="password" name="password" placeholder="Password" required>
                </div>
            </div>
            <div class="form-group d-flex justify-content-between">
                <label class="ui-checkbox ui-checkbox-info">
                    <input type="checkbox">
                    <span class="input-span"></span>Remember me</label>
                <a href="register.php">Buat Akun Baru</a>
            </div>
            <div class="form-group">
                <button class="btn btn-info btn-block" name="login" type="submit">Login</button>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>