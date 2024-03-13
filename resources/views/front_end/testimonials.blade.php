@extends('front_end.master')
@section('content')

<body>
<?php
use Illuminate\Support\Facades\Session;
session(['data' =>url()->current()]);
// $user=session::get('data');
?>

    <div class="container width-container">
        <div class="row">
            <div class="col-lg-12">
                <p class="project-head pt140">Testimonials</p>
            </div>
        </div>
        <div class="align-testimonils-n">
            <div class="row">
            @include('front_end.partials.messages')
                @foreach($test as $test)
                <div class="col-lg-6">
                    <div class="box-white-testimonials">
                        <div class="images-testi-profile">
                            <img src="{{ asset(Storage::url($test->image)) }}" class="img-fluid"style="border-radius: 50%;">
                        </div>
                        
                        <div class="col-lg-12 quat-icon">
                            <img src="images/qu.png" class="img-fluid">
                        </div>
                        <div class="col-lg-12">
                            <p class="test-total-dec">{!! $test->description !!}</p>
                            <p class="testimonial-name">{{$test->name}}</p>
                            <p class="testimonial-des">{{$test->designation}}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>


        <div class="testimonials-form-bg">
        <div class="row">
                <div class="col-lg-12">
                    <p class="testi-form-head">Write your testimonial here</p>
                </div>
            </div>

        <form action="{{ asset('save_testimonoal') }}" method="POST" enctype="multipart/form-data">
            <div class="row">

                @csrf
                <div class="col-lg-5">
                    <input type="text" class="testi-form-1" name="name" placeholder="Enter Your Name">
                </div>
                <div class="col-lg-5">
                    <input type="text" class="testi-form-2" name="designation" placeholder="Enter Your Designation">
                </div>
            
           
                <div class="col-lg-2 btn-padd">
                    <input type="file"name="image" id="real-file" hidden="hidden" />
                    <button type="button" id="custom-button"><i class="fa fa-picture-o" aria-hidden="true"></i>
 Upload Image </button>
                    <span id="custom-text"></span>
                </div>

                <div class="col-lg-12">
                    <textarea class="testi-form-3"name="description" placeholder="What's On Your Mind"></textarea>
                </div>

                <div class="col-lg-12">
                    <button type="submit" value="Save" class="testi-submit">Submit</button>
                </div>





            </div>
        </form>
        </div>

    </div>
    <!-- footer section -->

    <script>
        const realFileBtn = document.getElementById("real-file");
        const customBtn = document.getElementById("custom-button");
        const customTxt = document.getElementById("custom-text");

        customBtn.addEventListener("click", function() {
            realFileBtn.click();
        });

        realFileBtn.addEventListener("change", function() {
            if (realFileBtn.value) {
                customTxt.innerHTML = realFileBtn.value.match(
                    /[\/\\]([\w\d\s\.\-\(\)]+)$/
                )[1];
            } else {
                customTxt.innerHTML = "No file chosen, yet.";
            }
        });
    </script>
</body>
@endsection