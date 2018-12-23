@extends('news.main')
@section('title',$cat->nama_categorie)
@section('content')
<!-- ##### Blog Area Start ##### -->
<div class="blog-area section-padding-0-80">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="blog-posts-area">
                @foreach($data as $dat)
                    <!-- Single Featured Post -->
                    <div class="single-blog-post featured-post mb-30">
                            <div class="post-thumb">
                                <a href="{{route($dat->route.'.read',['url'=>$dat->url_title,'id'=>$dat->id])}}"><img src="{{App\Libs\Helper::url('images/photos/'.$dat->filename)}}" alt=""></a>
                            </div>
                            <div class="post-data">
                                <a href="{{route($dat->route.'.cat',['url'=>$dat->url_categorie])}}" class="post-catagory">{{$dat->kategori}}</a>
                                <a href="{{route($dat->route.'.read',['url'=>$dat->url_title,'id'=>$dat->id])}}" class="post-title">
                                    <h6>{{$dat->title}}</h6>
                                </a>
                                <div class="post-meta">
                                    <p class="post-author">By <a href="#">{{$dat->name}}</a></p>
                                    <p class="post-excerp">{{$dat->description}}</p>
                                </div>
                            </div>
                    </div>
                @endforeach
                </div>

                {{$data->links('vendor.pagination.bootstrap-4')}}

            </div>

            
            <div class="col-12 col-lg-4">
                @include('news.sidebar.featured-sidebar')
               
            </div>

        </div>
    </div>
</div>
<!-- ##### Blog Area End ##### -->
@endsection