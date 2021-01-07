<?php

require_once __DIR__ . '/autoload.php';

session_start();

$action = isset($_GET['action']) ? $_GET['action'] : null;

switch ($action) {
    case 'main':
        break;
    case 'admin':
        break;
    case 'login':
        break;
    case 'login-set':
        break;
    case 'logout':
        break;
    default:
        header('Location: index.php?action=login');
        break;
}
