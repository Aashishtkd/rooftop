@extends('layouts.front')
@section('style')
<style>


#demo {
  height:100%;
  position:relative;
  overflow:hidden;
}
.green{
  background-color:#6fb936;
}
.thumb{
    margin-bottom: 30px;
}

.page-top{
    margin-top:85px;
} 
img.zoom {
    width: 100%;
    height: 200px;
    border-radius:5px;
    object-fit:cover;
    -webkit-transition: all .3s ease-in-out;
    -moz-transition: all .3s ease-in-out;
    -o-transition: all .3s ease-in-out;
    -ms-transition: all .3s ease-in-out;
}
.transition {
    -webkit-transform: scale(1.2); 
    -moz-transform: scale(1.2);
    -o-transform: scale(1.2);
    transform: scale(1.2);
}
.modal-header {
   
     border-bottom: none;
}
.modal-title {
    color:#000;
}
.modal-footer{
  display:none;  
}

</style>
@endsection
@section('content')
@include('front/navbar')

  <!-- food section -->

  <section class="food_section layout_padding">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          Our Memoriable Collections
        </h2>
      </div>
      <ul class="filters_menu">
        <li class="active" data-filter="*">All</li>
        <li data-filter=".photos">Photo Gallery</li>
        <li data-filter=".videos">Video Gallery</li>
      </ul>
      
      <div class="filters-content">
        <div class="row grid">
          @foreach ($gallery as $item)
          @if ($item->type == 'photo')
          <div class="col-lg-3 col-md-4 col-xs-6 all photos">
            <a href="{{ url('gallery/'.$item->file) }}?auto=compress&cs=tinysrgb&h=650&w=940" class="fancybox" rel="ligthbox">
                <img  src="{{ url('gallery/'.$item->file) }}?auto=compress&cs=tinysrgb&h=650&w=940" class="zoom img-fluid "  alt="">
            </a>
          </div>
          @else
          <div class="col-lg-3 col-md-4 col-xs-6 all videos">
            <a href="https://www.youtube.com/watch?v={{ $item->file }}" class="fancybox" rel="ligthbox">
                <img src="https://img.youtube.com/vi/{{ $item->file }}/mqdefault.jpg" class="zoom img-fluid" alt="">
            </a>
        </div>
          @endif
          @endforeach

     </div>
      </div>
      {{-- <div class="btn-box">
        <a href="">
          View More
        </a>
      </div>
    </div> --}}
  </section>

  <!-- end food section -->


@endsection
@section('script')
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
<script src="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
  <script>
  $(document).ready(function(){
  $(".fancybox").fancybox({
        openEffect: "none",
        closeEffect: "none"
    });
    
    $(".zoom").hover(function(){
		
		$(this).addClass('transition');
	}, function(){
        
		$(this).removeClass('transition');
	});
});
    
  </script>
@endsection