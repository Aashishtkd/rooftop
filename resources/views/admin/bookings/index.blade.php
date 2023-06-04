@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-body  table-responsive">
      <h5 class="card-title">All Bookings</h5>

      <!-- Table with hoverable rows -->
      <table class="table table-hover" id="dataTable">
        <thead>
          <tr>
            <th scope="col">Name</th>
            <th scope="col">Phone</th>
            <th scope="col">Time</th>
            <th scope="col">People</th>
            <th scope="col">Date</th>
            <th scope="col">Booking Time</th>
            <th scope="col">Completed</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($bookings as $booking)
            <tr>
                <td scope="row">{{$booking->name}}</td>
                <td>{{$booking->phone}}</td>
                <td>{{$booking->time}}</td>
                <td>{{$booking->person}}</td>
                <td>{{$booking->date}}</td>
                <td>{{$booking->created_at}}</td>
                <td class="text-center">@if($booking->completed =='true') <span class="badge badge-success">Complete</span> @else <span  class="badge badge-danger">Pending</span> @endif</td>
                <td>
                  <a href="{{route('admin.booking.changestatus', $booking->id)}}" class="btn btn-sm  btn-primary ">@if($booking->completed =='true') Mark as Complete @else Mark as In-Complete  @endif</a>
                  <button class="btn btn-danger btn-sm float-right btnDelete" data-id="{{ $booking->id }}" >delete</button>
                </td>
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
                url: "{{ route('admin.booking.destroy') }}",
                type : "POST",
                cache:false,
                data: jQuery.param({ id: id}) ,
                contentType : 'application/x-www-form-urlencoded; charset=UTF-8', // you can also use multipart/form-data replace of false
                processData: false,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                dataType: "json",
                success : function(data){
                    if(data.status ==200){
                          window.location.href = "{{ route('admin.booking.index') }}"
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