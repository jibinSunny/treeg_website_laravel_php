@extends('layouts.master')
@section('title', 'Edit Project')
@section('content')

<div class="wrapper wrapper-content">
    <div class="animated fadeInRightBig">
        <div class="container">
            <form action="{{ route('projects.update',$project->id) }}" method="POST" enctype="multipart/form-data">
            <div class="row">
                    @csrf 
                    @method('PUT')       
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Title</label>
                        <input type="text" value="{{ $project->title }}" name="title" class="form-control">

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Select Category</label>
                        <select name="category_id" class="form-control" id="">
                                <option value="">Choose Category</option>
                                <option {{ ($project->category_id==1) ? 'selected' : '' }} value="1">Residential</option>
                                <option {{ ($project->category_id==2) ? 'selected' : '' }} value="2">Commercial</option>
                                {{-- @foreach($categories as $cat)
                                    <option {{ ($cat->id==$project->category_id) ? 'selected' : '' }} value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach --}}
                            </select>
                            
                        </div>
                    </div>
                    {{-- <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Image</label>
                            <input type="file" name="image" class="form-control">
                            <img src="/{{ $project->image }}" width="40" alt="">
                        </div>
                    </div> --}}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Caption</label>
                            <input type="text" value="{{ $project->caption }}" name="caption" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Priority</label>
                            <input value="{{ $project->priority }}" type="text" name="priority" class="form-control">
                             @if ($errors->has('priority'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('priority') }}</strong>
                        </span>
                    @endif
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Location</label>
                           <select name="location" id="" class="form-control">
                               @foreach($locations as $loc)
                                    <option {{ ($loc->id==$project->location) ? 'selected' : '' }} value="{{ $loc->id }}">{{ $loc->location }}</option>
                               @endforeach
                           </select>
                             @if ($errors->has('location'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('location') }}</strong>
                        </span>
                    @endif

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Brochure</label>
                            <input type="file" name="brochure" class="form-control">
                             @if ($errors->has('brochure'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('brochure') }}</strong>
                        </span>
                    @endif
                        @if($project->brochure)
                            <i class="fa fa-file-pdf"></i>
                        @endif
                        </div>
                    </div>
                    

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Logo</label>
                            <input type="file" name="logo" class="form-control">
                            <img src="{{ asset(Storage::url($project->logo)) }}" width="40" alt="">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Booking image</label>
                            <input type="file" name="booking_image" class="form-control">
                            <img src="{{ asset(Storage::url($project->booking_image)) }}" width="40" alt="">
                       
                  
                        </div>
                    </div>
                   
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Select Project Type</label>
                            <select name="type" class="form-control" id="">
                                 @foreach($types as $type)
                                <option {{ (old('type')==1) ? 'selected' : '' }} value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                            
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Select Project Status</label>
                            <select name="status" class="form-control" id="">
                                <option {{ ($project->status=='1') ? 'selected' : ''}} value="1">Ongoing Projects</option>
                                <option {{ ($project->status=='2') ? 'selected' : ''}} value="2">Completed Projects</option>
                                <option {{ ($project->status=='3') ? 'selected' : ''}} value="3">On hold Projects</option>
                            </select>
                            
                        </div>
                    </div>
         

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Phone</label>
                            <input type="text" name="phone" value="{{ $project->phone }}" class="form-control">

                             @if ($errors->has('phone'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('phone') }}</strong>
                        </span>
                    @endif
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Latitude</label>
                            <input type="text" value="{{ $project->latitude }}" name="latitude" class="form-control">
                             @if ($errors->has('latitude'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('latitude') }}</strong>
                        </span>
                    @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Longitude</label>
                            <input type="text" value="{{ $project->longitude }}" name="longitude" class="form-control">
                             @if ($errors->has('longitude'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('longitude') }}</strong>
                        </span>
                    @endif
                        </div>
                    </div>

                    <div class="col-md-6">
                    <!-- <div class="form-group"> -->
                    Show Booking Image
                        <label class="radio-inline" style="width: 100px;">
                        @if($project->show_booking_status_tab == 1)
                            <input type="checkbox" name="show_booking_status_tab" id="pdf"checked="checked" value="1">
                       @else
                       <input type="checkbox" name="show_booking_status_tab" id="pdf" value="1">
                       @endif
                        </label>

                    <!-- </div> -->
                </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Address</label>
                            <textarea name="address"  id="" class="form-control" rows="3">{{ $project->address }}</textarea>
                             @if ($errors->has('address'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('address') }}</strong>
                        </span>
                    @endif
                        </div>
                    </div>
                    
                    <div class="col-lg-12 mb-3">
                       <textarea name="description" id="editor1" rows="10">{{ $project->description }}</textarea>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Image</label>
                            <input type="file" name="image" class="form-control">
                            <img src="{{ asset(Storage::url($project->image)) }}" width="40" alt="">
                            @if ($errors->has('image'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('image') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
            

                 

           

                    <div class="col-md-12">
                        <div class="form-group ">
                        <input type="submit" class="mb-5 btn btn-outline btn-primary">
                    </div>
                    </div>
             

                    </div>
                </form>    
            
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script>
        if($('#featured').val()==1)
        {
            $('#featured-image').show();
        }else{
            $('#featured-image').hide();
        }
        $('#featured').on('change',function(){
            if($(this).val()==1)
            {
                $('#featured-image').show();
            }else{
                $('#featured-image').hide();
            }
        });


        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });
         $(document).ready(function(){

            CKEDITOR.replace( 'editor1' );

           var resize = $('#upload-demo').croppie({
            enableExif: true,
            enableOrientation: true,    
            viewport: { // Default { width: 100, height: 100, type: 'square' } 
                width: 370,
                height: 233,
                type: 'square' //square
            },
            boundary: {
                width: 350,
                height: 300
            }
        });


        $('#image').on('change', function () { 
          var reader = new FileReader();
            reader.onload = function (e) {
              resize.croppie('bind',{
                url: e.target.result
              }).then(function(){
                console.log('jQuery bind complete');
              });
            }
            reader.readAsDataURL(this.files[0]);
        });


       $('.upload-image').on('click', function (ev) {
          resize.croppie('result', {
            type: 'canvas',
            size: 'viewport'
          }).then(function (img) {
            $.ajax({
              url: "{{route('croppie.upload-image')}}",
              type: "POST",
              data: {"image":img},
              success: function (data) {
                html = '<img src="' + img + '" /><input type="hidden" name="thumb" value="'+data.filename+'">';
                $("#preview-crop-image").html(html);
              }
            });
          });
        });
             
        });


    </script>
@endsection