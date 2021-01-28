<?php
require_once __DIR__ . '/../autoload.php';


class Layout
{
    public static function header($params = [])
    {
        ob_start();
        ?>
        <!DOCTYPE html>
        <html>

        <head>
            <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
            <link rel="icon" type="image/jpeg" href="./front/img/favicon.png">

            <!-- Icons -->
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

            <!-- Bootstrap -->
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
                  integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
            <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
                    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
                    crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
                    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
                    crossorigin="anonymous"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
                    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
                    crossorigin="anonymous"></script>

            <!-- Leaflet  -->
            <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
                  integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
                  crossorigin="anonymous" />
            <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
                    integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
                    crossorigin="anonymous"></script>

            <!-- DataTable  -->
            <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.css">
            <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.js"></script>


            <script>$(document).ready(function () {
                    $.noConflict();
                    var table = $('#user_list').DataTable();
                });</script>

            <!-- Bootstrap Toggle -->
            <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
            <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

        </head>

        <body>

        <?= self::navbar()  ?>


        <?php
        $html = ob_get_clean();
        return $html;
    }

    public static function footer()
    {
        ob_start();
        ?>
        <footer class="footer position-fixed">
            <div class="container">
                <span>&copy; 2020 AppName</span>
            </div>
        </footer>

        <div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <h4 class="modal-title w-100 font-weight-bold">Sign in</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form class="modal-body mx-3" action="./index.php?action=login-set" method="post">
                        <div class="md-form mb-4">
                            <label data-error="wrong" data-success="right" for="email">E-mail</label>
                            <input type="email" id="email" name="email" class="form-control validate">
                        </div>
                        <div class="md-form mb-4">
                            <label data-error="wrong" data-success="right" for="password">Password</label>
                            <input type="password" id="password" name="password" class="form-control validate" autocomplete="on">
                        </div>
                        <div class="modal-footer d-flex justify-content-center">
                            <button class="btn btn-default" type="submit">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
        <script src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>
        <script type="module" src="./front/js/main.js"></script>
        </body>

        </html>
        <?php
        $html = ob_get_clean();
        return $html;
    }

    private static function navbar()
    {
        $userType = isset($_SESSION['role']) ? $_SESSION['role'] : null;

        ob_start();
        ?>
        <link rel="stylesheet" href="./front/css/logged_styles.css">

        <header class="position-sticky">
            <nav class="navbar navbar-expand-lg sticky-top">
                <a class="navbar-brand" href="#"><img src="./front/img/Logo.png"></i> AppName</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText"
                        aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"><i class="fas fa-bars"></i></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarText">
                    <ul class="navbar-nav mr-auto"></ul>

                <?php
                switch ($userType) {
                    case 'U':
                        ?>

                        <ul class="navbar-nav">
                            <li class="nav-item active">
                                <a class="nav-link" href="./index.php?action=main">Home <span class="sr-only">(current)</span></a>
                            </li>
                        <li class="nav-item">
                            <a href="./index.php?action=logout" class="nav-link">
                                Logout
                            </a>
                        </li>
                        <?php
                        break;
                    case 'A':
                        ?>
                            <ul class="navbar-nav">
                                <li class="nav-item active">
                                    <a class="nav-link" href="./index.php?action=user">Home <span class="sr-only">(current)</span></a>
                                </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./index.php?action=admin">Users</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Ads</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./index.php?action=logout">
                                Logout
                            </a>
                        </li>
                        <?php
                        break;
                    default:
                        ?>
                                <ul class="navbar-nav">
                                    <li class="nav-item active">
                                        <a class="nav-link" href="./index.php?action=main">Home <span class="sr-only">(current)</span></a>
                                    </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="modal" data-target="#modalLoginForm" href="#">
                                Login
                            </a>
                        </li>
                        <?php
                        break;
                }
                ?>
                            </ul>
                        </div>
                    </nav>
                </header>
            </div>
        </nav>
        <?php

        $html = ob_get_clean();
        return $html;
    }

}
