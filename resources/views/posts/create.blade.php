@extends ('layouts.master')

@section('content')
    <div class="col-md-8">
        <h1>Create a Post</h1>
        <hr>

        <form method="POST" action="/posts">
            {{ csrf_field() }}

            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" class="form-control" id="title" name="title">
            </div>

            <div class="form-group">
                <label for="body">Body:</label>
                <textarea name="body" id="body" class="summernote form-control" rows="12"></textarea>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Publish</button>
            </div>

            @include('layouts.errors')
        </form>

        <script>
            $(document).ready(function() {
                $('.summernote').summernote({
                    tabsize: 2,
                    height: 300
                });
            });
        </script>

    </div>
@endsection