@extends('news.main')
@section('title',$data->title)
@section('content')
<!-- ##### Blog Area Start ##### -->
<div class="blog-area section-padding-0-80">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="blog-posts-area">

                    <!-- Single Featured Post -->
                    <div class="single-blog-post featured-post single-post">
                        <div class="post-thumb">
                            <img src="{{App\Libs\Helper::url('images/photos/'.$data->filename)}}" 
                            alt="">
                        </div>
                        <div class="post-data">
                            <a href="{{route($data->route.'.cat',['url'=>$data->url_categorie])}}" class="post-catagory">{{$data->kategori}}</a>
                            <a href="{{route($data->route.'.read',['url'=>$data->url_title,'id'=>$data->id])}}" class="post-title">
                                <h6>{{$data->title}}</h6>
                            </a>
                            <div class="post-meta">
                                <p class="post-author">By <a href="#">{{$data->name}}</a></p>
                                <?= $data->content ?>
                            </div>
                        </div>
                    </div>

                    <!-- About Author -->
                   <!--  <div class="blog-post-author d-flex">
                        <div class="author-thumbnail">
                            <img src="@{{url('themes/img/bg-img/32.jpg')}}" alt="">
                        </div>
                        <div class="author-info">
                            <a href="#" class="author-name">James Smith, <span>The Author</span></a>
                            <p>Donec turpis erat, scelerisque id euismod sit amet, fermentum vel dolor. Nulla facilisi. Sed pellen tesque lectus et accu msan aliquam. Fusce lobortis cursus quam, id mattis sapien.</p>
                        </div>
                    </div>
 -->
                    <!-- Pager -->
          
                    <!-- Releated-->         

                    <!-- Comment Area Start -->
                   
                    <!-- post-a-comment-area -->
                   
                </div>
            </div>

            
            <div class="col-12 col-lg-4">
                @include('news.sidebar.featured-sidebar')
               
            </div>

        </div>
    </div>
</div>
<!-- ##### Blog Area End ##### -->
@endsection