@extends('front_end.master')
@section('content')
<?php
use Illuminate\Support\Facades\Session;
session(['data' =>url()->current()]);
// $user=session::get('data');
?>
<style type="text/css">
    .contants-bg {
    width: 100%;
    min-height: 110px;
}
</style>
<body>
    @include('front_end.partials.messages')
    <div class="container width-container">
        <div class="row">
            <div class="col-lg-12">
                <p class="project-head pt140">About Us</p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                
                <p class='about-main-dec1'>Known for our unique luxury projects spread across locales appealing to nature lovers, each project boasts of an exclusive identity of its own. We at treeG Builders & Developers consider customer satisfaction as a supreme factor behind the success of any project before it takes shape and thus have never once failed to meet expectations of our loyal clientele, which has largely grown with time.  Having to our credit over a decade of exposure in the field of real estate, our expertise knows no bounds and no client leaves our premises without fulfilling a dream. Our dedicated team that works round-the-clock ensures that customer needs are understood, analyzed and tailor-made where every detail exceeds expectations when delivered and every project is worth every penny invested. On-time delivery of projects is the motto we function on, which has also helped shape our unwavering successes to a great extend. Our reputed Chairman Mr. Subair C.H. heads a large network of businesses in India and is well-known among international contemporaries abroad as well. The Managing Director Mr. O. Abdul Vahab is a well-known personality handling socio-cultural activities in the city and is the mastermind behind TreeG Eye Care Hospital, Manjeri as well as Baraka, Oman. He has his business realm spread across the Malabar region and the Middle East. </p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <div class="align-right-edge-pad">
                    <p class="text-vision1">Vision</p>
                    <p class="text-vision-dec">To be the leading name in Real Estate and continually inspire aspirants.</p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="align-right-edge-pad">
                    <p class="text-vision1">MISSION</p>
                    <p class="text-vision-dec">To incorporate innovation and passion to achieve success par excellence.</p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="align-right-edge-pad">
                    <p class="text-vision1">Values</p>
                    <p class="text-vision-dec">Continually work on principles of commitment, integrity, efficiency and value for money.</p>
                </div>
            </div>
        </div>
        <div class="aling-photo-gallery">
            <div id="owl-demo-project" class="owl-carousel">
                <div class="owl-item"> 
                    <div class="col-12">
                        <a href="{{ url('project/view/9') }}">
                            <div class="hover-proprety">
                                <div class="project-image-bg">
                                    <img src="http://treeg.apps.eximuz.com/storage/projects_image/6ec368a2b52660f78080a906a45d0fca.jpg" class="img-fluid">
                                </div>
                                
                                <div class="contants-bg">
                                    <p class="heading-text1">TreeG Talia Sky Villas
                                    </p><p class="heading-text2">Ongoing</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div> 

                <div class="owl-item"> 
                    <div class="col-12">
                        <a href="{{ url('project/view/10') }}">
                            <div class="hover-proprety">
                                <div class="project-image-bg">
                                    <img src="http://treeg.apps.eximuz.com/storage/projects_image/f6ae25424c9afa0410ed43a8908cd7a4.jpg" class="img-fluid">
                                </div>
                                
                                <div class="contants-bg">
                                    <p class="heading-text1">TreeG Leafy Lounge 
                                    </p><p class="heading-text2">Ongoing</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div> 
                <div class="owl-item"> 
                    <div class="col-12">
                        <a href="{{ url('project/view/11') }}">
                            <div class="hover-proprety">
                                <div class="project-image-bg">
                                    <img src="http://treeg.apps.eximuz.com/storage/projects_image/5dba39a825ab3ab4538f87eaf4addac6.jpg" class="img-fluid">
                                </div>
                                
                                <div class="contants-bg">
                                    <p class="heading-text1">TreeG Memfield Lovely Homes
                                    </p><p class="heading-text2">Completed</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div> 
                <div class="owl-item"> 
                    <div class="col-12">
                        <a href="{{ url('project/view/12') }}">
                            <div class="hover-proprety">
                                <div class="project-image-bg">
                                    <img src="http://treeg.apps.eximuz.com/storage/projects_image/3ec22a1218f4ab2b86ff3ec0ea6a0d40.jpg" class="img-fluid">
                                </div>
                                
                                <div class="contants-bg">
                                    <p class="heading-text1">TreeG Morning dews
                                    </p><p class="heading-text2">Completed</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div> 
                <div class="owl-item"> 
                    <div class="col-12">
                        <a href="{{ url('project/view/13') }}">
                            <div class="hover-proprety">
                                <div class="project-image-bg">
                                    <img src="http://treeg.apps.eximuz.com/storage/projects_image/1fc5194db70fea167167981805104304.jpg" class="img-fluid">
                                </div>
                                
                                <div class="contants-bg">
                                    <p class="heading-text1">TreeG Puzhayoram
                                    </p><p class="heading-text2">Completed</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div> 
                <div class="owl-item"> 
                    <div class="col-12">
                        <a href="{{ url('project/view/14') }}">
                            <div class="hover-proprety">
                                <div class="project-image-bg">
                                    <img src="http://treeg.apps.eximuz.com/storage/projects_image/df6ad1640794fed1a27b240ef551ed12.jpg" class="img-fluid">
                                </div>
                                
                                <div class="contants-bg">
                                    <p class="heading-text1">TreeG Green Leaves
                                    </p><p class="heading-text2">Completed</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div> 

                
            </div>
            
        </div>
    </div>
    

    <script>
        $(document).ready(function() {
            $("#owl-demo-project").owlCarousel({
                items: 3,
                lazyLoad: true,
                navigation: true,
                autoPlay: 5000,
                stopOnHover: false
            });
        });
    </script>
</body>
@endsection