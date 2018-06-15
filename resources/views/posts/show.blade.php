@extends ('layouts.master')

@section('content')
    <div class="col-md-8 blog-main">
        <h1>
            {{ $post->title }}
        </h1>

        {{ $post->body }}
        <div class="row mt-4">
            <div class="col-md-8">
                <h5>Author: <a href="/users/{{$post->user->id}}">{{ $post->user->name }}</a> <small>on {{ $post->created_at->toDayDateTimeString() }}</small></h5>
            </div>

            @if (auth()->check() && (auth()->user() == $post->user))

                <div class="col-md-2">
                    <div class="row">
                        <div class="col-md-6">
                            <a href="/edit/{{ $post->id }}" class="btn btn-outline-dark">Edit</a>
                        </div>

                        <div class="col-md-6">
                            <form action="/posts/{{ $post->id }}" method="POST">
                                {{ csrf_field() }}
                                <input type="hidden" name="_method" value="DELETE" />
                                <button class="btn btn-outline-danger" type="button" data-toggle="modal" data-target="#deleteConfirmation">Delete</button>

                                <div class="modal fade" id="deleteConfirmation" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmation" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Delete a post</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you want to delete the post: <strong>{{ $post->title }}</strong>?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>


                </div>
            @endif
        </div>

        <hr>

        @include('posts.comments')

    </div>
@endsection