@extends('layouts.master')
@section('title', 'Add New Project')
@section('content')

<style type="text/css">
  #target {
    background-color: #ccc;
    width: 500px;
    height: 330px;
    font-size: 24px;
    display: block;
  }


</style>
<div class="wrapper wrapper-content">
    <div class="animated fadeInRightBig">
        <div class="container">
            <form action="{{ route('projects.store') }}" method="POST" enctype="multipart/form-data">
            <div class="row">
                    @csrf        
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Title</label>
                        <input type="text" name="title" value="{{ old('title') }}" class="form-control">
                         @if ($errors->has('title'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('title') }}</strong>
                        </span>
                        @endif

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Select Category</label>
                            <select name="category_id" class="form-control" id="">
                                <option value="">Choose Category</option>
                                <option value="1">Residential</option>
                                <option value="2">Commercial</option>
                                {{-- @foreach($categories as $cat)
                                    <option {{ ($cat->id==old('category_id') ? 'selected' : '') }} value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach --}}
                            </select>
                        @if ($errors->has('category_id'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('category_id') }}</strong>
                        </span>
                        @endif
                            
                        </div>
                    </div>
                   
                    
                  
                    {{-- <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Image</label>
                            <input type="file" id="image" name="image" class="form-control">
                             @if ($errors->has('image'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('image') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div id="croppedImage"></div>
                        
                    </div> --}}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Caption</label>
                            <input type="text" name="caption" class="form-control">
                        </div>
                    </div>
                     <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Priority</label>
                            <input type="text" name="priority" class="form-control">
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
                                    <option value="{{ $loc->id }}">{{ $loc->location }}</option>
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
                        </div>
                    </div>
              
                
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Logo</label>
                            <input type="file" name="logo" class="form-control">
                             @if ($errors->has('logo'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('logo') }}</strong>
                        </span>
                    @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Booking image (Size: 540x373)</label>
                            <input type="file" name="booking_image" class="form-control">
                             @if ($errors->has('logo'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('booking_image') }}</strong>
                        </span>
                    @endif
                        </div>
                    </div>
                    
                    <!-- <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Other Details</label>
                            <input type="text" value="{{ old('other_details') }}" class="form-control" name="other_details">
                             @if ($errors->has('other_details'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('other_details') }}</strong>
                        </span>
                    @endif
                        </div>
                    </div> -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Select Project Type</label>
                            <select name="type" class="form-control" id="">
                                @foreach($types as $type)
                                <option {{ (old('type')==1) ? 'selected' : '' }} value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                             @if ($errors->has('type'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('type') }}</strong>
                        </span>
                    @endif
                            
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Select Project Status</label>
                            <select name="status" class="form-control" id="cxvcdv">
                                <option  value="1">Ongoing Projects</option>
                                <option  value="2">Completed Projects</option>
                                 <option  value="3">On Hold Projects</option>
                            </select>
                             @if ($errors->has('status'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('status') }}</strong>
                        </span>
                    @endif
                            
                        </div>
                    </div>
                    <!-- <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Select Featured Or Not</label>
                            <select name="featured" id="featured" class="form-control" id="">
                                <option value="0">No</option>
                                <option value="1">Yes</option>
                            </select>
                             @if ($errors->has('featured'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('featured') }}</strong>
                        </span>
                    @endif
                        </div>
                    </div> -->


                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Phone</label>
                            <input type="text" name="phone" class="form-control">

                             @if ($errors->has('phone'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('phone') }}</strong>
                        </span>
                    @endif
                        </div>
                    </div>

                  

                                <!-- <div id="timeline" style="display: none"> -->
                        <div class="col-md-12 is-hidden" id="featured-image"style="display: none">
                            <div class="form-group">
                                <label for="">Featured Image <span style="color:red">(Image-siz: width:969, height:485)</span></label>
                                <input type="file" name="featured-image" class="form-control">
                                 @if ($errors->has('featured-image'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('featured-image') }}</strong>
                            </span>
                        @endif
                            </div>
                        </div>
                       

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Latitude</label>
                            <input type="text" name="latitude" class="form-control">
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
                            <input type="text" name="longitude" class="form-control">
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
                            <input type="checkbox" name="show_booking_status_tab" id="pdf" value="1">
                        </label>

                    <!-- </div> -->
                </div>
                    

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Address</label>
                            <textarea name="address" id="" class="form-control" rows="3"></textarea>
                             @if ($errors->has('address'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('address') }}</strong>
                        </span>
                    @endif
                        </div>
                    </div>


                    
                    <div class="col-lg-12 mb-2">
                       <textarea name="description" id="editor1" rows="10">
                
                    </textarea>
                   
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Image (Size: 800x448)</label>
                            <input type="file" name="image" class="form-control">
                            @if ($errors->has('image'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('image') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    
                


                  



                    

                    <div class="col-md-1 mt-2">
                        <div class="form-group ">
                        <input type="submit" class="mb-5 btn btn-outline btn-primary">
                        </div>
                       
                    </div>
                    <div class="col-md-1 mt-2">
                       
                        <div class="form-group ">
                        
                        <input type="reset" name="reset" class="btn btn-outline btn-danger">
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
        // $('#featured-image').hide();
        $('#featured').on('change',function(){
            alert("s");
            if($(this).val()=='1')
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