<div class="comments mb-3">
    <ul class="list-group">
        @foreach ($post->comments as $comment)
            <li class="list-group-item">
                @if (auth()->check() && (auth()->user() == $comment->user))
                    <a data-toggle="modal" data-target="#deleteConfirmation"><i style="color: darkred" class="far fa-trash-alt"></i></a>
                @endif
                <span class="badge badge-light">
                    {{ $comment->created_at->diffForHumans() }}
                </span>
                <strong>{{ $comment->user->name }}:</strong>
                {{ $comment->body }}
            </li>

            <form action="/comments/{{ $comment->id }}" method="POST">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="DELETE" />
                <div class="modal fade" id="deleteConfirmation" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmation" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to delete this comment?</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                {{$comment->body}}
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

        @endforeach
    </ul>

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
    @else
        <div>Please <a href="/login">sign in</a> or <a href="/register">register</a> to add comments!</div>
    @endif

</div>

