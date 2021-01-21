<?php
require_once __DIR__ . '/autoload.php';


if(isset($_REQUEST["cityName"])) {
    $weather = new WeatherRepository();
    $weather->deleteWeather($_REQUEST["cityName"]);
}

