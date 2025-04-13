<?php
require_once 'config/config.php';

class User {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function register($email, $password, $name, $isAdmin = null) {
        try {
            // Check if user already exists
            $stmt = $this->db->prepare("SELECT id FROM users WHERE email = ?");
            $stmt->execute([$email]);
            if ($stmt->fetch()) {
                return false;
            }

            // If isAdmin is not specified, make first user admin
            if ($isAdmin === null) {
                $stmt = $this->db->query("SELECT COUNT(*) FROM users");
                $isAdmin = ($stmt->fetchColumn() === 0);
            }

            $stmt = $this->db->prepare("INSERT INTO users (name, email, password, is_admin) VALUES (?, ?, ?, ?)");
            return $stmt->execute([
                $name,
                $email,
                password_hash($password, PASSWORD_DEFAULT),
                $isAdmin ? 1 : 0
            ]);
        } catch(PDOException $e) {
            return false;
        }
    }

    public function login($email, $password) {
        try {
            $stmt = $this->db->prepare("SELECT * FROM users WHERE email = ?");
            $stmt->execute([$email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($user && password_verify($password, $user['password'])) {
                unset($user['password']);
                return $user;
            }
            return false;
        } catch(PDOException $e) {
            return false;
        }
    }

    public function getUser($id) {
        try {
            $stmt = $this->db->prepare("SELECT * FROM users WHERE id = ?");
            $stmt->execute([$id]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($user) {
                unset($user['password']);
                return $user;
            }
            return null;
        } catch(PDOException $e) {
            return null;
        }
    }

    public function getAllUsers() {
        try {
            $stmt = $this->db->query("SELECT id, name, email, is_admin FROM users");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            return [];
        }
    }

    public function updateUser($id, $data) {
        try {
            $sets = [];
            $values = [];
            foreach ($data as $key => $value) {
                if ($key === 'password' && !empty($value)) {
                    $sets[] = "$key = ?";
                    $values[] = password_hash($value, PASSWORD_DEFAULT);
                } elseif ($key !== 'password') {
                    $sets[] = "$key = ?";
                    $values[] = $value;
                }
            }
            
            if (empty($sets)) {
                return false;
            }

            $values[] = $id;
            $query = "UPDATE users SET " . implode(', ', $sets) . " WHERE id = ?";
            $stmt = $this->db->prepare($query);
            return $stmt->execute($values);
        } catch(PDOException $e) {
            return false;
        }
    }

    public function deleteUser($id) {
        try {
            $stmt = $this->db->prepare("DELETE FROM users WHERE id = ?");
            return $stmt->execute([$id]);
        } catch(PDOException $e) {
            return false;
        }
    }
}
