@extends('layouts.admin')
@section('styles')
<link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <h4 class="card-title">List Of {{ $mode }}s</h4>
        <div class="row">
        @if($mode =='Video')
            @if($videos->count()>0)
                @foreach ($videos as $video)
                    <div class="col-md-2 col-6 mt-2 text-center">
                        <iframe class="w-100" height="150" src="https://www.youtube.com/embed/{{ $video->file }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        <button class="btn btn-danger btn-sm btnDelete mt-3" data-id="{{ $video->id }}" >delete</button>
                    </div> 
                @endforeach
            @else
                <div class="col-12 text-center mt-5">
                    <h2 class="text-danger bold">Opps!!! There is no videos on your Gallery.</h2>
                </div>
            @endif
        @else
            @if($photos->count()>0)
                @foreach ($photos as $photo)
                    <div class="col-md-2 col-6 mt-2">
                        <img src="{{ url('gallery/'.$photo->file)}}" class="mb-2" alt="Snow" style="width:100% ; height: 120px;">
                        <a href="{{ url('gallery/'.$photo->file)}}" class="btn btn-sm btn-success" target="_blank"> view</a>
                        <button class="btn btn-danger btn-sm float-right btnDelete" data-id="{{ $photo->id }}" >delete</button>
                    </div> 
                @endforeach
            @else
                <div class="col-12 text-center mt-5">
                    <h2 class="text-danger bold">Opps!!! There is no photos on your Gallery.</h2>
                </div>
            @endif
        @endif
        @if($mode == 'Photo') 
            <form id="SubmitForm">
                <div class="modal-body pb-0">
                <label for="photo">Upload : <span class="text-danger">*Upload only JPG and PNG file!</span></label><br>
                <input type="file" name="file" id="photo" onchange="previewImage(event)" class="form-control">
                <br>
                <small class="text-danger text-sm font-weight-bold"" id="file-error"></small>
                <div><img id="preview" class="w-25" /></div>
                <br>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-danger rounded" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success rounded" >Save</button>
                </div>
            </form>
            @else 
            <form id="SubmitForm">
                <div class="modal-body pb-0">
                    <label for="title">Enter Title : </label><br>
                    <input type="text" name="title" id="title"  class="form-control" placeholder="Enter Title">
                    <input type="hidden" name="type" value="video">
                    <small class="text-danger text-sm font-weight-bold"" id="file-error"></small>
                    <br>
                    <label for="photo">Upload : <span class="text-danger">*Upload only youtube video</span></label><br>
                    <input type="text" name="file" id="photo" class="form-control" placeholder="Enter url like: https://www.youtube.com/channel/UC6ogi54ktxZyt95MLXUu-LA">
                    <small class="text-danger text-sm font-weight-bold"" id="file-error"></small><br>
                    <br>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-danger rounded" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success rounded" >Save</button>
                </div>
            </form>
            @endif
        

            
        </div>
      </div>
      
  </div>


@endsection


@section('scripts')
<script>

    // preview image
    var previewImage = function(event) {
      var preview = document.getElementById('preview');
      preview.src = URL.createObjectURL(event.target.files[0]);
      preview.onload = function() {
        URL.revokeObjectURL(preview.src) // free memory
      }
    };

    $("#SubmitForm").on("submit", function(e){
      $('#file-error').text('');
      e.preventDefault();
      var formData = new FormData(this);
      $.ajax({
      type:'POST',
      url:"{{ route('admin.gallery.update') }}",
      cache:false,
      data :formData,
      contentType : false, // you can also use multipart/form-data replace of false
      processData: false,
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      //  data:{name:name, email:email, contact:contact, cource:cource},
      dataType:'json',
      error: function (response) {
        event.preventDefault();
        $('#file-error').text(response.responseJSON.errors.file);
        console.log(response.responseJSON.errors.file);

      },
        success:function(data){
          if(data.status ==200){
            Swal.fire({
              title:'Good job!',
              text : data.message,
              icon :'success',
              confirmButtonText: 'Ok',
            }).then((result) => {
              if (result.isConfirmed) {
                @if($mode == 'Video')
                    window.location.href = "{{ route('admin.gallery.index',['mode'=>'Video']) }}"
                @else
                    window.location.href = "{{ route('admin.gallery.index',['mode'=>'Photo']) }}"
                @endif
              } 
            })
          }else{
              Swal.fire({
                  icon: 'error',
                  title: 'Oops...',
                  text: 'Something went wrong!',
                })
          }
          jQuery.each(data.errors, function(key, value){
            jQuery('.alert-danger').show();
            jQuery('.alert-danger').append('<p>'+value+'</p>');
          });
      }
      });

  });
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
                url: "{{ route('admin.gallery.destroy') }}",
                type : "POST",
                cache:false,
                data: jQuery.param({ id: id}) ,
                contentType : 'application/x-www-form-urlencoded; charset=UTF-8', // you can also use multipart/form-data replace of false
                processData: false,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                dataType: "json",
                success : function(data){
                    if(data.status ==200){
                        @if($mode == 'Video')
                            window.location.href = "{{ route('admin.gallery.index',['mode'=>'Video']) }}"
                        @else
                            window.location.href = "{{ route('admin.gallery.index',['mode'=>'Photo']) }}"
                        @endif
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
