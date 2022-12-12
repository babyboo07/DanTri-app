<div class="gird-container">
    <div class="standalone-wrap">
        <ul class="breadcrumbs">
            @if ($parentCate != null)
                <li><a href="">{{ $parentCate->cateName }}</a></li>
            @endif
            <li><a href="">{{ $post->cateName }}</a></li>
        </ul>
        <article class="standalone-news">
            <h1 class="title-news">
                {{ $post->title }}
            </h1>
            <div class="author-news">
                <div class="author-avatar">
                    <img src="https://cdnweb.dantri.com.vn/dist/b474c6ca2d1abee5b89b.png" alt="">
                </div>
                <div class="author-name">
                    <a href="">{{ $post->author_name }}</a>
                </div>
                <div class="author-time">
                    &#x2022; {{ \Carbon\Carbon::parse($post->created_date)->format('l, d/m/Y - H:i') }}
                </div>
            </div>
            <h2 class="short-content">
                {!! $post->shortContent !!}
            </h2>
            <div class="news-content">
                {!! $post->content !!}
            </div>
        </article>

        <article class="article-relate">
            <div class="title-head">tin liên quan</div>
            @foreach ($postRelate as $item)
                <article class="article-items">
                    <div class="article-thumb">
                        <a href="#">
                            <img height="516" width="344" src="{{ asset('storage/post/' . $item->thumbnail) }}"
                                alt="" />
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
                        <img height="516" width="344"
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
                <form action="{{ route('client.comment') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <textarea class="input-comment" placeholder="Bạn gì về tin này ?" name="content" id="content"></textarea>
                    <input type="hidden" name="post_id" id="post_id" value="{{ $post->id }}">
                    <div class="sent note">
                        <p>Ý kiến của bạn sẽ được xét duyệt trước khi đăng. Xin vui lòng gõ tiếng Việt có dấu</p>
                        <div class="commnet-sent">
                            <button class="btn btn-sent" id="submit-form" type="submit">Gửi bình luận<i
                                    class="fa-solid fa-angle-right"></i></button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="commnet-container">
                <ul class="comment-list">
                    @foreach ($commentOfPost as $item)
                        <li>
                            <div class="comment-item">
                                <div class="comment-avatar">
                                    <img height="40" width="40"
                                        src="https://cdnweb.dantri.com.vn/dist/b474c6ca2d1abee5b89b.png" alt="">
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
                                                        <span>{{ count($item->like_id) }}</span> thích</button></li>
                                                <li>
                                                @else
                                                <li><button type="button"data-id="{{ $item->id }}"
                                                        class="like"><i class="fa-regular fa-heart"></i>
                                                        <span>{{ count($item->like_id) }}</span>
                                                        thích</button></li>
                                            @endif
                                        @else
                                            <li><button type="button"data-id="{{ $item->id }}" class="like"><i
                                                        class="fa-regular fa-heart"></i>
                                                    <span>0</span> thích</button></li>
                                        @endif
                                        <li>
                                            <button type="button" class="reply" data-id="{{ $item->id }}">Trả
                                                lời</button>
                                        </li>
                                    </ul>
                                    <form class="comment-box2-{{ $item->id }}" style="display: none"
                                        action="{{ route('client.comment') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <textarea class="input-comment" placeholder="Bạn gì về tin này ?" name="content" id="content"></textarea>
                                        <input type="hidden" name="post_id" id="post_id"
                                            value="{{ $post->id }}">
                                        <input type="hidden" name="reply_id" value="{{ $item->id }}">
                                        <div class="sent note">
                                            <p>Ý kiến của bạn sẽ được xét duyệt trước khi đăng. Xin vui lòng gõ
                                                tiếng Việt có dấu</p>
                                            <div class="commnet-sent">
                                                <button class="btn btn-sent" id="submit-form" type="submit">Gửi bình
                                                    luận<i class="fa-solid fa-angle-right"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            @if ($item->children()->get())
                                <ul class="comment-list child">
                                    <?php $reply = $item->childrenComment(); ?>
                                    @foreach ($reply as $child)
                                        <li>
                                            <div class="comment-item">
                                                <div class="comment-avatar">
                                                    <img height="40" width="40"
                                                        src="https://cdnweb.dantri.com.vn/dist/b474c6ca2d1abee5b89b.png"
                                                        alt="">
                                                </div>
                                                <div class="comment-content">
                                                    <div class="comment-top">
                                                        <div class="comment-author">{{ $child->replyName }}</div>
                                                        <div class="comment-time">
                                                            {{ \Carbon\Carbon::parse($child->comment_date)->format('H:i, l/d/m/Y') }}
                                                        </div>
                                                    </div>
                                                    <div class="comment-text">
                                                        <span>{{ $child->content }}</span>
                                                    </div>
                                                    <ul class="comment-bottom">
                                                        @if ($child->like_id)
                                                            @if (array_search(Auth::user()->id, $child->like_id) !== null)
                                                                <li><button type="button"
                                                                        data-id="{{ $child->id }}"
                                                                        class="like liked"><i
                                                                            class="fa-regular fa-heart"></i>
                                                                        <span>{{ count($child->like_id) }}</span>
                                                                        thích</button></li>
                                                                <li>
                                                                @else
                                                                <li><button
                                                                        type="button"data-id="{{ $child->id }}"
                                                                        class="like"><i
                                                                            class="fa-regular fa-heart"></i>
                                                                        <span>{{ count($child->like_id) }}</span>
                                                                        thích</button></li>
                                                            @endif
                                                        @else
                                                            <li><button type="button"data-id="{{ $child->id }}"
                                                                    class="like"><i class="fa-regular fa-heart"></i>
                                                                    <span>0</span> thích</button></li>
                                                        @endif
                                                    </ul>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endforeach
                    {{-- <li>
                        <div class="comment-item">
                            <div class="comment-avatar">
                                <img height="40" width="40"
                                    src="https://cdnweb.dantri.com.vn/dist/b474c6ca2d1abee5b89b.png" alt="">
                            </div>
                            <div class="comment-content">
                                <div class="comment-top">
                                    <div class="comment-author">maicute</div>
                                    <div class="comment-time">09:37 ngày 25/11/2022</div>
                                </div>
                                <div class="comment-text">
                                    <span>Nếu hòa giải không được , cơ quan nào cấp phép cho doanh nghiệp , cơ quan
                                        đó phải chịu trách nhiệm . Không đánh đỏi môi trường để lấy kinh tế , không
                                        đẻ dân thiệt hại .</span>
                                </div>
                            </div>
                        </div>
                    </li> --}}
                </ul>
            </div>
        </div>
        <hr style="margin-bottom: 24px">
        <article class="article-list">
            <div class="article-head"><span>đang được quan tâm</span></div>
            <article class="article-items">
                <div class="article-thumb">
                    <a href="#">
                        <img height="516" width="344"
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
            </article>
            <article class="article-items">
                <div class="article-thumb">
                    <a href="#">
                        <img height="516" width="344"
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
            </article>
        </article>
    </div>
    <div class="siderbar">
        <hr style="margin: 0">
        <article class="article-lot">
            <div class="article-head">Đọc nhiều trong {{ $post->cateName }}</div>
            @foreach ($mostPopular->slice(0, 1) as $item)
                <article class="article-item" style="width: 100%">
                    <div class="article-thumb">
                        <a href="{{ route('news', $item->id) }}"><img height="300" width="200"
                                src="{{ asset('storage/post/' . $item->thumbnail) }}" alt="" /></a>
                    </div>
                    <div class="count-post">
                        <div class="num-lot">1.</div>
                        <h3 class="article-title">
                            <a href="{{ route('news', $item->id) }}">{{ $item->title }}</a>
                        </h3>
                    </div>
                </article>
            @endforeach
            @foreach ($mostPopular->slice(1, 5) as $item)
                <article class="article-item" style="width: 100%">
                    <div class="count-post">
                        <div class="num-lot">2.</div>
                        <h3 class="article-title" style="margin-top: 7px">
                            <a href="{{ route('news', $item->id) }}" style="font-size: 14px">{{ $item->title }}</a>
                        </h3>
                    </div>
                    <div class="article-thumb">
                        <a href="{{ route('news', $item->id) }}"><img height="60" width="90"
                                style="width: 90px;height:60px" src="{{ asset('storage/post/' . $item->thumbnail) }}"
                                alt="" /></a>
                    </div>
                </article>
            @endforeach
            {{-- <article class="article-item" style="width: 100%">
                <div class="count-post">
                    <div class="num-lot">3.</div>
                    <h3 class="article-title" style="margin-top: 7px">
                        <a href="#" style="font-size: 14px">
                            Hà Nội dừng hoạt động giao dịch với hơn 760 pháp nhân liên
                            quan vụ án Vạn Thịnh Phát</a>
                    </h3>
                </div>
                <div class="article-thumb">
                    <a href="#"><img height="60" width="90" style="width: 90px;height:60px"
                            src="https://icdn.dantri.com.vn/zoom/516_344/2022/11/03/z3850470191963a028f8dcc653b066d5cea52140c89731-1667438250466.jpg"
                            alt="" /></a>
                </div>
            </article>
            <article class="article-item" style="width: 100%">
                <div class="count-post">
                    <div class="num-lot">4.</div>
                    <h3 class="article-title" style="margin-top: 7px">
                        <a href="#" style="font-size: 14px">
                            Hà Nội dừng hoạt động giao dịch với hơn 760 pháp nhân liên
                            quan vụ án Vạn Thịnh Phát</a>
                    </h3>
                </div>
                <div class="article-thumb">
                    <a href="#"><img height="60" width="90" style="width: 90px;height:60px"
                            src="https://icdn.dantri.com.vn/zoom/516_344/2022/11/03/z3850470191963a028f8dcc653b066d5cea52140c89731-1667438250466.jpg"
                            alt="" /></a>
                </div>
            </article>
            <article class="article-item" style="width: 100%">
                <div class="count-post">
                    <div class="num-lot">5.</div>
                    <h3 class="article-title" style="margin-top: 7px">
                        <a href="#" style="font-size: 14px">
                            Hà Nội dừng hoạt động giao dịch với hơn 760 pháp nhân liên
                            quan vụ án Vạn Thịnh Phát</a>
                    </h3>
                </div>
                <div class="article-thumb">
                    <a href="#"><img height="60" width="90" style="width: 90px;height:60px"
                            src="https://icdn.dantri.com.vn/zoom/516_344/2022/11/03/z3850470191963a028f8dcc653b066d5cea52140c89731-1667438250466.jpg"
                            alt="" /></a>
                </div>
            </article> --}}
        </article>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI="
    crossorigin="anonymous"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.reply').click(function() {
            const reply_id = $(this).data('id');
            $('.comment-box2-' + reply_id).toggle();
        });

        $('form').submit(function() {
            alert('GỬI BÌNH LUẬN THÀNH CÔNG');
        })

        $('.like').click(function() {
            var id = $(this).data('id')
            var url = "<?php echo route('likeComment', ':id'); ?>"
            url = url.replace(':id', id);
            console.log(url);
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: url,
                data: {
                    "_token": "{{ csrf_token() }}",
                }
            })
        })
    });
</script>
