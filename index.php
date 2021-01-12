<?php

require_once __DIR__ . '/autoload.php';

session_start();

$action = isset($_GET['action']) ? $_GET['action'] : null;

$loginController = new LoginController(new UserRepository());
$userController = new UserController(new UserRepository());

switch ($action) {
    case 'main':
    case 'admin':
        break;
    case 'login':
        $loginController->index();
        break;
    case 'login-set':
        $loginController->set();
        break;
    case 'logout':
        $loginController->logout();
        break;
    case 'get-all-users':
        $result = $userController->getAll();
        echo $result;
        break;
    case 'get-user':
        // Używa się wpisując np. index.php?action=get-user&id=1
        $result = $userController->getById($_GET['id']);
        echo $result;
        break;
    default:
        header('Location: index.php?action=login');
        break;
}
