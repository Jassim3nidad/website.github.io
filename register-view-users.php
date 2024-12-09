<?php
    session_start();
    if (!isset($_SESSION['user_level']) or ($_SESSION['user_level'] !=1)){
        header("Location: login.php");
        exit();
    }
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
    <title>Website ni Trinidad</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/includes.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        td a {
        text-decoration: none; 
        color: inherit; 
        }
    
    td a:hover {
        text-decoration: underline; 
        }
    </style>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</head>
<body>
    <div id="container">
        <?php include('header.php');?>
        <?php include('nav.php');?>
        
        <div id="content">
            <h2>Registered Users</h2>
            <p>
                <?php
                    require("mysqli_connect.php");
                    $q = "SELECT fname, lname, email, DATE_FORMAT(registration_date, '%M %d, %Y') AS regdat, user_id FROM users
                    ORDER BY user_id ASC";
                    $result = mysqli_query($dbcon, $q);
                    if ($result) {
                        echo '<table><tr><th>Name</th><th>Email</th><th>Registered Date</th><th>Actions</th></tr>';
                        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                            echo '<tr>
                            <td>'.$row['lname'].', '.$row['fname'].'</td>
                            <td>'.$row['email'].'</td>
                            <td>'.$row['regdat'].'</td>
                            <td style="text-align: center;">
                                <a href="edit_user.php?id='.$row['user_id'].'">
                                    📝
                                </a>
                                <a href="delete_user.php?id='.$row['user_id'].'">
                                    ❌
                                </a>
                            </td>
                            </tr>';
                        }
                        echo '</table>';
                        mysqli_free_result($result);
                    } else {
                        echo '<p class="error">The current users could not be retrieved. Contact the system administrator.</p>';
                    }
                    mysqli_close($dbcon);
                ?>
            </p>
        </div>
    </div>
    <?php include('footer.php');?>
</body>
</html>
