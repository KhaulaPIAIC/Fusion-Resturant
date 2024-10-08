<?php
include("dbConnection.php");

$errorMessage = ""; // Variable to hold error message

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']); // Hash the password
    $sql = "SELECT * FROM signup WHERE email = '$email' AND password = '$password'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        session_start();
        $row = $result->fetch_assoc();
        $_SESSION['email'] = $row['email'];
        header("Location: dashboard.php");
        exit();
    } else {
        $errorMessage = "Email not found or incorrect password."; // Set error message
    }
}
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

    <div class="container-fluid vh-100 d-flex justify-content-center align-items-center">
        <div class="col-md-6 p-5 wow fadeInUp" data-wow-delay="0.2s">
            <h5 class="section-title ff-secondary text-start text-primary fw-normal">Account</h5>
            <h1 class="text-white mb-4 text-center">Login</h1>

            <!-- Login Form -->
            <form method="post">
                <div class="row g-3">
                    <!-- Email -->
                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="email" class="form-control" id="loginEmail" placeholder="Your Email" name="email" required>
                            <label for="loginEmail">Your Email</label>
                        </div>
                    </div>
                    <!-- Password -->
                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="password" class="form-control" id="loginPassword" placeholder="Password" name="password" required>
                            <label for="loginPassword">Password</label>
                        </div>
                    </div>
                    <!-- Login Button -->
                    <div class="col-12">
                        <button class="btn btn-primary w-100 py-3" type="submit" name="submit">Login</button>
                    </div>
                    <h6 class="text-white mb-4 text-center">Create an account? <a href="SignUp.php" class="nav-item">Sign up</a></h6>
                </div>
            </form>
        </div>
    </div>

    <!-- Error Modal -->
    <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="errorModalLabel">Login Error</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php if ($errorMessage): ?>
                        <?php echo $errorMessage; ?>
                    <?php endif; ?>
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
            <?php if ($errorMessage): ?>
                var errorModal = new bootstrap.Modal(document.getElementById("errorModal"));
                errorModal.show();
            <?php endif; ?>
        });
    </script>
</body>
</html>
