@foreach ($hotcate as $cate)
    <div class="gird-category">
        <div class="category-header">
            <ol class="subcate">
                <li><a class="subcat-title" href="">{{ $cate->cateName }} </a></li>
                @foreach ($cate->children()->get() as $item)
                    <li><a href="#">{{ $item->cateName }}</a></li>
                @endforeach
            </ol>
        </div>
        <div class="grid-highlight">
            <article class="article-highlight">
                <article class="article-item">
                    <?php
                    $post = $cate->getHotPost();
                    ?>
                    @if ($post)
                        <div class="article-thumb">
                            <a href="#"><img height="516" width="344"
                                    src="{{ asset('storage/post/' . $post->thumbnail) }}" alt="" />
                            </a>
                        </div>
                        <div class="article-content">
                            <h3 class="article-title">
                                <a href="{{ route('news', $item->id) }}">{{ $post->title }}</a>
                            </h3>
                            <div class="article-excerpt">
                                <a href="{{ route('news', $item->id) }}">{!! $post->shortContent !!}</a>
                            </div>
                        </div>
                    @endif
                </article>
                <?php $postleft = $cate->getPostLeft(); ?>
                @foreach ($postleft->slice(0, 2) as $item)
                    <article class="article-item">
                        <div class="article-thumb">
                            <a href="{{ route('news', $item->id) }}">
                                <img height="234" width="156" src="{{ asset('storage/post/' . $item->thumbnail) }}"
                                    alt="" /></a>
                        </div>
                        <div class="article-content">
                            <h3 class="article-title">
                                <a href="{{ route('news', $item->id) }}">{{ $item->title }}</a>
                            </h3>
                        </div>
                    </article>
                @endforeach
            </article>

            <article class="article-special">
                @foreach ($postleft->slice(2, 5) as $item)
                    <article class="article-items">
                        <h3 class="article-text">
                            <a href="{{ route('news', $item->id) }}">
                                {{ $item->title }}</a>
                        </h3>
                        <div class="article-thumb">
                            <a href="{{ route('news', $item->id) }}"><img height="120" width="80"
                                    src="{{ asset('storage/post/' . $item->thumbnail) }}" alt="" /></a>
                        </div>
                    </article>
                @endforeach

                {{-- <article class="article-items">
                    <h3 class="article-text">
                        <a href="#">
                            Hà Nội dừng hoạt động giao dịch với hơn 760 pháp nhân liên
                            quan vụ án Vạn Thịnh Phát</a>
                    </h3>
                    <div class="article-thumb">
                        <a href="#"><img height="120" width="80"
                                src="https://icdn.dantri.com.vn/zoom/516_344/2022/11/03/z3850470191963a028f8dcc653b066d5cea52140c89731-1667438250466.jpg"
                                alt="" /></a>
                    </div>
                </article>
                <article class="article-items">
                    <h3 class="article-text">
                        <a href="#">
                            Hà Nội dừng hoạt động giao dịch với hơn 760 pháp nhân liên
                            quan vụ án Vạn Thịnh Phát</a>
                    </h3>
                    <div class="article-thumb">
                        <a href="#"><img height="120" width="80"
                                src="https://icdn.dantri.com.vn/zoom/516_344/2022/11/03/z3850470191963a028f8dcc653b066d5cea52140c89731-1667438250466.jpg"
                                alt="" /></a>
                    </div>
                </article> --}}
            </article>
        </div>
    </div>
@endforeach
