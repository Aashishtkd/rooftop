@extends('layouts.front')

@section('content')
@include('front/navbar')

<section class="about_section layout_padding">
    <div class="container  ">

      <div class="row">
        <div class="col-md-6 ">
          <div class="img-box">
            <img src="{{ asset('front/images/about-img.png') }}" alt="">

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


@endsection