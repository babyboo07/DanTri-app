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
        <div class="gird-list">
            <div class="main">
                <form action="{{ route('search') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="search-box">
                        <input class="search-box-input" type="text" name="search" id="search"
                            value="{{ old('sreach') }}" placeholder="Tìm kiếm tin tức...">
                        <button class="search-box-btn" type="submit"><i
                                class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                    <div class="title-tag">
                        @if ($text && $articleList)
                            <span>Có <strong>{{ $articleList->count() }}</strong> tin tức, video về "
                                <strong>{{ $text }}</strong>"</span>
                        @else
                            <span>Có <strong>0</strong> tin tức, video về " <strong></strong>"</span>
                        @endif
                    </div>
                    <div class="filter-row">
                        <div class="filter-col">
                            <label class="filter-label" for="">Chuyên mục</label>
                            <div class="filter-select">
                                <select id="cate_id" name="cate_id" class="select2 filter-select-item">
                                    <option value="">Tất cả</option>
                                    @foreach ($categories as $category)
                                        <option class="l1" {{ old('cate_id') == $category->id ? 'selected' : '' }}
                                            value="{{ $category->id }}">{{ $category->cateName }}</option>
                                        @if (count($category->children) > 0)
                                            @foreach ($category->children as $subcategory)
                                                <option class="l2"
                                                    {{ old('cate_id') == $subcategory->id ? 'selected' : '' }}
                                                    value="{{ $subcategory->id }}">
                                                    {{ $subcategory->cateName }}
                                                </option>
                                            @endforeach
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="filter-col"></div>
                    </div>
                </form>
                <div class="article-list">
                    @foreach ($articleList as $item)
                        <article class="article-items">
                            <div class="article-thumb">
                                <a href="{{ route('news', $post->id) }}">
                                    <img height="168" width="252"
                                        src="{{ asset('storage/post/' . $item->thumbnail) }}" alt="" />
                                </a>
                            </div>
                            <div class="article-content">
                                <h3 class="article-title">
                                    <a href="{{ route('news', $post->id) }}">{{ $item->title }}</a>
                                </h3>
                                <div class="article-excerpt">
                                    <a href="{{ route('news', $post->id) }}">{!! $item->shortContent !!}</a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                    {{-- <article class="article-items">
                        <div class="article-thumb">
                            <a href="#">
                                <img height="168" width="252"
                                    src="https://icdn.dantri.com.vn/zoom/516_344/2022/11/03/z3850470191963a028f8dcc653b066d5cea52140c89731-1667438250466.jpg"
                                    alt="" />
                            </a>
                        </div>
                        <div class="article-content">
                            <h3 class="article-title">
                                <a href="#">Nữ cảnh sát làm "mồi nhử" để bắt kẻ giết người hàng loạt trên xa
                                    lộ</a>
                            </h3>
                            <div class="article-excerpt">
                                <a href="#">
                                    Một nữ cảnh sát tự biến mình thành "mồi nhử" để dụ sát thủ xuất hiện, sau khi
                                    nhiều phụ nữ bị sát hại trên xa lộ 40 thuộc bang Delaware, Mỹ, hồi cuối thập
                                    niên 80.
                                    Gã sát nhân bệnh hoạn thoát án tử vì sai lầm của một cảnh sát
                                    Gã sát
                                </a>
                            </div>
                        </div>
                    </article> --}}
                </div>
            </div>

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

            $.ajax({
                type: 'GET',
                dataType: "jsonp",
                url: 'http://api.openweathermap.org/data/2.5/weather?q=HaNoi&appid=7de1ace9240420c8df546f1954457687&units=metric',
                headers: {},
                success: function(data, status, xhr) {
                    console.log('data: ', data);
                    var tem = Math.round(data.main.temp)
                    $(".icon-weather").attr("src", 'https://openweathermap.org/img/w/' + data.weather[0].icon + '.png');
                    $(".weather-temperature").text(data.main.temp);
                }
            });

            $('#cate_id').select2({
                templateResult: function(data) {
                    // We only really care if there is an element to pull classes from
                    if (!data.element) {
                        return data.text;
                    }

                    var $element = $(data.element);

                    var $wrapper = $('<span></span>');
                    $wrapper.addClass($element[0].className);

                    $wrapper.text(data.text);

                    return $wrapper;
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
