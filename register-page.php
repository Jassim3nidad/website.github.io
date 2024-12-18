<!DOCTYPE HTML>
<html lang="en">
<head>
    <title>Register page - Website ni Trinidad</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/includes.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</head>
<body>
    <div id="container">
        <?php include('header.php'); ?>
        <?php include('nav.php'); ?>
        <?php include('info-col.php'); ?>
        <?php include('mysqli_connect.php'); // Database connection ?>

        <div id="content">
            <?php
            // Initialize errors array
            $errors = array(); 

            // Check if the form has been submitted
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Validate first name
                if (empty($_POST['fname'])) {
                    $errors[] = 'Please enter your first name.';
                } else {
                    $fn = trim($_POST['fname']);
                }

                // Validate last name
                if (empty($_POST['lname'])) {
                    $errors[] = 'Please enter your last name.';
                } else {
                    $ln = trim($_POST['lname']);
                }

                // Validate email
                if (empty($_POST['email'])) {
                    $errors[] = 'Please enter your email.';
                } else {
                    $email = trim($_POST['email']);
                }

                // Validate password and confirm password
                if (empty($_POST['psword1'])) {
                    $errors[] = 'Please enter your password.';
                } else {
                    $psword1 = trim($_POST['psword1']);  // Store the entered password
                    // Check if passwords match
                    if ($psword1 != $_POST['psword2']) {
                        $errors[] = 'Your passwords do not match.';
                    } else {
                        // Hash the password before storing it
                        $p_hashed = password_hash($psword1, PASSWORD_DEFAULT);  // Hash the password securely
                    }
                }

                // If no errors, insert data into the database
                if (empty($errors)) {
                    // Prepare SQL statement for inserting data
                    $query = "INSERT INTO users (fname, lname, email, psword, registration_date) VALUES (?, ?, ?, ?, NOW())";

                    // Prepare and bind the statement
                    $stmt = mysqli_prepare($dbcon, $query);
                    mysqli_stmt_bind_param($stmt, 'ssss', $fn, $ln, $email, $p_hashed);

                    // Execute the query
                    if (mysqli_stmt_execute($stmt)) {
                        // Redirect to thank you page upon successful registration
                        header('Location: register-thanks.php');
                        exit();
                    } else {
                        echo '<h2>Error during registration. Please try again.</h2>';
                    }

                    // Close the statement
                    mysqli_stmt_close($stmt);
                } else {
                    // Display errors if any
                    echo '<h2>Error!</h2>
                          <p class="Error">The following error(s) occurred:<br>';
                    foreach ($errors as $ex) {
                        echo "→ $ex<br/>";
                    }
                    echo '</p><h4>Please try again</h4><br/><br/>';
                }
            }
            ?>

            <div id="register-form-container">
                <div id="register-form-content">
                    <h2>Register</h2>
                    <form action="register-page.php" method="post">
                        <p>
                            <label class="label" for='fname'>First name</label>
                            <input type="text" id="fname" name="fname" size="30" maxlength="40"
                            value="<?php if (isset($_POST['fname'])) echo $_POST['fname']; ?>">
                        </p>

                        <p>
                            <label class="label" for='lname'>Last name</label>
                            <input type="text" id="lname" name="lname" size="30" maxlength="40"
                            value="<?php if (isset($_POST['lname'])) echo $_POST['lname']; ?>">
                        </p>

                        <p>
                            <label class="label" for='email'>Email Address</label>
                            <input type="email" id="email" name="email" size="30" maxlength="50"
                            value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>">
                        </p>

                        <p>
                            <label class="label" for='psword1'>Password</label>
                            <input type="password" id="psword1" name="psword1" size="30" maxlength="40"
                            value="<?php if (isset($_POST['psword1'])) echo $_POST['psword1']; ?>">
                        </p>

                        <p>
                            <label class="label" for='psword2'>Confirm Password</label>
                            <input type="password" id="psword2" name="psword2" size="30" maxlength="40"
                            value="<?php if (isset($_POST['psword2'])) echo $_POST['psword2']; ?>">
                        </p>

                        <p>
                            <input type="submit" id="submit" name="submit" value="Register">
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php include('footer.php'); ?>
</body>
</html>
