@extends('layouts.master')
@section('title', 'Add New Testimonial')
@section('content')

<div class="wrapper wrapper-content">
    <div class="animated fadeInRightBig">
        <div class="container">
        <form action="{{ asset('admin/testimonial') }}" method="POST" enctype="multipart/form-data">
                <div class="row">
                        
                    @csrf        
                    <div class="col-md-4">
                    <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" value="{{ old('name') }}" name="name" class="form-control">
                            @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                            @endif

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Designation</label>
                            <input type="text" value="{{ old('designation') }}" name="designation" class="form-control">
                            @if ($errors->has('designation'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('designation') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Priority</label>
                            <input type="text" class="form-control" name="priority">
                        </div>
                    </div>

              
                    <div class="col-lg-12 mb-3">
                       <textarea name="description" id="editor1" rows="10" cols="80">{{ old('description') }}</textarea>
                       @if ($errors->has('description'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('description') }}</strong>
                            </span>
                        @endif
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

                    <div class="col-md-1 mt-2">
                        <div class="form-group ">
                           
                            <button type="submit" class="btn btn-outline btn-primary">
                                <i class="fa fa-plus"></i> Save
                            </button>
                        
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