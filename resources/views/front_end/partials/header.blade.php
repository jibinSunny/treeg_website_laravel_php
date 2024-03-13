@php
$menus = [
    [
        "title" => "Home",
        "icon" => "fa-sitemap",
        "actives" => ['home*'],
        "route" => "home",
      
    ],
    [
        "title" => "Projects",
        "icon" => "fa-video-camera",
        "actives" => ['projects*','project/category*','project/view*'],
        "route" => "projects",
  
    ],
    [
        "title" => "Testimonials",
        "icon" => "fa-video-camera",
        "actives" => ['testimonials*'],
        "route" => "testimonials",
  
    ],

    [
        "title" => "Media",
        "icon" => "fa-video-camera",
        "actives" =>['photo_gallary*','video_gallary*','news_events_gallary*','photo_gallary/view*'],
        "route" => "#",
        "submenus" => [
            [
                "title" => "Photo Gallery",  
                "actives" => ['photo_gallary*'],
                "route" => "photo_gallary",
            ],
            [
                        "title" => "Video Gallery",
                        "actives" => ['video_gallary*'],
                        "route" => "video_gallary",
            ],
            [
                        "title" => "News & Events",
                        "actives" => ['news_events_gallary*'],
                        "route" => "news_events_gallary",
            ],
            

        ]
  
    ],
    [
        "title" => "About Us",
        "icon" => "fa-video-camera",
        "actives" => ['about*'],
        "route" => "about",
  
    ],
    [
        "title" => "Contact Us",
        "icon" => "fa-video-camera",
        "actives" => ['contact*'],
        "route" => "contact",
  
    ],


  


];
@endphp
<style>
    .owl-theme .owl-controls .owl-page {
        margin: 0px 8px;
    }
    .fixed {
        position: fixed !important;
        top: 146px;
        left: 0;
        width: 100%;
        z-index: 99;
    }
    #amini  .owl-controls .owl-page {
        display: inline-block;
        margin: 0px 0px;
    }
    #amini .active span{
        background-color: #8A9E43;
        width: 18px;
    }
    #amini .owl-controls .owl-page span {
        margin: 5px 2px;
    }
    @media (max-width: 992px){
        .fixed {
            position: fixed !important;
            left: 0;
            width: 100%;
            z-index: 99;
            bottom: 0px;
            top: auto !important;
            padding-top: 10px;
                display: none;
        }
        .pc_none{
            display: none;
        }
        .project-pad-align {
            width: 100%;
        }
        .text-map-dec {
            width: 70%;
        }
        .aminity-align {
            display: none;
        }

          
    }
    @media (max-width: 576px){
        
        div#navbarSupportedContent {
            display: none !important;
        }
    }
    @media(min-width: 992px){
        .div_pc_block{
            display: block;
        }
    }
    span.spec_info span:last-child {
        display: inline;
        margin-left: 6px;
    }
    </style>

<nav class="navbar navbar-expand-lg navbar-light fixed-top">
    <div class="container">
        <a class="navbar-brand" href="/">
            <img src="{{url('images/logo.png')}}" class="img-fluid">
        </a>
        <button class="navbar-toggler show-side-nav" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse 	 " id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto topnav">
            @foreach($menus as $menu)
            @php
                    $active="";
                    foreach($menu['actives'] as $act){
                    if(request()->is($act)) $active="active";
                    }
                @endphp
                @if($menu['title'] !="Media")
            <li class="nav-item  {{ $active }}">
                    <a class="nav-link" href="{{ url($menu['route']) }}">{{ $menu['title'] }}  <span class="sr-only">(current)</span></a>
                </li>
                @else
                <li class="nav-item dropdown {{ $active }}">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Media</a>
                    @if(!empty($menu['submenus']))
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    @foreach($menu['submenus'] as $submenu)
                                @php
                                    $subactive="";
                                    foreach($submenu['actives'] as $act){
                                    if(request()->is($act)) $subactive="active";
                                    }
                                @endphp
                        <a class="dropdown-item {{ $subactive }}" href="{{ url($submenu['route']) }}">{{ $submenu['title'] }}</a>
                        @endforeach
                    </div>  
                    @endif
                </li>
                @endif
             @endforeach
             
              
             
             
             
             
             
             
             
             
             
             
             
   
            </ul>
        </div>    
    </div>
    </nav>

<!-- 
    mobile menu -->

<!-- side navigation fullpage menu -->
<div class="d-block d-sm-none">
    <div class="side-menu-bg fadeInRight">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 col-6 barand-side-nav">
                    <img src="{{url('images/logo.png')}}" class="img-fluid">
                </div>
                <div class="col-lg-6 col-6 close-icon-menu">
                    <img src="{{url('images/close2.png')}}" class="img-fluid close-nav-bg">
                </div>
            </div>
            <div class="nav-items-center">
                <ul>
                    @foreach($menus as $menu)
                    @php
                    $active="";
                    foreach($menu['actives'] as $act){
                    if(request()->is($act)) $active="active";
                    }
                    @endphp
                    <li class="{{ $active }} mobile_drop">  <a href="{{ url($menu['route']) }}">{{ $menu['title'] }}</a>
                        @if(!empty($menu['submenus']))
                        <ul class="mob_drop_child">
                            @foreach($menu['submenus'] as $submenu)
                            @php
                            $subactive="";
                            foreach($submenu['actives'] as $act){
                            if(request()->is($act)) $subactive="active";
                            }
                            @endphp
                            <li class="{{ $subactive }}"><a href="{{ url($submenu['route']) }}">{{ $submenu['title'] }}</a></li>
                            @endforeach
                        </ul>
                        @endif

                    </li>

                    <!-- <li class="drop-click1 active-community"><span class="nmbr-text">04</span> <a> Media <i class="fa fa-caret-down" aria-hidden="true"></i></a></li> -->
                    

                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function(){
    $(".show-side-nav").click(function(){
      $(".side-menu-bg").show();
    });
    $(".close-nav-bg").click(function(){
      $(".side-menu-bg, .drop-text1, .drop-text2, .drop-text3").fadeOut();
    });


    $(".drop-click1").click(function(){
      $(".drop-text1").slideToggle('slow');
    });
    $(".drop-click2").click(function(){
      $(".drop-text2").slideToggle('slow');
    });

    $(".active-community").click(function(){
      $(".drop-text2").slideUp('slow');
    });
    $(".active-events").click(function(){
      $(".drop-text1").slideUp('slow');
    });
});
</script>