<div class="comments">
    <ul class="list-group">
        @foreach ($post->comments as $comment)
            <li class="list-group-item">
                        <span class="badge badge-light">
                            {{ $comment->created_at->diffForHumans() }}
                        </span>
                <strong>{{ $comment->user->name }}:</strong>
                {{ $comment->body }}
            </li>
        @endforeach
    </ul>
</div>

@if (auth()->check())
    <div class="card">
        <div class="card-body">
            <form method="POST" action="/posts/{{ $post->id }}/comments">
                {{ csrf_field() }}
                <div class="form-group">
                    <textarea name="body" placeholder="Your comment here." class="form-control"></textarea>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Add Comment</button>
                </div>
            </form>

            @include ('layouts.errors')
        </div>
    </div>
@endif