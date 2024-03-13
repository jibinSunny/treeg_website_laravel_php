@extends('front_end.master')
@section('content')
<?php
use Illuminate\Support\Facades\Session;
session(['data' =>url()->current()]);
// $user=session::get('data');
?>
<body>
	<div class="container width-container">
		<div class="row">
			<div class="col-lg-12">
				<p class="project-head pt140">Video Gallery</p>
			</div>
		</div>
		<div class="gallery-main-align">
			<div class="row">
				@include('front_end.partials.messages')
				@foreach($videos as $videos)
				<div class="col-lg-3">
					<div class="video-gallery-box1-n">
						<iframe width="100%" height="100%" src="{{ $videos->youtube_video_id}}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
					</div>
				</div>
				@endforeach
			</div>
		</div>
	</div>
	<!-- footer section -->
	
</body>
@endsection