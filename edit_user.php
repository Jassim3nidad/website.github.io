<!DOCTYPE HTML>
<html lang="en">
<head>
    <title>Edit User - Website ni Trinidad</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/includes.css">
    <style>

        #content {
            width: 50%;
            margin: 100px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
        form {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 15px;
        }
        .form-group {
            width: 100%;
            max-width: 400px;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }
        label {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 5px;
            color: #333;
        }
        input[type="text"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }
        .form-actions {
            margin-top: 20px;
            text-align: center;
            width: 100%;
        }
        input[type="submit"] {
            background-color: #3498db;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 4px;
            transition: background-color 0.3s;
        }
        input[type="submit"]:hover {
            background-color: #2980b9;
        }
        a {
            color: #3498db;
            text-decoration: underline;
        }
        a:hover {
            color: #2980b9;
        }
        #content a {
            color: #3498db!important; 
            text-decoration: underline;
        }

        #content a:hover {
            color: #2980b9!important; 
        }
    </style>
    </style>
</head>
<body>
    <div id="container">
        <?php include('header.php'); ?>
        <?php include('nav.php'); ?>

        <div id="content">
            <h2>Edit User</h2>
            <?php
                if ((isset($_GET['id'])) && (is_numeric($_GET['id']))) {
                    $id = $_GET['id'];
                } elseif ((isset($_POST['id'])) && (is_numeric($_POST['id']))) {
                    $id = $_POST['id'];
                } else {
                    echo '<p>You are not supposed to be here!</p>
                    <p><a href="index.php">Click here to get redirected</a></p>';
                    exit();
                }

                require('mysqli_connect.php');

                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $fname = mysqli_real_escape_string($dbcon, trim($_POST['fname']));
                    $lname = mysqli_real_escape_string($dbcon, trim($_POST['lname']));

                    if (!empty($fname) && !empty($lname)) {
                        $q = "UPDATE users SET fname='$fname', lname='$lname' WHERE user_id=$id";
                        $result = @mysqli_query($dbcon, $q);

                        if (mysqli_affected_rows($dbcon) == 1) {
                            echo '<p>The user information has been updated.</p>
                            <p><a href="register-view-users.php">Go back</a></p>';
                        } else {
                            echo '<p>The record could not be updated due to a system error.</p>';
                        }
                    } else {
                        echo '<p>Please fill in both fields.</p>';
                    }
                } else {
                    $q = "SELECT fname, lname FROM users WHERE user_id=$id";
                    $result = @mysqli_query($dbcon, $q);

                    if ($result && mysqli_num_rows($result) == 1) {
                        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                        $fname = $row['fname'];
                        $lname = $row['lname'];
                        echo '
                        <form action="edit_user.php" method="post">
                            <label for="fname">First Name:</label>
                            <input type="text" name="fname" id="fname" value="' . htmlspecialchars($fname) . '">
                            <label for="lname">Last Name:</label>
                            <input type="text" name="lname" id="lname" value="' . htmlspecialchars($lname) . '">
                            <input type="hidden" name="id" value="' . $id . '">
                            <input type="submit" value="Update">
                        </form>
                        ';
                    } else {
                        echo '<p>ID not found.</p>
                        <p><a href="register-view-users.php">Go back.</a></p>';
                    }
                }

                mysqli_close($dbcon);
            ?>
        </div>
        <?php include('footer.php'); ?>
    </div>
</body>
</html>
