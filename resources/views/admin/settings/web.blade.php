@extends('layouts.admin')
@section('styles')
<link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Web Settings</h4>
        <form class="row" id="SubmitForm">
          <div class="col-md-3">
            <label for="email">Email</label>
          </div>
          <div class="col-md-9 pb-3">
            @if(isset($setting['id']))
            <input type="hidden" name="id" id="id" class="form-control"
            value = "{{ $setting['id'] }}" >
            @endif
            <input type="email" name="email" id="email" class="form-control"
            value = "@if(isset($setting['email'])){{ $setting['email'] }} @endif">
          </div>
          <div class="col-md-3">
            <label for="phone">Phone</label>
          </div>
          <div class="col-md-9 pb-3">
            <input type="text" name="phone" id="phone" class="form-control"
            value = "@if(isset($setting["phone"])){{ $setting["phone"] }} @endif">
          </div>
          <div class="col-md-3">
            <label for="mobile">Mobile</label>
          </div>
          <div class="col-md-9 pb-3">
            <input type="text" name="mobile" id="mobile" class="form-control"
            value = "@if(isset($setting["mobile"])){{ $setting["mobile"] }} @endif">
          </div>
          <div class="col-md-3">
            <label for="facebook">Facebook</label>
          </div>
          <div class="col-md-9 pb-3">
            <input type="text" name="facebook" id="facebook" class="form-control"
            value = "@if(isset($setting["facebook"])){{ $setting["facebook"] }}@endif">
          </div>
          <div class="col-md-3">
            <label for="tiktok">Tiktok</label>
          </div>
          <div class="col-md-9 pb-3">
            <input type="text" name="tiktok" id="tiktok" class="form-control"
            value = "@if(isset($setting["tiktok"])){{ $setting["tiktok"] }}@endif">
          </div>
          <div class="col-md-3">
            <label for="insta">Instagram</label>
          </div>
          <div class="col-md-9 pb-3">
            <input type="text" name="insta" id="insta" class="form-control"
            value = "@if(isset($setting["insta"])){{ $setting["insta"] }}@endif">
          </div>
          <div class="col-md-3">
            <label for="youtube">Youtube</label>
          </div>
          <div class="col-md-9 pb-3">
            <input type="text" name="youtube" id="youtube" class="form-control"
            value = "@if(isset($setting["youtube"])){{ $setting["youtube"] }}@endif">
          </div>
          <div class="col-md-3">
            <label for="twitter">Twitter</label>
          </div>
          <div class="col-md-9 pb-3">
            <input type="text" name="twitter" id="twitter" class="form-control"
            value = "@if(isset($setting["twitter"])){{ $setting["twitter"] }}@endif">
          </div>
         
          <div class="col-md-3">
            <label for="defoultPass">Defoult Password</label>
          </div>
          <div class="col-md-9 pb-3">
            <input type="text" name="defoultPass" id="defoultPass" class="form-control"
            value = "@if(isset($setting["defoultPass"])){{ $setting["defoultPass"] }}@endif">
            <small class="text-danger text-sm font-weight-bold"" id="password-error"></small>
          </div>
          <div class="col-md-3">
            <label for="copyright">Copyright Caption</label>
          </div>
          <div class="col-md-9 pb-3">
           <textarea name="copyright" id="copyright" class="form-control">@if(isset($setting["copyright"])){{ $setting["copyright"] }}@endif</textarea>
          </div>
          <div class="col-md-3">
            <label for="address">Address</label>
          </div>
          <div class="col-md-9 pb-3">
           <textarea name="address" id="address" class="form-control">@if(isset($setting["address"])){{ $setting["address"] }}@endif</textarea>
          </div>
          <div class="col-md-3">
            <label for="aboutus">About Us</label>
          </div>
          <div class="col-md-9 pb-3">
           <textarea name="aboutus" id="aboutus" class="form-control">@if(isset($setting["aboutus"])){{ $setting["aboutus"] }}@endif</textarea>
          </div>
          <div class="col-md-3">
            <label for="map">Map</label>
          </div>
          <div class="col-md-9 pb-3">
           <textarea name="map" id="map" class="form-control">@if(isset($setting["map"])){{ $setting["map"] }}@endif</textarea>
          </div>
          @if(isset($setting->admin->name))
          <div class="col-12">
            <span class="text-success ">Last Updated By {{ $setting->admin->name }} at {{ $setting->updated_at }}</span>
          </div>
          @endif
          <div class="col-12 text-right">
            <input type="submit" name="submit" class="btn btn-primary text-white rounded" value="Save">
          </div>
            {{-- button --}}
          
        </form>
      </div>
  </div>
@endsection

@section('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/35.2.1/classic/ckeditor.js"></script>
<script>
    $("#SubmitForm").on("submit", function(e){
      e.preventDefault();
      var formData = new FormData(this);
      $('#password-error').text('');
      $.ajax({
      type:'POST',
      url:"{{ route('admin.settings.update') }}",
      cache:false,
      data :formData,
      contentType : false, // you can also use multipart/form-data replace of false
      processData: false,
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      //  data:{name:name, email:email, contact:contact, cource:cource},
      dataType:'json',
      error: function (response) {
        event.preventDefault();
        $('#password-error').text(response.responseJSON.errors.defoultPass);
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
                window.location.href = "{{ route('admin.settings.web') }}"
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