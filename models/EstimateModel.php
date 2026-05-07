<?php
require_once 'config.php';

class EstimateModel {
    private $db;

    public function __construct() {
        $this->db = getDBConnection();
    }

    public function getEstimateByUserId($userId) {
        $stmt = $this->db->prepare("SELECT * FROM estimates WHERE user_id = ? LIMIT 1");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function saveOrUpdate($userId, $data) {
        $existing = $this->getEstimateByUserId($userId);
        
        if ($existing) {
            $stmt = $this->db->prepare("UPDATE estimates SET service_type = ?, total_area = ?, plants_count = ?, tree_removal_count = ?, total_cost = ? WHERE user_id = ?");
            $stmt->bind_param("sdiddi", $data['service_type'], $data['total_area'], $data['plants_count'], $data['tree_removal_count'], $data['total_cost'], $userId);
        } else {
            $stmt = $this->db->prepare("INSERT INTO estimates (user_id, service_type, total_area, plants_count, tree_removal_count, total_cost) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("isdidi", $userId, $data['service_type'], $data['total_area'], $data['plants_count'], $data['tree_removal_count'], $data['total_cost']);
        }
        
        $success = $stmt->execute();
        $stmt->close();
        return $success;
    }

    public function __destruct() {
        $this->db->close();
    }
}