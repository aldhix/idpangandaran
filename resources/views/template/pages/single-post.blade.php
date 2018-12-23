@extends('template.main')
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
                            <a href="#"><img src="img/bg-img/25.jpg" alt=""></a>
                        </div>
                        <div class="post-data">
                            <a href="#" class="post-catagory">Finance</a>
                            <a href="#" class="post-title">
                                <h6>Financial news: A new company is born today at the stock market</h6>
                            </a>
                            <div class="post-meta">
                                <p class="post-author">By <a href="#">Christinne Williams</a></p>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eu metus sit amet odio sodales placerat. Sed varius leo ac leo fermentum, eu cursus nunc maximus. Integer convallis nisi nibh, et ornare neque ullamcorper ac. Nam id congue lectus, a venenatis massa. Maecenas justo libero, vulputate vel nunc id, blandit feugiat sem.</p>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque consectetur, purus imperdiet volutpat tincidunt, eros sem mollis quam, ut placerat urna neque at massa. Proin vitae pulvinar justo. Donec vel placerat enim, at ultricies risus. In posuere luctus sem, ac dapibus felis semper quis. Integer ex ante, semper at velit nec, ultrices aliquet diam. Donec gravida non metus blandit facilisis. Cras tincidunt, lorem aliquam molestie eleifend, libero dui volutpat dui, nec sodales massa libero ut metus. Mauris pretium elit ut dapibus consequat. Nam ut lorem nec sem dignissim gravida. Duis fringilla, augue eget lacinia tincidunt, neque leo maximus sem, sed tristique enim orci id quam.</p>
                                <p>Donec turpis erat, scelerisque id euismod sit amet, fermentum vel dolor. Nulla facilisi. Sed pellentesque lectus et accumsan aliquam. Fusce lobortis cursus quam, id mattis sapien. Aliquam erat volutpat. Aliquam placerat, est quis sagittis tincidunt, ipsum eros posuere mi, ut finibus quam sem eget ex. Interdum et malesuada fames ac ante ipsum primis in faucibus. Donec commodo quis enim ac auctor. Ut et mollis felis, sit amet ultricies est. Suspendisse sed faucibus tortor.</p>
                                <a href="#" class="related--post">Related: Facebook announces changes to combat election meddling</a>
                                <p>Donec turpis erat, scelerisque id euismod sit amet, fermentum vel dolor. Nulla facilisi. Sed pellentesque lectus et accu msan aliquam. Fusce lobortis cursus quam, id mattis sapien. Aliquam erat volutpat. Aliquam placerat, est quis sagi ttis tincidunt, ipsum eros posuere mi, ut finibus quam sem eget ex. Interdum et malesuada fames ac ante ipsum pr imis in faucibus. Donec commodo quis enim ac auctor. Ut et mollis felis, sit amet ultricies est. Suspendisse sed faucibus tortor. </p>
                               
                            </div>
                        </div>
                    </div>

                    <!-- About Author -->
                    <div class="blog-post-author d-flex">
                        <div class="author-thumbnail">
                            <img src="{{url('themes/img/bg-img/32.jpg')}}" alt="">
                        </div>
                        <div class="author-info">
                            <a href="#" class="author-name">James Smith, <span>The Author</span></a>
                            <p>Donec turpis erat, scelerisque id euismod sit amet, fermentum vel dolor. Nulla facilisi. Sed pellen tesque lectus et accu msan aliquam. Fusce lobortis cursus quam, id mattis sapien.</p>
                        </div>
                    </div>

                    <!-- Pager -->
          
                    <!-- Releated-->         

                    <!-- Comment Area Start -->
                   
                    <!-- post-a-comment-area -->
                   
                </div>
            </div>

            
            <div class="col-12 col-lg-4">
                @include('template.sidebar.featured-sidebar')
               
            </div>

        </div>
    </div>
</div>
<!-- ##### Blog Area End ##### -->
@endsection