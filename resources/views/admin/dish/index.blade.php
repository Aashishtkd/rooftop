@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-body">
        <a class="btn btn-success" href="{{route('admin.dish.add')}}">Add new Dish</a>
      <h5 class="card-title">All Dishes</h5>

      <!-- Table with hoverable rows -->
      <table class="table table-hover" id="dataTable">
        <thead>
          <tr>
            <th scope="col">Name</th>
            <th scope="col">Price</th>
            <th scope="col">Image</th>
            <th scope="col">Category</th>
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($dishes as $dish)
            <tr>
                <th scope="row">{{$dish->name}}</th>
                <th scope="row">{{$dish->price}}</th>
                <th scope="row"><img src="{{asset($dish->image)}}" width="150px"></th>
                <th scope="row">{{$dish->category->name}}</th>
                <td><a href="{{route('admin.dish.edit', $dish->id)}}">Edit</a></td>
                <td><a href="{{route('admin.dish.delete', $dish->id)}}">Delete</a></td>
            </tr>
            @endforeach
        </tbody>
      </table>
      <!-- End Table with hoverable rows -->

    </div>
  </div>
@endsection