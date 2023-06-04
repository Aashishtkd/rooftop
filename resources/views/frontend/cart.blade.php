@extends('layouts.frontend')

@section('style')
<style>

</style>
@endsection

@section('content')

<div class="container-xxl py-5 bg-dark hero-header mb-5">
    <div class="container my-5 py-0">
        <div class="row align-items-center g-5">
            <div class="col-lg-6 text-center text-lg-start">
                <h1 class="display-3 text-white animated slideInLeft">Your Cart</h1>
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
                    <h1 class="mb-5">Your Cart</h1>
                </div>
                <div class="tab-class text-center wow fadeInUp" data-wow-delay="0.1s">
                    <div class="container mt-5 p-3 rounded cart">
                        <div class="row no-gutters">
                            <div class="col-md-8">
                                <div class="product-details mr-2">
                                    <table class="table">
                                        <tr class="bg-secondary text-white">
                                            <th>#</th>
                                            <th>Iten Name</th>
                                            <th>Iten Count</th>
                                            <th>Price</th>
                                            <th>Remove</th>
                                        </tr>
                                        <tr class="shadow-sm rounded-3 mb-3">
                                            <td>1</td>
                                            <td>Dal Vat</td>
                                            <td>4</td>
                                            <td>Rs 4000</td>
                                            <td><button class="btn btn-sm text-danger"><i class="fas fa-trash-alt"></i></button></td>
                                        </tr>
                                        <tr class="shadow-sm rounded-3">
                                            <td>4</td>
                                            <td>Dal Vat</td>
                                            <td>4</td>
                                            <td>Rs 4000</td>
                                            <td><button class="btn btn-sm text-danger"><i class="fas fa-trash-alt"></i></button></td>
                                        </tr>
                                    </table>
                                    <a href="{{route('order')}}" class="btn btn-sm btn-primary">Order Another Item <i class="fas fa-arrow-up"></i></a>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="w-100 shadow-sm p- bg-light">
                                    <div class="bg-primary p-3  mb-3 text-white rounded" style="text-align: left">
                                        <span class="text-left">Delivery Charge : Rs 5000</span><br>
                                        <span>Tax : Rs 5000</span><br>
                                        <hr>
                                        <h4 class="text-white">Total : Rs 5000</h4>
                                    </div>
                                    <h6 class="text-secondary">Insert Your Detail To Confirm Your Order</h6>
                                    <form action="{{route('completeorder')}}" class="p-3" method="POST">
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