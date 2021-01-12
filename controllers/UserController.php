<?php
require_once __DIR__ . '/../autoload.php';

class UserController
{
    private IRepository $_repo;

    public function __construct(IRepository $repository)
    {
        $this->_repo = $repository;
    }

    public function getAll() {
        $users = $this->_repo->getAll();

        return json_encode($users);
    }

    public function getById($id) {
        $user = $this->_repo->getById($id);

        return json_encode($user);
    }
}
