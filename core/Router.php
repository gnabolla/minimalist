<?php
class Router {
    private $routes = [
        'home' => ['controller' => 'HomeController', 'auth' => true],
        'auth' => ['controller' => 'AuthController', 'auth' => false],
        'admin' => ['controller' => 'AdminController', 'auth' => true, 'admin' => true]
    ];

    public function route() {
        session_start();
        
        $url = isset($_GET['url']) ? $_GET['url'] : '';
        $url = rtrim($url, '/');
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $parts = explode('/', $url);
        
        $controller = !empty($parts[0]) ? strtolower($parts[0]) : 'home';
        $action = !empty($parts[1]) ? $parts[1] : 'index';
        
        if (!isset($this->routes[$controller])) {
            $this->showError('Page not found', 404);
            return;
        }

        $route = $this->routes[$controller];
        
        // Check authentication
        if ($route['auth'] && !isset($_SESSION['user'])) {
            header('Location: ' . BASE_URL . 'auth/login');
            exit;
        }

        // Check admin access
        if (isset($route['admin']) && $route['admin'] && (!isset($_SESSION['user']['is_admin']) || !$_SESSION['user']['is_admin'])) {
            $this->showError('Access denied', 403);
            return;
        }

        require_once 'controllers/' . $route['controller'] . '.php';
        $controllerClass = $route['controller'];
        $controller = new $controllerClass();
        
        if (method_exists($controller, $action)) {
            $controller->$action();
        } else {
            $this->showError('Action not found', 404);
        }
    }

    private function showError($message, $code) {
        http_response_code($code);
        require_once 'views/error.php';
    }
}
