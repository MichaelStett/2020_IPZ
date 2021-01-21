<?php
require_once __DIR__ . '/../../autoload.php';

$_COOKIE['uid'] = 1;

class UserView
{
    public static function render()
    {
        ob_start();
        ?>
        <?= Layout::header(['userType' => "user"]); ?>

        <div class="container">
            <div class="row">
                <div class="col font-weight-bold" id="dataLayer"></div>
            </div>

            <div class="row">
                <form method="post">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Enter city name" id="searchInput" name="searchInput" >
                    <div class="input-group-append">
                        <button type="button" class="btn btn-primary" id="getWeatherButton"><i class="fas fa-search"></i>
                            Get Weather</button>
                        <button type="submit" formaction="./addFavourite.php"  class="btn btn-secondary" id="addCity" name="addCity"><i class="fas fa-plus"></i>
                            Add To Favourites</button>
                    </div>

                </div>
                </form>
            </div>

            <!-- <div class="row">
                <div class="col">
                    <h5>My location</h5>
                    <p id="currentLocation"></p>
                    <button type="button" class="btn btn-primary" id="getLocationButton">Get current location</button>
                </div>
            </div> -->

            <div class="row">
                <div class="col-md-6">
                    <div class="col-md-12" id="searchedWeather">
                        <img src="https://openweathermap.org/img/wn/02n@2x.png" style="width: 100px; height: 100px;" alt="Clouds">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="row">
                        <div class="col-md-12" id="weather_0"></div>
                        <div class="col-md-12" id="weather_1"></div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="row">
                        <div class="col-md-12" id="weather_2"></div>
                        <div class="col-md-12" id="weather_3"></div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-9" id="map_col">
                    <h5>Map</h5>
                    <div id="map-wrapper">
                        <div id="mapid"></div>
                    </div>
                </div>
                <div class="col-md-3" id="ad_col">
                    <h5>Ad</h5>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <button type="button" class="btn btn-danger" id="removeMarkersButton">Remove markers</button>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <h5>Ads</h5>
                    <div id="adsCarousel" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#adsCarousel" data-slide-to="0" class="active"></li>
                            <li data-target="#adsCarousel" data-slide-to="1"></li>
                            <li data-target="#adsCarousel" data-slide-to="2"></li>
                            <li data-target="#adsCarousel" data-slide-to="3"></li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img class="d-block w-100 h-100" src="./front/img/ads/Jacket_Ad.png" alt=" First slide">
                                <div class="carousel-caption d-none d-md-block">
                                    <h5>Jacket DESIGN</h5>
                                    <p>Smooth woven fabric with synthetic filling for lightweight warmth. Made with recycled
                                        polyester. Plastic bottles and textile waste are processed into plastic chips and
                                        melted into new fibres. This saves water and energy and reduces greenhouse-gas
                                        emissions!</p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100 h-100" src="./front/img/ads/Umbrella_Ad.png" alt="Second slide">
                                <div class="carousel-caption d-none d-md-block">
                                    <h5>Umbrella UMMY</h5>
                                    <p>This windproof, automatic opening recycled umbrella has a vented overlapping canopy,
                                        black rubber finished handle and carbon fibre ribs. 90 cm long. Canopy span 120 cm.
                                    </p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100 h-100" src="./front/img/ads/Sunglasses_Ad.png" alt="Third slide">
                                <div class="carousel-caption d-none d-md-block">
                                    <h5>Sunglasses SUNNY</h5>
                                    <p>Designed and crafted in Italy. Crystal-tempered sunglass lenses provide protection
                                        with distortion-free vision. With a brand character that can best be described as
                                        classy, exclusive, stylish, and unique, SUNNY continues to go beyond trends.</p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100 h-100" src="./front/img/ads/WateringCan_Ad.png" alt="Fourth slide">
                                <div class="carousel-caption d-none d-md-block">
                                    <h5>Watering Can CONNY</h5>
                                    <p>CONNY watering can is a trusted solution designed mainly for gardening activities.
                                        With a removable sieve. The large handle increases the comfort of use. Resistant to
                                        mechanical damage and UV-light. Available in 2 sizes – with capacity of 1.8 and 4.5
                                        litre – and 4 colour options. </p>
                                </div>
                            </div>
                            <a class="carousel-control-prev" href="#adsCarousel" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#adsCarousel" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col">
                    <h5>Diagrams</h5>
                    <div id="weatherChart" style="height: 370px; width: 100%; position: relative"></div>
                </div>
            </div>
        </div>

        <?= Layout::footer() ?>
        <?php
        $weather = new WeatherRepository();
        $id = $_COOKIE['uid'];
        $array = $weather->getCitynames($id);?>

        <script type="module">
            import { WeatherApi } from './front/js/WeatherApi.js';
            import { WeatherGrid } from './front/js/WeatherGrid.js';

            const api = new WeatherApi("7ded80d91f2b280ec979100cc8bbba94");
            const grid = new WeatherGrid(api);

            let jArray = <?php echo json_encode($array); ?>;

            jArray.forEach(async (cityName, index) => await grid.create(cityName, index))
        </script>

        <?php
        $html = ob_get_clean();
        return $html;
    }
}
?>