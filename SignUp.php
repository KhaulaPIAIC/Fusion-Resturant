<?php
include("dbConnection.php"); // Ensure connection is included only once

$showModal = false; // Initialize the flag for showing the modal
$errorMessage = ''; // Initialize error message variable

if (isset($_POST['submit'])) {
    $username = $_POST['username'];   
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password = md5($password); // Encrypt the password

    // Validate username (only letters, numbers, and underscores allowed)
    if (!preg_match('/^[a-zA-Z0-9_]+$/', $username)) {
        $errorMessage = 'Username can only contain letters, numbers, and underscores.';
    }
    // Validate email format
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMessage = 'Your email is incorrect.';
    } else {
        // Check if email already exists in the database
        $checkEmail = "SELECT * from signup where email='$email'";
        $result = $conn->query($checkEmail);  // $conn is still open and valid here

        if ($result->num_rows > 0) {
            $errorMessage = 'Email already exists!';
        } else {
            // Insert new user into the database
            $insertQuery = "INSERT INTO signup(username,email,password) VALUES('$username','$email','$password')";
            if ($conn->query($insertQuery) === TRUE) {
                $showModal = true; // Set the flag to show the success modal
                // Instead of redirecting immediately, we will handle it in HTML
            } else {
                echo "Error: " . $conn->error;
            }
        }
    }
}

$conn->close(); // Close the connection only after all queries are done
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Restoran - Bootstrap Restaurant Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&family=Pacifico&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>
<body class="bg-dark">
    <div class="container-fluid vh-100 d-flex justify-content-center align-items-center"> <!-- Full height container -->
        <div class="col-md-6 p-5 wow fadeInUp" data-wow-delay="0.2s">
            <h5 class="section-title ff-secondary text-start text-primary fw-normal">Account</h5>
            <h1 class="text-white mb-4 text-center">Signup</h1>

            <!-- Signup Form -->
            <form class="mb-5" method="post">
                <div class="row g-3">
                    <!-- Name -->
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="signupName" placeholder="Your Name" name="username" required>
                            <label for="signupName">Your Name</label>
                        </div>
                    </div>
                    <!-- Email -->
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="email" class="form-control" id="signupEmail" placeholder="Your Email" name="email" required>
                            <label for="signupEmail">Your Email</label>
                        </div>
                    </div>
                    <!-- Password -->
                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="password" class="form-control" id="signupPassword" placeholder="Password" name="password" required>
                            <label for="signupPassword">Password</label>
                        </div>
                    </div>

                    <!-- Signup Button -->
                    <div class="col-12">
                        <button class="btn btn-primary w-100 py-3" type="submit" name="submit">Sign Up</button>
                    </div>
                    <h6 class="text-white mb-4 text-center">Already have an account? <a href="Login.php" class="nav-item">Login</a></h6>
                </div>
                <?php if ($errorMessage): ?>
                    <div class="alert alert-danger mt-3" role="alert">
                        <?php echo $errorMessage; ?>
                    </div>
                <?php endif; ?>
            </form>
        </div>
    </div>

    <!-- Signup Success Modal -->
    <div class="modal fade" id="signupSuccessModal" tabindex="-1" aria-labelledby="signupSuccessModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="signupSuccessModalLabel">Success</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    You have successfully registered!
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (make sure this is included) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            <?php if ($showModal): ?>
                var signupSuccessModal = new bootstrap.Modal(document.getElementById("signupSuccessModal"));
                signupSuccessModal.show();
                setTimeout(function() {
                    window.location.href = "Login.php"; // Redirect after showing the modal
                }, 2000); // Redirect after 2 seconds
            <?php endif; ?>
        });
    </script>
</body>

</html>
