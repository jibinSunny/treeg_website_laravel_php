@extends('layouts.master')
@section('title', 'Update Photo Album')
@section('content')

<div class="wrapper wrapper-content">
  <div class="animated fadeInRightBig">
    <div class="container">
      <form action="{{ asset('admin/photo/'.$photo->id) }}" method="POST" enctype="multipart/form-data">
        <div class="row">

          @csrf
          @method('PUT')

          <div class="col-md-12">
            <div class="form-group">
              <label for="">Caption</label>
              <input type="text" value="{{ $photo->caption ?? old('caption') }}" name="caption" class="form-control">
              @if ($errors->has('caption'))
              <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('caption') }}</strong>
              </span>
              @endif

              <input type="hidden" name="parent_id" value="0">

            </div>
            <div class="form-group">
              <label for="">Priority</label>
              <input type="text" class="form-control" value="{{ $photo->priority}}" name="priority">
            </div>
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
            <img class="mt-3" src="{{ asset($photo->thumb) }}" width="100" alt="">
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