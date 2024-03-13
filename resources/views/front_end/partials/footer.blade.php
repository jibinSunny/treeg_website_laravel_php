<!-- Request Call Back popup -->
<div class="popup-bg-call-back">
    <div class="box-padd-start">
        <div class="row">
            <div class="col-lg-8 col-10">
                <p class="name-callback">REQUEST A CALL BACK</p>
            </div>
            <div class="col-lg-4 col-2">
                <p class="close-call-bg"><i class="fa fa-times" aria-hidden="true"></i></p>
            </div>
        </div>
    </div>

    <div class="forms-pad">
        <p class="text-small-head">We are always ready to help you. You may drop us a line here.</p>
        <!-- <form > -->
        <?php

        use Illuminate\Support\Facades\Session;

        $user = session::get('data');
        ?>

        <form action="{{url('request_callback')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" class="form-control" id="url" name="url" value="{{$user}}" data-original-title="Enter title here" />

            <div class="row">
                <div class="col-lg-6">
                    <input type="text" class="form-inp-call1" name="name" placeholder="Full Name *" required>
                </div>
                <input type="hidden" name="status" value="New">
                <div class="col-lg-6">
                    <input type="text" class="form-inp-call2" name="email" placeholder="Email ID *" required>
                </div>

                <div class="col-lg-6">
                    <input type="text" class="form-inp-call3" name="phone" placeholder="Phone Number *" required>
                </div>

                <div class="col-lg-6">
                    <input type="text" class="form-inp-call3" name="subject" placeholder="Subject *" required>
                </div>

                <input type="hidden" class="form-control" id="is_callback" name="is_callback" value="0" data-original-title="Enter title here" />

                <div class="col-lg-12">
                    <textarea class="form-inp-call4" name="message" placeholder="What's on Your mind" required></textarea>
                </div>

                <div class="col-lg-12">
                    <button type="submit" class="call-back-btn">Send Now</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="overly-bg2"></div>
<!--//Request Call Back popup -->


<div class="container width-container">
    <div class="requst-bg">
        <div class="row">
            <div class="col-lg-8">
                <p class="text-1-request1">One click away from owning your dream home!</p>
                <p class="text-1-request2">For project-specific and general enquiries.</p>
            </div>
            <div class="col-lg-4" align="center">
                <button type="button" class="request-call-button">Request Call Back</button>
            </div>
        </div>
    </div>

    <div class="footer-bg">
        <div class="row">
            <div class="col-lg-5 foot-log">
                <img src="{{url('images/logo.png')}}">
            </div>
            <div class="col-lg-7 text-left">
                <p class="text-foot-top semibold">
                	We take it upon us to deliver quality homes at picturesque locales, 
                	 <span  class="div_pc_block">built on international standards at affordable rates.</span>
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-5">
                <p class="address-text-foot">
                    Where you envision your dream home and we turn it into your present reality
                </p>
                <ul class="footer-social">
                    <li><a href="#" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                    <li><a href="#" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                    <li><a href="#" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                    <li><a href="#" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                </ul>

            </div>
            <div class="col-lg-2">
                <p class="text-head-footer-nav1">SEND MAIL</p>
                <p class="text-phone-foot2">info@treegbuilders.com</p>
                <p class="text-phone-foot2">treegmji@gmail.com</p>
            </div>
            <div class="col-lg-2">
                <p class="text-head-footer-nav2">MAKE CALL</p>
                <p class="text-phone-foot2"><a style="color: #151D41;" href="tel:0483 2969 938">0483 2969 938</a></p>
                <p class="text-phone-foot2"> <a style="color: #151D41;" href="tel:+91 9846 677 182">+91 9846 677 182</a> </p>
                <p class="text-phone-foot2"> <a style="color: #151D41;" href="tel:+91 9995 346 182">+91 9995 346 182</a> </p>
                
            </div>
            <div class="col-lg-3">
                <p class="text-head-footer-nav2">get in touch</p>
                <p class="text-phone-foot2">
                <strong class="block">TreeG Builders & Developers</strong>
                K.P.Tower, Byepass Jn., Thurakkal
                Manjeri-676121
                Kerala, India
                </p>
            </div>
        </div>
    </div>
    <div class="footer-line"></div>
    <div class="row">
        <div class="col-lg-6">
            <p class="copy">2020 &COPY; treeG , All rights reserved</p>

        </div>
        <div class="col-lg-6">
            <p class="powerd-text">Powered By <a href="https://www.eximuz.com/" target="_blank">Eximuz Technolabs</a></p>
        </div>
    </div>
