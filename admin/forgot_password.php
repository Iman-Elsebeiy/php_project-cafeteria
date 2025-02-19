<?php
// forgot_password.php
require_once '../includes/connect_to_db.php';
require_once "../includes/utils.php";
require '../vendor/autoload.php'; // Load PHPMailer
 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
 
$error = '';
 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? null;
 
    if ($email) {
        $pdo = connectToDB();
 
        // Check if email exists in users table
        $stmt = $pdo->prepare("SELECT user_id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
 
        if ($user) {
            // Delete any existing token for this email
            $deleteStmt = $pdo->prepare("DELETE FROM password_resets WHERE email = ?");
            $deleteStmt->execute([$email]);
 
            // Generate a unique token
            $token = bin2hex(random_bytes(16));
 
            // Insert new reset request
            $insert = $pdo->prepare("INSERT INTO password_resets (email, token, created_at) VALUES (?, ?, NOW())");
            $insert->execute([$email, $token]);
 
            // Construct reset link
            $resetLink = "reset_password.php?token=" . $token;
 
            // Send email using PHPMailer
            $mail = new PHPMailer(true);
 
            try {
                $mail->SMTPDebug = SMTP::DEBUG_SERVER;
                $mail->isSMTP();
                $mail->Host       = 'sandbox.smtp.mailtrap.io';
                $mail->SMTPAuth   = true;
                $mail->Username   = 'af16c4f320fcf8';
                $mail->Password   = '14d4fd22622035';
                $mail->SMTPSecure = 'tls';
                $mail->Port       = 587;
 
                $mail->setFrom('no-reply@yourdomain.com', 'php_project-cafeteria');
                $mail->addAddress($email);
 
                $mail->Subject = "Password Reset Request";
                $mail->Body    = "Hello, $email\n\nWe received a request to reset your password. Click the link below to reset it:\n\n$resetLink\n\nIf you did not request this, please ignore this email.";
 
                $mail->send();
 
                // Redirect user to the reset link (or you may want to display a confirmation message instead)
                header("Location: $resetLink");
                exit();
            } catch (Exception $e) {
                $error = "Failed to send email. Please try again later.";
            }
        } else {
            $error = "No user found with that email address.";
        }
    } else {
        $error = "Please enter your email.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Forgot Password</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Animate.css for animations -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<style>
    body {
      background: linear-gradient(135deg,rgb(145, 159, 223),rgb(107, 97, 117));
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 1rem;
    }
    .card {
      border: none;
      border-radius: 1rem;
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    }
    .card-body {
      padding: 2rem;
    }
    .form-control, .btn {
      border-radius: 0.5rem;
    }
</style>
</head>
<body>
<div class="container">
<div class="row justify-content-center">
<div class="col-md-6">
<div class="card animate__animated animate__fadeInDown">
<div class="card-body">
<h1 class="card-title text-center mb-4">Forgot Password</h1>
<?php if ($error): ?>
<div class="alert alert-danger animate__animated animate__shakeX">
<?= htmlspecialchars($error) ?>
</div>
<?php endif; ?>
<form action="" method="POST">
<div class="mb-3">
<label for="email" class="form-label">Enter your email address:</label>
<input type="email" name="email" id="email" class="form-control" placeholder="you@example.com" required>
</div>
<div class="d-grid">
<button type="submit" class="btn btn-primary">Send Reset Link</button>
</div>
</form>
</div>
</div>
</div>
</div>
</div>
<!-- Bootstrap Bundle JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>