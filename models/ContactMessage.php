<?php

class ContactMessage {
    public function saveMessage($data) {
        $conn = getDBConnection();

        $stmt = $conn->prepare(
            "INSERT INTO contact_messages (user_email, message) VALUES (?, ?)"
        );

        $stmt->bind_param(
            "ss",
            $data['email'],
            $data['message']
        );

        $result = $stmt->execute();

        $stmt->close();
        $conn->close();

        return $result;
    }
}