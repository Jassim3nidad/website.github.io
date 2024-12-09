<!DOCTYPE HTML>
<html lang="en">
<head>
    <title>Login page - Website ni Trinidad</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/includes.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</head>
<body>
    <div id="container">
        <?php include('header_login.php'); ?>
        <?php include('nav_login.php'); ?>
        <?php include('mysqli_connect.php'); // Database connection ?>

        <div id="content">
            <?php
                 if($_SERVER['REQUEST_METHOD'] == 'POST') {
                    require('mysqli_connect.php');
                    if(empty($_POST['email'])) {
                        echo '<p class="error">You forgot to enter your email address.</p>';
                    } else {
                        $e = trim($_POST['email']);
                    }

                    if(empty($_POST['psword'])) {
                        echo '<p class="error">You forgot to enter your password.</p>';
                    } else {
                        $p = trim($_POST['psword']);
                    }

                    if ($e && $p) {
                        $q = "SELECT user_id, fname, user_level, psword FROM users WHERE email='$e'";
                        $result = @mysqli_query($dbcon, $q);

                        if (mysqli_num_rows($result) == 1) {
                            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                            if (password_verify($p, $row['psword'])) {
                                session_start();
                                $_SESSION['user_id'] = $row['user_id'];
                                $_SESSION['fname'] = $row['fname'];
                                $_SESSION['user_level'] = $row['user_level'];
                                mysqli_free_result($result);
                                mysqli_close($dbcon);
                                $url = ($_SESSION['user_level'] == 1) ? 'admin_page.php' : 'member_page.php';
                                ob_end_clean();
                                header("Location: $url");
                                exit();
                            } else {
                                echo '<p class="error">The email address and password do not match our records.</p>';
                            }
                        } else {
                            echo '<p class="error">Try again.</p>';
                        }
                    }
                }
                mysqli_close($dbcon);
            ?>

            <div id="register-form-container">
                <div id="register-form-content">
                    <h2>Login</h2>
                    <form action="login.php" method="post">

                        <p>
                            <label class="label" for='email'>Email Address</label>
                            <input type="email" id="email" name="email" size="30" maxlength="50"
                            value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>">
                        </p>

                        <p>
                            <label class="label" for='psword'>Password</label>
                            <input type="password" id="psword" name="psword" size="30" maxlength="40"
                            value="<?php if (isset($_POST['psword'])) echo $_POST['psword']; ?>">
                        </p>

                        <p>
                            <input type="submit" id="submit" name="submit" value="Login">
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php include('footer.php'); ?>
</body>
</html>
