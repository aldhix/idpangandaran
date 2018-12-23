<header class="header-area">

<!-- Top Menu-->
<div class="nav-top">
      <div class="container">
       <nav class="navbar navbar-expand-lg navbar-dark bg-transparent p-0">
          <div class="collapse navbar-collapse" id="navbarTop">
            <ul class="navbar-nav">
              <li class="nav-item active">
                <a class="nav-link" href="{{route('index')}}">Home <span class="sr-only">(current)</span></a>
              </li>
              <?php 
                $top_menus = App\Menu::where('type_menu',1)->orderBy('sort_menu','asc')->get();
              ?>
              @foreach($top_menus as $top)
              <li class="nav-item">
                <a class="nav-link" href="{{$top->url_menu}}">{{$top->nama_menu}}</a>
              </li>
              @endforeach
            </ul>
          </div>
        </nav>
    </div>
 </div>


    <!-- Top Header Area -->
    <div class="top-header-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="top-header-content d-flex align-items-center justify-content-between">
                        <!-- Logo -->
                        <div class="logo">
                            <a href="{{route('news.home')}}">
                            <img src="{{App\Libs\Helper::url('themes/img/core-img/logo.png')}}" 
                            alt=""> <span class="badge text-white">News</span></a>
                        </div>

                        <div class="navbar-dark mr-auto d-lg-none">
                            <button 
                            class="btn bg-transparent" 
                            type="button" data-toggle="collapse" 
                            data-target="#navbarTop">
                              <span class="navbar-toggler-icon"></span>
                            </button>
                        </div>

                        <!-- Login Search Area -->
                        <div class="login-search-area d-flex align-items-center">
                            
                            <!-- Login -->
                            <!-- <div class="login d-flex">
                                <a href="#">Login</a>
                                <a href="#">Register</a>
                            </div> -->
                            <!-- Search Form -->
                           

                            <div class="search-form">
                            <?php 
                                $keyword = isset($_GET['keyword']) ? $_GET['keyword']: null;
                            ?>
                                <form action="{{route('news.search')}}" method="get">
                                    <input type="search" name="keyword" class="form-control" placeholder="Search" value="<?=$keyword?>">
                                    <button type="submit">
                                    <i class="fa fa-search" aria-hidden="true"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Navbar Area -->
    <div class="newspaper-main-menu" id="stickyMenu">
        <div class="classy-nav-container breakpoint-off">
            <div class="container">
                <!-- Menu -->
                <nav class="classy-navbar justify-content-between" id="newspaperNav">

                    <!-- Logo -->
                    <div class="logo">
                        <a href="{{route('news.home')}}">
                        <img src="{{App\Libs\Helper::url('themes/img/core-img/logo.png')}}" alt=""><span class="badge text-white">News</span></a>
                        </a>
                    </div>

                    <!-- Navbar Toggler -->
                    <div class="classy-navbar-toggler">
                        <span class="navbarToggler">
                        <span></span>
                        <span></span>
                        <span></span>
                        </span>
                    </div>

                    <!-- Menu -->
                    <div class="classy-menu">
                        <!-- close btn -->
                        <div class="classycloseIcon">
                            <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                        </div>

                        <!-- Nav Start -->
                        <div class="classynav">
                            <ul> 
                            <?php 
                              $second_menus = App\Menu::where('id_domain',2)
                              ->where('type_menu',2)->orderBy('sort_menu','asc')->get();
                             ?>
                                @foreach($second_menus as $second)
                                <li><a href="{{$second->url_menu}}">{{$second->nama_menu}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                        <!-- Nav End -->
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>
