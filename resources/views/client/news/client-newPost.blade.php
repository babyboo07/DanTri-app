@foreach ($newPosts as $newPost)
    <article class="article-item">
        <div class="article-thumb">
            <a href="{{ route('news', $newPost->id) }}"><img height="234" width="156"
                    src="{{ asset('storage/post/' . $newPost->thumbnail) }}" alt="" /></a>
        </div>
        <div class="article-content">
            <h3 class="article-title">
                <a href="{{ route('news', $newPost->id) }}">
                    {{ $newPost->title }}</a>
            </h3>
        </div>
    </article>
@endforeach
