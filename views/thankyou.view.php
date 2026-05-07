<?php
$is_logged_in = $is_logged_in ?? false;
$is_guest = $is_guest ?? false;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You - Short Cutt LLC</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <div class="header-container">
            <div class="logo">Short Cutt LLC</div>
            <nav>
                <ul>
                    <li><a href="estimates.php">Estimates</a></li>
                    <li><a href="home.php">Home</a></li>
                    <li><a href="contact.php">Contact Us</a></li>
                </ul>
            </nav>
            <div class="login-info">
                <?php if (isset($is_logged_in) && $is_logged_in): ?>
                    Logged in as: <?php echo htmlspecialchars($_SESSION['username']); ?>
                    <a href="logout.php"><button class="logout-btn">Logout</button></a>
                <?php elseif (isset($is_guest) && $is_guest): ?>
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
            <div class="thank-you">
                <h1>Thank You!</h1>
                <p>Your message has been sent successfully.</p>
                <p>We've sent a confirmation email to your address and will respond to your inquiry within 24-48 hours.</p>
                
                <div style="margin-top: 2rem;">
                    <a href="home.php"><button class="btn-primary" style="width: auto; padding: 1rem 2rem;">Return to Home</button></a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>