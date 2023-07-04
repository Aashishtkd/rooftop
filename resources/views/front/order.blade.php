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
                <h1 class="mb-5">Order Conformation</h1>
            </div>
            <div class="tab-class text-center wow fadeInUp" data-wow-delay="0.1s">
                <div class="container mt-5 p-3 rounded cart">
                    <div class="row no-gutters">
                        <div class="col-md-8 mb-5">
                            <div class="product-details mr-2">
                                <h3>Your Booking</h3>
                                <table class="table w-100">
                                    <tr class="bg-warning text-white">
                                        <td>Product name</td>
                                        <td>Quantity</td>
                                        <td>Total</td>
                                    </tr>
                                    <tr>
                                        <td>Food Name</td>
                                        <td>20</td>\
                                        <td>Rs. 500</td>
                                    </tr>
                                </table>
                            </div>
                            <div>
                                <h2>Total : Rs. 3000</h2>
                            </div>
                            <div class="my-3">
                                <a href="" class="btn btn-danger">Confirm Order</a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <img src="{{ url('front/images/qr.jpg') }}" alt="" class="w-100 shadow">
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

</script>

@endsection