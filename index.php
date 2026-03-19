<?php 
    include ("config/koneksi.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Register</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>

    <!-- <header>
        <h2 class="logo">Logo</h2>
        <nav class="navigation">
            <a href="#">Home</a>
            <a href="#">About</a>
            <a href="#">Services</a>
            <a href="#">Contact</a>
            <button class="btnLogin-popup">Login</button>
        </nav>
    </header> -->

    <div class="wrapper active-popup">
        <!-- <span class="icon-close"><ion-icon name="close"></ion-icon></span> -->

        <div class="form-box login">
            <h2>Login</h2>
            <form action="php/auth.php" method="POST">
                <div class="input-box">
                    <span class="icon"><ion-icon name="mail"></ion-icon></span>
                    <input type="text" name="username" required>
                    <label>Username</label>
                </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
                    <input type="password" name="password" required>
                    <label>Password</label>
                </div>
                <!-- <div class="input-box select-box">
                    <span class="icon"><ion-icon name="people-circle-outline"></ion-icon></span>
                    <select name="role" id="role" required>
                        <option value="" disabled selected hidden></option>
                        <option value="1">Admin</option>
                        <option value="2">Member</option>
                    </select>
                    <label>Role</label>
                </div> -->
                <!-- <div class="remember-forgot">
                    <label><input type="checkbox">Remember Me</label>
                    <a href="#">Forgot Password?</a>
                </div> -->
                <button type="submit" name="login" class="btn">Masuk</button>
                <!-- <div class="login-register">
                    <p>Belum punya akun? <a href="#" class="register-link">Daftar</a></p>
                </div> -->
            </form>
        </div>

        <div class="form-box register">
            <h2>Register</h2>
            <form action="php/auth.php" method="POST">
                <div class="input-box">
                    <span class="icon"><ion-icon name="person"></ion-icon></span>
                    <input type="text" name="username" required>
                    <label>Username</label>
                </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
                    <input type="password" name="password" required>
                    <label>Password</label>
                </div>
                <div class="input-box select-box">
                    <span class="icon"><ion-icon name="people-circle-outline"></ion-icon></span>
                    <select name="role" id="role" required>
                        <option value="" disabled selected hidden></option>
                        <option value="1">Admin</option>
                        <option value="2">Member</option>
                    </select>
                    <label>Role</label>
                </div>
                <div class="remember-forgot">
                    <!-- <label><input type="checkbox"> I agree of the terms & conditions</label> -->
                </div>
                <button type="submit" name="register" class="btn">Daftar</button>
                <div class="login-register">
                    <p>Sudah punya akun? <a href="#" class="login-link">Masuk</a></p>
                </div>
            </form>
        </div>
    </div>

    <script src="js/login.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>