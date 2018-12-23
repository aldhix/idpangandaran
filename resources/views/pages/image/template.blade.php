<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>ID Pangandaran Admin - Browser Image </title>
    <?php 
    $jscssadmin = new \App\Libs\JsCssAdmin;
    $css = $jscssadmin->css('Bootstrap v4.1.3')
          .$jscssadmin->css('Font Awesome 5.3.1');
     echo $css;
     ?>
    @stack('css')
    
  </head>
  <body>

    @yield('content')

    <?php 
    $js = $jscssadmin->js('jQuery v3.3.1')
          .$jscssadmin->js('Bootstrap v4.1.3');
    echo $js;
    ?>

    @stack('js')

  </body>
</html>
