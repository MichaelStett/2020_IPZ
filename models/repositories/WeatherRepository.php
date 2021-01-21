<?php
require_once __DIR__ . '/../../autoload.php';


class WeatherRepository
{
    private $pdo;

    public function __construct()
    {
        global $config;
        $this->pdo = new PDO($config['dsn'], $config['login'], $config['password']);
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

    public function addWeather()
    {

    }

    public function deleteWeather()
    {

    }
}