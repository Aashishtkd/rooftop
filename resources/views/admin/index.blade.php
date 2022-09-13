@extends('layouts.admin')

@section('content')

<div class="card">
    <div class="card-body">
      <h5 class="card-title"></h5>

      <div class="row">
        <div class="col-md-6 text-center">
            <i class="fa-solid fa-utensils fa-2xl"></i>
            <p style="margin-top: 20px;">{{$dish}} Dishes</p>
        </div>
        <div class="col-md-6 text-center">
            <i class="fa-solid fa-inbox fa-2xl"></i>
            <p style="margin-top: 20px;">{{$category}} Categories</p>
        </div>

        <div class="row" style="margin-top:50px; ">
            <div class="col-md-6 text-center">
                <i class="fa-solid fa-truck-fast fa-2xl"></i>
                <p style="margin-top: 20px;">{{$order}} Online Order</p>
            </div>
            <div class="col-md-6 text-center">
                <i class="fa-solid fa-comments fa-2xl"></i>
                <p style="margin-top: 20px;">{{$message}} Messages</p>
            </div>
        </div>

      </div>

    </div>
</div>

@endsection