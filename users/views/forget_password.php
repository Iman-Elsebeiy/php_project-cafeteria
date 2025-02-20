<?php
    // forgot_password.php
    require_once "../../includes/utils.php";
    require_once "../../includes/connect_to_db.php";
    // require_once "../includes/utils.php";
    require '../../vendor/autoload.php'; // Load PHPMailer

    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;

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
                $resetLink = "localhost/PHP-Project/php_project-cafeteria/users/views/reset_password.php?token=" . $token;

                // Send email using PHPMailer
                $mail = new PHPMailer(true);

                try {
                    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
                    $mail->isSMTP();
                    $mail->Host       = 'sandbox.smtp.mailtrap.io';
                    $mail->SMTPAuth   = true;
                    $mail->Username   = '5bc887318c2018';
                    $mail->Password   = '8f80ce434ebdd9';
                    $mail->SMTPSecure = 'tls';
                    $mail->Port       = 587;

                    $mail->setFrom('no-reply@yourdomain.com', 'php_project-cafeteria');
                    $mail->addAddress($email);

                    $mail->Subject = "Password Reset Request";
                    $mail->Body    = "Hello, $email\n\nWe received a request to reset your password. Click the link below to reset it:\n\n$resetLink\n\nIf you did not request this, please ignore this email.";

                    $mail->send();

                    // header("Location: $resetLink");
                    header("Location: reset_password.php?message=email_sent");
                    // echo "An email with a password reset link has been sent to your email address.";
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
    <link rel="stylesheet" href="../style/style.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Animate.css for animations -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Animate.css for animations -->
    <link rel="stylesheet" href="../../style/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
</head>

<body>

    <div class="container adduser login col-lg-5">
        <?php if ($error): ?>
        <div class="alert alert-danger animate__animated animate__shakeX">
            <?php echo htmlspecialchars($error) ?>
        </div>
        <?php endif; ?>
        <h1 class="text-center">forget password </h1>
        <form class="pd-3" method="POST">

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">email</label>
                <input type="text" class="form-control" name="email" id="email"
                    value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">


            </div>
            <div class="d-flex justify-content-center">
                <button type="submit" name="send">Send reset link</button>
            </div>


        </form>
    </div>
    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>