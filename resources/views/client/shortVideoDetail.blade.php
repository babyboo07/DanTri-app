<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('/css/shortvideo.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
</head>

<body>
    <div class="app__videos">
        <!-- video starts -->
        <!-- video starts -->
        <div class="video" data-id-video="{{ $video->id }}">
            <iframe class="video__player" src=" https://www.youtube.com/embed/{{ $video->link }}"></iframe>
            <!-- sidebar -->
            <div class="videoSidebar">
                @if ($video->like_id)
                    @if (array_search(Auth::user()->id, $video->like_id) !== null)
                        <div class="videoSidebar__button like liked"data-id="{{ $video->id }}">
                            <i class="fa-solid fa-heart"></i>
                            <p>{{ count($video->like_id) }}</p>
                        </div>
                    @else
                        <div class="videoSidebar__button like"data-id="{{ $video->id }}">
                            <i class="fa-regular fa-heart"></i>
                            <p>{{ count($video->like_id) }}</p>
                        </div>
                    @endif
                @else
                    <div class="videoSidebar__button like"data-id="{{ $video->id }}">
                        <i class="fa-regular fa-heart"></i>
                        <p>0</p>
                    </div>
                @endif

                <div class="videoSidebar__button comment">
                    <i class="fa-regular fa-message"></i>
                    @if ($comment)
                        <p>{{ count($comment) }}</p>
                    @else
                        <p>0</p>
                    @endif
                </div>
                <div class="video-comment"></div>

                <div class="videoSidebar__button copy" data-id="{{ $video->id }}">
                    <i class="fa-solid fa-share-nodes"></i>
                    @if ($video->copy)
                        <p>{{ $video->copy }}</p>
                    @else
                        <p>0</p>
                    @endif
                </div>
            </div>

            <!-- footer -->
            <div class="videoFooter">
                <div class="videoFooter__text">
                    <h3>{{ $video->cateName }}</h3>
                    <p class="videoFooter__description">{{ $video->title }}</p>
                </div>
            </div>
        </div>
        <!-- video ends -->

        @foreach ($listVideo as $item)
            <!-- video starts -->
            <div class="video" data-id-video="{{ $item->id }}">
                <iframe class="video__player" src=" https://www.youtube.com/embed/{{ $item->link }}"></iframe>
                <!-- sidebar -->
                <div class="videoSidebar">
                    @if ($item->like_id)
                        @if (array_search(Auth::user()->id, $item->like_id) !== null)
                            <div class="videoSidebar__button like liked"data-id="{{ $item->id }}">
                                <i class="fa-solid fa-heart"></i>
                                <p>{{ count($item->like_id) }}</p>
                            </div>
                        @else
                            <div class="videoSidebar__button like"data-id="{{ $item->id }}">
                                <i class="fa-regular fa-heart"></i>
                                <p>{{ count($item->like_id) }}</p>
                            </div>
                        @endif
                    @else
                        <div class="videoSidebar__button like"data-id="{{ $item->id }}">
                            <i class="fa-regular fa-heart"></i>
                            <p>0</p>
                        </div>
                    @endif

                    <div class="videoSidebar__button comment">
                        <i class="fa-regular fa-message"></i>
                        @if ($item->commentID != null)
                            <p>12</p>
                        @else
                            <p>0</p>
                        @endif
                    </div>

                    <div class="videoSidebar__button copy" data-id="{{ $item->id }}">
                        <i class="fa-solid fa-share-nodes"></i>
                        @if ($item->copy)
                            <p>{{ $item->copy }}</p>
                        @else
                            <p>0</p>
                        @endif
                    </div>
                </div>

                <!-- footer -->
                <div class="videoFooter">
                    <div class="videoFooter__text">
                        <h3>{{ $item->cateName }}</h3>
                        <p class="videoFooter__description">{{ $item->title }}</p>
                    </div>
                </div>
            </div>
            <!-- video ends -->
        @endforeach
    </div>



    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI="
        crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            const videos = document.querySelectorAll('video');

            for (const video of videos) {
                video.addEventListener('click', function() {
                    console.log('clicked');
                    if (video.paused) {
                        video.play();
                    } else {
                        video.pause();
                    }
                    alert('123');

                });
            }

            $(".video").hover(
                function() {
                    let id = $(this).data('id-video');
                    window.history.pushState("object or string", "Title", `/shortvideo/detail/${id}`);
                }
            );

            $("body").click(
                function() {
                    window.history.pushState("object or string", "Title", `http://127.0.0.1:8000/`);
                    setTimeout(() => {
                        window.location.reload(true);
                    }, 100);
                }
            );

            $('.like').click(function() {
                var id = $(this).data('id')
                var url = "<?php echo route('likeVideo', ':id'); ?>"
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
            });


            $('.copy').click(function() {
                let urlVideo = document.location.href
                var videoID = $(this).data('id');
                navigator.clipboard.writeText(urlVideo).then(function() {

                        var urlCopy = "<?php echo route('increaseCopy', ':id'); ?>";
                        urlCopy = urlCopy.replace(':id', videoID);
                        console.log(urlCopy);
                        $.ajax({
                            method: "POST",
                            url: urlCopy,
                            data: {
                                "_token": "{{ csrf_token() }}",
                            }
                        })
                        console.log('Copied!');
                    }),

                    function() {
                        console.log('Copy error')
                    }
            });
        });
    </script>
</body>

</html>
