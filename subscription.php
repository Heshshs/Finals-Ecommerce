<?php
require_once 'auth.php';
require_login();
require_once 'db.php';

if (has_active_subscription()) {
    header('Location: dashboard.php');
    exit();
}

$error = '';
$selectedPlan = 'premium';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $selectedPlan = $_POST['plan'] ?? 'premium';
    $cardNumber = preg_replace('/\D/', '', $_POST['card_number'] ?? '');
    $expiryDate = trim($_POST['expiry_date'] ?? '');
    $cvv = preg_replace('/\D/', '', $_POST['cvv'] ?? '');
    $cardholderName = trim($_POST['cardholder_name'] ?? '');

    $allowedPlans = ['basic', 'standard', 'premium'];

    if (!in_array($selectedPlan, $allowedPlans, true)) {
        $error = 'Please select a valid plan.';
    } elseif (strlen($cardNumber) < 12 || strlen($cardNumber) > 19) {
        $error = 'Please enter a valid card number.';
    } elseif (!preg_match('/^(0[1-9]|1[0-2])\/[0-9]{2}$/', $expiryDate)) {
        $error = 'Please enter the expiration date in MM/YY format.';
    } elseif (strlen($cvv) < 3 || strlen($cvv) > 4) {
        $error = 'Please enter a valid CVV.';
    } elseif ($cardholderName === '') {
        $error = 'Please enter the cardholder name.';
    } else {
        $status = 'active';
        $stmt = $conn->prepare('UPDATE users SET subscription_status = ?, subscription_plan = ? WHERE id = ?');
        $stmt->bind_param('ssi', $status, $selectedPlan, $_SESSION['user_id']);

        if ($stmt->execute()) {
            $_SESSION['is_subscribed'] = true;
            $_SESSION['subscription_plan'] = $selectedPlan;
            header('Location: dashboard.php');
            exit();
        } else {
            $error = 'Subscription could not be saved. Please try again.';
        }

        $stmt->close();
    }
}

