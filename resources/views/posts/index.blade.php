@extends ('layouts.master')

@section('content')

    <div class="col-md-8 blog-main">
        <h3 class="pb-3 mb-4 font-italic border-bottom">
            Latest Posts
        </h3>

        @foreach ($posts as $post)
            @include ('posts.post')
        @endforeach

        <nav class="blog-pagination">
            {{ $posts->links() }}
        </nav>

    </div><!-- /.blog-main -->
@endsection