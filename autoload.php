<?php
# Models
require_once __DIR__ . '/models/User.php';
require_once __DIR__ . '/models/Weather.php';
require_once __DIR__ . '/models/repositories/IRepository.php';
require_once __DIR__ . '/models/repositories/UserRepository.php';
require_once __DIR__ . '/models/repositories/WeatherRepository.php';


# Views
require_once __DIR__ . '/views/Layout.php';
require_once __DIR__ . '/views/GuestView/GuestView.php';
require_once __DIR__ . '/views/UserView/UserView.php';
require_once __DIR__ . '/views/AdminView/AdminUsersView.php';
require_once __DIR__ . '/views/AdminView/AdminAdsView.php';

# Controllers
require_once __DIR__ . '/controllers/LoginController.php';
require_once __DIR__ . '/controllers/UserController.php';

# Misc
require_once __DIR__ . '/config.php';
