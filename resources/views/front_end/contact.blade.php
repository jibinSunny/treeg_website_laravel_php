@extends('front_end.master')
@section('content')
<?php

use Illuminate\Support\Facades\Session;

session(['data' => url()->current()]);
$user = session::get('data');
?>

<body>
    <!-- header sec -->
    @include('front_end.partials.messages')
    <div class="container width-container">
       <div class="row">
            <div class="col-lg-12">
                <p class="project-head pt140">News & Events</p>
            </div>
        </div>
        <form action="{{url('request_callback')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-4">
                    <input type="text" name="name" class="contact-inp" placeholder="Name">
                </div>
                <input type="hidden" class="form-control" id="url" name="url" value="{{$user}}" data-original-title="Enter title here" />
                <input type="hidden" name="status" value="New">

                <div class="col-lg-4">
                    <input type="text" name="email" class="contact-inp2" placeholder="Email">
                </div>

                <div class="col-lg-4">
                    <input type="text" name="phone" class="contact-inp3" placeholder="Contact Number">
                </div>

                <div class="col-lg-12">
                    <textarea class="contact-inp4" name="subject" placeholder="Enquire Now"></textarea>
                </div>
                <input type="hidden" class="form-control" id="is_callback" name="is_callback" value="1" data-original-title="Enter title here" />
                <div class="col-lg-2">
                    <div class="captcha-white-box" align="center">
                        <img src="images/captcha.png" class="img-fluid">
                    </div>
                </div>
                <div class="col-lg-5">
                    <input type="text" class="contact-inp3-capcha" name="message" placeholder="Enter Cache here..">
                </div>
                <div class="col-lg-5">
                    <p class="cant-text">Can't Read Captcha <span class="linking"><a href="#">Click here</a></span> For Refresh </p>
                </div>
                <div class="col-lg-12">
                    <button type="reset" class="contact-clear-btn">Clear</button>
                    <button type="Submit" class="contact-submit-btn">Submit</button>
                </div>
            </div>
        </form>


        <div class="map-bg-contact">
            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d4016631.6651292397!2d76.12831845000001!3d10.54063!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sin!4v1587647533027!5m2!1sen!2sin" width="100%" height="100%" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
        </div>
    </div>
    <!-- footer section -->

</body>
@endsection