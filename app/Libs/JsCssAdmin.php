<?php

namespace App\Libs;

class JsCssAdmin
{
   public function css($filename)
   {
    $attr = '';
       switch ($filename) {
           case 'Bootstrap v4.1.3': $url = url('vendor/bootstrap/css/bootstrap.min.css'); 
              break;
           case 'Font Awesome 5.3.1': $url = url('vendor/fontawesome-free/css/all.min.css'); break;
            case 'SB Admin v5.0.2': $url = url('css/sb-admin.css'); break;
          
       }

       return '<link rel="stylesheet" href="'.$url.'" type="text/css" '.$attr.'/>'."\n";
   }

   public function js($filename)
   {
       $attr = '';
       switch ($filename) {
           case 'jQuery v3.3.1': $url = url('vendor/jquery/jquery.min.js'); 
            break;
           case 'Bootstrap v4.1.3': $url = url('vendor/bootstrap/js/bootstrap.bundle.min.js');
            break;
            case 'Vue.js v2.5.17': $url = url('js/vue.min.js');
            break;
            case 'axios v0.18.0': $url = url('js/axios.min.js');
            break;
            case 'SB Admin v5.0.2': $url = url('js/sb-admin.min.js');
            break;
            case 'vuelidate.min': $url = url('js/vuelidate.min.js');
            break;
            case 'validators.min': $url = url('js/validators.min.js');
            break;
            case 'jquery-sortable.js v0.9.13': $url = url('js/jquery-sortable.js');
            break;
            case 'Lodash 4.17.11': $url = url('js/lodash.js');
            break;
            case 'ckeditor4': $url = url('vendor/ckeditor4/ckeditor.js');
            break;
            case 'moment': $url = url('js/moment.min.js');
            break;
          
       }

       return '<script src="'.$url.'" '.$attr.'></script>'."\n";
   }
}
