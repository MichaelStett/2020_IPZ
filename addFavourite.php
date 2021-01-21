<?php
require_once __DIR__ . '/autoload.php';

if(isset($_REQUEST['searchInput'])) {
    $weather = new WeatherRepository();
    $weather->addWeather($_REQUEST['searchInput']);
}