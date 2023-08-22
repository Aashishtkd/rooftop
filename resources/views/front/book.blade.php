@extends('layouts.front')

@section('content')
@include('front/navbar')

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
          @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
          <div class="form_container">
            <form action="{{route('createbookings')}}" method="post">
              @csrf
              <div>
                <input type="text" class="form-control" name="name" placeholder="Your Name" />
              </div>
              <div>
                <input type="text" class="form-control" name="phone" placeholder="Phone Number" />
              </div>
              <div>
                <input type="number" class="form-control" name="person" placeholder="How many persons?" />
              </div>
              <div>
                <input type="date" name="date" class="form-control" placeholder="How Select Date" >
              </div>
              <div>
                <input type="time" name="time" class="form-control" placeholder="How Select Time">
              </div>
              <div class="btn_box">
                <button type="submit">
                  Book Now
                </button>
              </div>
            </form>
          </div>
        </div>
        <div class="col-md-6">
          <div class="map_container ">
            @if(isset($settings->map))
                    {!! $settings->map !!}
              @endif
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- end book section -->


@endsection