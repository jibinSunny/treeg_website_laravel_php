@extends('front_end.master')
@section('content')
<?php
use Illuminate\Support\Facades\Session;
session(['data' =>url()->current()]);
// $user=session::get('data');
?>
<div class="container width-container">
    <div class="row">
        <div class="col-lg-12">
            <p class="project-head pt140">Photo Gallery</p>
        </div>
    </div>

    <div class="gallery-main-align">
        <div class="row">
        @include('front_end.partials.messages')
        @foreach($photos as $photos)
            <div class="col-lg-3">
                <a href="{{ url('photo_gallary/view/') }}/{{ $photos->id }}">
                    <div class="hover-photo-bg-n">
                        <div class="image-photo-gallery-img">
                            <img src="{{ asset(Storage::url($photos->image)) }}" class="img-fluid">
                        </div>
                        <div class="phot-gallery-contants">
                            <p class="photo-galley-text">{{$photos->caption}}</p>
                            <!-- <p class="photo-galley-text2">Luxury Villas</p> -->
                        </div>
                    </div>
                </a>
            </div>
            @endforeach


        </div>
    </div>
</div>
@endsection