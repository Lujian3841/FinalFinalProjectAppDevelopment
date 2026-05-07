<?php
class User {
    private mysqli $conn;

    public function __construct(mysqli $conn) {
        $this->conn = $conn;
    }

    public function findByUsername(string $username): ?array {
        $stmt = $this->conn->prepare("SELECT id, username, password, email FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        $user = $result->num_rows > 0 ? $result->fetch_assoc() : null;

        $stmt->close();
        return $user;
    }

    public function usernameOrEmailExists(string $username, string $email): bool {
        $stmt = $this->conn->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
        $stmt->bind_param("ss", $username, $email);
        $stmt->execute();
        $result = $stmt->get_result();

        $exists = $result->num_rows > 0;

        $stmt->close();
        return $exists;
    }

    public function create(string $username, string $email, string $password): bool {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $this->conn->prepare("INSERT INTO users (username, password, email) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $hashedPassword, $email);

        $created = $stmt->execute();

        $stmt->close();
        return $created;
    }
}
?>
