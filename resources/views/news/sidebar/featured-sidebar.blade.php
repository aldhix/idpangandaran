 <!-- Single Featured Post -->
<?php 
$recent = \App\RecentCategoriesPost::joinSelect()
->where('domains.route','news')
->orderBy('posts.id','desc')->limit(5)->get();
?>
@foreach($recent as $rec)
<div class="single-blog-post small-featured-post d-flex">
    <div class="post-thumb">
        <a href="{{route($rec->route.'.read',['url'=>$rec->url_title,'id'=>$rec->id])}}">
            <img src="{{App\Libs\Helper::url('images/photos/thumbs/thumb_'.$rec->filename)}}" alt="">
        </a>
    </div>
    <div class="post-data">
        <a href="{{route($rec->route.'.cat',['url'=>$rec->url_categorie])}}" class="post-catagory">{{$rec->kategori}}</a>
        <div class="post-meta">
            <a href="{{route($rec->route.'.read',['url'=>$rec->url_title,'id'=>$rec->id])}}" class="post-title">
                <h6>{{$rec->title}}</h6>
            </a>
            <p class="post-date">
            {{ date_format(date_create($rec->create),"h:i A | M d")}}
            </p>
        </div>
    </div>
</div>
@endforeach
