@extends('front_end.master')
@section('content')
<section>
  <?php
  use Illuminate\Support\Facades\Session;
  session(['data' =>url()->current()]);
  // $user=session::get('data');
  ?>
  <link href="{{ asset('/front_css/lightbox.min.css') }}" rel="stylesheet" type="text/css">
  <style type="text/css">
    
  </style>
  <div class="containerCarousel">
    <div id="home-carousel" class="owl-carousel homeCarousel">
    	<div class="slide">
        <div class="banner-image-bg" style="background-image: url(../images/banner_2.jpg);">
          <div class="overly-bg">
            <h1 class="banner-text">
            <!--  <img src="{{url('images/leafy_png.jpg')}}" class="img_botom_bnr"> -->
            </h1>
          </div>
        </div>
        <h3></h3>
      </div>
      
      <div class="slide">
        <div class="banner-image-bg" style="background-image: url(../images/banner.jpg);">
          <div class="overly-bg">
            <h1 class="banner-text">
            <!-- <img src="{{url('images/talia_logo.png')}}" class="img_botom_bnr"> -->
            </h1>
          </div>
        </div>
        <h3></h3>
      </div>
      
      <div class="slide">
        <div class="banner-image-bg" style="background-image: url(../images/banner_3.jpg)">
          <div class="overly-bg">
            <h1 class="banner-text">
            <!-- <img src="{{url('images/memfield.png')}}" class="img_botom_bnr"> -->
            </h1>
          </div>
        </div>
        <h3></h3>
      </div>
    </div>
  </div>
</section>
<!-- section 2-->
<section>
  <div class="container width-container">
    <div class="row">
      <div class="col-lg-12">
        <h1 class="sec2-head">treeG Touching Generations</h1>
        <p class="sec-2-dec"> 
"In every walk with nature one receives for more than he seeks" treeG builders and developers achieved 100 more satisfied clients by providing them peaceful nature happiness through green villas, created an unique space by touching generations with our trustful values. treeG provides cool, fine quality, luxury villas constructed in heavenly places. Having engraved a trusted name in the field of construction in Malabar, treeG builders is a highly preferred construction major that has completed sum of the prestigious projects with uncompromising standards and comfort level, extensive amenities, convenience, harmony of living and more overvalue of money.</p>
      </div>
    </div>
    <div id="counter" class="bg-counter">
      <div class="row">
        <div class="col-lg-3 col-6">
          <div class="counter-value" data-count="{{$projects_count}}">0</div>
          <p class="count-title">Projects</p>
        </div>
        <div class="col-lg-3 col-6">
          <div class="counter-value" data-count="{{$ongoing_count}}">0</div>
          <p class="count-title">Ongoing</p>
        </div>
        <div class="col-lg-3 col-6">
          <div class="counter-value" data-count="{{$complete_count}}">0</div>
          <p class="count-title">Completed</p>
        </div>
        <div class="col-lg-3 col-6">
          <div class="counter-value" data-count="2">0</div>
          <p class="count-title">Upcoming</p>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- section 3 -->
