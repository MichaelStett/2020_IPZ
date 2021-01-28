<?php
require_once __DIR__ . '/../autoload.php';

class LoginController
{
    private IRepository $_repo;

    public function __construct(IRepository $repository)
    {
        $this->_repo = $repository;
    }

    public function set()
    {
        if (!isset($_SESSION['uid']) || $_SESSION['uid'] == '') {

            $exist = $this->_repo->exist($_REQUEST);

            if ($exist) {
                $user = $this->_repo->getByEmail($_REQUEST['email']);

                $_SESSION['uid'] = hash("md5", $user);
                $_SESSION['role'] = $user->getRole();
                $_SESSION['id'] = $user->getId();
                setcookie('usr_id', $user->getId());

                echo "Successfully logged in for: " . $user . PHP_EOL;
            }
            else {
                echo "Wrong credentials" . PHP_EOL;
                header('Location: index.php?action=main');
            }
        }
        else {
            echo "You are already logged in." . PHP_EOL;
        }

        echo UserView::render();
    }

    public static function logout()
    {
        if (!isset($_SESSION['uid']) || $_SESSION['uid'] == '') {
            echo "You are not logged in." . PHP_EOL;
        } else {
            session_unset();
            session_destroy();

            echo "Successfully logged out." . PHP_EOL;
        }

        header('Location: index.php?action=main');
    }
}
