@foreach ($mediaVid as $item)
    <div class="video-item">
        <div class="video-thumb">
            <a href="{{ route('video.details',$item->id) }}"><iframe width="350" height="197"
                    src="https://www.youtube.com/embed/{{ $item->link }}" ></iframe>
            </a>
        </div>
        <h3 class="video-title">
            <a href="{{ route('video.details',$item->id) }}">{{ $item->title }}</a>
        </h3>
    </div>
@endforeach
