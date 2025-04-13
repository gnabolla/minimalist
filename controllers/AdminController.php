<?php
require_once 'models/User.php';

class AdminController {
    private $user;

    public function __construct() {
        $this->user = new User();
    }

    public function index() {
        $users = $this->user->getAllUsers();
        require_once 'views/admin/index.php';
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $isAdmin = isset($_POST['is_admin']) ? 1 : 0;

            if ($this->user->register($email, $password, $name, $isAdmin)) {
                header('Location: ' . BASE_URL . 'admin');
                exit;
            }
            $error = 'User creation failed. Email might already be taken.';
        }
        require_once 'views/admin/create.php';
    }

    public function edit() {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: ' . BASE_URL . 'admin');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'name' => $_POST['name'] ?? '',
                'email' => $_POST['email'] ?? '',
                'is_admin' => isset($_POST['is_admin']) ? 1 : 0
            ];
            
            if (!empty($_POST['password'])) {
                $data['password'] = $_POST['password'];
            }

            if ($this->user->updateUser($id, $data)) {
                header('Location: ' . BASE_URL . 'admin');
                exit;
            }
            $error = 'Update failed';
        }

        $userData = $this->user->getUser($id);
        if (!$userData) {
            header('Location: ' . BASE_URL . 'admin');
            exit;
        }

        require_once 'views/admin/edit.php';
    }

    public function delete() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
            $id = $_POST['id'];
            if ($id == $_SESSION['user']['id']) {
                $_SESSION['error'] = 'You cannot delete your own account';
            } else if ($this->user->deleteUser($id)) {
                $_SESSION['success'] = 'User deleted successfully';
            } else {
                $_SESSION['error'] = 'Failed to delete user';
            }
        }
        header('Location: ' . BASE_URL . 'admin');
        exit;
    }
}