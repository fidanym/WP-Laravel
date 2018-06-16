<div class="blog-post">
    <h2 class="blog-post-title">
        <a href="/posts/{{ $post->id }}">
            {{ $post->title }}
        </a>
    </h2>
    <p class="blog-post-meta">{{ $post->created_at->toDayDateTimeString() }} by <a href="/users/{{$post->user->id}}">{{ $post->user->name }}</a></p>

    {!! $post->body !!}

    <div class="mt-2">
        <i class="far fa-comments"> </i><span class="badge badge-light">{{count($post->comments)}}</span>
    </div>
</div><!-- /.blog-post -->