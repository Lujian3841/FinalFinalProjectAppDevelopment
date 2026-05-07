<?php
require_once 'config.php';

$is_logged_in = isset($_SESSION['user_id']);
$is_guest = isset($_SESSION['guest']);

require 'views/home.view.php';