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
    <title>Dashboard - ANGAT.TV</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body class="dashboard-page">
    <!-- Top Navigation -->
    <div class="top-header">
        <div class="header-content">
            <div class="header-left">
                <button class="menu-btn" id="menuBtn">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <line x1="3" y1="12" x2="21" y2="12"></line>
                        <line x1="3" y1="6" x2="21" y2="6"></line>
                        <line x1="3" y1="18" x2="21" y2="18"></line>
                    </svg>
                </button>
                <h1 class="header-logo">ANGAT.TV</h1>
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

                <a href="profile.php" class="user-info">
                    <span class="welcome-text">Welcome back, <span id="usernameDisplay">User</span>!</span>
                    <div class="user-avatar"></div>
                </a>
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
                <a href="SubbedAnime.php" class="menu-item">Subbed Anime</a>
                <a href="DubbedAnime.php" class="menu-item">Dubbed Anime</a>
                <a href="Trending.php" class="menu-item">Trending</a>
                <a href="movie.php" class="menu-item">Movies</a>
                <button class="menu-item" id="genreBtn">Genre</button>
                
                <div class="genre-grid" id="genreGrid" style="display: none;">
                    <button class="genre-item">Action</button>
                    <button class="genre-item">Adventure</button>
                    <button class="genre-item">Cars</button>
                    <button class="genre-item">Comedy</button>
                    <button class="genre-item">Drama</button>
                    <button class="genre-item">Game</button>
                    <button class="genre-item">Ecchi</button>
                    <button class="genre-item">Fantasy</button>
                </div>
            </div>
        </div>
    </div>

    <!-- New this week -->
        <div class="content-section">
            <h3 class="section-title">Subbed Anime </h3>
            <div class="anime-grid">
                <div class="anime-card">
                    <div class="anime-image-container">
                        <img src="https://heshshs.github.io/E-commerce-/frieren.jpg" alt="Frieren" class="anime-image">
                        <div class="anime-overlay">
                            <button class="btn-play-small">Play</button>
                        </div>
                    </div>
                    <h4 class="anime-title">Frieren (Subbed)</h4>
                </div>

                <div class="anime-card">
                    <div class="anime-image-container">
                        <img src="https://heshshs.github.io/E-commerce-/Rideyourwave.jpg" alt="Ride Your Wave" class="anime-image">
                        <div class="anime-overlay">
                            <button class="btn-play-small">Play</button>
                        </div>
                    </div>
                    <h4 class="anime-title">Ride Your Wave (Subbed)</h4>
                </div>

                <div class="anime-card">
                    <div class="anime-image-container">
                        <img src="https://heshshs.github.io/E-commerce-/JujutsuKaisen.jpg" alt="Jujutsu Kaisen" class="anime-image">
                        <div class="anime-overlay">
                            <button class="btn-play-small">Play</button>
                        </div>
                    </div>
                    <h4 class="anime-title">Jujutsu Kaisen (Subbed)</h4>
                </div>

                <div class="anime-card">
                    <div class="recent-image-container">
                        <img src="https://heshshs.github.io/E-commerce-/Kuroko.jpg" alt="Kuroko Basketball" class="recent-image">
                        <div class="anime-overlay">
                            <button class="btn-play-small">Play</button>
                        </div>
                    </div>
                    <h4 class="anime-title">Kuroko's Basketball (Subbed)</h4>
                </div>

                <div class="anime-card">
                    <div class="recent-image-container">
                        <img src="https://heshshs.github.io/E-commerce-/ChainsawMan.jpg" alt="ChainsawMan" class="recent-image">
                        <div class="anime-overlay">
                            <button class="btn-play-small">Play</button>
                        </div>
                    </div>
                    <h4 class="anime-title">Chainsaw Man (Subbed)</h4>
                </div>

                <div class="anime-card">
                    <div class="recent-image-container">
                        <img src="https://heshshs.github.io/E-commerce-/HXH.jpg" alt="Hunter X Hunter" class="recent-image">
                        <div class="anime-overlay">
                            <button class="btn-play-small">Play</button>
                        </div>
                    </div>
                    <h4 class="anime-title">HunterxHunter (Subbed)</h4>
                </div>

                <div class="anime-card">
                    <div class="recent-image-container">
                        <img src="https://heshshs.github.io/E-commerce-/SlamDunk.jpg" alt="Slam Dunk" class="recent-image">
                        <div class="anime-overlay">
                            <button class="btn-play-small">Play</button>
                        </div>
                    </div>
                    <h4 class="anime-title">Slam Dunk (Subbed)</h4>
                </div>

                <div class="anime-card">
                    <div class="recent-image-container">
                        <img src="https://heshshs.github.io/E-commerce-/BlackClover.jpg" alt="Black Clover" class="recent-image">
                        <div class="anime-overlay">
                            <button class="btn-play-small">Play</button>
                        </div>
                    </div>
                    <h4 class="anime-title">Black Clover (Subbed)</h4>
                </div>

                <div class="anime-card">
                    <div class="recent-image-container">
                        <img src="https://heshshs.github.io/E-commerce-/SoloLeveling.jpg" alt="Solo Leveling" class="recent-image">
                        <div class="anime-overlay">
                            <button class="btn-play-small">Play</button>
                        </div>
                    </div>
                    <h4 class="anime-title">Solo Leveling (Subbed)</h4>
                </div>


                
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

        // Genre toggle
        const genreBtn = document.getElementById('genreBtn');
        const genreGrid = document.getElementById('genreGrid');
        let genreOpen = false;

        genreBtn.addEventListener('click', function() {
            genreOpen = !genreOpen;
            genreGrid.style.display = genreOpen ? 'grid' : 'none';
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