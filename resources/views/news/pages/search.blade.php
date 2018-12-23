@extends('news.main')
@section('title','Search='.$keyword)
@section('content')
<!-- ##### Blog Area Start ##### -->
<div class="blog-area section-padding-0-80">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-12">
                <div class="title-search">
                    <h3>
                        <small>Pencarian dengan kata kunci kata kunci </small> "{{$keyword}}"
                    </h3>
                </div>
                <hr class="mb-4">
                <div class="blog-posts-area">
                    <!-- Single Featured Post -->
                    @foreach($datas as $dat)
                    <div class="single-blog-post featured-post mb-30">
                        <div class="media">
                          <img src="{{App\Libs\Helper::url('images/photos/thumbs/thumb_'.$dat->filename)}}" class="mr-3" alt="">
                          <div class="media-body post-data">
                            <a href="{{route($dat->route.'.read',['url'=>$dat->url_title,'id'=>$dat->id])}}" class="post-title">
                                <h6>{{$dat->title}}</h6>
                            </a>
                            <a href="{{route($dat->route.'.cat',['url'=>$dat->url_categorie])}}" class="post-catagory">{{$dat->kategori}}</a>
                            <p>{{$dat->description}}</p>
                            <p class="post-date">
                            {{ date_format(date_create($dat->create),"h:i A | M d, Y")}}
                            </p>
                          </div>
                        </div>            
                    </div>
                    @endforeach      
                </div>
                {{ $datas->appends(['keyword' =>$keyword])->links('vendor.pagination.bootstrap-4') }}
            </div>

        </div>
    </div>
</div>
<!-- ##### Blog Area End ##### -->
@endsection

@push('css')
<style type="text/css">
.single-blog-post.featured-post .post-data{
    padding-top: 0;
}
.single-blog-post.featured-post .post-data .post-title h6  {
    font-size: 20px;
    margin-top: 0;
}
</style>
@endpush