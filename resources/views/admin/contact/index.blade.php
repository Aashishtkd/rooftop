@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-body">
      <h5 class="card-title">All Orders</h5>

      <!-- Table with hoverable rows -->
      <table class="table table-hover" id="dataTable">
        <thead>
          <tr>
            <th scope="col">Name</th>
            <th scope="col">Phone</th>
            <th scope="col">Seen</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($contacts as $contact)
            <tr>
                <th scope="row">{{$contact->name}}</th>
                <th scope="row">{{$contact->phone}}</th>
                <th scope="row">@if($contact->seen) <span class="badge bg-success">Seen</span> @else <span class="badge bg-danger">Not Seen</span> @endif</th>
                <td>
                  <a href="{{route('admin.contact.single', $contact->id)}}" class="btn btn-sm btn-warning">View</a>
                  <button class="btn btn-danger btn-sm float-right btnDelete" data-id="{{ $contact->id }}" >Delete</button>
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
                url: "{{route('admin.contact.delete')}}",
                type : "POST",
                cache:false,
                data: jQuery.param({ id: id}) ,
                contentType : 'application/x-www-form-urlencoded; charset=UTF-8', // you can also use multipart/form-data replace of false
                processData: false,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                dataType: "json",
                success : function(data){
                    if(data.status ==200){
                          window.location.href = "{{ route('admin.contact.index') }}"
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