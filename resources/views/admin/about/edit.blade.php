@extends('layouts.master')
@section('title', 'Edit Testimonial')
@section('content')

<div class="wrapper wrapper-content">
    <div class="animated fadeInRightBig">
        <div class="container">
            <form action="{{ asset('admin/about/edit_save ') }}" method="POST" enctype="multipart/form-data">
                @csrf

      
                <div class="col-lg-12 mb-3">
                <input type="hidden" class="form-control" id="id" name="id" value="{{ $about[0]->id}}" name="title"/>
                       <textarea name="description" id="editor1" rows="10" cols="80">{{$about[0]->description }}</textarea>
                       @if ($errors->has('description'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('description') }}</strong>
                            </span>
                        @endif
                    </div>

                   

                <div class="col-lg-12 mt-4">
                    <div class="form-group">
                        <input type="submit" value="Save" class="mt-3 btn btn-outline btn-primary">
                    </div>
                </div>




                <!-- </div> -->
            </form>

        </div>
    </div>
</div>
@endsection


@section('scripts')


<script>
    $(document).ready(function() {

        // CKEDITOR.replace( 'editor1' );

        $('.tagsinput').tagsinput({
            tagClass: 'label label-primary'
        });

        var $image = $(".image-crop > img")
        $($image).cropper({
            aspectRatio: 1.618,
            preview: ".img-preview",
            done: function(data) {
                // Output the result data for cropping image.
            }
        });

        var $inputImage = $("#inputImage");
        if (window.FileReader) {
            $inputImage.change(function() {
                var fileReader = new FileReader(),
                    files = this.files,
                    file;

                if (!files.length) {
                    return;
                }

                file = files[0];

                if (/^image\/\w+$/.test(file.type)) {
                    fileReader.readAsDataURL(file);
                    fileReader.onload = function() {
                        $inputImage.val("");
                        $image.cropper("reset", true).cropper("replace", this.result);
                    };
                } else {
                    showMessage("Please choose an image file.");
                }
            });
        } else {
            $inputImage.addClass("hide");
        }

        $("#download").click(function() {
            window.open($image.cropper("getDataURL"));
        });

        $("#zoomIn").click(function() {
            $image.cropper("zoom", 0.1);
        });

        $("#zoomOut").click(function() {
            $image.cropper("zoom", -0.1);
        });

        $("#rotateLeft").click(function() {
            $image.cropper("rotate", 45);
        });

        $("#rotateRight").click(function() {
            $image.cropper("rotate", -45);
        });

        $("#setDrag").click(function() {
            $image.cropper("setDragMode", "crop");
        });

    });
</script>
@endsection