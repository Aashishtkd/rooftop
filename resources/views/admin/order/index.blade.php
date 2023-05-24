@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-body  table-responsive">
      <h5 class="card-title">All Orders</h5>

      <!-- Table with hoverable rows -->
      <table class="table table-hover" id="dataTable">
        <thead>
          <tr>
            <th scope="col">Name</th>
            <th scope="col">Location</th>
            <th scope="col">Phone</th>
            <th scope="col">Created At</th>
            <th scope="col">Completed</th>
            <th scope="col">View</th>
            <th scope="col">Delete</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
            <tr>
                <th scope="row">{{$order->name}}</th>
                <th scope="row">{{$order->location}}</th>
                <th scope="row">{{$order->phone}}</th>
                <th scope="row">{{$order->created_at}}</th>
                <th scope="row">@if($order->completed) Yes @else No @endif</th>
                <td><a href="{{route('admin.order.single', $order->id)}}" class="btn btn-sm  btn-warning">View</a></td>
                <td><a href="{{route('admin.order.delete', $order->id)}}" class="btn btn-sm  btn-danger">Delete</a></td>
            </tr>
            @endforeach
        </tbody>
      </table>
      <!-- End Table with hoverable rows -->

    </div>
  </div>
@endsection