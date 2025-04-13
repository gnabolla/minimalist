<?php
define('ROOT_PATH', __DIR__);
require_once ROOT_PATH . '/config/config.php';
require_once ROOT_PATH . '/core/Router.php';

$router = new Router();
$router->route();
