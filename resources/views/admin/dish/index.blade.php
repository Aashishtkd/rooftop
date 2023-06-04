@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-body table-responsive">
        <a class="btn btn-success" href="{{route('admin.dish.add',['mode'=>'add'])}}">Add new Dish</a>
      <h5 class="card-title">All Dishes</h5>

      <!-- Table with hoverable rows -->
      <table class="table table-hover" id="dataTable">
        <thead>
          <tr>
            <th scope="col">Name</th>
            <th scope="col">Price</th>
            <th scope="col">Image</th>
            <th scope="col">Category</th>
            <th scope="col">Feature</th>
            <th scope="col">Discount</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($dishes as $dish)
            <tr>
                <th scope="row">{{$dish->name}}</th>
                <th scope="row">{{$dish->price}}</th>
                <th scope="row"><img src="{{ url('images/'.$dish->image) }}" width="50" height="50"></th>
                <th scope="row">{{$dish->category->name}}</th>
                <th scope="row">
                  @if ($dish->feature == "true")
                  <span class="badge badge-success">Active</span>
                  @else
                  <span class="badge badge-danger">Inactive</span>
                  @endif
                </th>
                <th scope="row">{{$dish->discount}}%</th>
                <td><a href="{{route('admin.dish.add', ['mode'=>'update','id'=>$dish->id])}}" class="btn btn-sm  btn-success">Edit</a>
                  <button data-id="{{ $dish->id }}" class="btn btn-sm btn-danger btnDelete">Delete</button></td>
            </tr>
            @endforeach
        </tbody>
      </table>
      <!-- End Table with hoverable rows -->

    </div>
  </div>
@endsection
@section('scripts')
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ url('js/global.js')}}"></script>

<script>
 
 $(document).ready(function(){
  $(".btnDelete").on('click',function(){
        // get the current row
       var id = $(this).attr("data-id");
        Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "{{ route('admin.dish.delete') }}",
                type : "POST",
                cache:false,
                data: jQuery.param({ id: id}) ,
                contentType : 'application/x-www-form-urlencoded; charset=UTF-8', // you can also use multipart/form-data replace of false
                processData: false,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                dataType: "json",
                success : function(data){
                    if(data.status ==200){
                      window.location.href = "{{ route('admin.dish.index') }}"
                    }else{
                      window.location.href = "{{ route('admin.dish.index') }}"
                    }
                }
                });
          
        }
      })
    });

});
</script>
@endsection