@extends('layouts.front')

@section('content')
@include('front/navbar')
    <!-- Blog Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row ">
                @isset ($blogs)
                    @foreach ($blogs as $blog)
                       {{-- item start --}}
                        <div class="col-md-4">
                            <div class="card mb-4">
                            <img src="{{ asset('images/'.$blog->image) }}" class="card-img-top" alt="Image 1" height="250">
                            <div class="card-body">
                                <h5 class="card-title"><b>{{ $blog->title }}</b></h5>
                                <p class="card-text">{{ date('Y-F-j', strtotime($blog->created_at)) }}</p>
                                <a href="{{ route('blogDetails',['id'=> $blog->id] ) }}" class="btn btn-warning">Read More</a>
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