<section>
  <div class="container width-container">
    <p class="project-head-first">Projects</p>
    <!-- pc size  project-deatails -->
    <div class="ds-none d-sm-block pc_none">
      <div class="row">
        @include('front_end.partials.messages')
        @foreach($projects as $projects)
        <div class="col-md-4">
          <div class="">
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
                  $text1 = str_ireplace('<p>', '', $projects->short_description);
                  $text = str_ireplace('</p>', '', $text1);
                  ?>
                  <p class="heading-text3 ellipsis">{{$text}}</p>
                </div>
              </div>
            </a>
          </div>
        </div>
        @endforeach
      </div>
      <div class="row">
        <div class="col-12">
          <p class="view-all-text"><a href="{{ url('projects') }}">View All Projects <i class="vam fa fa-long-arrow-right" aria-hidden="true"></i></a></p>
        </div>
      </div>
    </div>
    
    <!-- <div class="col-12">
      <p class="view-all-text2"><a href="{{ url('projects') }}">View All Projects <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a></p>
    </div> -->
  </div>
  <!-- pc size  project-deatails close -->
  <!-- mobile size  project-deatails -->
  <div class="d-block d-sm-none">
    <div class="mobile_projects_row">
      <div id="owl-demo-project" class="owl-carousel">
        @foreach($projects_mobile as $vdfvdd)
        <div class="item">
          <div class="col-12">
            <a href="{{ url('project/view/') }}/{{ $vdfvdd->id }}">
              <div class="hover-proprety">
                <div class="project-image-bg">
                  <img src="{{ asset(Storage::url($vdfvdd->image)) }}" class="img-fluid">
                </div>
                
                <div class="contants-bg">
                  <p class="heading-text1">{{$vdfvdd->title}}</</p>
                  @if($vdfvdd->status=="1")
                  <p class="heading-text2">Ongoing</p>
                  @elseif($vdfvdd->status=="2")
                  <p class="heading-text2">Completed</p>
                  @elseif($vdfvdd->status=="3")
                  <p class="heading-text2">Upcoming</p>
                  @endif
                  <?php
                  $text1 = str_ireplace('<p>', '', $vdfvdd->short_description);
                  $text = str_ireplace('</p>', '', $text1);
                  ?>
                  <p class="heading-text3 ">{{$text}}</p>
                </div>
              </div>
            </a>
          </div>
        </div>
        @endforeach
      </div>
      <div class="col-12">
        <p class="view-all-text"><a href="{{ url('projects') }}">View All Projects <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a></p>
      </div>
    </div>
  </div>
  <!-- mobile size  project-deatails close -->
</div>
</section>
<!--//section 3 -->
<!-- section4 -->
<section>
<div class="container width-container">
  <div class="col-md-12">
    <div class="video-box" align="center">
      <iframe width="100%" height="100%" src="https://www.youtube.com/embed/8b99508LqC0" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    </div>
  </div>
</div>
<div class="bg-video-green"></div>
</section>
<section>
<div class="testi-bg">
  <div class="container width-container">
    <div class="row">
      <div class="col-lg-12">
        <p class="heading-testimonials">Testimonials </p>
      </div>
    </div>
    <div class="row">
      <div class="col-md-8 m0auto">
        <div id="owl-demo-testimonials" class="owl-carousel owl-theme">
          @foreach($test as $test)
          <div class="item">
            <p class="cleint-say">{{$test->description}}.</p>
            <div class="profile-men" align="center">
              <img src="{{ asset(Storage::url($test->image)) }}" class=ïmg-responsive>
            </div>
            <p class="name-testi">{{$test->name}}</p>
            <p class="name-testi2">{{$test->designation}}</p>
          </div>
          @endforeach
        </div>
      </div>
    </div>
    <p class="view-all-testi"><a href="{{url('testimonials') }}">View All Testimonials <i class="vam fa fa-long-arrow-right" aria-hidden="true"></i></a></p>
    <div class="space col-lg-12"></div>
  </div>
