<?php
require_once __DIR__ . '/../../autoload.php';


class WeatherRepository
{
    private $pdo;

    public function __construct()
    {
        global $config;
        $this->pdo = new PDO($config['dsn'], $config['login'], $config['password']);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    }

    public function getCitynames($user_id)
    {
        $sql = "SELECT city_name FROM weather WHERE user_id = :user_id";
        $statement = $this->pdo->prepare($sql);

        $statement->bindValue(':user_id', $user_id);

        $result = $statement->execute();


        $documents = array();
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $cities = implode("|", $row);
            array_push($documents, $cities);
        }
        return $documents;

    }

    public function addWeather($city_name)
    {
        try {
            $user_id = $_COOKIE['uid'];

            $sql = "INSERT INTO weather (user_id, city_name) VALUES (:user_id, :city_name);";

            $statement = $this->pdo->prepare($sql);

            $statement->bindValue(':user_id', $user_id);
            $statement->bindValue(':city_name', $city_name);

            $result = $statement->execute();

            header( 'Location:index.php?action=user');
        }catch(PDOException $e){}
    }

    public function deleteWeather($city_name)
    {
                $user_id = $_COOKIE['uid'];


                $sql = "DELETE FROM weather WHERE city_name = :city_name AND user_id = :user_id";

                $statement = $this->pdo->prepare($sql);

                $statement->bindValue(':user_id', $user_id);
                $statement->bindValue(':city_name', $city_name);

                $result = $statement->execute();

                header('Location:index.php?action=user');

    }
}