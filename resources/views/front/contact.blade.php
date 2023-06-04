@extends('layouts.front')

@section('content')
@include('front/navbar')


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
            <form action="{{route('createcontact')}}" method="post">
                @csrf 
              <div>
                <input type="text" name="name" id="name"  class="form-control" placeholder="Your Name" />
              </div>
              <div>
                <input type="text" id="phone" name="phone" class="form-control" placeholder="Phone Number" />
              </div>
              <div>
                <textarea class="form-control" placeholder="Leave a message here" id="message" name="message" style="height: 150px"></textarea>
              </div>
                <button type="submit" name="submit">
                    Send Message
                </button>
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

@endsection