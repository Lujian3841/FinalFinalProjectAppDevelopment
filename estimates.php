<?php
require_once 'config.php';
require_once 'models/EstimateModel.php';

// Initialize variables to prevent HTML/JS breakages
$is_logged_in = isset($_SESSION['user_id']);
$is_guest = isset($_SESSION['guest']);
$message = '';
$saved_estimate = null;
$model = new EstimateModel();

if ($is_logged_in) {
    $saved_estimate = $model->getEstimateByUserId($_SESSION['user_id']);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save'])) {
    if (!$is_logged_in) {
        $message = '<div class="error-message">You must be logged in to save.</div>';
    } else {
        $data = [
            'service_type' => $_POST['service_type'],
            'total_area' => floatval($_POST['total_area']),
            'plants_count' => intval($_POST['plants_count']),
            'tree_removal_count' => intval($_POST['tree_removal_count'])
        ];
        
        $rates = ['Rock' => 5, 'Mulch' => 3, 'Lawn' => 2, 'Snow' => 4];
        $data['total_cost'] = (($rates[$data['service_type']] ?? 0) * $data['total_area']) + ($data['plants_count'] * 25) + ($data['tree_removal_count'] * 200);

        if ($model->saveOrUpdate($_SESSION['user_id'], $data)) {
            $message = '<div class="success-message">Estimate saved successfully!</div>';
            $saved_estimate = $model->getEstimateByUserId($_SESSION['user_id']);
        }
    }
}

// Correct path to your view folder
include 'views/estimates_view.php';