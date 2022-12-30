<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive"
    aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="navbarResponsive">
    <ul class="navbar-nav ml-auto text-nowrap">
        <li class="nav-item {{ request()->is('/') ? 'active' : '' }}">
            <a class="nav-link" href="{{ url('/') }}">{{ __('site.home') }}</a>
        </li>
        <li class="nav-item {{ request()->is('products*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ url('/products?product=all') }}">{{ __('site.pruducts') }}</a>
        </li>
        <div class="nav-item dropdown">
            <a class="nav-link" data-bs-toggle="dropdown" aria-expanded="false" role="button">
                {{ __('site.category') }}
            </a>
            <div class="dropdown-menu">
                <ul class="nav flex-column bg-white text-center">
                    @foreach ($categories as $c)
                        <a href="{{ url('/products?product=new&category=' . $c->slug) }}" style="color: black">
                            <li class="nav-item m-2">{{ app()->getLocale() === 'mm' ? $c->mm_name : $c->name }}</li>
                        </a>
                        <div class="border opacity-50"></div>
                    @endforeach
                </ul>
            </div>
        </div>
        <li class="nav-item">
            <a class="nav-link position-relative" href="/profile#/cart">{{ __('site.cart') }}
                @auth
                    <span id="cart"
                        class="position-absolute top-0 start-100 @if ($cartCount === 0) d-none @endif
                        translate-middle badge bg-danger rounded-pill">{{ $cartCount }}</span>
                @endauth
            </a>
        </li>
        <li class="nav-item  {{ Str::endsWith(url()->full(), 'aboutUs') ? 'active' : '' }}">
            <a class="nav-link" href="{{ url('/aboutUs') }}">{{ __('site.about') }}</a>
        </li>
        <li class="nav-item  {{ Str::endsWith(url()->full(), 'contactUs') ? 'active' : '' }}">
            <a class="nav-link" href="{{ url('/contactUs') }}">{{ __('site.contact') }}</a>
        </li>
        <small class="small-menu d-none">Account settings</small>
        @guest
            <li class="nav-item nav-hide"><a class="nav-link" href="{{ url('/login') }}">{{ __('site.log in') }}</a></li>
            <li class="nav-item nav-hide"><a class="nav-link" href="{{ url('/register') }}">{{ __('site.sign in') }}</a>
            </li>
        @endguest
        @auth
            <li class="nav-item nav-hide"><a class="nav-link" href="{{ url('/profile') }}">{{ __('site.profile') }}</a>
            </li>
            <li class="nav-item nav-hide"><a class="nav-link" href="{{ url('/logout') }}">{{ __('site.log out') }}</a>
            </li>
        @endauth
        <small class="small-menu d-none text-center">Language</small>
        <li class="nav-item nav-hide"><a class="nav-link" href="{{ url('/locale/mm') }}">{{ __('site.myanmar') }}</a>
        </li>
        <li class="nav-item nav-hide"><a class="nav-link" href="{{ url('/locale/en') }}">{{ __('site.english') }}</a>
        </li>
    </ul>
    <div class="dropdown" id="account-button">
        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
            aria-expanded="false">
            {{ __('site.account') }}
        </button>
        <ul class="dropdown-menu">
            @guest
                <li><a class="dropdown-item" href="{{ url('/login') }}">{{ __('site.log in') }}</a></li>
                <li><a class="dropdown-item" href="{{ url('/register') }}">{{ __('site.sign in') }}</a></li>
            @endguest
            @auth
                <li><a class="dropdown-item" href="{{ url('/profile') }}">{{ __('site.profile') }}</a></li>
                <li><a class="dropdown-item" href="{{ url('/logout') }}">{{ __('site.log out') }}</a></li>
            @endauth
        </ul>
    </div>
    <div class="dropdown ms-2" id="lang-button">
        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
            aria-expanded="false">
            {{ __('site.language') }}
        </button>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="{{ url('/locale/mm') }}">{{ __('site.myanmar') }}</a></li>
            <li><a class="dropdown-item" href="{{ url('/locale/en') }}">{{ __('site.english') }}</a></li>
        </ul>
    </div>
</div>
