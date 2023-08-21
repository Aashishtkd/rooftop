@extends('layouts.front')

@section('content')
@include('front/navbar')

  <!-- food section -->

  <section class="food_section layout_padding">
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
                        Rs. {{ $dish->price }} <span class="price_cut">Rs. {{ round(($dish->price+(($dish->price*$dish->discount)/100)),2) }}</span>
                      </h6>
                      <a class="cart_link text-white addCartBtn " data-route="{{ route('addNewCart') }}" data-id="{{ $dish->id }}" href="#">
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
      {{-- <div class="btn-box">
        <a href="">
          View More
        </a>
      </div>
    </div> --}}
  </section>

  <!-- end food section -->


@endsection