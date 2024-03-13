@extends('layouts.master')
@section('title', 'Update Project Gallery')
@section('content')
<div class="wrapper wrapper-content">
    <div class="animated fadeInRightBig">
        <div class="container">
            <form class="form-horizontal" method="POST" action="{{ route('project_gallery.update',$projectGallery->id) }}" enctype="multipart/form-data">

                <div class="row">

                    @csrf
                    @method('PUT')
                    <div class="col-md-12">

                        <div class="form-group" id="err_name">
                            <!-- <label>Project Name</label> -->

                            <input type="hidden" name="project_id" value="{{ $projectGallery->project_id }}">
                        </div>

                        <div class="form-group">
                            <label for="">Priority</label>
                            <input type="text" class="form-control" value="{{ $projectGallery->priority }}" name="priority">
                        </div>
          
                    </div>


                    <div class="col-md-4 text-center">
                        <div id="upload-demo"></div>
                    </div>
                    <div class="col-md-3" style="padding:5%;">
                        <strong>Select image to crop:</strong>
                        <input type="file" name="image" id="image">
                        <img src="{{ asset(Storage::url($projectGallery->image)) }}" width="40" alt="">
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

    $(document).ready(function() {



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


        $('#image').on('change', function() {
            var reader = new FileReader();
            reader.onload = function(e) {
                resize.croppie('bind', {
                    url: e.target.result
                }).then(function() {
                    console.log('jQuery bind complete');
                });
            }
            reader.readAsDataURL(this.files[0]);
        });


        $('.upload-image').on('click', function(ev) {
            resize.croppie('result', {
                type: 'canvas',
                size: 'viewport'
            }).then(function(img) {
                $.ajax({
                    url: "{{route('croppie.upload-image')}}",
                    type: "POST",
                    data: {
                        "image": img
                    },
                    success: function(data) {
                        html = '<img src="' + img + '" /><input type="hidden" name="thumb" value="' + data.filename + '">';
                        $("#preview-crop-image").html(html);
                    }
                });
            });
        });

    });
</script>
@endsection