@extends('layouts.master')
@section('title', 'Update Project keyInformation')
@section('content')

<div class="wrapper wrapper-content">
    <div class="animated fadeInRightBig">
        <div class="container">
            <form class="form-horizontal" method="POST" action="{{ route('key_information.update',$keyInformation->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group" id="err_name">
                    <!-- <label>Project Name</label> -->

                    <input type="hidden" name="project_id" value="{{ $keyInformation->project_id }}">
                </div>
                <div class="form-group">
                    <label for="">Priority</label>
                    <input type="text" class="form-control" value="{{ $keyInformation->priority}}" name="priority">
                </div>
                <!-- <div class="form-group" >
                                                    <label>Title</label>
                                                    <input name="specification_title" type="text" class="form-control">

                                                </div> -->
                <div class="form-group">
                    <label>Title</label>
                    <input name="title" value="{{ $keyInformation->title}}" type="text" class="form-control">

                </div>
                <div class="form-group">
                    <label>Select Icon</label>
                    <input type="file" name="image" class="form-control">
                    <img src="{{ asset(Storage::url($keyInformation->image)) }}" width="40" alt="">
                </div>

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