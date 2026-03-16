<?php
require_once 'db.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function require_login(): void
{
    if (!isset($_SESSION['user_id'])) {
        header('Location: login.php');
        exit();
    }
}

function has_active_subscription(): bool
{
    global $conn;

    require_login();

    $stmt = $conn->prepare('SELECT subscription_status FROM users WHERE id = ? LIMIT 1');
    $stmt->bind_param('i', $_SESSION['user_id']);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();

    $isActive = isset($user['subscription_status']) && $user['subscription_status'] === 'active';
    $_SESSION['is_subscribed'] = $isActive;

    return $isActive;
}

function require_subscription(): void
{
    if (!has_active_subscription()) {
        header('Location: subscription.php');
        exit();
    }
}
?>