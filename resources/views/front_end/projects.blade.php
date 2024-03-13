@extends('front_end.master')
@section('content')

  <link href="css/lightbox.min.css" rel="stylesheet" type="text/css">
  <style type="text/css">
  	.project-banner {
	    height: calc(60vh - 85px) !important;
	}
  </style>

<body>
  <?php

  use Illuminate\Support\Facades\Session;

  session(['data' => url()->current()]);
  // $user=session::get('data');
  ?>
  <!-- header sec -->
 
  @php
  $menus = [
  [
  "title" => "All",
  "actives" => ['projects*'],
  "route" => "projects",

  ],
  [
  "title" => "Ongoing",
  "actives" => ['project/category/1*'],
  "route" => "project/category/1",

  ],


  [
  "title" => "Completed",
  "actives" => ['project/category/2*'],
  "route" => "project/category/2",

  ],
  [
  "title" => "Upcoming",
  "actives" => ['project/category/3'],
  "route" => "project/category/3",

  ],





  ];
  @endphp
  <div class="project-banner">
  </div>
  <div class="container width-container">
    <div class="row">
      <div class="col-lg-12">
        <div class="project-bot-mrnu" align="center">
          <div class="scrollmenu">
            @include('front_end.partials.messages')
            @foreach($menus as $menu)
            @php
            $active="";
            foreach($menu['actives'] as $act){
            if(request()->is($act)) $active="active-first";
            }
            @endphp
            <a class="{{ $active }}" href="{{ url($menu['route']) }}">{{ $menu['title'] }}</a>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
  <section>


    <section>
      <div class="container width-container">
        <div class="align-pad-project-div">
          <div class="row ">
            @foreach($projects as $projects)
            <div class="col-lg-4 mpb20">
              <a href="{{ url('project/view/') }}/{{ $projects->id }}">
                <div class="hover-proprety">
                  <div class="project-image-bg">
                    <img src="{{ asset(Storage::url($projects->image)) }}" class="img-fluid">
                  </div>
                  <div class="contants-bg">
                    <p class="heading-text1">{{$projects->title}}</p>
                    @if($projects->status=="1")
                    <p class="heading-text2">Ongoing</p>
                    @elseif($projects->status=="2")
                    <p class="heading-text2">Completed</p>
                    @elseif($projects->status=="3")
                    <p class="heading-text2">Upcoming</p>
                    @endif
                    <?php
                    $text = str_ireplace('<p>', '', $projects->description);
                    $text1 = str_ireplace('</p>', '', $text);
                    $text2 = html_entity_decode($text1);

                    ?>
                    <p class="heading-text3 ellipsis">{{$text2}}</p>
                  </div>
                </div>
              </a>
            </div>
            @endforeach
          </div>
        </div>

        <!-- pc size  project-deatails close -->

      </div>
    </section>



    <div class="mobile_footer_manu">
      <div class="top_menu_mfm hide">
        <div class="scrollmenus_mob">
          @include('front_end.partials.messages')
          @foreach($menus as $menu)
          @php
          $active="";
          foreach($menu['actives'] as $act){
          if(request()->is($act)) $active="active-first";
          }
          @endphp
          <a class="" href="{{ url($menu['route']) }}">{{ $menu['title'] }}</a>
          @endforeach
        </div>
      </div>
      <div class="inner_mfm">
        <div class="row_man">
          <div class="pr_menu tl">
            <span>Project Menu</span>
          </div>
          <div class="pr_menu tr">
            <span><i class="fa fa-angle-up" aria-hidden="true"></i></span>
          </div>
          <div style="clear:both;"></div>
        </div>
      </div>
    </div>


    <!-- footer section -->

</body>
@endsection