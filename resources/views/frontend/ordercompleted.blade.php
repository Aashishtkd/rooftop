@extends('layouts.frontend')

@section('content')

<div class="container-xxl py-5 bg-dark hero-header mb-5">
    <div class="container my-5 py-5">
        <div class="row align-items-center g-5">
            <div class="col-lg-6 text-center text-lg-start">
                <h1 class="display-3 text-white animated slideInLeft">Enjoy Our<br>Delicious Meal</h1>
            </div>
            <div class="col-lg-6 text-center text-lg-end overflow-hidden">
                <img class="img-fluid" src="img/hero.png" alt="">
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <h5 class="card-title">Thank you {{$order->name}}</h5>

        <div class="shadow-lg p-3 mb-5 bg-body rounded">
            <p>Your order has been completed, we will get to you as soon as possible !!</p>

            <p>Ordered items:</p>
            <ul>
                @php
                    $total = 0;
                @endphp
                @foreach ($order->items as $item)
                    @php
                        $total = $total + $item->dish->price;
                    @endphp
                    <li>Dish: {{$item->dish->name}} || <span class="border-top">Price: {{$item->dish->price}}</span></li>
                @endforeach
            </ul>
            <h5><span class="border-top">Total: {{$total}}</span></h5>
        </div>
    </div>
</div>

@endsection