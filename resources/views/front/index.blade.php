@extends('layouts.front')

@section('content')
<body>
<div class="hero_area">
    <div class="bg-box">
      <img src="{{ asset('front/images/final1.jpg') }}" alt="">
    </div>
    <!-- header section strats -->
    <header class="header_section">
      <div class="container">
        <nav class="navbar navbar-expand-lg custom_nav-container ">
          <a class="navbar-brand" href="{{route('index')}}">
            <span>
              RoofTop
            </span>
          </a>

          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class=""> </span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav  mx-auto ">
              <li class="nav-item {{ request()->routeIs('index') ? 'active' : '' }}">
                <a class="nav-link" href="{{route('index')}}">Home</a>
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
                <a class="nav-link" href="{{route('contact')}}">Contact Us</a>
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
    <!-- slider section -->
    <section class="slider_section ">
        <div id="customCarousel1" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item active">
              <div class="container ">
                <div class="row">
                  <div class="col-md-7 col-lg-6 ">
                    <div class="detail-box">
                      <h1>
                        Roof-Top Restaurant
                      </h1>
                      <p>
                      Roof-Top Restaurant is a family-owned and operated restaurant that has been serving various local and trending dishes for over 5 years. It is located in Kushma Parbat and offers stunning views of the bungy and swing.
                      </p>
                      <div class="btn-box">
                        <a href="{{route('menu')}}" class="btn1">
                          Order Now
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="carousel-item ">
              <div class="container ">
                <div class="row">
                  <div class="col-md-7 col-lg-6 ">
                    <div class="detail-box">
                      <h1>
                        The Traveler's Hub
                      </h1>
                      <p>
                      Roof-Top Restaurant is a popular spot for travelers and locals alike in Kushma. The restaurant offers a wide variety of Continental, Chinese, Indian and international dishes, all of which are made with fresh, high-quality ingredients.
                      </p>
                      <div class="btn-box">
                        <a href="{{route('menu')}}" class="btn1">
                          Order Now
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="carousel-item">
              <div class="container ">
                <div class="row">
                  <div class="col-md-7 col-lg-6 ">
                    <div class="detail-box">
                      <h1>
                        Roof-Top Restaurant
                      </h1>
                      <p>
                      Roof-Top Restaurant is a family-owned and operated restaurant that has been serving various local and trending dishes for over 5 years. It is located in Kushma Parbat and offers stunning views of the bungy and swing.
                      </p>
                      <div class="btn-box">
                        <a href="{{route('menu')}}" class="btn1">
                          Order Now
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="container">
            <ol class="carousel-indicators">
              <li data-target="#customCarousel1" data-slide-to="0" class="active"></li>
              <li data-target="#customCarousel1" data-slide-to="1"></li>
              <li data-target="#customCarousel1" data-slide-to="2"></li>
            </ol>
          </div>
        </div>
  
      </section>
      <!-- end slider section -->
    </div>
  
    <!-- offer section -->
  
    <section class="offer_section layout_padding-bottom">
      <div class="offer_container">
        <div class="container ">
          <div class="heading_container heading_center">
            <h2>
              Todays Special
            </h2>
          </div>
          <div class="row justify-content-around">
          @isset($feature)
            @foreach ($feature as $feat)
            <div class="col-md-6">
              <div class="box ">
                <div class="img-box">
                  <img src="{{asset('images/'.$feat->image)}}" alt="">
                </div>
                <div class="detail-box " >
                  <h5>
                    {{ $feat->name }}
                  </h5>
                  <h6>
                    <span>{{ $feat->discount }}%</span> Off
                  </h6>
                  <a class="cart_link text-white addCartBtn " data-route="{{ route('addNewCart') }}" data-id="{{ $feat->id }}" href="#">
                    <i class="fa fa-shopping-cart"></i>
                  </a>
                </div>
              </div>
            </div>
            @endforeach
          @endisset 
          </div>
        </div>
      </div>
    </section>
  
    <!-- end offer section -->
  
    <!-- food section -->
  
    <section class="food_section pb-5">
      <div class="container">
        <div class="heading_container heading_center">
          <h2>
            Our Menu
          </h2>
        </div>
        <ul class="filters_menu">
          <li class="active" data-filter="*">All</li>
          @foreach ( $categories as $cat)
          <li data-filter=".category{{ $cat->name }}">{{ $cat->name }}</li>
          @endforeach
        </ul>
        
        <div class="filters-content">
          <div class="row grid">
            @foreach ( $categories as $category)
            @foreach ( $category->dishes as $dish)
              <div class="col-sm-6 col-lg-4 all category{{ $category->name }}">
                <div class="box">
                  <div>
                    <div class="img-box">
                      <img src="{{asset('images/'.$dish->image)}}" alt="">
                    </div>
                    <div class="detail-box">
                      <h5>
                        {{ $dish->name }}
                      </h5>
                      <div class="options">
                        <h6>
                          Rs. {{ $dish->price }}
                        </h6>
                        <a class="cart_link text-white addCartBtn " data-route="{{ route('addNewCart') }}" data-id="{{ $dish->id }}"  href="#">
                          <i class="fa fa-shopping-cart"></i>
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              @endforeach
            @endforeach
            
          </div>
        </div>
        <div class="btn-box">
          <a href="{{route('menu')}}">
            View More
          </a>
        </div>
      </div>
    </section>
  
    <!-- end food section -->
  
    <!-- about section -->
  
    <section class="about_section layout_padding">
      <div class="container  ">
  
        <div class="row">
          <div class="col-md-6 ">
            <div class="img-box">
              <img src=" {{ asset('front/images/image3.jpg') }}" alt="">
            </div>
          </div>
          <div class="col-md-6">
            <div class="detail-box">
              <div class="heading_container">
                <h2>
                  Why RoofTop
                </h2>
              </div>
              <p>
              We provide local and typical dishes as well as trending dishes in a reasonable price with warm hospitality and beutiful sight seeing of bungy and swing. We had a good location and loyal following.
              </p>
              <a href="">
                Read More
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>
  
    <!-- end about section -->
  
    <!-- book section -->
    <section class="book_section layout_padding">
      <div class="container">
        <div class="heading_container">
          <h2>
            Book A Table
          </h2>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form_container">
              <form action="">
                <div>
                  <input type="text" class="form-control" placeholder="Your Name" />
                </div>
                <div>
                  <input type="text" class="form-control" placeholder="Phone Number" />
                </div>
                <div>
                  <input type="email" class="form-control" placeholder="Your Email" />
                </div>
                <div>
                  <select class="form-control nice-select wide">
                    <option value="" disabled selected>
                      How many persons?
                    </option>
                    <option value="">
                      2
                    </option>
                    <option value="">
                      3
                    </option>
                    <option value="">
                      4
                    </option>
                    <option value="">
                      5
                    </option>
                  </select>
                </div>
                <div>
                  <input type="date" class="form-control">
                </div>
                <div class="btn_box">
                  <button>
                    Book Now
                  </button>
                </div>
              </form>
            </div>
          </div>
          <div class="col-md-6">
            <div class="map_container ">
              <div id="googleMap"></div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- end book section -->
  
    <!-- client section -->
  
    <section class="client_section layout_padding-bottom">
      <div class="container">
        <div class="heading_container heading_center psudo_white_primary mb_45">
          <h2>
            What Says Our Customers
          </h2>
        </div>
        <div class="carousel-wrap row ">
          <div class="owl-carousel client_owl-carousel">
            @foreach ($testimonial as $item)
            <div class="item">
              <div class="box">
                <div class="detail-box">
                  {!! $item->content !!}
                  <h6>
                    {{ $item->author }}
                  </h6>
                </div>
                <div class="img-box" >
                  <img src="{{ asset('images/'.$item->image) }}" width="100" height="110" alt="" class="box-img" >
                </div>
              </div>
            </div>
            @endforeach
          </div>
        </div>
      </div>
    </section>
@endsection