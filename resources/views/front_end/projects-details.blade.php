@extends('front_end.master')
@section('content')
<link href="{{ asset('/front_css/lightbox.min.css') }}" rel="stylesheet" type="text/css">
<style type="text/css">
.text-map-dec {
display: block;
width: 90%;
}
</style>
<body>
    <?php
    use Illuminate\Support\Facades\Session;
    session(['data' => url()->current()]);
    // $user=session::get('data');
    ?>
    <!-- header sec -->
    <div class="project-banner" style="background-image:url({{asset(Storage::url($project[0]->image)) }});">
    </div>
    <div class="container width-container">
        <div class="row">
            <div class="col-lg-12">
                <div class="project-bot-mrnu" align="center">
                    <div class="scrollmenu">
                        <nav class="navigation">
                            <a class="navigation__link active-first" href="#1" id="home" onClick="home_click(this.id)">{{$project[0]->title}}</a>
                            <?php if(count($floorPlan)>0){ ?>
                            <a class="navigation__link" href="#2" id="plan" onClick="plan_click(this.id)"> Villas Type Plans</a>
                            <?php } ?>
                            <?php if(count($projectAmenities)>0){ ?>
                            <a class="navigation__link" href="#3" id="amenities" onClick="amen_click(this.id)">Amenities</a>
                            <?php } ?>
                            <?php if(count($projectSpecification_category)>0){ ?>
                            <a class="navigation__link" href="#4" id="specfi" onClick="spe_click(this.id)">Specification</a>
                            <?php } ?>
                            @if(isset($project[0]) && $project[0]->show_booking_status_tab==1)
                            <a class="navigation__link" href="#5" id="book" onClick="book_click(this.id)">Booking Status</a>
                            @endif
                            <!-- <a class="navigation__link" href="#6" id="gallary" onClick="gallary_click(this.id)">Gallary</a> -->
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section id="1">
        <div class="container width-container">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="sec2-head2">{{$project[0]->title}}</h1>
                    <?php
                    $text = str_ireplace('<p>', '', $project[0]->description);
                    $text1 = str_ireplace('</p>', '', $text);
                    $text2 = html_entity_decode($text1);
                    ?>
                    <p class="sec-2-dec">{{$text2}}.</p>
                </div>
            </div>
            @include('front_end.partials.messages')
            <div class="bg-padd-edge">
                <div class="row">
                    <div class=" <?php if(count($keyInformation)==0){ echo "col-lg-12"; } else { echo "col-lg-4"; } ?> map1-icon" align="center">
                        <img src="{{url('images/map.png')}}" class="img-fluid click-pop">
                        <p class="text-map-dec" style="padding-top:0px;">
                            <p class="text-map-dec" style="padding-top:0px;">{{$project[0]->address}}
                                @foreach($location as $location)
                                @if($location->id ==$project[0]->location)
                                {{$location->location}}
                                @endif
                                @endforeach
                            </div>
                            @foreach($keyInformation as $key=>$keyInformation)
                            <div class="col-lg-4 map1-icon2" align="center">
                                <img src="{{ asset(Storage::url($keyInformation->image)) }}" class="img-fluid">
                                <p class="text-map-dec">{{$keyInformation->title}}<br>
                                </p>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="pop-bg">
                    <div class="close-bg">
                        <i class="fa fa-times" aria-hidden="true"></i>
                    </div>
                    <iframe src="https://maps.google.com/maps?width=100%&amp;hl=en&amp;coord={{$project[0]->latitude}},{{$project[0]->longitude}}&amp;q=Address+(Project Name)&amp;ie=UTF8&amp;t=&amp;z=13&amp;iwloc=B&amp;output=embed" width="100%" height="100%" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                </div>
            </section>
            <?php if(count($floorPlan)>0){ ?>
            <section id="2">
                <div class="container width-container">
                    <p class="project-head3">Villas Type and Plans</p>
                    <div class="owel-gallery-align">
                        <div class="row">
                            <div class="col-lg-12">
                                <div id="owl-demo-gallery" class="owl-carousel">
                                    @foreach($floorPlan as $key=>$floorplan)
                                    <div class="item">
                                        <a href="{{ asset(Storage::url($floorplan->image)) }}" data-lightbox="photos" title="Villas Type and Plans">
                                            <img class="img-fluid" src="{{ asset(Storage::url($floorplan->image)) }}">
                                            <p class="textaminity1">{{$floorplan->title}}</p>
                                        </a>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <?php } ?>
            <?php if(count($projectAmenities)>0){ ?>
            <section id="3">
                <div class="container width-container">
                    <p class="project-head3">Amenities</p>
                    <div class="aminity-align">
                        <div class="row">
                            @foreach($projectAmenities as $amenities)
                            <div class="col-lg-3">
                                <div class="ameniti-image1">
                                    <img src="{{ asset(Storage::url($amenities->image)) }}" class="img-fluid">
                                </div>
                                <p class="textaminity1">{{$amenities->title}}</p>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="aminity-align d-block d-sm-none">
                        <div class="mobile_projects_row">
                            <div id="amini" class="owl-carousel">
                                @foreach($projectAmenities as $amenities)
                                <div class="item">
                                    <div class="col-12">
                                        <div class="ameniti-image1">
                                            <img src="{{ asset(Storage::url($amenities->image)) }}" class="img-fluid">
                                        </div>
                                        <p class="textaminity1">{{$amenities->title}}</p>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            
                        </div>
                    </div>
                </div>
            </section>
            
            <?php } ?>
            <?php if (count($projectSpecification_category)>0) { ?>
            <section id="4">
                <div class="container width-container">
                    <p class="project-head3">Specifications </p>
                    <div class="box-spec-none">
                        <div class="row">
                            <div class="col-md-12">
                                @foreach($projectSpecification_category as $key=>$category)
                                <div class="spec_div_main box-spec">
                                    <div class="spec_parent">
                                        <span class="spec_h block semibold">{{$category->title}}</span>
                                        <span class="spec_info">
                                            @foreach($category->specification as $specification)
                                            <div class="m0"> <div style="float: left; display: block;"><i class="fa fa-circle" aria-hidden="true"></i></div>
                                            <div class="vam" style="display: flow-root;margin-left: 15px;padding-top: 5px;"> {{ isset($specification)?$specification->content:''}}</div>
                                        </div>
                                        @endforeach
                                    </span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div style="clear: both;"></div>
                    </div>
                </div>
            </div>
        </section>
        <?php } ?>
        @if($project[0]->show_booking_status_tab==1)
        <section id="5">
            <div class="container width-container">
                <p class="project-head3">Booking Status </p>
                <div class="row">
                    <div class="col-lg-6 project-pad-align">
                        <img src="{{ asset(Storage::url($project[0]->booking_image)) }}" class="img-fluid">
                    </div>
                    <div class="col-lg-6">
                        <div class="box-right-pad">
                            <p class="text-status1">Site Layout & Booking Status</p>
                            <p class="text-status-desc">Count on our representative to take you through the treeG journey.</p>
                            <a href="{{url('contact')}}"> <button type="button" class="enq-status-btn">Enquire Now</button></a>
                        </div>
                    </div>
                </div>
            </section>
            @endif
            <?php
            $count = count($projectGallery);
            ?>
            @if($count>0)
            <section id="6">
                <div class="container width-container">
                    <p class="project-head">Project Gallary</p>
                    
                    @if($count<=4) <div class="row">
                        @foreach($projectGallery as $key=>$gallery)
                        <div class="col-lg-3">
                            <div class="progress-image-bg">
                                <a href="{{ asset(Storage::url($gallery->image)) }}" data-lightbox="photos"><img class="img-fluid" src="{{ asset(Storage::url($gallery->image)) }}"></a>
                            </div>
                            <p class="text-progress-text"></p>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="row">
                        <?php
                        for ($i = 0; $i < 4; $i++) {
                        ?>
                        <div class="col-lg-3">
                            <div class="progress-image-bg">
                                <a href="{{ asset(Storage::url($projectGallery[$i]->image)) }}" data-lightbox="photos"><img class="img-fluid" src="{{ asset(Storage::url($projectGallery[$i]->image)) }}"></a>
                            </div>
                        </div>
                        <?php
                        }
                        ?>
                    </div>
                    <p class="view-all-text"><a href="{{url('project_gallary')}}/{{ $project[0]->id }}">View All Images <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a></p>
                    @endif
                </div>
            </section>
            @endif
            <div class="mobile_footer_manu">
                <div class="top_menu_mfm hide">
                    <div class="scrollmenus_mob prdetail_a">
                        <a class="navigation__link" href="#1" id="home" onClick="home_click(this.id)">{{$project[0]->title}}</a>
                        <a class="navigation__link" href="#2" id="plan" onClick="plan_click(this.id)"> Villas Type Plans</a>
                        <a class="navigation__link" href="#3" id="amenities" onClick="amen_click(this.id)">Amenities</a>
                        <a class="navigation__link" href="#4" id="specfi" onClick="spe_click(this.id)">Specification</a>
                        <a class="navigation__link" href="#5" id="book" onClick="book_click(this.id)">Booking Status</a>
                        <a class="navigation__link" href="#6" id="gallary" onClick="gallary_click(this.id)">Gallary</a>
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
            <script>
            $(document).ready(function() {
            $('a[href*="#"]').on('click', function(event) {
            let hash = this.hash;
            if (hash) {
            event.preventDefault();
            $('html, body').animate({
            scrollTop: $(hash).offset().top - 100
            }, 1000);
            }
            });
            });
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
            $(".click-pop").click(function() {
            $(".pop-bg").fadeIn();
            });
            $(".close-bg").click(function() {
            $(".pop-bg").fadeOut();
            });
            });
            </script>
            <script type="text/javascript">
            function home_click(clicked_id) {
            $('#home').addClass('active-first');
            $('#plan').removeClass('active-first');
            $('#amenities').removeClass('active-first');
            $('#book').removeClass('active-first');
            $('#gallary').removeClass('active-first');
            $('#specfi').removeClass('active-first');
            }
            function plan_click(clicked_id) {
            $('#plan').addClass('active-first');
            $('#home').removeClass('active-first');
            $('#amenities').removeClass('active-first');
            $('#gallary').removeClass('active-first');
            $('#specfi').removeClass('active-first');
            $('#book').removeClass('active-first');
            }
            function amen_click(clicked_id) {
            $('#amenities').addClass('active-first');
            $('#home').removeClass('active-first');
            $('#plan').removeClass('active-first');
            $('#book').removeClass('active-first');
            $('#gallary').removeClass('active-first');
            $('#specfi').removeClass('active-first');
            }
            function gallary_click(clicked_id) {
            $('#gallary').addClass('active-first');
            $('#home').removeClass('active-first');
            $('#plan').removeClass('active-first');
            $('#book').removeClass('active-first');
            $('#amenities').removeClass('active-first');
            $('#specfi').removeClass('active-first');
            }
            function book_click(clicked_id) {
            $('#book').addClass('active-first');
            $('#home').removeClass('active-first');
            $('#plan').removeClass('active-first');
            $('#amenities').removeClass('active-first');
            $('#gallary').removeClass('active-first');
            $('#specfi').removeClass('active-first');
            }
            function spe_click(clicked_id) {
            $('#specfi').addClass('active-first');
            $('#book').removeClass('active-first');
            $('#home').removeClass('active-first');
            $('#plan').removeClass('active-first');
            $('#amenities').removeClass('active-first');
            $('#gallary').removeClass('active-first');
            }
            </script>
            <script src="{{ URL::asset('/front_js/lightbox.min.js') }}"></script>
            <script type="text/javascript">
            $(".spec_parent").each(function(index, el) {
            var height = $(this).height();
            // $(this).parent('.col-md-6').height(height);
            });
            </script>
        </body>
        @endsection