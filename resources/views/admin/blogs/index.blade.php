@extends('layouts.admin')
@section('styles')
<link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection

@section('content')
<div class="card">
    <div class="card-body table-responsive">
      <a class="btn btn-success" href="{{ route('admin.blog.form' ,['mode'=>'add']) }}">Add new Blog</a>
      <h5 class="card-title">All Blogs</h5>

      <!-- Table with hoverable rows -->
      <table
            id="datatable"
            class="table table-striped table-bordered yajra-datatables" 
            style="width: 100%"
            >
            <thead>
                <tr>
                <th>#</th>
                <th>ID</th>
                <th>Title</th>
                <th>Author</th>
                <th>Added By</th>
                <th>Date</th>
                <th>Action</th>
                </tr>
            </thead>
            <tbody>
                {{-- content here --}}
            </tbody>
            <tfoot>
                <tr>
                <th>#</th>
                <th>ID</th>
                <th>Title</th>
                <th>Author</th>
                <th>Added By</th>
                <th>Date</th>
                <th>Action</th>
                </tr>
            </tfoot>
            </table>
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
  loadtable()
  $("#datatable").on('click','.btnDelete',function(){
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
                url: "{{ route('admin.blog.destroy') }}",
                type : "POST",
                cache:false,
                data: jQuery.param({ id: id}) ,
                contentType : 'application/x-www-form-urlencoded; charset=UTF-8', // you can also use multipart/form-data replace of false
                processData: false,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                dataType: "json",
                success : function(data){
                    if(data.status ==200){
                      $('.yajra-datatables').DataTable().ajax.reload();
                      Swal.fire(
                        'Deleted!',
                        'Your data has been deleted.',
                        'success'
                      )
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

    // loadtable
    function loadtable() {
    var table = $('.yajra-datatables').DataTable({
        processing: true,
        order: [ 1, 'desc' ],
        serverSide: true,

        ajax: "{{ route('admin.blog.loadtable') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false, width: '5%'},
            {data: 'id', name: 'id', "visible": false, },
            {data: 'title', name: 'title', width: '20%'},
            {data: 'author', name: 'author'},
            {data: 'admin', name: 'admin'},
            {data: 'created_at', name: 'created_at'},
            {
              data: 'action', 
              name: 'action', 
              orderable: false, 
              searchable: false,
              width: '20%'
            },
        ]
    });
  };
});
</script>
@endsection