@extends('layouts.admin')

@section('content')

<div class="card">
    <div class="card-body">
        <h4 class="card-title">Order information @if($order->completed) <a href="" class="btn btn-warning">Completed</a>  @else <a href="{{route('admin.order.complete', $order->id)}}" class="btn btn-info">Mark as Completed</a> @endif</h4>
        <div class="card p-3">
            <p>Name: {{$order->name}}</p>
            <p>Phone: {{$order->phone}}</p>
            <p>Location: {{$order->location}}</p>
        </div>
        <hr>
        <h4>Order itscksems:</h4>
        @php
            $total = 0;
            $amount = 0;
        @endphp
        <table class="table table-hover" id="dataTable">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Dish Name</th>
                <th scope="col">Quantity</th>
                <th scope="col">Price</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($orderitems as $order)
                <tr>
                    @php
                        $total = $total + $order->quantity;
                        $amount = $amount + $order->amt;
                    @endphp
                    <th scope="row">{{ 1 }}</th>
                    <th scope="row">{{$order->dishs->name}}</th>
                    <th scope="row">{{$order->quantity}}</th>
                    <th scope="row">{{$order->amt}}</th>
                </tr>
                @endforeach
            </tbody>
          </table>
          <div class="row">
            <div class="col-md-5">
                <h4>Total Quantity : {{ $total}}</h4>
                <h4>Total Amount : Rs. {{ $amount }}</h4>
            </div>
          </div>
          <a href="{{route('admin.order.index')}}" class="btn btn-secondary"> Back</a>
    </div>

</div>
@endsection