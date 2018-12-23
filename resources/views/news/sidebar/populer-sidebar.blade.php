<!-- Popular News Widget -->
<?php 
$recent = \App\Post::joinSelect()
->where('domains.route','news')
->inRandomOrder()->limit(4)->get();
$i = 1;
?>
<div class="popular-news-widget mb-30">
    <h3>4 Most Popular</h3>

    <!-- Single Popular Blog -->
    @foreach($recent as $rec)
    <div class="single-popular-post">
        <a href="{{route($rec->route.'.read',['url'=>$rec->url_title,'id'=>$rec->id])}}" 
        class="post-title">
            <h6><span>{{$i}}.</span> {{$rec->title}}</h6>
        </a>
        <p>{{ date_format(date_create($rec->create),"M d, Y")}}</p>
    </div>
    @php $i++ @endphp
    @endforeach

</div>