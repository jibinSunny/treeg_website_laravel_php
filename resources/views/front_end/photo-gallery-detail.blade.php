@extends('front_end.master')
@section('content')
<?php
use Illuminate\Support\Facades\Session;
session(['data' =>url()->current()]);
// $user=session::get('data');
?>
<link href="{{ asset('/front_css/lightbox.min.css') }}" rel="stylesheet" type="text/css">
<div class="container width-container">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="innerpage-headings">Photo Gallery</h1>
            <p class="step-by-step">Home&ensp;<i class="fa fa-caret-right" aria-hidden="true"></i>&ensp;Media&ensp;<i class="fa fa-caret-right" aria-hidden="true"></i>&ensp;<font color="#8A9E43">Photo Gallery</font>
            </p>
        </div>
    </div>

    <div class="gallery-main-align">
        <div class="row">
        @include('front_end.partials.messages')
        @foreach($photo as $photo)

            <div class="col-lg-3">
                <div class="hover-photo-bg">
                    <div class="image-photo-gallery-img">
                        <a href="{{ asset(Storage::url($photo->image)) }}" data-lightbox="photos"><img class="img-fluid" src="{{ asset(Storage::url($photo->image)) }}"></a>
                    </div>
                    <div class="phot-gallery-contants" style="box-shadow:none;">
                        <p class="photo-galley-text"></p>
                    </div>
                </div>
            </div>

            @endforeach
        </div>
    </div>
</div>
</div>
<script src="{{ URL::asset('/front_js/lightbox.min.js') }}"></script>
@endsection