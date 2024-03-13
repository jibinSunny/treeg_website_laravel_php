@extends('layouts.master')
@section('title', 'Update News/Event')
@section('content')

<div class="wrapper wrapper-content">
    <div class="animated fadeInRightBig">
        <div class="container">
            <form action="{{ asset('admin/newsandevents/'.$newsandevent->id)  }}" method="POST" enctype="multipart/form-data">
            <div class="row">
                        
                    @csrf  
                    @method('PUT')      
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Title</label>
                            <input type="text"  value="{{ $newsandevent->title ?? old('title') }}" name="title" class="form-control">

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">{{ $newsandevent->date ?? old('date') }}</label>
                            <input type="date"  value="{{ $newsandevent->date ?? old('date') }}" name="date" class="form-control">

                        </div>
                    </div>
                   {{--  <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Image</label>
                            <input type="file" name="image" class="form-control">
                            <img src="{{ Storage::url($newsandevent->image) }}" width="40" alt="">
                        </div>
                    </div> --}}

            {{-- <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title  back-change">
                        <h5>Image cropper <small>http://fengyuanchen.github.io/cropper/</small></h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="fa fa-wrench"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-user">
                                <li><a href="#" class="dropdown-item">Config option 1</a>
                                </li>
                                <li><a href="#" class="dropdown-item">Config option 2</a>
                                </li>
                            </ul>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <p>
                            A simple jQuery image cropping plugin.
                        </p>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="image-crop">
                                    <img src="/img/p3.jpg">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h4>Preview image</h4>
                                <div class="img-preview img-preview-sm"></div>
                                <h4>Comon method</h4>
                                <p>
                                    You can upload new image to crop container and easy download new cropped image.
                                </p>
                                <div class="btn-group">
                                    <label title="Upload image file" for="inputImage" class="btn btn-primary">
                                        <input type="file" accept="image/*" name="image" id="inputImage" class="hide">
                                        Upload new image
                                    </label>
                                    <label title="Donload image" id="download" class="btn btn-primary">Download</label>
                                </div>
                                <h4>Other method</h4>
                                <p>
                                    You may set cropper options with <code>$(image}).cropper(options)</code>
                                </p>
                                <div class="btn-group">
                                    <button class="btn btn-white" id="zoomIn" type="button">Zoom In</button>
                                    <button class="btn btn-white" id="zoomOut" type="button">Zoom Out</button>
                                    <button class="btn btn-white" id="rotateLeft" type="button">Rotate Left</button>
                                    <button class="btn btn-white" id="rotateRight" type="button">Rotate Right</button>
                                    <button class="btn btn-warning" id="setDrag" type="button">New crop</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
        

              
                    <div class="col-lg-12 mb-3">
                       <textarea name="description" id="editor1" rows="10" cols="80">{{ $newsandevent->description ?? old('description') }}</textarea>
                    </div>

                    <div class="col-md-4 text-center">
                        <div id="upload-demo"></div>
                    </div>
                    <div class="col-md-3" style="padding:5%;">
                        <strong>Select image to crop:</strong>
                        <input type="file" name="image" id="image">
                        @if ($errors->has('image'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('image') }}</strong>
                        </span>
                        @endif

                        <button type="button" class="btn btn-primary btn-block upload-image" style="margin-top:2%">Crop Image</button>
                    </div>

                    <div class="col-md-5">
                    <div id="preview-crop-image" style="background:#9d9d9d;width:100%;height:300px;"></div>
                    </div>

                     <div class="col-lg-12">
                       <div class="form-group">
                           <input type="submit" value="Save" class="btn btn-outline btn-primary">
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
                width: 350,
                height: 200,
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