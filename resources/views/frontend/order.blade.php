@extends('layouts.frontend')

@section('content')

<div class="container-xxl py-5 bg-dark hero-header mb-5">
    <div class="container my-5 py-5">
        <div class="row align-items-center g-5">
            <div class="col-lg-6 text-center text-lg-start">
                <h1 class="display-3 text-white animated slideInLeft">Enjoy Our<br>Delicious Meal</h1>
                <p class="text-white animated slideInLeft mb-4 pb-2">Tempor erat elitr rebum at clita. Diam
                    dolor diam ipsum sit. Aliqu diam amet diam et eos. Clita erat ipsum et lorem et sit, sed
                    stet lorem sit clita duo justo magna dolore erat amet</p>
                <a href="" class="btn btn-primary py-sm-3 px-sm-5 me-3 animated slideInLeft">Book A
                    Table</a>
            </div>
            <div class="col-lg-6 text-center text-lg-end overflow-hidden">
                <img class="img-fluid" src="img/hero.png" alt="">
            </div>
        </div>
    </div>
</div>

        <!-- Menu Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                    <h5 class="section-title ff-secondary text-center text-primary fw-normal">Food Menu</h5>
                    <h1 class="mb-5">Most Popular Items</h1>
                </div>
                <div class="tab-class text-center wow fadeInUp" data-wow-delay="0.1s">
                    <ul class="nav nav-pills d-inline-flex justify-content-center border-bottom mb-5">
                        @for ($i = 0; $i < count($categories); $i++)
                        <li class="nav-item">
                            <a class="d-flex align-items-center text-start mx-3 ms-0 pb-3 @if($i==0) active @endif" data-bs-toggle="pill" href="#tab-{{$i}}">
                                <i class="fa fa-coffee fa-2x text-primary"></i>
                                <div class="ps-3">
                                    <h6 class="mt-n1 mb-0">{{$categories[$i]->name}}</h6>
                                </div>
                            </a>
                        </li>
                        @endfor
                    </ul>
                    <div class="tab-content">
                        @for ($i = 0; $i < count($categories); $i++)
                        <div id="tab-{{$i}}" class="tab-pane fade show p-0 @if($i==0) active @endif">
                            <div class="row g-4">
                                @foreach ($categories[$i]->dishes as $dish)
                                <div class="col-lg-6">
                                    <div class="d-flex align-items-center">
                                        <img class="flex-shrink-0 img-fluid rounded" src="{{asset($dish->image)}}" alt="" style="width: 80px;">
                                        <div class="w-100 d-flex flex-column text-start ps-4">
                                            <h5 class="d-flex justify-content-between border-bottom pb-2">
                                                <span>{{$dish->name}}</span>
                                                <span class="text-primary">{{$dish->price}}</span>
                                                <span class="text-primary"><a onclick="addToCart({{$dish->id}})" class="btn btn-success">+</a></span>
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endfor
                    </div>

                    <div style="margin-top:50px;"> 
                        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                            <h4 class="section-title ff-secondary text-center text-primary fw-normal">Cart</h4>
                        </div>
                        <div class="row">
                            @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            <div class="col-md-6">
                                <h5 class="section-title ff-secondary text-center text-primary fw-normal">Your Orders</h5>
                                <div id="cart-item">

                                </div>
                            </div>
                            <div class="col-md-6">
                                <h5 class="section-title ff-secondary text-center text-primary fw-normal">Total</h5>
                                <form action="{{route('completeorder')}}" method="POST">
                                    @csrf

                                    <input type="text" class="form-control"  name="name" placeholder="Your Name">
                                    <input type="text" class="form-control" style="margin-top:20px;" name="location" placeholder="Your Location">
                                    <input type="text" class="form-control"style="margin-top:20px;" name="phone" placeholder="Your Mobile Number">

                                    <div id="order-form">

                                    </div>

                                    <p id="total"></p>

                                    <input type="submit" class="btn btn-primary" style="margin-top:20px;" value="Order Now">
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- Menu End -->

@endsection

@section('script')

<script>

    let cart = [];
    let total = 0;

    function addToCart(id){
        cart.push(id);
        showCart();
    }

    function showCart(){
        $("#cart-item").empty();
        $("#order-form").empty();
        total = 0;
        for(let item of cart){

            // Ajax call
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                method: 'post',
                url: "{{route('single')}}",
                data: {"id":item},
                success: function(data){
                    total = total + data.price;
                    let htmlObj = `
                        <p> `+data.name+` </p>
                    `;
                    $('#cart-item').append(htmlObj);

                    $("#total").html('Total: ' + total);
                    let orderFormObj = `
                        <input type="hidden" name="order[]" value="`+data.id+`">
                    `;
                    $("#order-form").append(orderFormObj);
                }
            });
        }
    }
</script>

@endsection