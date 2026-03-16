<?php
require_once 'auth.php';
require_login();
require_subscription();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - ANGAT.TV</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body class="profile-page">
    <!-- Top Navigation -->
    <div class="top-header profile-header">
        <div class="header-content">
            <div class="header-left">
                <button class="menu-btn" id="menuBtn">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <line x1="3" y1="12" x2="21" y2="12"></line>
                        <line x1="3" y1="6" x2="21" y2="6"></line>
                        <line x1="3" y1="18" x2="21" y2="18"></line>
                    </svg>
                </button>
                <a href="dashboard.php" class="header-logo">ANGAT.TV</a>
            </div>

            <div class="header-right">
                <!-- Search Bar -->
                <div class="header-search">
                    <svg class="search-icon-small" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <circle cx="11" cy="11" r="8"></circle>
                        <path d="m21 21-4.35-4.35"></path>
                    </svg>
                    <input type="text" id="headerSearch" class="header-search-input">
                    <button class="clear-btn-small" id="clearHeaderSearch" style="display: none;">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                    </button>
                </div>

                <div class="user-info">
                    <span class="welcome-text">Welcome back, <span id="usernameDisplay">User</span>!</span>
                    <div class="user-avatar"></div>
                    
                </div>
            </div>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-content">
            <button class="close-menu" id="closeMenu">
                <span>← Close Menu</span>
            </button>

            <div class="menu-items">
                <a href="dashboard.php" class="menu-item">Home</a>
                <a href="profile.php" class="menu-item active">My Profile</a>
                <button class="menu-item logout-btn" id="logoutBtn">Logout</button>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content profile-content">
        <!-- Tabs -->
        <div class="tabs">
            <button class="tab active" data-tab="watching">Watching</button>
            <button class="tab" data-tab="onhold">On hold</button>
            <button class="tab" data-tab="plantowatch">Plan to Watch</button>
            <button class="tab" data-tab="completed">Completed</button>
        </div>

        <!-- Recent Watches Section -->
        <div class="recent-section">
            <div class="recent-header">
                <h2 class="section-title">Your Recent Watches</h2>
                <div class="recent-search">
                    <svg class="search-icon-small" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <circle cx="11" cy="11" r="8"></circle>
                        <path d="m21 21-4.35-4.35"></path>
                    </svg>
                    <input type="text" placeholder="Search..." class="recent-search-input">
                </div>
            </div>

            <div class="recent-grid">
                <div class="recent-card">
                    <div class="recent-image-container">
                        <img src="https://heshshs.github.io/E-commerce-/DemonSlayer.png" alt="Demon Slayer" class="recent-image">
                        <div class="recent-overlay">
                            <button class="btn-play-small">Continue</button>
                        </div>
                    </div>
                </div>

                <div class="recent-card">
                    <div class="recent-image-container">
                        <img src="https://heshshs.github.io/E-commerce-/Bleach.jpg" alt="Bleach" class="recent-image">
                        <div class="recent-overlay">
                            <button class="btn-play-small">Continue</button>
                        </div>
                    </div>
                </div>

                <div class="recent-card">
                    <div class="recent-image-container">
                        <img src="https://heshshs.github.io/E-commerce-/Kuroko.jpg" alt="Kuroko Basketball" class="recent-image">
                        <div class="recent-overlay">
                            <button class="btn-play-small">Continue</button>
                        </div>
                    </div>
                </div>

                <div class="recent-card">
                    <div class="recent-image-container">
                        <img src="https://heshshs.github.io/E-commerce-/ChainsawMan.jpg" alt="ChainsawMan" class="recent-image">
                        <div class="recent-overlay">
                            <button class="btn-play-small">Continue</button>
                        </div>
                    </div>
                </div>

                <div class="recent-card">
                    <div class="recent-image-container">
                        <img src="https://heshshs.github.io/E-commerce-/HXH.jpg" alt="Hunter X Hunter" class="recent-image">
                        <div class="recent-overlay">
                            <button class="btn-play-small">Continue</button>
                        </div>
                    </div>
                </div>

                <div class="recent-card">
                    <div class="recent-image-container">
                        <img src="https://heshshs.github.io/E-commerce-/SlamDunk.jpg" alt="Slam Dunk" class="recent-image">
                        <div class="recent-overlay">
                            <button class="btn-play-small">Continue</button>
                        </div>
                    </div>
                </div>

                <div class="recent-card">
                    <div class="recent-image-container">
                        <img src="https://heshshs.github.io/E-commerce-/BlackClover.jpg" alt="Black Clover" class="recent-image">
                        <div class="recent-overlay">
                            <button class="btn-play-small">Continue</button>
                        </div>
                    </div>
                </div>

                <div class="recent-card">
                    <div class="recent-image-container">
                        <img src="https://heshshs.github.io/E-commerce-/SoloLeveling.jpg" alt="Solo Leveling" class="recent-image">
                        <div class="recent-overlay">
                            <button class="btn-play-small">Continue</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Ad Banner -->
        <div class="ad-banner">
            <div class="ad-content">
                <h3 class="ad-title">SUBSCRIBE NOW</h3>
                <p class="ad-subtitle">The Best Anime Streaming Platfrom</p>
                <p class="ad-subtitle">4k Resolution, No ads, No buffering.</p>
                <div class="ad-tags">
                    <span class="ad-discount">10% OFF</span>
                    <span class="ad-label">FOR STUDENTS!!!</span>
                </div>
            </div>
            <div class="ad-price">
                <div class="price">₱150.00/month</div>
                <div class="order-now">Subscribe now &gt;</div>
            </div>
        </div>

        <div class="ad-banner">
            <div class="ad-content">
                <h3 class="ad-title">SUBSCRIBE NOW</h3>
                <p class="ad-subtitle">The Best Anime Streaming Platfrom.</p>
                <p class="ad-subtitle">4k Resolution, No ads, No buffering.</p>
            </div>
            <div class="ad-price">
                <div class="price">₱165.00/month</div>
                 <div class="price">₱1900.00/year</div>
                <div class="order-now">Subscribe now &gt;</div>
            </div>
        </div>
    </div>

    

    <script>
        const username = <?php echo json_encode($_SESSION['username'] ?? 'User'); ?>;
        const usernameDisplayEl = document.getElementById('usernameDisplay');
        if (usernameDisplayEl) usernameDisplayEl.textContent = username;

        // Menu toggle
        const menuBtn = document.getElementById('menuBtn');
        const sidebar = document.getElementById('sidebar');
        const closeMenu = document.getElementById('closeMenu');

        menuBtn.addEventListener('click', function() {
            sidebar.classList.add('active');
        });

        closeMenu.addEventListener('click', function() {
            sidebar.classList.remove('active');
        });

        // Logout
        document.getElementById('logoutBtn').addEventListener('click', function() {
            window.location.href = 'logout.php';
        });

        // Tab switching
        const tabs = document.querySelectorAll('.tab');
        tabs.forEach(tab => {
            tab.addEventListener('click', function() {
                tabs.forEach(t => t.classList.remove('active'));
                this.classList.add('active');
            });
        });

        // Header search
        const headerSearch = document.getElementById('headerSearch');
        const clearHeaderSearch = document.getElementById('clearHeaderSearch');

        headerSearch.addEventListener('input', function() {
            clearHeaderSearch.style.display = this.value ? 'block' : 'none';
        });

        clearHeaderSearch.addEventListener('click', function() {
            headerSearch.value = '';
            clearHeaderSearch.style.display = 'none';
        });
    </script>
</body>
</html>
