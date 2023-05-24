<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Rooftop Resturant</title>
  <meta content="" name="description">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{asset('vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{asset('vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
  <link href="{{asset('vendor/quill/quill.snow.css')}}" rel="stylesheet">
  <link href="{{asset('vendor/quill/quill.bubble.css')}}" rel="stylesheet">
  <link href="{{asset('vendor/remixicon/remixicon.css')}}" rel="stylesheet">
  {{-- datatable --}}
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" >
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>

  {{-- toaster css --}}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" />

  <!-- Template Main CSS File -->
  <link href="{{asset('css/style.css')}}" rel="stylesheet">
  <style>
    .nav-item.active{
      color: white;
      background-color: red;
    }
  </style>
  @yield('styles')
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="/" class="logo d-flex align-items-center">
        <img src="assets/img/logo.png" alt="">
        <span class="d-none d-lg-block">NiceAdmin</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">




        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <span class="d-none d-md-block dropdown-toggle ps-2">{{ Auth::user()->name }}</span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile p-0">
            <li>
              <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="bi bi-box-arrow-right"></i>
                                        {{ __('Logout') }}
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                  @csrf
              </form>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link {{ Route::is('admin.index')  ? 'active' : '' }}" href="{{route('admin.index')}}">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-heading">Pages</li>

      <li class="nav-item">
        <a class="nav-link collapsed {{ Route::is('admin.blog.index') || Route::is('admin.blog.form') ? 'active' : '' }} " href="{{ route('admin.blog.index') }}">
          <i class="fa-solid fa-blog"></i>
          <span>Blogs</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed {{ Route::is('admin.gallery.index') && request()->query('mode') === 'Photo' ? 'active' : '' }}" href="{{ route('admin.gallery.index',['mode'=>'Photo']) }}">
          <i class="fa-solid fa-image"></i>
          <span>Photo Gallery</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed {{ Route::is('admin.gallery.index') && request()->query('mode') === 'Video' ? 'active' : '' }}" href="{{ route('admin.gallery.index',['mode'=>'Video']) }}">
          <i class="fa-solid fa-video"></i>
          <span>Video Gallery</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed {{ request()->is('admin/dishcategory') || request()->is('admin/dishcategory/add') ? 'active' : '' }}" href="{{route('admin.dishcategory.index')}}">
          <i class="fa-solid fa-boxes-stacked"></i>
          <span>Dish Category</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed {{ request()->is('admin/dish') || request()->is('admin/dish/add') ? 'active' : '' }}" href="{{route('admin.dish.index')}}">
          <i class="fa-solid fa-bowl-food"></i>
          <span>Dish</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed {{ request()->is('admin/order') ? 'active' : '' }}" href="{{route('admin.order.index')}}">
          <i class="fa-solid fa-cart-shopping"></i>
          <span>Orders ({{$order_remaining}})</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed {{ request()->is('admin/contact') ? 'active' : '' }}" href="{{route('admin.contact.index')}}">
          <i class="fa-solid fa-address-book"></i>
          <span>Contacts ({{$unseen_contact}})</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed {{ Route::is('admin.others.tindex') || Route::is('admin.others.tform')? 'active' : '' }}" href="{{ route('admin.others.tindex') }}">
          <i class="fa-solid fa-comment"></i>
          <span>Testimonials </span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed {{ Route::is('admin.settings.web') ? 'active' : '' }}" href="{{ route('admin.settings.web') }}">
          <i class="fa-solid fa-gear"></i>
          <span>Settings </span>
        </a>
      </li>
      

    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    @yield('content')
<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
  </main><!-- End #main -->
  <!-- Vendor JS Files -->
  <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
  
  <script src="{{asset('vendor/apexcharts/apexcharts.min.js')}}"></script>
  <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('vendor/chart.js/chart.min.js')}}"></script>
  <script src="{{asset('vendor/echarts/echarts.min.js')}}"></script>
  <script src="{{asset('vendor/quill/quill.min.js')}}"></script>
  <script src="{{asset('vendor/tinymce/tinymce.min.js')}}"></script>
  <script src="{{asset('vendor/php-email-form/validate.js')}}"></script>

  {{-- data table --}}
  <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

  {{-- toasre js --}}
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" ></script>

  <!-- Template Main JS File -->
  <script src="{{asset('js/main.js')}}"></script>


  <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    function generateSlug(){
      title = $("#title").val();
      $("#slug").val(title.replace(' ', '-'));
    }
  </script>

<script>
  $(document).ready( function () {

    $('#dataTable').DataTable();

    $('#lfm').filemanager('image');

      // toaster
      toastr.options = {
      "closeButton": true,
      "debug": false,
      "newestOnTop": true,
      "progressBar": true,
      "positionClass": "toast-top-right",
      "preventDuplicates": false,
      "onclick": null,
      "showDuration": "300",
      "hideDuration": "1000",
      "timeOut": "5000",
      "extendedTimeOut": "1000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut"
      }



  } );
  function showToast(){
      Command: toastr["success"]("iam himalayan pyramids", "Message");
  }
</script>

  @yield('script')
  @yield('scripts')
</body>

</html>