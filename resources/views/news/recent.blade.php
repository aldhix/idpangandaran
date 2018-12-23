<?php
$datanotin = \App\Post::joinSelect()
->where('domains.route','news')
->orderBy('posts.id','desc')->limit(3)->get();
foreach($datanotin as $key => $i){
    $idnotin[] = $i->id; 
}
?>
<div class="popular-news-area section-padding-80-50">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-8">
                    <div class="section-heading">
                        <h6>Recents</h6>
                    </div>                  
                    <div class="row">
                        @foreach(
                        \App\Post::joinSelect()
                        ->where('posts.type_save','publish')
                        ->where('domains.route','news')
                        ->whereNotIn('posts.id', $idnotin)
                        ->orderBy('posts.id','desc')
                        ->limit(4)->get()
                        as $rc
                        )
                        <!-- Single Post -->
                        <div class="col-12 col-md-6">
                            <div class="single-blog-post style-3">
                                <div class="post-thumb">
                                    <a href="{{route($rc->route.'.read',['url'=>$rc->url_title,'id'=>$rc->id])}}"><img src="{{App\Libs\Helper::url('images/photos/'.$rc->filename)}}" alt=""></a>
                                </div>
                                <div class="post-data">
                                    <a href="{{route($rc->route.'.cat',['url'=>$rc->url_categorie])}}" class="post-catagory">{{$rc->kategori}}</a>
                                    <a href="{{route($rc->route.'.read',['url'=>$rc->url_title,'id'=>$rc->id])}}" class="post-title">
                                        <h6>{{$rc->title}}</h6>
                                    </a>
                                </div>
                            </div>     
                        </div>
                       @endforeach
                    </div>
                </div>

                <div class="col-12 col-lg-4">
                     <div class="section-heading">
                        <h6>Info</h6>
                    </div>
                   @include('news.sidebar.populer-sidebar')
                   <!-- include('template.sidebar.newsletter-sidebar') -->
                </div>
            </div>
        </div>
    </div>