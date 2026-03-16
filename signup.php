<?php
session_start();
require_once 'db.php';

$error = '';

if (isset($_SESSION['user_id'])) {
    if (!empty($_SESSION['is_subscribed'])) {
        header('Location: dashboard.php');
    } else {
        header('Location: subscription.php');
    }
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirm_password'] ?? '';

    if ($email === '' || $username === '' || $password === '' || $confirmPassword === '') {
        $error = 'Please complete all fields.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Please enter a valid email address.';
    } elseif ($password !== $confirmPassword) {
        $error = 'Passwords do not match.';
    } else {
        $check = $conn->prepare('SELECT id FROM users WHERE username = ? OR email = ? LIMIT 1');
        $check->bind_param('ss', $username, $email);
        $check->execute();
        $result = $check->get_result();

        if ($result->fetch_assoc()) {
            $error = 'Username or email is already registered.';
            $check->close();
        } else {
            $check->close();
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $subscriptionStatus = 'inactive';
            $stmt = $conn->prepare('INSERT INTO users (email, username, password, subscription_status) VALUES (?, ?, ?, ?)');
            $stmt->bind_param('ssss', $email, $username, $hashedPassword, $subscriptionStatus);

            if ($stmt->execute()) {
                $_SESSION['user_id'] = $stmt->insert_id;
                $_SESSION['username'] = $username;
                $_SESSION['is_subscribed'] = false;
                header('Location: subscription.php');
                exit();
            } else {
                $error = 'Something went wrong while creating the account.';
            }
            $stmt->close();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - ANGAT.TV</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body class="auth-page">
    <div class="auth-container">
        <div class="landing-left">
           <center><h1 class="logo-title">ANGAT.TV</h1></center>
        </div>        

        <div class="auth-card">
            <h1 class="auth-title">Sign Up</h1>
            <?php if ($error): ?>
                <p style="color:#ff6b6b; margin-bottom: 15px; text-align:center;"><?php echo htmlspecialchars($error); ?></p>
            <?php endif; ?>
            
            <form method="POST" class="auth-form">
                <input type="email" name="email" placeholder="Email" class="auth-input" required>
                <input type="text" name="username" placeholder="Username" class="auth-input" required>
                <input type="password" name="password" placeholder="Password" class="auth-input" required>
                <input type="password" name="confirm_password" placeholder="Confirm Password" class="auth-input" required>
                <div class="auth-submit">
                    <button type="submit" class="auth-btn">Create Account</button>
                </div>
            </form>
            
            <p class="auth-link-text">
                Already have an account? 
                <a href="login.php" class="auth-link">Login here</a>
            </p>
        </div>
    </div>
</body>
</html>
