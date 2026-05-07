<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Short Cutt LLC</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <div class="header-container">
            <div class="logo">Short Cutt LLC</div>
            <nav>
                <ul>
                    <li><a href="estimates.php">Estimates</a></li>
                    <li><a href="index.php?page=home">Home</a></li>
                    <li><a href="index.php?page=contact" class="active">Contact Us</a></li>
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
            <div class="contact-form">
                <h2>Contact Us</h2>
                
                <?php echo $message; ?>
                
                <p style="text-align: center; color: #4a5568; margin-bottom: 2rem;">
                    Have a question or ready to get started? Send us a message and we'll get back to you soon!
                </p>
                
                <form method="POST" action="contact.php">
                    <div class="form-group">
                        <label for="email">Your Email</label>
                        <input 
                            type="email" 
                            id="email" 
                            name="email"
                            value="<?php echo isset($is_logged_in) && $is_logged_in ? htmlspecialchars($_SESSION['email']) : ''; ?>" 
                            required
                        >
                    </div>
                    
                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea 
                            id="message" 
                            name="message" 
                            required 
                            placeholder="Tell us about your landscaping needs..."
                        ></textarea>
                    </div>
                    
                    <button type="submit" class="btn-send">Send Message</button>
                </form>
                
                <div class="info-note" style="margin-top: 2rem;">
                    <strong>What happens next?</strong><br>
                    • We'll receive a copy of your message to our email<br>
                    • You'll receive a confirmation email to your address<br>
                    • We'll respond to your inquiry within 24-48 hours
                </div>
            </div>
        </div>
    </div>
</body>
</html>