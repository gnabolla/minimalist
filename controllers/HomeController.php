<?php
class HomeController {
    public function index() {
        $data = $_SESSION['user'];
        require_once 'views/home/index.php';
    }
}
