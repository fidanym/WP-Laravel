@extends ('layouts.master')

@section('content')
    <div class="col-md-8">
        <h1>Update Post</h1>
        <hr>

        <form method="POST" action="/posts/{{$post->id}}/update">
            {{ csrf_field() }}
            <div class="form-group">
                <input type="hidden" value="{{csrf_token()}}" name="_token" />
                <label for="title">Title:</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $post->title }}">
            </div>

            <div class="form-group">
                <label for="body">Body:</label>
                <textarea name="body" id="body" class="form-control" rows="12">{{ $post->body }}</textarea>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>

            @include('layouts.errors')
        </form>

    </div>
@endsection