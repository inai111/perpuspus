<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">Library</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav w-100 mb-2 mb-lg-0">
                <li class="nav-item">
                    <a @class(['nav-link', 'active' => request()->segment(1) == null]) aria-current="page" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a @class(['nav-link', 'active' => request()->segment(1) == 'book']) aria-current="page" href="{{ route('book.index') }}">Books</a>
                </li>
                @if (auth()->user()->role_id == 1)
                    <li class="nav-item">
                        <a @class(['nav-link', 'active' => request()->segment(1) == 'user']) aria-current="page" href="{{ route('user.index') }}">Members</a>
                    </li>
                    <li class="nav-item">
                        <a @class(['nav-link', 'active' => request()->segment(1) == 'category']) aria-current="page"
                            href="{{ route('category.index') }}">Category</a>
                    </li>
                @endif
                @if (auth()->user())
                <li class="nav-item">
                    <a class="nav-link" href="{{route('borrow.index')}}">Borrow Book</a>
                </li>
                @endif

                <li class="nav-item dropdown ms-lg-auto">
                    <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-user"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        @if (auth()->user())
                            <li><a class="dropdown-item" href="{{ route('library.setting') }}">Edit Library Profile</a></li>
                            <li><a class="dropdown-item" href="{{ route('user.setting') }}">Setting</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>
                        @else
                            <li><a class="dropdown-item" href="{{ route('login') }}">Login</a></li>
                        @endif
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
