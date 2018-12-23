<?php

namespace App\Libs;

class Helper
{
   public static  function url($uri = '')
   {
      $http='https';
      // if (\Request::secure())
      // {
      //   $http = "https";
      // } else {
      //   $http =  "http";
      // }
      $uri =  trim($uri,'/');
      $host = $_SERVER['HTTP_HOST'];
      preg_match("/[^\.\/]+\.[^\.\/]+$/", $host, $matches);
      return $http.'://'.$matches[0].'/'.$uri;
   }

}