</div>

<style type="text/css">
  .back_to_top {
      position: fixed;
      right: 5px;
      bottom: 5px;
      font-size: 26px;
      
      color: #000;
      border-radius: 50%;
      height: 35px;
      width: 35px;
      text-align: center;
      cursor: pointer;
  }
  @media(max-width: 992px){
   .back_to_top {
      position: fixed;
      right: 5px;
      bottom: 50px;
      font-size: 26px;
      color: #000;
      border-radius: 50%;
      height: 35px;
      width: 35px;
      text-align: center;
      cursor: pointer;
  } 
  }

</style>

<div class="back_to_top totop" id="totop">
  <i class="fa fa-long-arrow-up" aria-hidden="true"></i>

</div>

<script>
    $(document).ready(function() {
        $(".request-call-button").click(function() {
            $(".popup-bg-call-back,.overly-bg2").fadeIn();
        });

        $(".overly-bg2,.close-call-bg").click(function() {
            $(".popup-bg-call-back,.overly-bg2").fadeOut();
        });
    });
    $(window).scroll(function(){ 
        if ($(this).scrollTop() > 100) { 
            $('#totop').fadeIn(); 
        } else { 
            $('#totop').fadeOut(); 
        } 
    }); 
    $('#totop').click(function(){ 
        $("html, body").animate({ scrollTop: 0 }, 600); 
        return false; 
    }); 
</script>
 <script type="text/javascript">
        var header = $(".project-bot-mrnu");
          $(window).scroll(function() {    
            var scroll = $(window).scrollTop();
               if (scroll >= window.innerHeight - 230) {
                  header.addClass("fixed");
                } else {
                  header.removeClass("fixed");
                }
        });
          $(".mobile_drop").click(function(event) {
              /* Act on the event */
              $(this).children('ul').toggleClass('mob_drop_chil')
          });
    </script>
    <script>
      $(document).ready(function() {
        $("#owl-project").owlCarousel({
          items: 3,
          // lazyLoad: true,
          // navigation: true,
          autoPlay: 5000,
          stopOnHover: false,
          slideBy: 3,
          scrollPerPage: true,
          nav    : true,
          navText : ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"]
        });
      });
      $(".inner_mfm").click(function(event) {
          /* Act on the event */
          $(".top_menu_mfm").toggleClass('hide');
          $(".pr_menu i").toggleClass('rotate90');
      });

      $(".prdetail_a a").click(function(event) {
          /* Act on the event */
          $(".top_menu_mfm").toggleClass('hide');
      });
      $(".col-lg-6 .click_news:first-child").addClass('active_news');
      $(".click_news").click(function(event) {
          /* Act on the event */
          $(".click_news").each(function(index, el) {
              $(this).removeClass('active_news');
          });
          $(this).addClass('active_news');
          
          var id = $(this).data('id');
          $(".item_news").each(function(index, el) {
              if ($(this).data('id') == id) {
                $(this).css('display', 'block');
              }
              else {
                  $(this).css('display', 'none');
              }
          });
      });
      $(".viewmoredetail").click(function(event) {
      	/* Act on the event */
      	$(this).parents('.viewmore').prev(".heading-text3").toggleClass('view_more_height');
      	//var v_text = $(this).text();
      	 
      	if ($(this).text() == "View more") {
      		$(this).text('View less');
      		 
      	}
      	else if ($(this).text() == "View less") {
      		$(this).text('View more');
      	}
      });
      $(document).ready(function() {
            $("#amini").owlCarousel({
                items: 4,
                lazyLoad: true,
                navigation: true,
                autoPlay: 5000,
                stopOnHover: false
            });
        });

      var spec= [];

      $('.spec_div_main').sort(function (a, b) {
          return $(a).height() > $(b).height() ? 1 : -1;  
      }).appendTo('.box-spec-none .col-md-12');

      $(".sc_p").each(function(index, el) {
          // spec.push($(this).html());
          // console.log(spec);

          // var prevheight = $(this).prev(".spec_div_main").height();
          // var thisheight = $(this).height();
          // if (prevheight <= thisheight) {
          //   var def = thisheight - prevheight;
          // }
          // else{
          //   var def = prevheight - thisheight; 
          // }
          //$(this).next(".spec_div_main").css('top', '-'+def+'px');
      });
    </script>

