<?php

require_once __DIR__ . '/autoload.php';

session_start();

$action = isset($_GET['action']) ? $_GET['action'] : null;

<<<<<<< Updated upstream
switch ($action) {
    case 'main':
=======
//$loginController = new LoginController(new UserRepository());
//$userController = new UserController(new UserRepository());

switch ($action) {
    case 'main':
        echo GuestView::render();
>>>>>>> Stashed changes
        break;
    case 'admin':
        echo AdminUsersView::render();
        break;
    case 'user':
        echo UserView::render();
        break;
    case 'ads':
        echo AdminAdsView::render();
        break;
    case 'login':
<<<<<<< Updated upstream
        break;
    case 'login-set':
        break;
    case 'logout':
=======
        //$loginController->index();
        break;
    case 'login-set':
        //$loginController->set();
        break;
    case 'logout':
        //$loginController->logout();
        break;
    case 'get-all-users':
        //$result = $userController->getAll();
        //echo $result;
        break;
    case 'get-user':
        // Używa się wpisując np. index.php?action=get-user&id=1
        //$result = $userController->getById($_GET['id']);
        //echo $result;
>>>>>>> Stashed changes
        break;
    default:
        header('Location: index.php?action=main');
        break;
}
