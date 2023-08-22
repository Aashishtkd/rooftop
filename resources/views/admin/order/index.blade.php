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
            <th scope="col">Ordered Date</th>
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
                <th scope="row">@if($order->completed) <span class="badge bg-success">Yes</span> @else <span class="badge bg-danger">No</span> @endif</th>
                <td><a href="{{route('admin.order.single', $order->id)}}" class="btn btn-sm  btn-warning">View</a></td>
                <td><button class="btn btn-danger btn-sm float-right btnDelete" data-id="{{ $order->id }}" >Delete</button></td>
            </tr>
            @endforeach
        </tbody>
      </table>
      <!-- End Table with hoverable rows -->

    </div>
  </div>
@endsection
@section('scripts')
<script>

  $(".btnDelete").on("click", function(e){
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
                url: "{{route('admin.order.delete')}}",
                type : "POST",
                cache:false,
                data: jQuery.param({ id: id}) ,
                contentType : 'application/x-www-form-urlencoded; charset=UTF-8', // you can also use multipart/form-data replace of false
                processData: false,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                dataType: "json",
                success : function(data){
                    if(data.status ==200){
                          window.location.href = "{{ route('admin.order.index') }}"
                    }else{
                      $('.yajra-datatables').DataTable().ajax.reload();
                      Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong!',
                      })
                    }
                }
                });
          
        }
      })
  });
</script>
@endsection