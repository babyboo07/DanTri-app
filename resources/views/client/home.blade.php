<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('/css/home.css') }}" />
    <!-- Fontawesome  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />

    <!-- jquery -->
</head>

<body>
    <header class="navbar header container">
        <a href="/">
            <img width="130" height="70"
                src="https://cdnweb.dantri.com.vn/dist/static-logo.1-0-1.329fb29fe0ea34cca545.svg" alt="" />
        </a>

        <div class="navbar-right">
            <a href="#" class="btn btn-version"><img height="26" width="26"
                    src="https://cdnweb.dantri.com.vn/dist/static-avatar-default.1-0-1.b474c6ca2d1abee5b89b.png"
                    alt="" />
                International Version</a>
            <div class="weather">
                <div class="wearther-wrap">
                    <span class="weather-location">Hà Nội</span>
                    <span class="weather-datetime">{{ \Carbon\Carbon::now()->format('l,d/m/Y') }}</span>
                </div>
                <a href="/weather">
                    <img class="icon-weather" alt="" />
                </a>
                <a href="/weather" style="display: contents;text-decoration: none;color: #222;">
                    <span class="weather-temperature">25&#176;C</span><span style="font-size: 18px">&#8451;</span>
                </a>
            </div>
            <div class="auth">

                @guest
                    <button type="button" class="btn-acc">
                        <a href="{{ route('register') }}">Đăng Nhập <i class="fa-regular fa-user"></i></a>
                    </button>
                @else
                    <div class="dropdown">
                        <button type="button" class="dropbtn">Chào,{{ Auth::user()->name }}</button>

                        <div class="auth-dropdown">
                            <ul>
                                @if (Auth::user()->role_id == '1' || Auth::user()->role_id == '3' || Auth::user()->role_id == '4')
                                    <li><a href="/dashboard"><i class="fa-solid fa-chart-pie"></i> Dashboad</a></li>
                                @endif
                                <li>
                                    <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                             document.getElementById('logout-form').submit();">
                                        <i class="fa-solid fa-arrow-right"></i>
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                @endguest
            </div>
            <a class="search-link" href="/search"><i class="fa-solid fa-magnifying-glass"></i></a>
        </div>
    </header>
    @include('client.common.category')
    <main class="body container">

        @include('client.common.highlight')

        @include('client.common.spotlight')

        @include('client.common.shortvideo')

        @include('client.common.postbycatecenter')

        @include('client.common.postbycatebottom')
    </main>

    <button type="button" class="btn-top" onclick="topFunction()" id="btnTop"><i
            class="fa-solid fa-arrow-up"></i></button>

    <footer class="footer footer-container" style="padding-top:34px; padding-bottom: 30px;">
        <div class="footer-logo">
            <a href="#"><img width="102" height="25"
                    src="https://cdnweb.dantri.com.vn/dist/static-logo.1-0-1.329fb29fe0ea34cca545.svg"
                    alt=""></a>
        </div>
        <div class="footer-wrap">
            <div class="footer-col footer-one">
                <ul class="footer-list">
                    <li>Cơ quan của Bộ Lao động - Thương binh và Xã hội</li>
                    <li>Tổng biên tập: Phạm Tuấn Anh</li>
                    <li>Giấy phép hoạt động báo điện tử Dân trí số 298/GP - BTTTT Hà Nội, ngày 14-07-2020.</li>
                    <li>Địa chỉ tòa soạn: Nhà 48, ngõ 2 Giảng Võ, Cát Linh, Đống Đa, Hà Nội</li>
                    <li>Văn phòng đại diện miền Nam: 51 Võ Văn Tần, Phường Võ Thị Sáu, Quận 3, TP.HCM</li>
                    <li>Điện thoại: 024-3736-6491. Fax: 024-3736-6491</li>
                    <li>Hotline HN: 0973-567-567. Hotline TP HCM: 0974-567-567</li>
                    <li>Email: info@dantri.com.vn</li>
                </ul>
            </div>
            <div class="footer-col footer-two">
                <ul class="footer-list">
                    <li>Liên hệ quảng cáo: 0945.54.03.03</li>
                    <li>Email: quangcao@dantri.com.vn</li>
                </ul>
            </div>
            <div class="footer-col footer-three">
                <div class="footer-app">
                    <label class="footer-app-lable">
                        Đọc báo Dân trí trên mobile:
                    </label>
                    <div class="footer-app-mobile">
                        <a href="#">
                            <img width="150" height="47"
                                src="https://cdnweb.dantri.com.vn/dist/ee6bf097e303486d2a1c.png" alt=""></a>
                        <a href="#">
                            <img width="150" height="47"
                                src="https://cdnweb.dantri.com.vn/dist/25695d60eaeb16411962.png" alt=""></a>
                    </div>
                </div>
                <div class="social">
                    <label for="" class="lable-social">Theo dõi Dân trí trên:</label>
                    <div class="social-list">
                        <a href="#">
                            <img src="https://cdnweb.dantri.com.vn/dist/f79dca0321a473942b57.svg" alt="">
                        </a>
                        <a href="#">
                            <img src="https://cdnweb.dantri.com.vn/dist/add0b845165b2db1bdc0.svg" alt="">
                        </a>
                        <a href="#">
                            <img src="	https://cdnweb.dantri.com.vn/dist/e84c1388df2f58641617.svg" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright">
            <span>&#169;2005-2022 Bản quyền thuộc về Báo điện tử Dân trí. Cấm sao chép dưới mọi hình thức nếu không có
                sự chấp
                thuận bằng văn bản.</span>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI="
        crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.more').click(function() {
                $('.nav-full').attr("style", "opacity: 1;visibility: visible ");
                $('.more').attr("style", "display: none");
                $('.close').removeAttr("style");
            });
            $('.close').click(function() {
                $('.nav-full').removeAttr("style");
                $('.more').removeAttr("style");
                $('.close').attr("style", "display: none");
            });

            $.ajax({
                type: 'GET',
                dataType: "jsonp",
                url: 'http://api.openweathermap.org/data/2.5/weather?q=HaNoi&appid=7de1ace9240420c8df546f1954457687&units=metric',
                headers: {},
                success: function(data, status, xhr) {
                    console.log('data: ', data);
                    var tem = Math.round(data.main.temp)
                    $(".icon-weather").attr("src", 'https://openweathermap.org/img/w/' + data.weather[0]
                        .icon + '.png');
                    $(".weather-temperature").text(data.main.temp);
                }
            });

        })

        let mybutton = document.getElementById("btnTop");

        window.onscroll = function() {
            scrollFunction()
        };

        function scrollFunction() {
            if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
                mybutton.style.display = "block";
            } else {
                mybutton.style.display = "none";
            }
        }

        function topFunction() {
            $('html, body').animate({
                scrollTop: 0
            }, 800);
        }
    </script>
</body>

</html>
