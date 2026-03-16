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
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username === '' || $password === '') {
        $error = 'Please enter your username and password.';
    } else {
        $stmt = $conn->prepare('SELECT id, username, password, subscription_status FROM users WHERE username = ? LIMIT 1');
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($user = $result->fetch_assoc()) {
            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = (int) $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['is_subscribed'] = ($user['subscription_status'] ?? 'inactive') === 'active';

                if ($_SESSION['is_subscribed']) {
                    header('Location: dashboard.php');
                } else {
                    header('Location: subscription.php');
                }
                exit();
            }
        }

        $error = 'Invalid username or password.';
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - ANGAT.TV</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body class="auth-page">
    <div class="auth-container">
        <div class="title-container">
           <center><h1 class="logo-title">ANGAT.TV</h1></center>
        </div>

        <div class="auth-card">
            <h1 class="auth-title">Login</h1>

            <?php if ($error): ?>
                <p style="color:#ff6b6b; margin-bottom: 15px; text-align:center;"><?php echo htmlspecialchars($error); ?></p>
            <?php endif; ?>
            
            <form method="POST" class="auth-form">
                <input type="text" name="username" placeholder="Username" class="auth-input" required>
                <input type="password" name="password" placeholder="Password" class="auth-input" required>
                <div class="auth-submit">
                    <button type="submit" class="auth-btn">Login</button>
                </div>
            </form>
            
            <p class="auth-link-text">
                Not Registered? 
                <a href="signup.php" class="auth-link">Create an account</a>
            </p>
        </div>
    </div>
</body>
</html>
