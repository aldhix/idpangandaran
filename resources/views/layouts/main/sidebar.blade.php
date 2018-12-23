<ul class="sidebar navbar-nav">
    <li class="nav-item">
      <a class="nav-link" href="{{route('home')}}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span>
      </a>
    </li>
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-link"></i>
        <span>Kategori</span>
      </a>
      <div class="dropdown-menu" aria-labelledby="pagesDropdown">
        @foreach(\App\Domain::orderBy('id','asc')->get() as $r)
        <a class="dropdown-item" href="{{route('admin.categorie',['id'=>$r->id])}}">
        {{$r->domain}}</a>
        @endforeach
      </div>
    </li>
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-link"></i>
        <span>Post</span>
      </a>
      <div class="dropdown-menu" aria-labelledby="pagesDropdown">
        @foreach(\App\Domain::orderBy('id','asc')->get() as $r)
        <a class="dropdown-item" href="{{route('admin.post',['id'=>$r->id])}}">
        {{$r->domain}}</a>
        @endforeach
      </div>
    </li>
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-cog"></i>
        <span>Setting</span>
      </a>
      <div class="dropdown-menu" aria-labelledby="pagesDropdown">
        <a class="dropdown-item" href="{{route('admin.domain')}}">Domain</a>
        <a class="dropdown-item" href="{{route('admin.menu')}}">Menu</a>
      </div>
    </li>
  </ul>