</div>
</section>
<!--//section4 -->
<!-- <section 5 -->
<section>
<div class="container width-container">
  <p class="project-head">News & Events</p>
  <div class='row'>
    <div class="col-lg-6 image-news">
      <div class="main_news_box">
        <?php $count = 0; ?>
        @foreach($new as $news)
        <?php if($count == 5) break; ?>
        <div class="item_news" data-id="{{ $news->id }}">
          <img src="{{ asset(Storage::url($news->image)) }}" class="img-fluid">
          <p class="head-text-news">{{$news->title}}</p>
          <?php
          $text1 = str_ireplace('<p>', '', $news->description);
          $text = str_ireplace('</p>', '', $text1);
          ?>
          <p class="text-dec-news">{{$text}}</p>
          
        </div>
        <?php $count++; ?>
        @endforeach
      </div>
    </div>
    <div class="col-lg-6">
      <?php $count = 0; ?>
      @foreach($new as $new)
      <?php if($count == 5) break; ?>
      <div class="box-white-padd click_news" data-id="{{$new->id}}">
        <div class="row">
          <div class="col-lg-2 col-3 padd-right">
            <div class="news-clndr-top">
              <?php
              $month =explode(" ",$new->date);
              ?>
              <p class="feb-tex">{{$month[1]}}</p>
            </div>
            <div class="number-bg-news">
              <p class="date-number">{{$month[0]}}</p>
            </div>
            <div class="news-clndr-top">
              <?php
              $month =explode(" ",$new->date);
              ?>
              <p class="feb-tex">{{$month[2]}}</p>
            </div>
          </div>
          <div class="col-lg-10 col-9">
            <p class="news-texthead">{{$new->title}}</p>
            <?php
            $text1 = str_ireplace('<p>', '', $new->description);
            $text = str_ireplace('</p>', '', $text1);
            ?>
            <p class="news-text-cntants">{{$text}}</p>
          </div>
        </div>
      </div>
      <?php $count++; ?>
      @endforeach
      <p class="text-view-more mt20"><a href="{{ url('news_events_gallary') }}">View All News &ensp;<i class="fa fa-long-arrow-right" aria-hidden="true"></i></a></p>
    </div>
  </div>
</div>
</section>
<!--//<section 5 -->
<!-- section6 -->
<section>
<div class="container width-container">
  <p class="project-head">Gallery</p>
  <div class="owel-gallery-align">
    <div class="row">
      <div class="col-lg-12">
        <div id="owl-demo-gallery" class="owl-carousel">
          @foreach($photos as $photos)
          <div class="item"><a href="{{ asset(Storage::url($photos->image)) }}" data-lightbox="photos"><img class="img-fluid lazyOwl" src="{{ asset(Storage::url($photos->image)) }}"></a></div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</div>
</section>
<!-- //section6 -->
<!-- footer section -->
<script>
$(document).ready(function() {
$("#owl-demo-gallery").owlCarousel({
items: 4,
lazyLoad: true,
navigation: true,
autoPlay: 5000,
stopOnHover: false
});
});
</script>
<script>
$(document).ready(function() {
$("#owl-demo-project").owlCarousel({
items: 1,
lazyLoad: true,
navigation: true,
autoPlay: 5000,
stopOnHover: false
});
});
</script>
<script>
$(document).ready(function() {
$("#owl-demo-testimonials").owlCarousel({
navigation: true, // Show next and prev buttons
slideSpeed: 300,
paginationSpeed: 400,
singleItem: true,
autoPlay: 5000,
stopOnHover: false
// "singleItem:true" is a shortcut for:
// items : 1,
// itemsDesktop : false,
// itemsDesktopSmall : false,
// itemsTablet: false,
// itemsMobile : false
});
});
</script>
<!--banner slide -->
<script>
$(document).ready(function() {
var owl;
function customPager() {
$.each(this.owl.userItems, function(i) {
var titleData = jQuery(this).find('h3').text();
var paginationLinks = jQuery('.owl-controls .owl-pagination .owl-page span');
$(paginationLinks[i]).append(titleData).wrap('<h3 class="slideTitle"></h3>');
});
}
$('.homeCarousel').owlCarousel({
autoPlay: 3000,
navigation: true,
slideSpeed: 1000,
paginationSpeed: 2000,
singleItem: true,
afterInit: customPager,
afterUpdate: customPager,
navigationText: false
});
});
</script>
<!-- //banner slide -->
<!-- countar -->
<script>
var a = 0;
$(window).scroll(function() {
var oTop = $('#counter').offset().top - window.innerHeight;
if (a == 0 && $(window).scrollTop() > oTop) {
$('.counter-value').each(function() {
var $this = $(this),
countTo = $this.attr('data-count');
$({
countNum: $this.text()
}).animate({
countNum: countTo
}, {
duration: 1000,
easing: 'swing',
step: function() {
$this.text(Math.floor(this.countNum));
},
complete: function() {
$this.text(this.countNum);
//alert('finished');
}
});
});
a = 1;
}
});
</script>
<script src="{{ URL::asset('/front_js/lightbox.min.js') }}"></script>
</body>
@endsection