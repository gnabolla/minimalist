<?php
require_once 'models/User.php';

class AuthController {
    private $user;

    public function __construct() {
        $this->user = new User();
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            $user = $this->user->login($email, $password);
            if ($user) {
                $_SESSION['user'] = $user;
                header('Location: ' . BASE_URL);
                exit;
            }
            $error = 'Invalid credentials';
        }
        require_once 'views/auth/login.php';
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            if ($this->user->register($email, $password, $name)) {
                header('Location: ' . BASE_URL . 'auth/login');
                exit;
            }
            $error = 'Registration failed. Email might already be taken.';
        }
        require_once 'views/auth/register.php';
    }

    public function logout() {
        session_destroy();
        header('Location: ' . BASE_URL . 'auth/login');
        exit;
    }
}