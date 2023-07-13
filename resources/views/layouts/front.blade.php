<!DOCTYPE html>
<html>

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <link href="{{ asset('front/images/favicon.png') }}" rel="stylesheet">
  <title> RoofTop Restaurant </title>

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="{{ asset('front/css/bootstrap.css') }}" />

  <!--owl slider stylesheet -->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
  <!-- nice select  -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.min.css" integrity="sha512-CruCP+TD3yXzlvvijET8wV5WxxEh5H8P4cmz0RFbKK6FlZ2sYl3AEsKlLPHbniXKSrDdFewhbmBK5skbdsASbQ==" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"  />
  <!-- font awesome style -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" />
  {{-- toster --}}
  <link href="{{ asset('front/css/font-awesome.min.css') }}" rel="stylesheet">
  <link href="{{ asset('front/css/style.css') }}" rel="stylesheet">
  <link href="{{ asset('front/css/responsive.css') }}" rel="stylesheet">
  <style>
    .disabled-link {
      cursor: not-allowed;
      pointer-events: none;
      opacity: 0.7;
    }
  </style>
  @yield('style')

</head>






  <!-- end client section -->
  @yield('content')

  <!-- footer section -->
  <footer class="footer_section">
    <div class="container">
      <div class="row">
        <div class="col-md-4 footer-col">
          <div class="footer_contact">
            <h4>
              Contact Us
            </h4>
            <div class="contact_link_box">
             
              @if(isset($settings->address))
                <a href="">
                  <i class="fa fa-envelope" aria-hidden="true"></i>
                  <span>
                    {{ $settings->address }}
                  </span>
                </a>
              @endif
              @if(isset($settings->mobile))
                <a href="">
                  <i class="fas fa-mobile"></i>
                  <span>
                    {{ $settings->mobile }}
                  </span>
                </a>
              @endif
              @if(isset($settings->phone))
                <a href="">
                <i class="fa fa-phone" aria-hidden="true"></i>
                  <span>
                    {{ $settings->phone }}
                  </span>
                </a>
              @endif
              @if(isset($settings->email))
                <a href="">
                  <i class="fa fa-envelope" aria-hidden="true"></i>
                  <span>
                    {{ $settings->email }}
                  </span>
                </a>
              @endif
            </div>
          </div>
        </div>
        <div class="col-md-4 footer-col">
          <div class="footer_detail">
            <a href="" class="footer-logo">
              RoofTop
              
            </a>
            {{ $settings->aboutus }}
            <div class="footer_social">
                @if(isset($settings->twitter))
                <a href="{{ $settings->twitter }}">
                  <i class="fa fa-twitter" aria-hidden="true"></i>
                </a>
                @endif
                @if(isset($settings->youtube))
                <a href="{{ $settings->youtube }}">
                  <i class="fa-brands fa-youtube" aria-hidden="true"></i>
                </a>
                @endif
                @if(isset($settings->tiktok))
                <a href="{{ $settings->tiktok }}">
                  <i class="fab fa-tiktok" style="color"></i>
                </a>
                @endif
                @if(isset($settings->insta))
                <a href="{{ $settings->insta }}">
                  <i class="fa fa-instagram" aria-hidden="true"></i>
                </a>
                @endif
                @if(isset($settings->facebook))
                <a href="{{ $settings->facebook }}">
                  <i class="fa fa-facebook" aria-hidden="true"></i>
                </a>
                @endif
            </div>
          </div>
        </div>
        <div class="col-md-4 footer-col">
          <h4>
            Opening Hours
          </h4>
          <p>
            Everyday
          </p>
          <p>
            24/7
          </p>
        </div>
      </div>
      <div class="footer-info">
        <p>
          &copy; <span id="displayYear"></span> All Rights Reserved By
          <a href="">RoofTop Restro</a><br><br>
          &copy; <span id="displayYear"></span> Developed By
          <a href="http://cupsandcode.com/" target="_blank">Cups&Code</a>
        </p>
      </div>
    </div>
  </footer>
  <!-- footer section -->

  <!-- jQery -->
  <script src="{{ asset('front/js/jquery-3.4.1.min.js') }}"></script>
  <!-- popper js -->
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
  </script>
  <!-- bootstrap js -->
  <script src="{{ asset('front/js/bootstrap.js') }}"></script>
  <!-- owl slider -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js">
  </script>
  <!-- isotope js -->
  <script src="https://unpkg.com/isotope-layout@3.0.4/dist/isotope.pkgd.min.js"></script>
  <!-- nice select -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js"></script>
  <!-- custom js -->
  <script src="{{ asset('front/js/custom.js') }}"></script>
  <!-- Google Map -->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCh39n5U-4IoWpsVGUHWdqB6puEkhRLdmI&callback=myMap"> </script>
   {{-- toster --}}
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" ></script>
  <script src="{{ asset('front/js/custom.js') }}"></script>
  <script src="{{ asset('front/js/global.js') }}"></script>
 
  <!-- End Google Map -->
  @yield('script')
</body>

</html>