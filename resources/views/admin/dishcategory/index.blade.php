@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-body">
        <a class="btn btn-success" href="{{route('admin.dishcategory.add')}}">Add new Dish Category</a>
      <h5 class="card-title">All Dish Categories</h5>

      <!-- Table with hoverable rows -->
      <table class="table table-hover" id="dataTable">
        <thead>
          <tr>
            <th scope="col">Name</th>
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
            <tr>
                <th scope="row">{{$category->name}}</th>
                <td><a href="{{route('admin.dishcategory.edit', $category->id)}}">Edit</a></td>
                <td><a href="{{route('admin.dishcategory.delete', $category->id)}}">Delete</a></td>
            </tr>
            @endforeach
        </tbody>
      </table>
      <!-- End Table with hoverable rows -->

    </div>
  </div>
@endsection