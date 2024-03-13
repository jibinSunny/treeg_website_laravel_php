@extends('front_end.master')
@section('content')
<?php
use Illuminate\Support\Facades\Session;
session(['data' =>url()->current()]);
// $user=session::get('data');
?>
<style type="text/css">
    .heading-text1 {
        line-height: 24px !important;
    }
    .white-event-detail-bg {
        padding: 0px 23px 7px !important;
        margin-bottom: 20px;
    }
    .heading-text3 {
        display: block;
        height: 44px;
        overflow: hidden;
    }
    .viewmore{
        text-align: center;
    }
    .viewmoredetail{
        color: #8A9E43 !important;
        cursor: pointer;
    }
    .view_more_height {
        height: auto;
    }
    .heading-text3 {
        color: #000000 !important;
    }
    .heading-text2 {
        color: #000000 !important;
    }
    .heading-text1 {
        color: #000000 !important;
    }
</style>
<body>
    <div class="container width-container">
        <div class="row">
            <div class="col-lg-12">
                <p class="project-head pt140">News & Events</p>
            </div>
        </div>
        <div class="gallery-main-align">
            <div class="row">
                @include('front_end.partials.messages')
                @foreach($data as $data)
                <div class="col-lg-4">
                     
                        <div class="events-images">
                            <img src="{{ asset(Storage::url($data->image)) }}" class="img-fluid">
                        </div>
                        <div class="white-event-detail-bg">
                            <p class="heading-text1">{{$data->title}}</p>
                            <p class="heading-text2">{{$data->date}}</p>
                            <?php
                            $text1 = str_ireplace('<p>', '', $data->description);
                            $text = str_ireplace('</p>', '', $text1);
                            ?>
                            <p class="heading-text3">{{$text}}</p>
                            <div class="viewmore">
                                <span class="block viewmoredetail">View more</span>
                            </div>
                        </div>
                        
                    
                </div>
                @endforeach
            </div>
        </div>
    </div>
</body>