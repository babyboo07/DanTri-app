@foreach ($shortVid as $item)
    <div class="video-item">
        <div class="video-img">
            <a href="{{ route('shortvideo.details', $item->id) }}">
                <img width="202" height="359" src="{{ $item->thumbnail }}" alt="">
            </a>
        </div>
        <div class="video-content">
            <a href="{{ route('shortvideo.details', $item->id) }}">
                <p>{{ $item->title }}</p>
            </a>
        </div>
        <div class="video-view">
            <span>3241 lượt xem</span> &#8226; <span class="">{{ $item->cateName }}</span>
        </div>
    </div>
@endforeach
