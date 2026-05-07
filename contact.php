<?php
require_once 'config.php';
require_once 'models/ContactMessage.php';

$is_logged_in = isset($_SESSION['user_id']);
$is_guest = isset($_SESSION['guest']);
$message = '';

$model = new ContactMessage();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = [
        'email' => trim($_POST['email']),
        'message' => trim($_POST['message'])
    ];

    if ($model->saveMessage($data)) {
        header('Location: thankyou.php');
        exit();
    } else {
        $message = '<div class="error-message">Error sending message. Please try again.</div>';
    }
}

include 'views/contact.view.php';