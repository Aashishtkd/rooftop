@extends('layouts.frontend')

@section('content')

    <div class="container-xxl py-5 bg-dark hero-header mb-5">
        <div class="container my-5 py-5">
            <div class="row align-items-center g-5">
                <div class="col-lg-6 text-center text-lg-start">
                    <h1 class="display-3 text-white animated slideInLeft">Our Blogs</h1>
                </div>
                <div class="col-lg-6 text-center text-lg-end overflow-hidden">
                    <img class="img-fluid" src="img/hero.png" alt="">
                </div>
            </div>
        </div>
    </div>
    <!-- Blog Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row ">
                @isset ($blogs)
                    @foreach ($blogs as $blog)
                       {{-- item start --}}
                        <div class="col-md-3">
                            <div class="card mb-4">
                            <img src="{{ asset('images/'.$blog->image) }}" class="card-img-top" alt="Image 1" height="250">
                            <div class="card-body">
                                <h5 class="card-title">{{ $blog->title }}</h5>
                                <p class="card-text">{{ date('Y-F-j', strtotime($blog->created_at)) }}</p>
                                <a href="{{ route('blogDetails',['id'=> $blog->id] ) }}" class="btn btn-primary">Read More</a>
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
