<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('/css/home.css') }}" />
    <link rel="stylesheet" href="{{ asset('/css/sreach.css') }}" />
    <!-- Fontawesome  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif&display=swap" rel="stylesheet">
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
        <div class="body-container">
            <div class="title-container">
                <div class="title-breadcrumbs">
                    <h1 class="title-page">
                        <a href="{{ route('sreachByCategory', $category->id) }}">{{ $category->cateName }}</a>
                    </h1>
                </div>
            </div>
            <ul class="second-menu child">
                @foreach ($category->children()->get() as $item)
                    <li><a href="{{ route('sreachByCategory', $item->id) }}">{{ $item->cateName }}</a></li>
                @endforeach
            </ul>

            <div class="grid-highlinght">
                <article class="article-wap">
                    <article class="article-grid">
                        @foreach ($hotArticles->slice(0, 1) as $item)
                            <article class="article-item">
                                <div class="article-thumb">
                                    <a href="{{ route('news', $item->id) }}"><img height="516" width="344"
                                            src="{{ asset('storage/post/' . $item->thumbnail) }}" alt="" /></a>
                                </div>
                                <div class="article-content">
                                    <h3 class="article-title">
                                        <a href="{{ route('news', $item->id) }}">{{ $item->title }}</a>
                                    </h3>
                                    <div class="article-excerpt">
                                        <a href="{{ route('news', $item->id) }}">
                                            {!! $item->shortContent !!}
                                        </a>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                        @foreach ($hotArticles->slice(1, 2) as $item)
                            <article class="article-item">
                                <div class="article-thumb">
                                    <a href="{{ route('news', $item->id) }}"><img height="168" width="252"
                                            src="{{ asset('storage/post/' . $item->thumbnail) }}" alt="" /></a>
                                </div>
                                <h3 class="article-title">
                                    <a href="{{ route('news', $item->id) }}">{{ $item->title }}</a>
                                </h3>
                            </article>
                        @endforeach
                        {{-- <article class="article-item">
                            <div class="article-thumb">
                                <a href="#"><img height="168" width="252"
                                        src="https://icdn.dantri.com.vn/zoom/516_344/2022/11/03/z3850470191963a028f8dcc653b066d5cea52140c89731-1667438250466.jpg"
                                        alt="" /></a>
                            </div>
                            <h3 class="article-title">
                                <a href="#">
                                    Hà Nội dừng hoạt động giao dịch với hơn 760 pháp nhân liên
                                    quan vụ án Vạn Thịnh Phát</a>
                            </h3>
                        </article> --}}
                    </article>
                    <article class="article-col">
                        @foreach ($articleCol as $item)
                            <article class="article-item">
                                <div class="article-thumb">
                                    <a href="{{ route('news', $item->id) }}"><img height="168" width="252"
                                            src="{{ asset('storage/post/' . $item->thumbnail) }}" alt="" /></a>
                                </div>
                                <h3 class="article-title">
                                    <a href="{{ route('news', $item->id) }}">{{ $item->title }}</a>
                                </h3>
                            </article>
                        @endforeach

                        {{-- <article class="article-item">
                            <div class="article-thumb">
                                <a href="#"><img height="168" width="252"
                                        src="https://icdn.dantri.com.vn/zoom/516_344/2022/11/03/z3850470191963a028f8dcc653b066d5cea52140c89731-1667438250466.jpg"
                                        alt="" /></a>
                            </div>
                            <h3 class="article-title">
                                <a href="#">
                                    Hà Nội dừng hoạt động giao dịch với hơn 760 pháp nhân liên
                                    quan vụ án Vạn Thịnh Phát</a>
                            </h3>
                        </article> --}}
                    </article>
                </article>
            </div>

            <div class="grid-list">
                <div class="main">
                    <article class="article-list">
                        @foreach ($allArticle as $item)
                            <article class="article-items">
                                <div class="article-thumb">
                                    <a href="{{ route('news', $item->id) }}">
                                        <img height="168" width="252"
                                            src="{{ asset('storage/post/' . $item->thumbnail) }}" alt="" />
                                    </a>
                                </div>
                                <div class="article-content">
                                    <h3 class="article-title">
                                        <a href="{{ route('news', $item->id) }}">{{ $item->title }}</a>
                                    </h3>
                                    <div class="article-excerpt">
                                        <a href="{{ route('news', $item->id) }}">{!! $item->shortContent !!}</a>
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
                    </article>
                </div>
                <div class="sidebar">
                    <div class="article-sidebar">
                        <div class="title">tiêu điểm</div>
                        <article class="article-item">
                            <div class="article-thumb">
                                <a href="#">
                                    <img height="168" width="252"
                                        src="https://icdn.dantri.com.vn/zoom/516_344/2022/11/03/z3850470191963a028f8dcc653b066d5cea52140c89731-1667438250466.jpg"
                                        alt="" />
                                </a>
                            </div>
                            <h3 class="article-title">
                                <a href="#">Nữ cảnh sát làm "mồi nhử" để bắt kẻ giết người hàng loạt trên xa
                                    lộ</a>
                            </h3>
                        </article>
                        <article class="article-item">
                            <h3 class="article-title">
                                <a href="#">Cơn
                                    sóng thần mang tên "ung thư" đang tấn công người trẻ trên toàn cầu</a>
                            </h3>
                            <div class="article-thumb">
                                <a href="#"><img width="114" height="76"
                                        src="https://icdn.dantri.com.vn/zoom/234_156/2022/11/01/thumb-1-1667289623482.png"
                                        alt=""></a>
                            </div>
                        </article>
                        <article class="article-item">
                            <h3 class="article-title">
                                <a href="#">Cơn
                                    sóng thần mang tên "ung thư" đang tấn công người trẻ trên toàn cầu</a>
                            </h3>
                            <div class="article-thumb">
                                <a href="#"><img width="114" height="76"
                                        src="https://icdn.dantri.com.vn/zoom/234_156/2022/11/01/thumb-1-1667289623482.png"
                                        alt=""></a>
                            </div>
                        </article>
                        <article class="article-item">
                            <h3 class="article-title">
                                <a href="#">Cơn
                                    sóng thần mang tên "ung thư" đang tấn công người trẻ trên toàn cầu</a>
                            </h3>
                            <div class="article-thumb">
                                <a href="#"><img width="114" height="76"
                                        src="https://icdn.dantri.com.vn/zoom/234_156/2022/11/01/thumb-1-1667289623482.png"
                                        alt=""></a>
                            </div>
                        </article>
                    </div>
                </div>
            </div>
            <div class="grid-category">
                @foreach ($category->children()->get()->slice(0, 1) as $item)
                    <div class="head">
                        <h3 class="title">
                            <a href="{{ route('sreachByCategory', $item->id) }}">{{ $item->cateName }}</a>
                        </h3>
                    </div>
                    <div class="article-container">
                        <?php $article = $item->articleByFirstSubCategoryHot(); ?>
                        <?php $articleList = $item->articleByFirstSubCategory(); ?>
                        @foreach ($article->slice(0, 1) as $item)
                            <article class="article-highlight">
                                <article class="article-item">
                                    <div class="article-thumb">
                                        <a href="{{ route('news', $item->id) }}"><img height="516" width="344"
                                                src="{{ asset('storage/post/' . $item->thumbnail) }}"
                                                alt="" /></a>
                                    </div>
                                    <div class="article-content">
                                        <h3 class="article-title">
                                            <a href="{{ route('news', $item->id) }}">{{ $item->title }}</a>
                                        </h3>
                                        <div class="article-excerpt">
                                            <a href="{{ route('news', $item->id) }}">{!! $item->shortContent !!}</a>
                                        </div>
                                    </div>
                                </article>
                        @endforeach
                        @foreach ($article->slice(1, 2) as $item)
                            <article class="article-item">
                                <div class="article-thumb">
                                    <a href="#"><img height="234" width="156"
                                            src="{{ asset('storage/post/' . $item->thumbnail) }}"
                                            alt="" /></a>
                                </div>
                                <div class="article-content">
                                    <h3 class="article-title">
                                        <a href="#">{{ $item->title }}</a>
                                    </h3>
                                </div>
                            </article>
                        @endforeach
                        {{-- <article class="article-item">
                        <div class="article-thumb">
                            <a href="#"><img height="234" width="156"
                                    src="https://icdn.dantri.com.vn/zoom/516_344/2022/11/03/z3850470191963a028f8dcc653b066d5cea52140c89731-1667438250466.jpg"
                                    alt="" /></a>
                        </div>
                        <div class="article-content">
                            <h3 class="article-title">
                                <a href="#">
                                    Hà Nội dừng hoạt động giao dịch với hơn 760 pháp nhân liên
                                    quan vụ án Vạn Thịnh Phát</a>
                            </h3>
                        </div>
                    </article> --}}
                        </article>
                        <article class="article-list">
                            @foreach ($articleList as $item)
                                <article class="article-item" style="width: 100%">
                                    <h3 class="article-title">
                                        <a href="{{ route('news', $item->id) }}">{{ $item->title }}</a>
                                    </h3>
                                    <div class="article-thumb">
                                        <a href="{{ route('news', $item->id) }}"><img width="114" height="76"
                                                src="{{ asset('storage/post/' . $item->thumbnail) }}"
                                                alt=""></a>
                                    </div>
                                </article>
                            @endforeach
                            {{-- <article class="article-item" style="width: 100%">
                                <h3 class="article-title">
                                    <a href="#">Cơn
                                        sóng thần mang tên "ung thư" đang tấn công người trẻ trên toàn cầu</a>
                                </h3>
                                <div class="article-thumb">
                                    <a href="#"><img width="114" height="76"
                                            src="https://icdn.dantri.com.vn/zoom/234_156/2022/11/01/thumb-1-1667289623482.png"
                                            alt=""></a>
                                </div>
                            </article>
                            <article class="article-item" style="width: 100%">
                                <h3 class="article-title">
                                    <a href="#">Cơn
                                        sóng thần mang tên "ung thư" đang tấn công người trẻ trên toàn cầu</a>
                                </h3>
                                <div class="article-thumb">
                                    <a href="#"><img width="114" height="76"
                                            src="https://icdn.dantri.com.vn/zoom/234_156/2022/11/01/thumb-1-1667289623482.png"
                                            alt=""></a>
                                </div>
                            </article> --}}
                        </article>
                    </div>
                @endforeach
            </div>
            <div class="grid-row">
                @foreach ($category->children()->get() as $item)
                    <div class="article-col">
                        <h2 class="title">{{ $item->cateName }}</h2>
                        <article class="article-wrap">
                            <?php $post = $item->getHotArticleBySubCate(); ?>
                            @if ($post)
                                <article class="article-item" style="width: 100%">
                                    <div class="article-thumb">
                                        <a href="{{ route('news', $post->id) }}"><img width="264" height="176"
                                                src="{{ asset('storage/post/' . $post->thumbnail) }}"
                                                alt=""></a>
                                    </div>
                                    <h3 class="article-title">
                                        <a href="{{ route('news', $post->id) }}">{{ $post->title }}</a>
                                    </h3>
                                </article>
                            @endif
                            <?php $article = $item->articleOfSubCategory(); ?>
                            @foreach ($article as $item)
                                <article class="article-items" style="width: 100%">
                                    <h3 class="article-title">
                                        <a href="{{ route('news', $item->id) }}">{{ $item->title }}</a>
                                    </h3>
                                    <div class="article-thumb">
                                        <a href="{{ route('news', $item->id) }}"><img width="114" height="76"
                                                src="{{ asset('storage/post/' . $item->thumbnail) }}"
                                                alt=""></a>
                                    </div>
                                </article>
                            @endforeach
                            {{-- <article class="article-items" style="width: 100%">
                                <h3 class="article-title">
                                    <a href="#">Cơn
                                        sóng thần mang tên "ung thư" đang tấn công người trẻ trên toàn cầu</a>
                                </h3>
                                <div class="article-thumb">
                                    <a href="#"><img width="114" height="76"
                                            src="https://icdn.dantri.com.vn/zoom/234_156/2022/11/01/thumb-1-1667289623482.png"
                                            alt=""></a>
                                </div>
                            </article>
                            <article class="article-items" style="width: 100%">
                                <h3 class="article-title">
                                    <a href="#">Cơn
                                        sóng thần mang tên "ung thư" đang tấn công người trẻ trên toàn cầu</a>
                                </h3>
                                <div class="article-thumb">
                                    <a href="#"><img width="114" height="76"
                                            src="https://icdn.dantri.com.vn/zoom/234_156/2022/11/01/thumb-1-1667289623482.png"
                                            alt=""></a>
                                </div>
                            </article> --}}

                        </article>
                    </div>
                @endforeach
                {{-- <div class="article-col">
                    <h2 class="title">Pháp luật</h2>
                    <ol class="navigation">
                        <li><a href="#">Hồ sơ vụ án</a></li>
                        <li><a href="#">Pháp đình</a></li>
                    </ol>

                    <article class="article-wrap">
                        <article class="article-item" style="width: 100%">
                            <div class="article-thumb">
                                <a href="#"><img width="264" height="176"
                                        src="https://icdn.dantri.com.vn/zoom/234_156/2022/11/01/thumb-1-1667289623482.png"
                                        alt=""></a>
                            </div>
                            <h3 class="article-title">
                                <a href="#">Cơn
                                    sóng thần mang tên "ung thư" đang tấn công người trẻ trên toàn cầu</a>
                            </h3>
                        </article>
                        <article class="article-items" style="width: 100%">
                            <h3 class="article-title">
                                <a href="#">Cơn
                                    sóng thần mang tên "ung thư" đang tấn công người trẻ trên toàn cầu</a>
                            </h3>
                            <div class="article-thumb">
                                <a href="#"><img width="114" height="76"
                                        src="https://icdn.dantri.com.vn/zoom/234_156/2022/11/01/thumb-1-1667289623482.png"
                                        alt=""></a>
                            </div>
                        </article>
                        <article class="article-items" style="width: 100%">
                            <h3 class="article-title">
                                <a href="#">Cơn
                                    sóng thần mang tên "ung thư" đang tấn công người trẻ trên toàn cầu</a>
                            </h3>
                            <div class="article-thumb">
                                <a href="#"><img width="114" height="76"
                                        src="https://icdn.dantri.com.vn/zoom/234_156/2022/11/01/thumb-1-1667289623482.png"
                                        alt=""></a>
                            </div>
                        </article>
                        <article class="article-items" style="width: 100%">
                            <h3 class="article-title">
                                <a href="#">Cơn
                                    sóng thần mang tên "ung thư" đang tấn công người trẻ trên toàn cầu</a>
                            </h3>
                            <div class="article-thumb">
                                <a href="#"><img width="114" height="76"
                                        src="https://icdn.dantri.com.vn/zoom/234_156/2022/11/01/thumb-1-1667289623482.png"
                                        alt=""></a>
                            </div>
                        </article>

                    </article>
                </div>
                <div class="article-col">
                    <h2 class="title">Pháp luật</h2>
                    <ol class="navigation">
                        <li><a href="#">Hồ sơ vụ án</a></li>
                        <li><a href="#">Pháp đình</a></li>
                    </ol>

                    <article class="article-wrap">
                        <article class="article-item" style="width: 100%">
                            <div class="article-thumb">
                                <a href="#"><img width="264" height="176"
                                        src="https://icdn.dantri.com.vn/zoom/234_156/2022/11/01/thumb-1-1667289623482.png"
                                        alt=""></a>
                            </div>
                            <h3 class="article-title">
                                <a href="#">Cơn
                                    sóng thần mang tên "ung thư" đang tấn công người trẻ trên toàn cầu</a>
                            </h3>
                        </article>
                        <article class="article-items" style="width: 100%">
                            <h3 class="article-title">
                                <a href="#">Cơn
                                    sóng thần mang tên "ung thư" đang tấn công người trẻ trên toàn cầu</a>
                            </h3>
                            <div class="article-thumb">
                                <a href="#"><img width="114" height="76"
                                        src="https://icdn.dantri.com.vn/zoom/234_156/2022/11/01/thumb-1-1667289623482.png"
                                        alt=""></a>
                            </div>
                        </article>
                        <article class="article-items" style="width: 100%">
                            <h3 class="article-title">
                                <a href="#">Cơn
                                    sóng thần mang tên "ung thư" đang tấn công người trẻ trên toàn cầu</a>
                            </h3>
                            <div class="article-thumb">
                                <a href="#"><img width="114" height="76"
                                        src="https://icdn.dantri.com.vn/zoom/234_156/2022/11/01/thumb-1-1667289623482.png"
                                        alt=""></a>
                            </div>
                        </article>
                        <article class="article-items" style="width: 100%">
                            <h3 class="article-title">
                                <a href="#">Cơn
                                    sóng thần mang tên "ung thư" đang tấn công người trẻ trên toàn cầu</a>
                            </h3>
                            <div class="article-thumb">
                                <a href="#"><img width="114" height="76"
                                        src="https://icdn.dantri.com.vn/zoom/234_156/2022/11/01/thumb-1-1667289623482.png"
                                        alt=""></a>
                            </div>
                        </article>

                    </article>
                </div>
                <div class="article-col">
                    <h2 class="title">Pháp luật</h2>
                    <ol class="navigation">
                        <li><a href="#">Hồ sơ vụ án</a></li>
                        <li><a href="#">Pháp đình</a></li>
                    </ol>

                    <article class="article-wrap">
                        <article class="article-item" style="width: 100%">
                            <div class="article-thumb">
                                <a href="#"><img width="264" height="176"
                                        src="https://icdn.dantri.com.vn/zoom/234_156/2022/11/01/thumb-1-1667289623482.png"
                                        alt=""></a>
                            </div>
                            <h3 class="article-title">
                                <a href="#">Cơn
                                    sóng thần mang tên "ung thư" đang tấn công người trẻ trên toàn cầu</a>
                            </h3>
                        </article>
                        <article class="article-items" style="width: 100%">
                            <h3 class="article-title">
                                <a href="#">Cơn
                                    sóng thần mang tên "ung thư" đang tấn công người trẻ trên toàn cầu</a>
                            </h3>
                            <div class="article-thumb">
                                <a href="#"><img width="114" height="76"
                                        src="https://icdn.dantri.com.vn/zoom/234_156/2022/11/01/thumb-1-1667289623482.png"
                                        alt=""></a>
                            </div>
                        </article>
                        <article class="article-items" style="width: 100%">
                            <h3 class="article-title">
                                <a href="#">Cơn
                                    sóng thần mang tên "ung thư" đang tấn công người trẻ trên toàn cầu</a>
                            </h3>
                            <div class="article-thumb">
                                <a href="#"><img width="114" height="76"
                                        src="https://icdn.dantri.com.vn/zoom/234_156/2022/11/01/thumb-1-1667289623482.png"
                                        alt=""></a>
                            </div>
                        </article>
                        <article class="article-items" style="width: 100%">
                            <h3 class="article-title">
                                <a href="#">Cơn
                                    sóng thần mang tên "ung thư" đang tấn công người trẻ trên toàn cầu</a>
                            </h3>
                            <div class="article-thumb">
                                <a href="#"><img width="114" height="76"
                                        src="https://icdn.dantri.com.vn/zoom/234_156/2022/11/01/thumb-1-1667289623482.png"
                                        alt=""></a>
                            </div>
                        </article>

                    </article>
                </div> --}}
            </div>
            <div class="video-container">
                <div class="video-header">
                    <h2 class="title"><i class="fa-solid fa-circle-play" style="color: green;"></i> media</h2>
                    <a href="#">Theo dõi dân trí tại <i class="fa-brands fa-youtube" style="color: red;"></i>
                        youtube</a>
                </div>
                <div class="video-row">
                    <div class="video-col main">
                        @if ($videoHot)
                            <div class="video-item">
                                <a href=""><iframe width="100%" height="450px"
                                        src="https://www.youtube.com/embed/{{ $videoHot->link }}"></iframe>
                                </a>
                                <h3 class="video-title">
                                    <a href="#">{{ $videoHot->title }}</a>
                                </h3>
                            </div>
                        @endif
                    </div>
                    <ul class="video-col list">
                        @foreach ($listVideo as $item)
                            <li class="video-item">
                                <div class="video-thumb"><a href="#">
                                        <iframe width="100%" height="70px"
                                            src="https://www.youtube.com/embed/{{ $item->link }}"></iframe></a>
                                </div>
                                <div class="video-content">
                                    <h3 class="video-title"><a href="">{{ $item->title }}</a></h3>
                                </div>
                            </li>
                        @endforeach
                        {{-- <li class="video-item">
                            <div class="video-thumb"><a href="#">
                                    <iframe width="100%" height="70px"
                                        src="https://www.youtube.com/embed/qEpLyIqDoio"></iframe></a></div>
                            <div class="video-content">
                                <h3 class="video-title"><a href="">Nga đưa UAV "sát thủ vô hình" thách thức
                                        Ukraine trên chiến trường</a></h3>
                            </div>
                        </li> --}}

                    </ul>
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
