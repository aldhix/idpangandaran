<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title -->
    <title>News ID Pangandaran | @yield('title')</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{App\Libs\Helper::url('themes/img/core-img/favicon.png')}}" />

    <!-- Core Stylesheet -->
    <?php 
    $jscss = new \App\Libs\JsCss;
    $css = $jscss->css('cyrillic-ext')
           .$jscss->css('Bootstrap v4.1.0')
           .$jscss->css('Owl Carousel v2.2.1')
           .$jscss->css('Animate.css')
           .$jscss->css('magnific-popup.css')
           .$jscss->css('Font Awesome 4.7.0')
           .$jscss->css('custom-icon.css')
           .$jscss->css('classy-nav.min.css')
           .$jscss->css('nice-select.min.css')
           .$jscss->css('Master Stylesheet - v1.0')
           .$jscss->css('custom-style');
    echo $css;
    ?>
    <style type="text/css">
      .logo .badge{
        font-size: 14px;
        font-family: Arial;
      }
    </style>
    @stack('css')
</head>

<body>
   
    <!-- ##### Header Area Start ##### -->
    @include('news.header')
    <!-- ##### Header Area End ##### -->

    <!-- ##### Hero Area Start ##### -->
    <!-- include('news.hero-area') -->
    <!-- ##### Hero Area End ##### -->
    <div class="mb-3" style="margin-top:50px;"></div>
   @yield('content')

   <!-- ##### Footer Area Start ##### -->
    @include('template.footer')
    <!-- ##### Footer Area Start ##### -->
    <!-- ##### All Javascript Files ##### -->
    <?php 
    $js = $jscss->js('jquery-2.2.4.min')
          .$jscss->js('popper.min')
          .$jscss->js('Bootstrap v4.1.0')
          .$jscss->js('plugins')
          .$jscss->js('active');
    echo $js;
    ?>
    @stack('js')
</body>

</html>