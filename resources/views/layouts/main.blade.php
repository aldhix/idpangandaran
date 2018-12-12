<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>IDPangandaran Admin - @yield('title')</title>
    <!-- Bootstrap core CSS-->
    <link href="{{url('vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Custom fonts for this template-->
   <link href="{{url('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <!-- Custom styles for this template-->
    <link href="{{url('css/sb-admin.css')}}" rel="stylesheet">
    @stack('css')
  </head>
  <body id="page-top">

    @include('layouts.main.navbar')

    <div id="wrapper">

      <!-- Sidebar -->
      @include('layouts.main.sidebar') 
      
      <div id="content-wrapper">

        <div class="container-fluid">
          @if(url()->current() != route('home'))
          <!-- Breadcrumbs-->
          @include('layouts.main.breadcrumb')
          @endif
          <!-- Page Content -->
          @yield('content')

        </div>
        <!-- /.container-fluid -->

        <!-- Sticky Footer -->
        <footer class="sticky-footer">
          <div class="container my-auto">
            <div class="copyright text-center my-auto">
              <span>Copyright © Your Website 2018</span>
            </div>
          </div>
        </footer>

      </div>
      <!-- /.content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>
    @include('layouts.main.modal-delete')
     <!-- Bootstrap core JavaScript-->
    <script src="{{url('vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{url('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- Core plugin JavaScript-->
 <!--    <script src="{{url('vendor/jquery-easing/jquery.easing.min.js')}}"></script>
 -->
    <!-- Custom scripts for all pages-->
    <script src="{{url('js/sb-admin.min.js')}}"></script>
    @stack('js')

  </body>
</html>
