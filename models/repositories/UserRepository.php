<?php
require_once __DIR__ . '/../../autoload.php';

class UserRepository implements IRepository
{
    private $pdo;

    public function __construct()
    {
        global $config;
        $this->pdo = new PDO($config['dsn'], $config['login'], $config['password']);
    }

    public function exist($params) : ?User
    {
        $username = $params['username'];
        $password = hash('md5', $params['password']);

        $sql = "SELECT * FROM users WHERE username = :username AND password = :password";
        $statement = $this->pdo->prepare($sql);

        $result = $statement->execute(array(
            'username' => $username,
            'password' => $password,
        ));

        $row = $statement->fetch(PDO::FETCH_ASSOC);
        if (! $row) {
            return null;
        }

        $user = new User($row);

        return $user;
    }

    public function getAll() : ?array
    {
        $sql = "SELECT * FROM users";
        $statement = $this->pdo->prepare($sql);

        $result = $statement->execute();

        $arr = $statement->fetchAll(PDO::FETCH_ASSOC);
        if (! $arr) {
            return null;
        }

        $result = [];
        foreach ($arr as $item)
        {
            array_push($result, new User($item));
        }

        return $result;
    }

    public function getById($id) : ?User
    {
        $sql = "SELECT * FROM users WHERE id = :id";
        $statement = $this->pdo->prepare($sql);

        $statement->bindValue(':id', $id);

        $result = $statement->execute();

        $row = $statement->fetch(PDO::FETCH_ASSOC);

        if (! $row) {
            return null;
        }

        $user = new User($row);

        return $user;
    }

    /**
     * @param $username
     * @return User|null
     */
    public function getByUsername($username) : ?User
    {
        $sql = "SELECT * FROM users WHERE username = :username";
        $statement = $this->pdo->prepare($sql);

        $statement->bindValue(':username', $username);

        $result = $statement->execute();

        $row = $statement->fetch(PDO::FETCH_ASSOC);

        if (! $row) {
            return null;
        }

        $user = new User($row);

        return $user;
    }

    public function create($params) : object
    {
        // TODO: Implement create() method.
        throw new BadMethodCallException();
    }

    public function update($params) : object
    {
        // TODO: Implement update() method.
        throw new BadMethodCallException();
    }

    public function delete($id) : bool
    {
        // TODO: Implement delete() method.
        throw new BadMethodCallException();
    }
}
