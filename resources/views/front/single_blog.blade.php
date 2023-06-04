@extends('layouts.front')

@section('content')
@include('front/navbar')

    <!-- Blog Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row ">
              @isset($blog)
              <div class="col-md-9">
                <div class="card mb-4">
                  <img src="{{ asset('images/'.$blog->image) }}" class="card-img-top" alt="Image 1">
                  <div class="card-body">
                    <h4 class="card-title">{{ $blog->title }}</h4>
                    <p class="card-text">{{ date('Y-F-j', strtotime($blog->created_at)) }}</p>
                    <b class="card-text">Author : {{ $blog->author }}</b>
                    <hr>
                    <p class="card-text"><?php  echo $blog->content ?></p>
                  </div>
                </div>
              </div>
              @endisset
                
              <div class="col-md-3">
                @isset ($blogs)
                    @foreach ($blogs as $b)
                       {{-- item start --}}
                            <div class="row w-100">
                              <div class="card mb-4 w-100">
                                <img src="{{ asset('images/'.$b->image) }}" class="card-img-top" alt="Image 1" height="220">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $b->title }}</h5>
                                    <p class="card-text">{{ date('Y-F-j', strtotime($b->created_at)) }}</p>
                                    <a href="{{ route('blogDetails',['id'=> $b->id] ) }}" class="btn btn-sm btn-warning">Read More</a>
                                </div>
                                </div>
                            </div>
                            {{-- item end --}} 
                    @endforeach
                @endisset
              </div>
              
         
        </div>
    </div>
    <!-- Blog End -->

@endsection
