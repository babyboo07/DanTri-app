@foreach ($postSpecials as $postSpecial)
    <article class="article-items">
        <h3 class="article-text">
            <a href="{{ route('news', $postSpecial->id) }}">
                {{ $postSpecial->title }}</a>
        </h3>
        <div class="article-thumb">
            <a href="{{ route('news', $postSpecial->id) }}"><img height="120" width="80"
                    src="{{ asset('storage/post/' . $postSpecial->thumbnail) }}" alt="" /></a>
        </div>
    </article>
@endforeach
