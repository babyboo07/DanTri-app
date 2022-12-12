<nav class="category container">
    <ol class="category-wrap">
        <li><a href="/"><i class="fa-solid fa-house"></i></a></li>
        @include('client.category.client-category')
        <li class="menu-more" id="menu-more">
            <a class="more" id="more" href="#">...</a>
        </li>
        <li class="menu-more" id="menu-more">
            <button style="display: none;" class="btn-acc close"><i class="fa-regular fa-circle-xmark"></i></button>
        </li>
    </ol>
    <div class="nav-full bg-wrap show" id="menu-more">
        <div class="nf-wrap container">
            <ul class="nf-menu">
                @include('client.category.client-allCategory')
                {{-- @foreach ($allCate as $item)
                    <li><a href="">{{ $item->cateName }}</a>
                        <ul class="nf-submenu">
                            @foreach ($item->children()->get() as $item)
                                <li><a href="#">{{ $item->cateName }}</a></li>
                            @endforeach
                        </ul>
                    </li>
                @endforeach --}}
            </ul>
            <div class="nf-sidebar">
                <ul class="nfs-menu">
                    <li><a class="nfs-text" href="#">SỰ KIỆN NỔI BẬT</a></li>
                    <li><a class="nfs-text" href="#">DÂN TRÍ TV</a></li>
                    <li class="line"></li>
                    <li><a class="nfs-text" href="#">DMagazine</a></li>
                    <li><a class="nfs-text" href="#">Infographic</a></li>
                    <li><a class="nfs-text" href="#">Photo Story</a></li>
                    <li class="line"></li>
                    <li><a class="nfs-text" href="#">Nhịp sống trẻ</a></li>
                    <li><a class="nfs-text" href="#">Khoa học</a></li>
                    <li><a class="nfs-text" href="#">Tâm điểm</a></li>
                    <li><a class="nfs-text" href="#">Bạn đọc</a></li>
                    <li class="line"></li>
                    <li><a href="#"><i class="fa-regular fa-envelope"></i> Gửi thư cho toà soạn</a></li>
                    <li><a href="#"><i class="fa-solid fa-headset"></i> Liên hệ quảng cáo</a></li>
                </ul>
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
</nav>
