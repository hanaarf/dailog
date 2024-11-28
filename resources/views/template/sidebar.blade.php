<div class="deznav">
    <div class="deznav-scroll">
        <div class="main-profile">
            <div class="image-bx">
                @if(Auth::user()->image)
                <img src="{{ asset('storage/' . Auth::user()->image) }}" alt="User Image">
                @else
                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->username) }}"
                    alt="User Avatar">
                @endif 
            </div>
            <h5 class="name"><span class="font-w400">Hello,</span> {{ Auth::user()->name }}</h5>
            <p class="email"><a href="/cdn-cgi/l/email-protection" class="__cf_email__"
                    data-cfemail="95f8f4e7e4e0f0efefefefd5f8f4fcf9bbf6faf8">{{ Auth::user()->email }}</a></p>
        </div>
        <ul class="metismenu" id="menu">
            <li class="nav-label first">Main Menu</li>
            <li><a href="{{ route('index.dashboard')}}" aria-expanded="false">
                    <i class="flaticon-144-layout"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
            </li>
        </li>
            <li class="nav-label">Apps</li>
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-077-menu-1"></i>
                    <span class="nav-text">Users</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('index.admin') }}">Admin</a></li>
                    <li><a href="{{ route('index.user') }}">User</a></li>
                </ul>
            </li>
            {{-- <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-061-puzzle"></i>
                    <span class="nav-text">Posts</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="chart-flot.html">Flot</a></li>
                </ul>
            </li> --}}
            <li><a href="{{ route('index.post') }}" class="ai-icon" aria-expanded="false">
                <i class="flaticon-061-puzzle"></i>
                <span class="nav-text">Post</span>
            </a>
            </li>
            <li><a class="ai-icon" href="{{ route('a.index.report')}}" aria-expanded="false">
                <i class="flaticon-381-internet"></i>
                <span class="nav-text">Report</span>
            </a>
        </li>
            <li class="nav-label">components</li>
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-003-diamond"></i>
                    <span class="nav-text">Bootstrap</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="ui-accordion.html">Accordion</a></li>

                </ul>
            </li>
        </ul>
        {{-- <div class="copyright">
            <p><strong>Zenix Crypto Admin Dashboard</strong> © 2021 All Rights Reserved</p>
            <p class="fs-12">Made with <span class="heart"></span> by DexignZone</p>
        </div> --}}
    </div>
</div>
