@extends ('layouts.master')

@section('content')

    <div class="col-md-8 blog-main">
        <h3 class="pb-3 mb-4 font-italic border-bottom">
            Latest Posts by {{ $user->name }}
        </h3>

        @foreach ($posts as $post)
            @include ('posts.post')
        @endforeach

    </div><!-- /.blog-main -->
@endsection