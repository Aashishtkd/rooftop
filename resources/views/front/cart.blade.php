@extends('layouts.front')

@section('style')
<style>
 .custom-input::-webkit-inner-spin-button,
  .custom-input::-webkit-outer-spin-button {
    -webkit-appearance: none;
    margin: 0;
  }
</style>
@endsection

@section('content')
@include('front/navbar')

        <!-- Menu Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                    <h1 class="mb-5">Your Cart</h1>
                </div>
                <div class="tab-class text-center wow fadeInUp" data-wow-delay="0.1s">
                    <div class="container mt-5 p-3 rounded cart">
                        <div class="row no-gutters">
                            <div class="col-md-8 mb-5">
                                <div class="product-details mr-2">
                                    <table class="table w-100">
                                        <tr class="bg-warning text-white">
                                            <th>#</th>
                                            <th>Iten Name</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>Remove</th>
                                        </tr>
                                        @isset($items)
                                          @foreach ($items as $key => $item)
                                            <tr class="shadow-sm rounded-3 mb-3">
                                              <td>{{ $key + 1 }}</td>
                                              <td>{{ $item->dishes->name }}</td>
                                              <td class="d-flex">
                                                  <button class="btn btn-sm btn-light px-2 qtyChangeBtn" data-id ="{{ $item->id }}"  data-route="{{ route('decrementCart') }}">
                                                    <i class="fa fa-minus"></i>
                                                  </button>
                                            
                                                  <input min="0" name="quantity" value="{{ $item->quantity }}" type="number" class="custom-input" style="padding: 0 5px; width: 30px;">
                                            
                                                  <button class="btn btn-sm btn-light px-2 qtyChangeBtn" data-id ="{{ $item->id }}"  data-route="{{ route('incrementCart') }}" >
                                                    <i class="fa fa-plus"></i>
                                                  </button>
                                                </td>
                                              <td>Rs {{ $item->dishes->price * $item->quantity }}</td>
                                              <td><button class="btn btn-sm btn-danger deleteCartBtn" data-id ="{{ $item->id }}"  data-route="{{ route('deleteCart') }}" ><i class="fa fa-trash"></i></button></td>
                                          </tr>
                                          @endforeach
                                        @endisset
                                    </table>
                                    <a href="{{route('menu')}}" class="btn btn-sm btn-warning">Order Another Item <i class="fa fa-shopping-cart"></i></a>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="w-100 shadow-sm p- bg-light">
                                    <div class="bg-secondary p-3  mb-3 text-white rounded" style="text-align: left">
                                        <span class="text-left">Delivery Charge : Rs 0</span><br>
                                        <span>Tax : 0%</span><br>
                                        <hr>
                                        <h4 class="text-white">Total : Rs {{ $totalSum }}</h4>
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
    
                                        <input type="submit" class="btn btn-warning" style="margin-top:20px;" value="Order Now">
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
$(".qtyChangeBtn").on("click", function(e){
    // get the current row
    var id = $(this).attr("data-id");
    var userAgent = navigator.userAgent;
    var addNewCartUrl = $(this).attr("data-route");
    $.ajax({
    url:addNewCartUrl,
    type : "POST",
    cache:false,
    data: jQuery.param({ id: id,userAgent:userAgent}) ,
    contentType : 'application/x-www-form-urlencoded; charset=UTF-8', // you can also use multipart/form-data replace of false
    processData: false,
    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    dataType: "json",
    error: function (response) {
      window.location.reload();
      // console.log(response)
    },
      success:function(data){
        // console.log(data)
        window.location.reload();
    }
    });
});
$(".deleteCartBtn").on("click", function(e){
    // get the current row
    var id = $(this).attr("data-id");
    var userAgent = navigator.userAgent;
    var addNewCartUrl = $(this).attr("data-route");
    $.ajax({
    url:addNewCartUrl,
    type : "POST",
    cache:false,
    data: jQuery.param({ id: id,userAgent:userAgent}) ,
    contentType : 'application/x-www-form-urlencoded; charset=UTF-8', // you can also use multipart/form-data replace of false
    processData: false,
    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    dataType: "json",
    error: function (response) {
      window.location.reload();
      // console.log(response)
    },
      success:function(data){
        // console.log(data)
        window.location.reload();
    }
    });
});


</script>

@endsection