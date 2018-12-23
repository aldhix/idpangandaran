    <div class="featured-post-area">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6 col-lg-8">
                    <div class="row">

                        <!-- Single Featured Post -->
                        <?php 
                        $hd1 = \App\Post::joinSelect()->orderBy('id','desc')->first();
                        ?>
                        <div class="col-12 col-lg-7">
                            <div class="single-blog-post featured-post">
                                <div class="post-thumb">
                                    <a href="{{route($hd1->route.'.read',['url'=>$hd1->url_title,'id'=>$hd1->id])}}">
                                    <img src="{{App\Libs\Helper::url('images/photos/'.$hd1->filename)}}" alt="">
                                    </a>
                                </div>
                                <div class="post-data">
                                    <a href="{{route($hd1->route.'.cat',['url'=>$hd1->url_categorie])}}" class="post-catagory">{{$hd1->kategori}}</a>
                                    <a href="{{route($hd1->route.'.read',['url'=>$hd1->url_title,'id'=>$hd1->id])}}" class="post-title">
                                        <h6>{{$hd1->title}}</h6>
                                    </a>
                                    <div class="post-meta">
                                        <p class="post-author">
                                            By <a href="#">{{$hd1->name}}</a>
                                        </p>
                                        <p class="post-excerp">{{$hd1->description}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-lg-5">
                        <?php 
                        $hd2 = \App\Post::joinSelect()
                        ->whereNotIn('posts.id',[$hd1->id])
                        ->orderBy('id','desc')->limit(2)->get();
                         $id_hd[] = $hd1->id;
                        ?>
                          @foreach($hd2 as $h2)
                          <?php $id_hd[] = $h2->id?>
                            <!-- Single Featured Post -->
                            <div class="single-blog-post featured-post-2">
                                <div class="post-thumb">
                                    <a href="{{route($h2->route.'.read',['url'=>$h2->url_title,'id'=>$h2->id])}}">
                                    <img src="{{App\Libs\Helper::url('images/photos/'.$h2->filename)}}" alt=""></a>
                                </div>
                                <div class="post-data">
                                    <a href="{{route($h2->route.'.cat',['url'=>$h2->url_categorie])}}" class="post-catagory">{{$h2->kategori}}</a>
                                    <div class="post-meta">
                                        <a href="{{route($h2->route.'.read',['url'=>$h2->url_title,'id'=>$h2->id])}}" class="post-title">
                                            <h6>{{$h2->title}}</h6>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-4">
                   @include('template.sidebar.featured-sidebar')
                </div>
            </div>
        </div>
    </div>