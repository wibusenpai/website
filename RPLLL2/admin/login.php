<?php
    include "../connect.php";
    session_start();

    if (isset($_POST["login"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];

        // Validasi untuk memastikan username dan password tidak kosong
        if (empty($username) || empty($password)) {
            $_SESSION["error"] = "Username dan password harus diisi.";
            header("Location: login.php?error=1");
            exit;
        }

        $query = mysqli_query($connect, "SELECT * FROM admin WHERE username = '$username' and password='$password'");
        $row = mysqli_fetch_array($query);

        if ($row) {
            // Jika data ditemukan, set session dan redirect ke halaman admin.php
            $_SESSION["username"] = $username;
            header("Location: admin.php");
            exit; // Pastikan tidak ada output sebelum header redirect
        } else {
            // Jika login gagal, set pesan error dan redirect ke halaman login dengan parameter error=1
            $_SESSION["error"] = "Username atau password salah.";
            header("Location: login.php?error=1");
            exit; // Pastikan tidak ada output sebelum header redirect
        }
    }
?>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/login.css">
    <title>Login Page</title>
</head>
<body>
    <div class="background">
        <div class="login-container">
            <h2>Selamat Datang!</h2>
            <form method="POST">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password">
                </div>
                <button type="submit" name="login">Login</button>
            </form>
            <br>
            <a style="text-decoration: none; color: #000;" href="../index.php">Menuju ke Halaman Utama</a>
        </div>

        <?php
            if (isset($_SESSION["error"])) {
                echo '<script>alert("' . $_SESSION["error"] . '")</script>';
                unset($_SESSION["error"]); // Hapus session error setelah ditampilkan
            }
        ?>
    </div>
</body>
</html>
