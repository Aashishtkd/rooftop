@extends('layouts.admin')

@section('content')

<div class="card">
    <div class="card-body">
        <h4 class="card-title">Order information @if($order->completed) @else <a href="{{route('admin.order.complete', $order->id)}}" class="btn btn-info">Mark as Completed</a> @endif</h4>
        <ul>
            <li>Name: {{$order->name}}</li>
            <li>Phone: {{$order->phone}}</li>
            <li>Location: {{$order->location}}</li>
        </ul>

        <h5>Order items:</h5>
        @php
            $total = 0;
        @endphp
        @foreach ($order->items as $item)
            <div class="shadow-lg p-3 mb-5 bg-body rounded">{{$item->dish->name}}</div>
            @php
                $total = $total + $item->dish->price;
            @endphp
        @endforeach

        <span class="border-top">Total: {{$total}}</span>
    </div>

</div>
@endsection