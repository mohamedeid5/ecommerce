    <div class="d-flex flex-column flex-shrink-0 bg-light vh-100" style="width: 100px;">
        <ul class="nav nav-pills nav-flush flex-column mb-auto text-center">
            <li class="nav-item"> <a href="{{ route('profile.general') }}" class="nav-link py-3 border-bottom {{ str_contains(Request::url(), 'general') ? 'active' : '' }}" > <i class="fa fa-home"></i> <small>General</small> </a> </li>
            <li> <a href="{{ route('profile.mobile') }}" class="nav-link py-3 border-bottom {{ str_contains(Request::url(), 'mobile') ? 'active' : '' }}"> <i class="fa fa-dashboard"></i> <small>Mobile</small> </a> </li>
            <li> <a href="#" class="nav-link py-3 border-bottom"> <i class="fa fa-first-order"></i> <small>My Orders</small> </a> </li>
            <li> <a href="#" class="nav-link py-3 border-bottom"> <i class="fa fa-cog"></i> <small>Settings</small> </a> </li>
            <li> <a href="#" class="nav-link py-3 border-bottom"> <i class="fa fa-bookmark"></i> <small>Bookmark</small> </a> </li>
        </ul>
        <div class="dropdown border-top"> <a href="#" class="d-flex align-items-center justify-content-center p-3 link-dark text-decoration-none dropdown-toggle" id="dropdownUser3" data-bs-toggle="dropdown" aria-expanded="false"> <img src="https://github.com/mdo.png" alt="mdo" width="24" height="24" class="rounded-circle"> </a>
            <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser3">
                <li><a class="dropdown-item" href="#">New project...</a></li>
                <li><a class="dropdown-item" href="#">Settings</a></li>
                <li><a class="dropdown-item" href="#">Profile</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="#">Sign out</a></li>
            </ul>
        </div>
    </div>


@push('css')

<style>
    body {
        background-color: #eee
    }

    .nav-link {
        border-radius: 0px !important;
        transition: all 0.5s;
        width: 100px;
        display: flex;
        flex-direction: column
    }

    .nav-link small {
        font-size: 12px
    }

    .nav-link:hover {
        background-color: #52525240 !important
    }

    .nav-link .fa {
        transition: all 1s;
        font-size: 20px
    }

    .nav-link:hover .fa {
        transform: rotate(360deg)
    }

    .main-category {
        display: none;
    }
</style>

@endpush
