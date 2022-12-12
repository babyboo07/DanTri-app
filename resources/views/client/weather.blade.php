<!DOCTYPE html>

<!-- =========================================================
* Sneat - Bootstrap 5 HTML Admin Template - Pro | v1.0.0
==============================================================

* Product Page: https://themeselection.com/products/sneat-bootstrap-html-admin-template/
* Created by: ThemeSelection
* License: You must have a valid license purchased in order to legally use the theme for your project.
* Copyright ThemeSelection (https://themeselection.com)

=========================================================
 -->
<!-- beautify ignore:start -->
<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Dashboard - Analytics | Sneat - Bootstrap 5 HTML Admin Template - Pro</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="../../assets/vendor/fonts/boxicons.css" />

    <link rel="stylesheet" href="{{ asset('/css/weather.css') }}" />


    <!-- Core CSS -->
    <link rel="stylesheet" href="../../assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="../../assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="../../assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="../../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <link rel="stylesheet" href="../../assets/vendor/libs/apex-charts/apex-charts.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="../../assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="../../assets/js/config.js"></script>
    <link rel="stylesheet" href="/js/post.js">
        
  </head>

  <body>
    <header>
      <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
          <a class="navbar-brand" href="#"> <img width="100" height="50"
            src="https://cdnweb.dantri.com.vn/dist/static-logo.1-0-1.329fb29fe0ea34cca545.svg" alt="" /></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <img width="130" height="70"
                src="https://cdnweb.dantri.com.vn/dist/static-logo.1-0-1.329fb29fe0ea34cca545.svg" alt="" />
          </button>
          <div class="collapse navbar-collapse" id="navbarNavDropdown" >
            <ul class="navbar-nav ">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Features</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Pricing</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Dropdown link
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="#">Action</a></li>
                  <li><a class="dropdown-item" href="#">Another action</a></li>
                  <li><a class="dropdown-item" href="#">Something else here</a></li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </header>

    <div class="layout-page mt-3 ps-0 mx-5">
      <div class="content-wrapper mx-auto">
        <div class="container mx-5">
          <div class="row">
            <div class="col-7">
              <div class="card mx-5 card-weather">
                <div class="card-header p-2 bg-secondary">
                  Hanoi, Vietnam As of 2:31 pm GMT+07:00
                </div>
                <div class="card-body p-0 px-4 row mt-4">
                  <div class="col-9 pt-3">
                    <span class="mb-0 text-white weather-temp fs-1"></span><span style="font-size: 22px">&#8451;</span>
                    <p class="mb-0 weather-main"></p>
                    <p class="mb-0">Day 20° • Night 15°</p>
                  </div>
                  <div class="col">
                    <img class="float-end w-100 icon-weather " alt="">
                  </div>
                </div>
                <div class="card-footer p-0 p-2 m-3 d-flex justify-content-center bg-secondary ">
                  <span><i class="fa-regular fa-circle-play"></i> Watch:Disturbing News For Children's Medicine</span>
                </div>
              </div>

              <div class="mt-3">
                <div class="card mx-5">
                  <div class="card-body">
                    <h3>Weather Today in Hanoi, Vietnam</h3>
                    <div class="row">
                      <div class="col float-stats">
                        <div class="">
                          <span class="weather-feellike fs-1"></span><span style="font-size: 22px">&#8451;</span>
                        </div>
                        <p>Feels Like</p>
                        <ul class="list-group list-group-flush">
                          <li class="list-group-item d-flex">
                            <i class="fa-solid fa-temperature-three-quarters fs-5"></i>
                            <span class="ms-1">High / Low</span>
                            <div class="ms-auto">
                              <span class="weather-hight"></span><span style="font-size: 12px">&#9702;</span>/
                              <span class="weather-low"></span><span style="font-size: 12px">&#8728;</span>
                            </div>
                          </li>
                          <li class="list-group-item d-flex">
                            <i class="fa-solid fa-droplet fs-5"></i>
                            <span class="ms-1">Humidity</span>
                            <div class="ms-auto">
                              <span class="weather-humidity"></span><span style="font-size: 12px">%</span>
                            </div>
                          </li>
                          <li class="list-group-item d-flex">
                            <i class="fa-solid fa-temperature-three-quarters fs-5"></i>
                            <span class="ms-1">Pressure</span>
                            <div class="ms-auto">
                              <span style="font-size: 20px">&#8595;</span><span class="weather-pressure"></span>mb
                            </div>
                          </li>
                          <li class="list-group-item d-flex">
                            <i class="fa-solid fa-eye fs-5"></i>
                            <span class="ms-1">Visibility</span>
                            <div class="ms-auto">
                              <span class="weather-visibility"></span>km
                            </div>
                          </li>
                        </ul>
                      </div>
                      <div class="col">
                        <div>
                          <svg width="135" height="71">
                            <path d="M125,80 a60,60 0 1,0 -115,0" fill="#fff" stroke="#e87538" stroke-width="3" />
                            <g style="transform: translate(114.0696px, 35.6476px);">
                              <svg set="current-conditions" name="daylight2" theme="" data-testid="Icon" aria-hidden="true">
                                <title>Daylight</title>
                                <circle cx="12" cy="12" r="12" fill="#FFF"></circle>
                                <path fill="#F7C044" d="M18.405 17.661a1 1 0 0 1-1.437 1.391l-1.665-1.72a1 1 0 1 1 1.437-1.39l1.665 1.72zm-5.541 2.651a1 1 0 0 1-2 0v-2.366a1 1 0 1 1 2 0v2.366zm-6.718-1.624a1 1 0 0 1-1.357-1.469l1.758-1.624a1 1 0 1 1 1.357 1.47l-1.758 1.623zm-2.753-5.769a1 1 0 1 1 .002-2l2.422.001a1 1 0 0 1-.001 2l-2.423-.001zm1.77-6.115A1 1 0 0 1 6.6 5.414l1.664 1.719a1 1 0 0 1-1.436 1.391l-1.665-1.72zm5.751-3.391a1 1 0 1 1 2 0v2.366a1 1 0 0 1-2 0V3.413zm6.5 1.903a1 1 0 1 1 1.356 1.47l-1.757 1.623a1 1 0 1 1-1.357-1.47l1.758-1.623zm3.005 6.114a1 1 0 0 1-.002 2l-2.422-.001a1 1 0 0 1 .001-2l2.423.001z"></path>
                                <ellipse fill="#F7C044" cx="11.85" cy="11.935" rx="3.225" ry="3.256"></ellipse></svg></g>
                          </svg>
                        </div>
                        <div class="d-flex mt-1">
                          <div class="d-flex">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-sunrise text-warning" viewBox="0 0 16 16">
                              <path d="M7.646 1.146a.5.5 0 0 1 .708 0l1.5 1.5a.5.5 0 0 1-.708.708L8.5 2.707V4.5a.5.5 0 0 1-1 0V2.707l-.646.647a.5.5 0 1 1-.708-.708l1.5-1.5zM2.343 4.343a.5.5 0 0 1 .707 0l1.414 1.414a.5.5 0 0 1-.707.707L2.343 5.05a.5.5 0 0 1 0-.707zm11.314 0a.5.5 0 0 1 0 .707l-1.414 1.414a.5.5 0 1 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zM8 7a3 3 0 0 1 2.599 4.5H5.4A3 3 0 0 1 8 7zm3.71 4.5a4 4 0 1 0-7.418 0H.499a.5.5 0 0 0 0 1h15a.5.5 0 0 0 0-1h-3.79zM0 10a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2A.5.5 0 0 1 0 10zm13 0a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5z"/>
                            </svg>
                            <p class="ms-2 mb-0">6:20 am</p>
                          </div>
                          <div class="d-flex ms-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-sunset text-warning" viewBox="0 0 16 16">
                              <path d="M7.646 4.854a.5.5 0 0 0 .708 0l1.5-1.5a.5.5 0 0 0-.708-.708l-.646.647V1.5a.5.5 0 0 0-1 0v1.793l-.646-.647a.5.5 0 1 0-.708.708l1.5 1.5zm-5.303-.51a.5.5 0 0 1 .707 0l1.414 1.413a.5.5 0 0 1-.707.707L2.343 5.05a.5.5 0 0 1 0-.707zm11.314 0a.5.5 0 0 1 0 .706l-1.414 1.414a.5.5 0 1 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zM8 7a3 3 0 0 1 2.599 4.5H5.4A3 3 0 0 1 8 7zm3.71 4.5a4 4 0 1 0-7.418 0H.499a.5.5 0 0 0 0 1h15a.5.5 0 0 0 0-1h-3.79zM0 10a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2A.5.5 0 0 1 0 10zm13 0a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5z"/>
                            </svg>
                            <p class="ms-2 mb-0">5:14 pm</p>
                          </div>
                        </div>
                        <ul class="list-group list-group-flush">
                          <li class="list-group-item d-flex">
                            <i class="fa-solid fa-wind fs-5"></i>
                            <span class="ms-1">Wind</span>
                            <div class="ms-auto">
                              <i class="fa-solid fa-location-arrow"></i><span class="weather-wind"></span>km/h
                            </div>
                          </li>
                          <li class="list-group-item d-flex">
                            <i class="fa-solid fa-droplet fs-5"></i>
                            <span class="ms-1">Dew Point</span>
                            <div class="ms-auto">
                              <span class="weather-humidity"></span><span style="font-size: 12px">%</span>
                            </div>
                          </li>
                          <li class="list-group-item d-flex">
                            <i class="fa-solid fa-cloud fs-5"></i>
                            <span class="ms-1">Clouds</span>
                            <div class="ms-auto">
                              <span class="weather-clouds"></span>%
                            </div>
                          </li>
                          <li class="list-group-item d-flex">
                            <i class="fa-solid fa-water fs-5"></i>
                            <span class="ms-1">Sea level</span>
                            <div class="ms-auto">
                              <span class="weather-sealevel"></span><span>hPa</span>
                            </div>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="mt-3 mx-5">
                <div class="card">
                  <div class="card-header">
                    <p class="mb-0 pb-0 fs-4">Daily Forecast</p>
                  </div>
                  <div class="card-body row">
                    <div class="col">
                      
                    </div>
                    <div class="col">fs</div>
                    <div class="col">fs</div>
                    <div class="col">sdf</div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col">
              
            </div>
          </div>
        </div>
        </div>
      </div>
    </div>
  
    

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="../../assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../../assets/vendor/libs/popper/popper.js"></script>
    <script src="../../assets/vendor/js/bootstrap.js"></script>
    <script src="../../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="../../assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="../../assets/vendor/libs/apex-charts/apexcharts.js"></script>

    <!-- Main JS -->
    <script src="../../assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="../../assets/js/dashboards-analytics.js"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI="
        crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $.ajax({
                type: 'GET',
                dataType: "jsonp",
                url: 'http://api.openweathermap.org/data/2.5/weather?q=HaNoi&appid=7de1ace9240420c8df546f1954457687&units=metric',
                headers: {},
                success: function(data, status, xhr) {
                    console.log('data: ', data);
                    $(".icon-weather").attr("src", 'https://openweathermap.org/img/w/' + data.weather[0]
                        .icon + '.png');
                    $(".weather-main").text(data.weather[0].main);
                    $(".weather-temp").text(data.main.temp);
                    $(".weather-feellike").text(data.main.feels_like);
                    $(".weather-hight").text(data.main.temp_max);
                    $(".weather-low").text(data.main.temp_min);
                    $(".weather-humidity").text(data.main.humidity);
                    $(".weather-pressure").text(data.main.pressure);
                    $(".weather-visibility").text(data.visibility);
                    $(".weather-clouds").text(data.clouds.all);
                    $(".weather-sealevel").text(data.main.sea_level);
                    $(".weather-wind").text(data.wind.speed);
                }
            });

            $.ajax({
                type: 'GET',
                // dataType: "jsonp",
                url: 'https://api.weatherapi.com/v1/forecast.json?key=428737f9bb444a8c83862639220712&q=Hanoi&days=5&aqi=no&alerts=no',
                headers: {},
                success: function(data7, status, xhr) {
                    console.log('data7day: ', data7);
                    // console.log(data7.current.cloud);
                }
            });
        })
    </script>

  </body>
</html>
