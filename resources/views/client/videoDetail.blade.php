<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('/css/home.css') }}" />
    <link rel="stylesheet" href="{{ asset('/css/video.css') }}" />
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
                <img class="icon-weather" alt="" />

                <span class="weather-temperature">25&#176;C</span><span style="font-size: 18px">&#8451;</span>
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
        <div class="video-main bg-wrap">
            <div class="video-media">
                <iframe width="100%" style="min-height: 635px" src="https://www.youtube.com/embed/{{ $video->link }}"
                    frameborder="0"></iframe>
            </div>
        </div>
        <div class="video-individual">
            <div class="video-content">
                <ul class="breadcrumbs">
                    <li><a href="/">Trang chủ</a></li>
                    <li><a href="/">{{ $video->cateName }}</a></li>
                </ul>
                <h1 class="heading">{{ $video->title }}</h1>
                <div class="video-more">
                    <span>{{ $video->description }}</span>
                </div>
                <div class="comment">
                    <div class="comment-head">
                        <div class="comment-title">
                            <i class="fa-regular fa-comments"></i><span>bình luận({{ $commentCount->count() }})</span>
                        </div>
                        <div class="comment-action">
                            @guest
                                <div class="comment-btn">
                                    <a href="{{ route('login') }}"><button class="btn btn-res">Đăng nhập</button></a>
                                    <a href="{{ route('register') }}">
                                        <button class="btn btn-login">Đăng ký</button>
                                    </a>
                                    <span>để bình luận</span>
                                </div>
                            @else
                                <div class="comment-acc">
                                    <p>{{ Auth::user()->name }}</p>
                                    <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                        Đăng xuất
                                    </a>
                                </div>
                            @endguest
                        </div>
                    </div>
                    <div class="commnet-box">
                        <form action="{{ route('video.comment') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <textarea class="input-comment" placeholder="Bạn gì về tin này ?" name="content" id="content"></textarea>
                            <input type="hidden" name="video_id" id="video_id" value="{{ $video->id }}">
                            <div class="sent note">
                                <p>Ý kiến của bạn sẽ được xét duyệt trước khi đăng. Xin vui lòng gõ tiếng Việt có dấu
                                </p>
                                <div class="commnet-sent">
                                    <button class="btn btn-sent" id="submit-form" type="submit">Gửi bình luận<i
                                            class="fa-solid fa-angle-right"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="commnet-container">
                        <ul class="comment-list">
                            @foreach ($comment as $item)
                                <li>
                                    <div class="comment-item">
                                        <div class="comment-avatar">
                                            <img height="40" width="40"
                                                src="https://cdnweb.dantri.com.vn/dist/b474c6ca2d1abee5b89b.png"
                                                alt="">
                                        </div>
                                        <div class="comment-content">
                                            <div class="comment-top">
                                                <div class="comment-author">{{ $item->userName }}</div>
                                                <div class="comment-time">
                                                    {{ \Carbon\Carbon::parse($item->comment_date)->format('H:i, l/d/m/Y') }}
                                                </div>
                                            </div>
                                            <div class="comment-text">
                                                <span>{{ $item->content }}</span>
                                            </div>
                                            <ul class="comment-bottom">
                                                @if ($item->like_id)
                                                    @if (array_search(Auth::user()->id, $item->like_id) !== null)
                                                        <li><button type="button" data-id="{{ $item->id }}"
                                                                class="like liked"><i class="fa-regular fa-heart"></i>
                                                                <span>{{ count($item->like_id) }}</span> thích</button>
                                                        </li>
                                                        <li>
                                                        @else
                                                        <li><button type="button"data-id="{{ $item->id }}"
                                                                class="like"><i class="fa-regular fa-heart"></i>
                                                                <span>{{ count($item->like_id) }}</span>
                                                                thích</button></li>
                                                    @endif
                                                @else
                                                    <li><button type="button"data-id="{{ $item->id }}"
                                                            class="like"><i class="fa-regular fa-heart"></i>
                                                            <span>0</span> thích</button></li>
                                                @endif
                                                <li>
                                                    <button type="button" class="reply"
                                                        data-id="{{ $item->id }}">Trả
                                                        lời</button>
                                                </li>
                                            </ul>
                                            <form class="comment-box2-{{ $item->id }}" style="display: none"
                                                action="{{ route('video.comment') }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <textarea class="input-comment" placeholder="Bạn gì về tin này ?" name="content" id="content"></textarea>
                                                <input type="hidden" name="video_id" id="video_id"
                                                    value="{{ $item->video_id }}">
                                                <input type="hidden" name="reply_id" value="{{ $item->id }}">
                                                <div class="sent note">
                                                    <p>Ý kiến của bạn sẽ được xét duyệt trước khi đăng. Xin vui lòng gõ
                                                        tiếng Việt có dấu</p>
                                                    <div class="commnet-sent">
                                                        <button class="btn btn-sent" id="submit-form"
                                                            type="submit">Gửi
                                                            bình
                                                            luận<i class="fa-solid fa-angle-right"></i></button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <ul class="comment-list child">
                                        <li>
                                            <div class="comment-item">
                                                <div class="comment-avatar">
                                                    <img height="40" width="40"
                                                        src="https://cdnweb.dantri.com.vn/dist/b474c6ca2d1abee5b89b.png"
                                                        alt="">
                                                </div>
                                                <div class="comment-content">
                                                    <div class="comment-top">
                                                        <div class="comment-author">gafg
                                                        </div>
                                                        <div class="comment-time">
                                                            {{ \Carbon\Carbon::parse()->format('H:i, l/d/m/Y') }}
                                                        </div>
                                                    </div>
                                                    <div class="comment-text">
                                                        <span>gdfgfdg</span>
                                                    </div>
                                                    <ul class="comment-bottom">

                                                        <li><button type="button"data-id="" class="like"><i
                                                                    class="fa-regular fa-heart"></i>
                                                                <span>0</span> thích</button></li>

                                                    </ul>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="video-list"></div>
        </div>
        <div class="video-grid line">
            <div class="heading">mới nhất</div>
            @foreach ($listVideo as $item)
                <div class="video-item">
                    <div class="video-thumb">
                        <a href="{{ route('video.details', $item->id) }}">
                            <img src="{{ $item->thumbnail }}" alt="">
                        </a>
                    </div>
                    <div class="video-content">
                        <a href="{{ route('video.details', $item->id) }}">
                            <p>{{ $item->title }}</p>
                        </a>
                        <div class="video-view">
                            <span>3241 lượt xem</span> &#8226; <span>{{ $item->cateName }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

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

            $('.reply').click(function() {
                const reply_id = $(this).data('id');
                $('.comment-box2-' + reply_id).toggle();
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