$username = $_SESSION['username'] ?? 'User';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subscription - ANGAT.TV</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body class="dashboard-page subscription-page">
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
                <div class="header-search">
                    <svg class="search-icon-small" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <circle cx="11" cy="11" r="8"></circle>
                        <path d="m21 21-4.35-4.35"></path>
                    </svg>
                    <input type="text" class="header-search-input" placeholder="Search..." readonly>
                </div>

                <div class="user-info">
                    <span class="welcome-text">Welcome back, <?php echo htmlspecialchars($username); ?></span>
                    <div class="user-avatar subscription-avatar"></div>
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
                <button class="menu-item logout-btn" id="logoutBtn">Logout</button>
            </div>
        </div>
    </div>

    <main class="subscription-wrapper">
        <section class="subscription-hero">
            <h1 class="subscription-title">Choose Your Plan</h1>
            <p class="subscription-subtitle">Select the perfect plan for your streaming needs</p>
            <?php if ($error): ?>
                <p class="subscription-error"><?php echo htmlspecialchars($error); ?></p>
            <?php endif; ?>
        </section>

        <form method="POST" class="subscription-form-page">
            <input type="hidden" name="plan" id="selectedPlanInput" value="<?php echo htmlspecialchars($selectedPlan); ?>">

            <section class="plans-grid">
                <article class="plan-card <?php echo $selectedPlan === 'basic' ? 'selected' : ''; ?>" data-plan="basic">
                    <h2 class="plan-name">Basic</h2>
                    <div class="plan-price-row"><span class="plan-price">₱150.00</span><span class="plan-frequency">/month</span></div>
                    <ul class="plan-features">
                        <li>Watch on 1 device</li>
                        <li>SD Quality</li>
                        <li>Limited content library</li>
                        <li>Monthly billing</li>
                    </ul>
                    <button type="button" class="plan-select-btn">Select Plan</button>
                </article>

                <article class="plan-card <?php echo $selectedPlan === 'standard' ? 'selected' : ''; ?>" data-plan="standard">
                    <div class="plan-badge">Most Popular</div>
                    <h2 class="plan-name">Standard</h2>
                    <div class="plan-price-row"><span class="plan-price">₱165.00</span><span class="plan-frequency">/month</span></div>
                    <ul class="plan-features">
                        <li>Watch on 2 devices</li>
                        <li>HD Quality</li>
                        <li>Full content library</li>
                        <li>Monthly billing</li>
                        <li>Download on 2 devices</li>
                    </ul>
                    <button type="button" class="plan-select-btn">Select Plan</button>
                </article>

                <article class="plan-card <?php echo $selectedPlan === 'premium' ? 'selected' : ''; ?>" data-plan="premium">
                    <h2 class="plan-name">Premium</h2>
                    <div class="plan-price-row"><span class="plan-price">₱1900.00</span><span class="plan-frequency">/year</span></div>
                    <ul class="plan-features">
                        <li>Watch on 4 devices</li>
                        <li>4K + HDR Quality</li>
                        <li>Full content library</li>
                        <li>Monthly billing</li>
                        <li>Download on 4 devices</li>
                        <li>Priority support</li>
                    </ul>
                    <button type="button" class="plan-select-btn">Selected</button>
                </article>
            </section>

            <section class="payment-card">
                <h2 class="payment-title">Payment Information</h2>

                <label class="payment-label" for="card_number">Card Number</label>
                <input type="text" id="card_number" name="card_number" class="payment-input payment-input-full" placeholder="1234 5678 9012 3456" maxlength="19" required>

                <div class="payment-row">
                    <div class="payment-col">
                        <label class="payment-label" for="expiry_date">Expiration Date</label>
                        <input type="text" id="expiry_date" name="expiry_date" class="payment-input" placeholder="MM/YY" maxlength="5" required>
                    </div>

                    <div class="payment-col">
                        <label class="payment-label" for="cvv">CVV</label>
                        <input type="text" id="cvv" name="cvv" class="payment-input" placeholder="123" maxlength="4" required>
                    </div>
                </div>

                <label class="payment-label" for="cardholder_name">Cardholder Name</label>
                <input type="text" id="cardholder_name" name="cardholder_name" class="payment-input payment-input-full" placeholder="John Doe" required>

                <button type="submit" class="subscribe-btn">Subscribe Now</button>
                <p class="payment-note">Your subscription will renew automatically each month</p>
            </section>
        </form>
    </main>

    <script>
        const selectedPlanInput = document.getElementById('selectedPlanInput');
        const planCards = document.querySelectorAll('.plan-card');

        function updateSelectedPlan(plan) {
            selectedPlanInput.value = plan;

            planCards.forEach((card) => {
                const isSelected = card.dataset.plan === plan;
                card.classList.toggle('selected', isSelected);

                const button = card.querySelector('.plan-select-btn');
                if (button) {
                    button.textContent = isSelected ? 'Selected' : 'Select Plan';
                }
            });
        }

        planCards.forEach((card) => {
            const button = card.querySelector('.plan-select-btn');
            card.addEventListener('click', () => updateSelectedPlan(card.dataset.plan));
            if (button) {
                button.addEventListener('click', (event) => {
                    event.preventDefault();
                    updateSelectedPlan(card.dataset.plan);
                });
            }
        });

        const cardInput = document.getElementById('card_number');
        cardInput.addEventListener('input', function() {
            let value = this.value.replace(/\D/g, '').substring(0, 16);
            value = value.replace(/(.{4})/g, '$1 ').trim();
            this.value = value;
        });

        const expiryInput = document.getElementById('expiry_date');
        expiryInput.addEventListener('input', function() {
            let value = this.value.replace(/\D/g, '').substring(0, 4);
            if (value.length > 2) {
                value = value.substring(0, 2) + '/' + value.substring(2);
            }
            this.value = value;
        });

        const cvvInput = document.getElementById('cvv');
        cvvInput.addEventListener('input', function() {
            this.value = this.value.replace(/\D/g, '').substring(0, 4);
        });

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