@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-body table-responsive">
      <a class="btn btn-success " href="{{ route('admin.dishcategory.add' ,['mode'=>'add']) }}">Add new Dish Category</a>
      <h5 class="card-title">All Dish Categories</h5>

      <!-- Table with hoverable rows -->
      <table class="table table-hover " id="dataTable">
        <thead>
          <tr>
            <th scope="col">Name</th>
            <th scope="col">Image</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
            <tr>
                <th scope="row">{{$category->name}}</th>
                <td>
                  <img id="preview" 
            @if(isset($category['image']))
              src="{{ url('images/'.$category->image) }}"
                @endif  width="50" height="50"/>
                </td>
                <td><a href="{{ route('admin.dishcategory.add' ,['mode'=>'update','id'=>$category->id]) }}" class="btn btn-sm  btn-success">Edit</a>
                  <button data-id="{{ $category->id }}" class="btn btn-sm btn-danger btnDelete">Delete</button></td>
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
                url: "{{ route('admin.dishcategory.delete') }}",
                type : "POST",
                cache:false,
                data: jQuery.param({ id: id}) ,
                contentType : 'application/x-www-form-urlencoded; charset=UTF-8', // you can also use multipart/form-data replace of false
                processData: false,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                dataType: "json",
                success : function(data){
                    if(data.status ==200){
                      window.location.href = "{{ route('admin.dishcategory.index') }}"
                    }else{
                      window.location.href = "{{ route('admin.dishcategory.index') }}"
                    }
                }
                });
          
        }
      })
    });

});
</script>
@endsection