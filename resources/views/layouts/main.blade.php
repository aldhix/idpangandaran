<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>ID Pangandaran Admin - @yield('title')</title>
    <?php 
    $jscssadmin = new \App\Libs\JsCssAdmin;
    $css = $jscssadmin->css('Bootstrap v4.1.3')
          .$jscssadmin->css('Font Awesome 5.3.1')
          .$jscssadmin->css('SB Admin v5.0.2');
     echo $css;
     ?>
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
    <?php 
    $js = $jscssadmin->js('jQuery v3.3.1')
          .$jscssadmin->js('Bootstrap v4.1.3')
          .$jscssadmin->js('SB Admin v5.0.2');
    echo $js;
    ?>
    @stack('js')

  </body>
</html>
