<div class="grid-row">
    @foreach ($catebottom as $parent)
        <div class="article-col">
            <div style="height: 56px">
                <h2 class="title">
                    {{ $parent->cateName }}</h2>
                <ol class="navigation">
                    @foreach ($parent->children()->take(2)->get() as $item)
                        <li><a href="#">{{ $item->cateName }}</a></li>
                    @endforeach

                </ol>
            </div>

            <article class="article-wrap">
                <?php $post = $parent->getHotPost(); ?>
                <article class="article-item" style="width: 100%">
                    @if ($post)
                        <div class="article-thumb">
                            <a href="{{ route('news', $post->id) }}"><img width="264" height="176"
                                    src="{{ asset('storage/post/' . $post->thumbnail) }}" alt=""></a>
                        </div>
                        <h3 class="article-title">
                            <a href="{{ route('news', $post->id) }}">{{ $post->title }}</a>
                        </h3>
                    @endif
                </article>
                <?php $postbottom = $parent->getPostLeft(); ?>
                @foreach ($postbottom as $item)
                    <article class="article-items" style="width: 100%">
                        <h3 class="article-title">
                            <a href="{{ route('news', $item->id) }}">{{ $item->title }}</a>
                        </h3>
                        <div class="article-thumb">
                            <a href="{{ route('news', $item->id) }}"><img width="114" height="76"
                                    src="{{ asset('storage/post/' . $item->thumbnail) }}" alt=""></a>
                        </div>
                    </article>
                @endforeach
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