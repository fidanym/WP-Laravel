<header class="blog-header py-3">
    <div class="row flex-nowrap justify-content-between align-items-center">
        <div class="col-4 pt-1">

        </div>
        <div class="col-4 text-center">
            <a class="blog-header-logo text-dark" href="/">The Blog</a>
        </div>
        <div class="col-4 d-flex justify-content-end align-items-center">
            @if (auth()->check())
                <div class="btn-group" role="group">
                <button id="btnGroupDrop1" type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{ auth()->user()->name }}
                </button>
                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                    <a class="dropdown-item" href="/posts/create">Create a new post</a>
                    <a class="dropdown-item" href="/users/{{auth()->user()->id}}">My Posts</a>
                    <a class="dropdown-item" data-toggle="modal" data-target="#logoutConfirmation">Sign out</a>
                </div>

                <div class="modal fade bd-example-modal-sm" id="logoutConfirmation" tabindex="-1" role="dialog" aria-labelledby="logoutConfirmation" aria-hidden="true">
                    <div class="modal-dialog modal-sm" role="document">
                        <div class="modal-content">
                            <div class="modal-body">
                                Are you sure you want to sign out?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Cancel</button>
                                <a href="/logout" class="btn btn-dark">Sign out</a>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
            @else
                <a class="btn btn-sm btn-outline-secondary" href="/login">Sign In</a> &nbsp;
                <a class="btn btn-sm btn-outline-secondary" href="/register">Register</a>
            @endif
        </div>
    </div>
</header>