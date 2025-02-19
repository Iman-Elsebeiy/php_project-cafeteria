<?php
// reset_password.php
require_once '../includes/connect_to_db.php';
require_once "../includes/utils.php";
 
$pdo = connectToDB();
$token = $_GET['token'] ?? '';
 
$error = '';
$message = '';
 
if ($token) {
    // Validate the token: It must exist and be less than 1 hour old.
    $stmt = $pdo->prepare("SELECT * FROM password_resets WHERE token = ? AND created_at > DATE_SUB(NOW(), INTERVAL 1 HOUR)");
    $stmt->execute([$token]);
    $resetRequest = $stmt->fetch(PDO::FETCH_ASSOC);
 
    if (!$resetRequest) {
        $error = "Invalid or expired token.";
    } else {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $newPassword = $_POST['password'] ?? '';
            if ($newPassword) {
                // Update the user's password
                $updateStmt = $pdo->prepare("UPDATE users SET password = ? WHERE email = ?");
                $updateStmt->execute([password_hash($newPassword, PASSWORD_BCRYPT), $resetRequest['email']]);
 
                // Delete the reset token
                $deleteStmt = $pdo->prepare("DELETE FROM password_resets WHERE token = ?");
                $deleteStmt->execute([$token]);
 
                if ($updateStmt->rowCount() > 0) {
                    $message = "Password successfully updated. Redirecting to login...";
                } else {
                    $error = "Failed to update password.";
                }
            } else {
                $error = "Please enter a new password.";
            }
        }
    }
} else {
    $error = "Token missing.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Reset Password</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Animate.css for animations -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<style>
    body {
      background: linear-gradient(135deg, #667eea, #764ba2);
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
<h2 class="card-title text-center mb-4">Reset Password</h2>
<?php if ($error): ?>
<div class="alert alert-danger animate__animated animate__shakeX">
<?= htmlspecialchars($error) ?>
</div>
<?php endif; ?>
<?php if ($message): ?>
<div class="alert alert-success animate__animated animate__fadeIn">
<?= htmlspecialchars($message) ?>
</div>
<script>
                // Redirect to login page after 3 seconds
                setTimeout(function() {
                  window.location.href = "login.php?message=password_reset_success";
                }, 3000);
</script>
<?php endif; ?>
<?php if (!$message && !$error): ?>
<form action="reset_password.php?token=<?= htmlspecialchars($token) ?>" method="POST">
<div class="mb-3">
<label for="password" class="form-label">Enter your new password:</label>
<input type="password" name="password" id="password" class="form-control" required>
</div>
<div class="d-grid">
<button type="submit" class="btn btn-primary">Reset Password</button>
</div>
</form>
<?php endif; ?>
</div>
</div>
</div>
</div>
</div>
<!-- Bootstrap Bundle JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>