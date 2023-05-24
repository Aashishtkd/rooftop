@extends('layouts.admin')

@section('content')

<div class="card">
    <div class="card-body">

      <h5 class="card-title">{{ $data['title'] }}</h5>

      <!-- Vertical Form -->
      <form class="row g-3" id="SubmitForm">
        <div class="col-12">
          @if(isset($category['id']))
            <input type="hidden" name="id" id="id" class="form-control"
            value = "{{ $category['id'] }}" >
            @endif
          <label for="name" class="form-label">Name</label>
          <input type="text" class="form-control" name="name" id="name"
          @if(isset($category['name']))
            value = "{{ $category['name'] }}"
          @endif
          >
          <small class="text-danger text-sm font-weight-bold" id="name-error"></small>
        </div>
        <div class="col-12">
          <label for="image" class="form-label">Category Image</label>
          <input type="file" class="form-control" name="image" id="image" onchange="previewImage(event)">
          <small class="text-danger text-sm font-weight-bold" id="image-error"></small>
        </div>
        <div>
          <img id="preview" 
            @if(isset($category['image']))
              src="{{ url('images/'.$category['image']) }}"
              @endif
            class="w-25" />
        </div>
        <div class="text-left">
          <button type="submit" class="btn btn-primary">Save</button>
          <a href="{{route('admin.dishcategory.index')}}" class="btn btn-secondary">Back</a>
        </div>
        
      </form><!-- Vertical Form -->

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
        $('#name-error').text('');
          $('#image-error').text('');
        e.preventDefault();
        var formData = new FormData(this);
        
        $.ajax({
        type:'POST',
        url:"{{ route('admin.dishcategory.create') }}",
        cache:false,
        data :formData,
        contentType : false, // you can also use multipart/form-data replace of false
        processData: false,
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        //  data:{name:name, email:email, contact:contact, cource:cource},
        dataType:'json',
        error: function (response) {
          event.preventDefault();
          $('#name-error').text(response.responseJSON.errors.name);
          $('#image-error').text(response.responseJSON.errors.image);
        },
          success:function(data){
            if(data.status ==200){
              $('#preview').removeAttr('src');
               $('#SubmitForm').trigger("reset");
               $('#preview').removeAttr('src');
              Swal.fire({
                title:'Good job!',
                text : data.message,
                icon :'success',
                confirmButtonText: 'Ok',
              }).then((result) => {
                if (result.isConfirmed) {
                  window.location.href = "{{ route('admin.dishcategory.index') }}"
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
        }
        });

    });



      
</script>
  @endsection

