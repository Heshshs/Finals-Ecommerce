<?php
session_start();
require_once 'db.php';

/*
Later, when you add admin role checking, you can use something like:
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit();
}
*/

$adminName = $_SESSION['username'] ?? 'Admin';

/* =========================
   Dashboard Statistics
========================= */

// Total Users
$totalUsers = 0;
$result = $conn->query("SELECT COUNT(*) AS total FROM users");
if ($result && $row = $result->fetch_assoc()) {
    $totalUsers = (int)$row['total'];
}

// Active Subscribers
$totalSubscribers = 0;
$result = $conn->query("SELECT COUNT(*) AS total FROM users WHERE subscription_status = 'active'");
if ($result && $row = $result->fetch_assoc()) {
    $totalSubscribers = (int)$row['total'];
}

/*
IMPORTANT:
For Total Anime and Total Movies, this depends on your content table.
If you do not have the content table yet, these will stay 0 for now.
Change 'content' and 'type' below to match your actual table/column names.
*/
$totalAnime = 0;
$totalMovies = 0;

// Example only — will work only if you have a content table with a type column
$checkContentTable = $conn->query("SHOW TABLES LIKE 'content'");
if ($checkContentTable && $checkContentTable->num_rows > 0) {
    $result = $conn->query("SELECT COUNT(*) AS total FROM content WHERE type = 'anime'");
    if ($result && $row = $result->fetch_assoc()) {
        $totalAnime = (int)$row['total'];
    }

    $result = $conn->query("SELECT COUNT(*) AS total FROM content WHERE type = 'movie'");
    if ($result && $row = $result->fetch_assoc()) {
        $totalMovies = (int)$row['total'];
    }
}

/* =========================
   Recent Users
========================= */
$recentUsers = [];
$result = $conn->query("
    SELECT username, email, subscription_status
    FROM users
    ORDER BY created_at DESC
    LIMIT 5
");

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $recentUsers[] = [
            'username' => $row['username'],
            'email' => $row['email'],
            'status' => ucfirst($row['subscription_status'] ?? 'inactive')
        ];
    }
}

/* =========================
   Recent Subscriptions
========================= */
$recentSubscriptions = [];
$result = $conn->query("
    SELECT username, subscription_plan, subscription_status
    FROM users
    WHERE subscription_plan IS NOT NULL
    ORDER BY created_at DESC
    LIMIT 5
");

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $recentSubscriptions[] = [
            'username' => $row['username'],
            'plan' => ucfirst($row['subscription_plan'] ?? 'None'),
            'status' => ucfirst($row['subscription_status'] ?? 'inactive')
        ];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - ANGAT.TV</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body class="admin-page">
    <div class="top-header">
        <div class="header-content">
            <div class="header-left">
                <button class="menu-btn" id="menuBtn" type="button" aria-label="Menu">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <line x1="3" y1="12" x2="21" y2="12"></line>
                        <line x1="3" y1="6" x2="21" y2="6"></line>
                        <line x1="3" y1="18" x2="21" y2="18"></line>
                    </svg>
                </button>
                <h1 class="header-logo">ANGAT.TV</h1>
            </div>

            <div class="header-right">
                <div class="user-info">
                    <span class="welcome-text">
                        Welcome, <?php echo htmlspecialchars($adminName); ?>
                        <span class="admin-badge">ADMIN</span>
                    </span>
                    <div class="user-avatar"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="sidebar" id="sidebar">
        <div class="sidebar-content">
            <button class="close-menu" id="closeMenu">
                <span>← Close Menu</span>
            </button>

            <div class="menu-items">
                <a href="admin_dashboard.php" class="menu-item active">Dashboard</a>
                <a href="admin_users.php" class="menu-item">Users</a>
                <a href="admin_subscriptions.php" class="menu-item">Subscriptions</a>
                <a href="admin_content.php" class="menu-item">Content</a>
                <a href="dashboard.php" class="menu-item">Back to Site</a>
                <button class="menu-item logout-btn" id="logoutBtn">Logout</button>
            </div>
        </div>
    </div>

    <main class="admin-main">
        <section class="admin-hero">
            <h2>Admin Dashboard</h2>
            <p>Manage users, subscriptions, and content for ANGAT.TV in one place.</p>
        </section>

        <section class="admin-stats">
            <div class="admin-card">
                <h3>Total Users</h3>
                <div class="admin-number"><?php echo $totalUsers; ?></div>
            </div>

            <div class="admin-card">
                <h3>Active Subscribers</h3>
                <div class="admin-number"><?php echo $totalSubscribers; ?></div>
            </div>

            <div class="admin-card">
                <h3>Total Anime</h3>
                <div class="admin-number"><?php echo $totalAnime; ?></div>
            </div>

            <div class="admin-card">
                <h3>Total Movies</h3>
                <div class="admin-number"><?php echo $totalMovies; ?></div>
            </div>
        </section>

        <section class="admin-sections">
            <div class="admin-panel">
                <h3>Recent Users</h3>
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($recentUsers as $user): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($user['username']); ?></td>
                                <td><?php echo htmlspecialchars($user['email']); ?></td>
                                <td class="<?php echo strtolower($user['status']) === 'active' ? 'status-active' : 'status-inactive'; ?>">
                                    <?php echo htmlspecialchars($user['status']); ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div class="admin-panel">
                <h3>Recent Subscriptions</h3>
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Plan</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($recentSubscriptions as $subscription): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($subscription['username']); ?></td>
                                <td><?php echo htmlspecialchars($subscription['plan']); ?></td>
                                <td class="<?php echo strtolower($subscription['status']) === 'active' ? 'status-active' : 'status-expired'; ?>">
                                    <?php echo htmlspecialchars($subscription['status']); ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </section>

        <section class="admin-actions">
            <h3>Quick Actions</h3>
            <div class="action-buttons">
                <a href="admin_users.php" class="action-btn">Manage Users</a>
                <a href="admin_subscriptions.php" class="action-btn">View Subscriptions</a>
                <a href="admin_content.php" class="action-btn">Manage Content</a>
                <a href="admin_add_anime.php" class="action-btn">Add New Anime</a>
            </div>
        </section>
    </main>

    <script>
        const menuBtn = document.getElementById('menuBtn');
        const sidebar = document.getElementById('sidebar');
        const closeMenu = document.getElementById('closeMenu');
        const logoutBtn = document.getElementById('logoutBtn');

        menuBtn.addEventListener('click', function() {
            sidebar.classList.add('active');
        });

        closeMenu.addEventListener('click', function() {
            sidebar.classList.remove('active');
        });

        logoutBtn.addEventListener('click', function() {
            window.location.href = 'logout.php';
        });
    </script>
</body>
</html>