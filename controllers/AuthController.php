<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../models/User.php';

class AuthController {
    public function showLogin(): void {
        $error = '';
        $success = '';
        require __DIR__ . '/../views/login.view.php';
    }

    public function login(): void {
        $error = '';
        $success = '';

        if (isset($_POST['guest'])) {
            unset($_SESSION['user_id']);
            unset($_SESSION['username']);
            unset($_SESSION['email']);

            $_SESSION['guest'] = true;

            header('Location: home.php');
            exit();
}

        $username = trim($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';

        if ($username === '' || $password === '') {
            $error = 'Username and password are required';
            require __DIR__ . '/../views/login.view.php';
            return;
        }

        $conn = getDBConnection();
        $userModel = new User($conn);
        $user = $userModel->findByUsername($username);
        $conn->close();

        if ($user && password_verify($password, $user['password'])) {
            unset($_SESSION['guest']);
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];
            header('Location: home.php');
            exit();
        }

        $error = 'Invalid username or password';
        require __DIR__ . '/../views/login.view.php';
    }

    public function showSignup(): void {
        $error = '';
        $success = '';
        require __DIR__ . '/../views/signup.view.php';
    }

    public function signup(): void {
        $error = '';
        $success = '';

        $username = trim($_POST['username'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        $confirmPassword = $_POST['confirm_password'] ?? '';

        if ($username === '' || $email === '' || $password === '' || $confirmPassword === '') {
            $error = 'All fields are required';
            require __DIR__ . '/../views/signup.view.php';
            return;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = 'Please enter a valid email address';
            require __DIR__ . '/../views/signup.view.php';
            return;
        }

        if ($password !== $confirmPassword) {
            $error = 'Passwords do not match';
            require __DIR__ . '/../views/signup.view.php';
            return;
        }

        $conn = getDBConnection();
        $userModel = new User($conn);

        if ($userModel->usernameOrEmailExists($username, $email)) {
            $conn->close();
            $error = 'Username or email already exists';
            require __DIR__ . '/../views/signup.view.php';
            return;
        }

        if ($userModel->create($username, $email, $password)) {
            $success = 'Account created successfully! You can now log in.';
        } else {
            $error = 'Error creating account. Please try again.';
        }

        $conn->close();
        require __DIR__ . '/../views/signup.view.php';
    }
}
?>
