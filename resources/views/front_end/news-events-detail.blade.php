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
            <h1 class="innerpage-headings">News & Events</h1>
          <p class="step-by-step">Home&ensp;<i class="fa fa-caret-right" aria-hidden="true"></i>&ensp;Media&ensp;<i class="fa fa-caret-right" aria-hidden="true"></i>&ensp;<font color="#8A9E43">News & Events</font>
            </p>
        </div>
    </div>

    <div class="gallery-main-align">
        <div class="row">
        @include('front_end.partials.messages')
        @foreach($res['data']['newsimage'] as $data1)

            <div class="col-lg-3">
                <div class="hover-photo-bg">
                    <div class="image-photo-gallery-img">
                        <a href="{{ asset(Storage::url($data1['image'])) }}" data-lightbox="photos"><img class="img-fluid" src="{{ asset(Storage::url($data1['image'])) }}"></a>
                    </div>
                   
                </div>
            </div>

            @endforeach
        </div>
    </div>
</div>
</div>

@endsection