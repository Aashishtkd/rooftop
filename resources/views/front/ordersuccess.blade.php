@extends('layouts.front')

@section('content')
@include('front/navbar')


<div class="container">
    <div class="row">
        <div class="col-12 py-5">
            <div class="card  alert alert-success">
                <div class="card-body text-center">
                    <h5 class="card-title">Thank you ! for Your Order</h5>
                    <p>We will get back to you, as soon as possible !!</p>
                    <a href="{{route('index')}}" class="btn btn-warning text-white rounded-50">Go to Home</a>
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection