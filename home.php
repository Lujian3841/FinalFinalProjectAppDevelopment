<?php
require_once 'config.php';

$is_logged_in = isset($_SESSION['user_id']);
$is_guest = isset($_SESSION['guest']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Short Cutt LLC</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <div class="header-container">
            <div class="logo">Short Cutt LLC</div>
            <nav>
                <ul>
                    <li><a href="estimates.php">Estimates</a></li>
                    <li><a href="home.php" class="active">Home</a></li>
                    <li><a href="contact.php">Contact Us</a></li>
                </ul>
            </nav>
            <div class="login-info">
                <?php if ($is_logged_in): ?>
                    Logged in as: <?php echo htmlspecialchars($_SESSION['username']); ?>
                    <a href="logout.php"><button class="logout-btn">Logout</button></a>
                <?php elseif ($is_guest): ?>
                    Guest User
                    <a href="logout.php"><button class="logout-btn">Exit</button></a>
                <?php else: ?>
                    <a href="index.php"><button class="logout-btn">Login</button></a>
                <?php endif; ?>
            </div>
        </div>
    </header>
    
    <div class="main-content">
        <div class="content-box">
            <div class="hero-section">
                <h1>Welcome to Short Cutt LLC</h1>
                <p>Professional Landscaping Services for Your Home</p>
            </div>
            
            <div class="services-grid">
                <div class="service-card">
                    <h3>🌱 Lawn Care</h3>
                    <p>Expert lawn maintenance and care services to keep your yard looking pristine all year round.</p>
                </div>
                
                <div class="service-card">
                    <h3>🌺 Mulch & Plants</h3>
                    <p>Beautiful mulch installation and plant selection to enhance your landscape's aesthetic appeal.</p>
                </div>
                
                <div class="service-card">
                    <h3>❄️ Snow Removal</h3>
                    <p>Reliable snow removal services to keep your property safe and accessible during winter.</p>
                </div>
                
                <div class="service-card">
                    <h3>🪨 Rock & Gravel</h3>
                    <p>Quality rock and gravel installation for driveways, pathways, and decorative landscaping.</p>
                </div>
                
                <div class="service-card">
                    <h3>🌳 Tree Services</h3>
                    <p>Professional tree removal and maintenance to keep your property safe and beautiful.</p>
                </div>
                
                <div class="service-card">
                    <h3>📋 Free Estimates</h3>
                    <p>Get a free estimate for your landscaping project. Click on Estimates to get started!</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
