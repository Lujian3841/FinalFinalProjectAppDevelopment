<?php
require_once 'config.php';

$is_logged_in = isset($_SESSION['user_id']);
$is_guest = isset($_SESSION['guest']);
$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_email = $_POST['email'];
    $user_message = $_POST['message'];
    
    // Save message to database
    $conn = getDBConnection();
    $stmt = $conn->prepare("INSERT INTO contact_messages (user_email, message) VALUES (?, ?)");
    $stmt->bind_param("ss", $user_email, $user_message);
    
    if ($stmt->execute()) {
        // In a real application, you would send actual emails here using PHPMailer or similar
        // For this demo, we'll just simulate it
        
        // Email to company (simulated)
        $to_company = "info@shortcutt.com";
        $subject_company = "New Contact Form Submission";
        $message_company = "You have received a new message from: $user_email\n\n$user_message";
        
        // Email to user (confirmation - simulated)
        $subject_user = "Thank you for contacting Short Cutt LLC";
        $message_user = "Thank you for reaching out! We have received your message and will get back to you shortly.\n\nYour message:\n$user_message";
        
        // In production, use mail() or PHPMailer:
        // mail($to_company, $subject_company, $message_company);
        // mail($user_email, $subject_user, $message_user);
        
        $stmt->close();
        $conn->close();
        
        // Redirect to thank you page
        header('Location: thankyou.php');
        exit();
    } else {
        $message = '<div class="error-message">Error sending message. Please try again.</div>';
    }
    
    $stmt->close();
    $conn->close();
}
?>
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
                    <li><a href="home.php">Home</a></li>
                    <li><a href="contact.php" class="active">Contact Us</a></li>
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
            <div class="contact-form">
                <h2>Contact Us</h2>
                
                <?php echo $message; ?>
                
                <p style="text-align: center; color: #4a5568; margin-bottom: 2rem;">
                    Have a question or ready to get started? Send us a message and we'll get back to you soon!
                </p>
                
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="email">Your Email</label>
                        <input type="email" id="email" name="email" 
                               value="<?php echo $is_logged_in ? htmlspecialchars($_SESSION['email']) : ''; ?>" 
                               required>
                    </div>
                    
                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea id="message" name="message" required placeholder="Tell us about your landscaping needs..."></textarea>
                    </div>
                    
                    <button type="submit" class="btn-send">Send Message</button>
                </form>
                
                <div class="info-note" style="margin-top: 2rem;">
                    <strong>What happens next?</strong><br>
                    • We'll receive a copy of your message at our email<br>
                    • You'll receive a confirmation email to your address<br>
                    • We'll respond to your inquiry within 24-48 hours
                </div>
            </div>
        </div>
    </div>
</body>
</html>
