@extends('layouts.admin')
@section('styles')
<style>
  .ck-editor__editable_inline {
      min-height: 400px;
  }
  </style>
@endsection
@section('content')

<div class="card">
    <div class="card-body">
        <h4 class="card-title">{{ $data['title'] }}</h4>
        <form class="row" id="SubmitForm">
          <div class="col-md-8">
            <label for="">Content</label>
            <textarea name="content" id="content" cols="30" rows="10">
              @if(isset($testi['content']))
                    {{ $testi['content'] }}
             @endif
            </textarea>
            <small class="text-danger text-sm font-weight-bold"" id="content-error"></small>
          </div>
          <div class="col-md-4">
            <label for="">Author</label>
            <input type="text" name="author" id="author" class="form-control"
            @if(isset($testi['author']))
            value = "{{ $testi['author'] }}"
            @endif
            >
            @if(isset($testi['id']))
            <input type="hidden" name="id" id="id" class="form-control"
            value = "{{ $testi['id'] }}" >
            @endif
            <small class="text-danger text-sm font-weight-bold" id="author-error"></small><br>
            <label for="">Image</label>
            <input type="file" name="image"  id="image"class="form-control" onchange="previewImage(event)">
            <small class="text-danger text-sm font-weight-bold" id="image-error"></small>
            <br>
            <div>
              <img id="preview"
              @if(isset($testi['image']))
              src="{{ url('images/'.$testi['image']) }}"
              @endif
              class="w-100" />
            </div>
            <br>
            {{-- button --}}
            <input type="submit" name="submit" class="btn btn-primary text-white rounded" value="Save">
            <a href="{{ route('admin.others.tindex') }}" class="btn btn-secondary text-white rounded" >Back</a>
          </div>
        </form>
      
      </div>
  </div>

@endsection
@section('scripts')
  <script src="https://cdn.ckeditor.com/ckeditor5/35.2.1/classic/ckeditor.js"></script>
  <script>
    ClassicEditor
        .create( document.querySelector( '#content' ),{
          ckfinder:{
            uploadUrl:"{{route('ckeditor.upload', ['_token' => csrf_token() ])}}"
          },
          image: {
              toolbar: [ 'toggleImageCaption', 'imageTextAlternative' ]
          }

        })
        .catch( error => {
            console.error( error );
        });

      // preview image
      var previewImage = function(event) {
        var preview = document.getElementById('preview');
        preview.src = URL.createObjectURL(event.target.files[0]);
        preview.onload = function() {
          URL.revokeObjectURL(preview.src) // free memory
        }
      };

      $("#SubmitForm").on("submit", function(e){
          $('#content-error').text('');
          $('#author-error').text('');
          $('#image-error').text('');
        e.preventDefault();
        var formData = new FormData(this);
        
        $.ajax({
        type:'POST',
        url:"{{ route('admin.others.tupdate') }}",
        cache:false,
        data :formData,
        contentType : false, // you can also use multipart/form-data replace of false
        processData: false,
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        //  data:{name:name, email:email, contact:contact, cource:cource},
        dataType:'json',
        error: function (response) {
          event.preventDefault();
          $('#content-error').text(response.responseJSON.errors.content);
          $('#author-error').text(response.responseJSON.errors.author);
          $('#image-error').text(response.responseJSON.errors.image);
        },
          success:function(data){
            if(data.status ==200){
              $('#preview').removeAttr('src');
               $('#SubmitForm').trigger("reset");
               $('.ck-editor__editable').html( '' );
               $('#preview').removeAttr('src');
              Swal.fire({
                title:'Good job!',
                text : data.message,
                icon :'success',
                confirmButtonText: 'Ok',
              }).then((result) => {
                if (result.isConfirmed) {
                  window.location.href = "{{ route('admin.others.tindex') }}"
                } 
              })
            }else{
                contact_right_message_sent.text(data.message);
                contact_right_message_sent.show();
                
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
</script>
  @endsection
