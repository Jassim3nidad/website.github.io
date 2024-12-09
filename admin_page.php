<!DOCTYPE HTML>
<html lang="en">
<head>
    <title>Admin ni Trinidad</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/includes.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <style>
        /* Reset some default styles for a better layout */
        body, h1, p, img {
            margin: 0;
            padding: 0;
        }

        /* General body styling */
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f4f4f4;
            color: #333;
        }

        /* Container for the entire page */
        #container {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* Header and Navigation bar */
        #header, #nav_admin {
            background-color: #333;
            color: white;
            padding: 15px;
        }

        #header a, #nav_admin a {
            color: white;
            text-decoration: none;
            padding: 10px;
            display: inline-block;
        }

        /* Content styling */
        #content {
            flex: 1;
            padding: 20px;
            background-color: white;
            text-align: center;
        }

        /* Styling for the title */
        h1 {
            font-size: 2rem;
            color: #333;
            margin-bottom: 20px;
        }

        /* Make the image responsive */
        img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
        }

        /* Footer styling */
        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px 0;
        }

        /* Responsive design adjustments */
        @media (max-width: 768px) {
            h1 {
                font-size: 1.5rem;
            }

            #header, #nav_admin {
                padding: 10px;
            }

            img {
                max-width: 90%;
            }
        }
    </style>
</head>
<body>
    <div id="container">
        <!-- Include header and navigation -->
        <?php include('header_admin.php'); ?>
        <?php include('nav_admin.php'); ?>

        <!-- Main content area -->
        <div id="content">
            <h1>Welcome to Admin Page</h1>
            <img src="https://cdn1.dronahq.com/wp-content/uploads/2024/08/Dashboard-Image-Final.webp" alt="Admin Dashboard Image">
        </div>
    </div>

    <!-- Optional footer -->
    <footer>
        <p>&copy; 2024 Trinidad Admin Dashboard</p>
    </footer>
</body>
</html>
