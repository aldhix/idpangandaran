@extends('template.main')
@section('title','Home')
@section('content')

 <!-- ##### Featured Post Area Start ##### -->
    @include('template.headline')
    <!-- ##### Featured Post Area End ##### -->
    <!-- ##### Popular News Area Start ##### -->
    @include('template.recent')
    <!-- ##### Popular News Area End ##### -->

    <!-- ##### Video Post Area Start ##### -->
    <!-- include('template.video') -->
    <!-- ##### Video Post Area End ##### -->

    <!-- ##### Editorial Post Area Start ##### -->
    <!-- include('template.editor') -->
    <!-- ##### Editorial Post Area End ##### -->

    <!-- ##### Footer Add Area Start ##### -->
   <!-- include('template.footer-add') -->
    <!-- ##### Footer Add Area End ##### -->


@endsection