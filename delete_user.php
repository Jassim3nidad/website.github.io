<!DOCTYPE HTML>
<html lang="en">
<head>
    <title>Delete User - Website ni Trinidad</title>
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
        }
        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
        h3 {
            text-align: center;
            color: #e74c3c;
        }
        p {
            font-size: 16px;
            text-align: center;
            color:#333
        }
        a {
            text-decoration: underline;
        }
        form {
            text-align: center;
            margin-top: 20px;
        }
        input[type="submit"] {
            background-color: #3498db;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            margin: 10;
            border-radius: 4px;
            transition: background-color 0.3;
        }
        input[type="submit"]:hover {
            background-color: #2980b9;
        }
        #content a {
            color: #3498db!important; 
            text-decoration: underline;
        }

        #content a:hover {
            color: #2980b9!important; 
        }


    </style>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</head>
<body>
    <div id="container">
        <?php include('header.php');?>
        <?php include('nav.php');?>

        <div id="content">
            <h2>Deleting Record...</h2>
            <?php
                if((isset($_GET['id'])) && (is_numeric($_GET['id']))) {(
                    $id = $_GET['id']);
                }elseif((isset($_POST['id'])) && (is_numeric($_POST['id']))) {(
                    $id = $_POST['id']);
                }else{
                    echo '<p>You are not supposed to be here!</p>
                    <p><a href="index.php">Click here to go back</a></p>';
                    exit() ;
                }

                require ('mysqli_connect.php');
                    if($_SERVER['REQUEST_METHOD'] == 'POST'){
                        if($_POST['sure'] == 'Yes'){
                            $q = "DELETE FROM users WHERE user_id = $id";
                            $result = @mysqli_query($dbcon, $q);
                            if(mysqli_affected_rows($dbcon) == 1) {
                                echo '<p>The record has been deleted.</p>
                                <p><a href="register-view-users.php">Go back</a></p>';
                            }else{
                                echo '<p>The record could not be deleted due to a system error.</p>';
                            }
                        }else{//no
                            echo '<p>Record was not deleted.</p>
                            <p><a href="register-view-users.php">Go back</a></p>';//record was not deleted
                            //link going back to view-users page
                        }
                }else{//display details of user
                    $q = "SELECT CONCAT(fname, ' ', lname) from users where user_id = $id";
                    $result=@mysqli_query($dbcon, $q);
                    if($result && mysqli_num_rows($result) == 1){
                        $row = mysqli_fetch_array($result, MYSQLI_NUM);
                        echo "<h3>Are you sure you want to delete this user? $row[0]</h3>";
                        echo '
                        <form action="delete_user.php" method="post">
                        <input id="submit-yes" type="submit" name="sure" value="Yes">
                        <input id="submit-yes" type="submit" name="sure" value="No">
                        <input type="hidden" name="id" value="'.$id.'">
                        </form>
                        ';
                    }else{//not valid id. no members found
                        echo '<h3>ID not found.
                        <a href="index.php">Go back</a></h3>';
                    }
                }    mysqli_close($dbcon)
            ?>
    </div>
    <?php include('footer.php');?>
</body>
</html>