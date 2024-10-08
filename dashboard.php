<?php 
session_start();
include("dbConnection.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa; /* Light background color */
        }
        .welcome-container {
            text-align: center;
            padding: 15%;
            background-color: #ffffff; /* White background for the container */
            border-radius: 8px; /* Rounded corners */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Subtle shadow */
        }
        .welcome-message {
            font-size: 50px;
            font-weight: bold;
            color: #343a40; /* Dark text color */
        }
        .logout-link {
            font-size: 20px;
            margin-top: 20px;
            text-decoration: none;
            color: #007bff; /* Bootstrap primary color */
        }
        .logout-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container welcome-container">
        <p class="welcome-message">Welcome 
            <?php  
            if(isset($_SESSION['email'])){
                $email = $_SESSION['email'];
                $query = mysqli_query($conn, "SELECT signup.* FROM `signup` WHERE signup.email = '$email'");
                while($row = mysqli_fetch_array($query)){
                    echo htmlspecialchars($row['username']).' ('.htmlspecialchars($row['email']).')'; // Safely output username and email
                }
            } else {
                echo "Guest"; // Fallback if the session is not set
            }
            ?> 
            :)
        </p>
        <a class="logout-link" href="logout.php">Logout</a>
    </div>

    <!-- Bootstrap JS (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
