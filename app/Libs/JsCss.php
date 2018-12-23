<?php

namespace App\Libs;
use App\Libs\Helper;

class JsCss
{
   public function css($filename)
   {
    $attr = '';
       switch ($filename) {
           case 'Bootstrap v4.1.0': $url = Helper::url('themes/css/bootstrap.min.css'); break;
           case 'Owl Carousel v2.2.1': $url = Helper::url('themes/css/owl.carousel.min.css'); break;
           case 'Animate.css': $url = Helper::url('themes/css/animate.css'); break;
           case 'magnific-popup.css': $url = Helper::url('themes/css/magnific-popup.css'); break;
           case 'Font Awesome 4.7.0': $url = Helper::url('themes/css/font-awesome.min.css'); break;
           case 'custom-icon.css': $url = Helper::url('themes/css/custom-icon.css'); break;
           case 'classy-nav.min.css': $url = Helper::url('themes/css/classy-nav.min.css'); break;
           case 'nice-select.min.css': $url = Helper::url('themes/css/nice-select.min.css'); break;
           case 'Master Stylesheet - v1.0': $url = Helper::url('themes/style.css'); break;
           case 'cyrillic-ext': $url = "https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900"; break;
           case 'custom-style': $url = Helper::url('themes/css/custom-style.css'); break;
       }

       return '<link rel="stylesheet" href="'.$url.'" '.$attr.'/>'."\n";
   }

   public function js($filename)
   {
       $attr = '';
       switch ($filename) {
           case 'jquery-2.2.4.min': $url = Helper::url('themes/js/jquery/jquery-2.2.4.min.js'); break;
           case 'popper.min': $url = Helper::url('themes/js/bootstrap/popper.min.js'); break;
           case 'Bootstrap v4.1.0': $url = Helper::url('themes/js/bootstrap/bootstrap.min.js'); break;
           case 'plugins': $url = Helper::url('themes/js/plugins/plugins.js'); break;
           case 'active': $url = Helper::url('themes/js/active.js'); break;
           case 'moment': $url = url('js/moment.min.js');
            break;
       }

       return '<script src="'.$url.'" '.$attr.'></script>'."\n";
   }
}
