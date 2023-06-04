<body class="sub_page">

  <div class="hero_area">
    <div class="bg-box">
      <img src="{{ asset('front/images/hero-bg.jpg') }}" alt="">

    </div>
    <!-- header section strats -->
    <header class="header_section">
      <div class="container">
        <nav class="navbar navbar-expand-lg custom_nav-container ">
          <a class="navbar-brand" href="index.html">
            <span>
              Feane
            </span>
          </a>

          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class=""> </span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav  mx-auto ">
              <li class="nav-item {{ request()->routeIs('index') ? 'active' : '' }}">
                <a class="nav-link" href="{{route('index')}}">Home <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item {{ request()->routeIs('menu') ? 'active' : '' }}">
                <a class="nav-link" href="{{route('menu')}}">Menu</a>
              </li>
              <li class="nav-item {{ request()->routeIs('about') ? 'active' : '' }}">
                <a class="nav-link" href="{{route('about')}}">About</a>
              </li>
              <li class="nav-item {{ request()->routeIs('mygallery') ? 'active' : '' }}">
                <a class="nav-link" href="{{route('mygallery')}}">Gallery</a>
              </li>
              <li class="nav-item {{ request()->routeIs('blog') ? 'active' : '' }}">
                <a class="nav-link" href="{{route('blog')}}">Blogs</a>
              </li>
              <li class="nav-item {{ request()->routeIs('contact') ? 'active' : '' }}">
                <a class="nav-link" href="{{route('contact')}}">Contact Us </a>
              </li>
            </ul>
            <div class="user_option">
              {{-- <a href="" class="user_link">
                <i class="fa fa-user" aria-hidden="true"></i>
              </a> --}}
              <a class="cart_link {{ request()->routeIs('cart') ? 'text-warning' : 'text-white' }}" href="{{route('cart')}}">
                <i class="fa fa-shopping-cart"></i><span class="badge badge-danger ml-1 cartCount">{{ $totalcart }}</span>
              </a>
              <a href="{{route('book')}}" class="order_online">
                Book a Table
              </a>
            </div>
          </div>
        </nav>
      </div>
    </header>
    <!-- end header section -->
  </div>
