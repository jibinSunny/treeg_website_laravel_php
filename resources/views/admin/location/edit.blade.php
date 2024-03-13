@extends('layouts.master')
@section('title', 'Update Location')
@section('content')

<div class="wrapper wrapper-content">
    <div class="animated fadeInRightBig">
        <div class="container">
            <form class="form-horizontal" method="POST" action="{{ route('location.update',$location->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')


                <div class="form-group">
                    <label>Location</label>
                    <input id="name" type="text" class="form-control" name="location" value="{{$location->location}}" placeholder="Name"></div>



                <div>

                    <div>
                        <button type="submit" class="btn btn-outline btn-primary"><i class="fa fa-check"></i> Save</button>

                        <button type="reset" class="btn btn-danger btn-outline"><i class="fa fa-refresh"></i> Reset</button>

                        <!-- <a class="btn btn-default btn-outline pull-right" onclick="$('#modal-form').modal('hide');"><i class="fa fa-times"></i> Close</a> -->


                    </div>
            </form>

        </div>
    </div>
</div>
@endsection