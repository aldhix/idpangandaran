    <div class="hero-area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 col-lg-8">
                    <!-- Breaking News Widget -->
                    <div class="breaking-news-area d-flex align-items-center">
                        <div class="news-title">
                            <p>Breaking News</p>
                        </div>
                        <div id="breakingNewsTicker" class="ticker">
                            <ul>
                            <?php
                            $data = \App\Post::joinSelect()
                            ->where('categories.id_domain',2)->limit(4)->get();
                            ?>
                            @foreach($data as $r)
                                <li>
                                    <a href="{{route($r->route.'.read',['url'=>$r->url_title,'id'=>$r->id])}}">
                                   {{$r->title}}
                                    </a>
                                </li>
                            @endforeach   
                            </ul>
                        </div>
                    </div>

                    <!-- Breaking News Widget -->
                    <div class="breaking-news-area d-flex align-items-center mt-15">
                        <div class="news-title title2">
                            <p>Info Wisata</p>
                        </div>
                        <div id="internationalTicker" class="ticker">
                            <ul>
                                <?php
                                $data = \App\Post::joinSelect()
                                ->where('categories.id',13)->limit(4)->get();
                                ?>
                                @foreach($data as $r)
                                    <li>
                                        <a href="{{route($r->route.'.read',['url'=>$r->url_title,'id'=>$r->id])}}">
                                       {{$r->title}}
                                        </a>
                                    </li>
                                @endforeach  
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Hero Add -->
                <div class="col-12 col-lg-4">
                    <div class="hero-add">
                        <a href="#"><img src="{{App\Libs\Helper::url('themes/img/bg-img/hero-add.gif')}}" alt=""></a>
                    </div>
                </div>
            </div>
        </div>
    </div>