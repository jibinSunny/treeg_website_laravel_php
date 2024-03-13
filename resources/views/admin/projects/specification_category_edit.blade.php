@extends('layouts.master')
@section('title', 'Update Project Specification Category')
@section('content')

<div class="wrapper wrapper-content">
    <div class="animated fadeInRightBig">
        <div class="container">
            <form class="form-horizontal" method="POST" action="{{ route('specification_category.update',$project_spec_category[0]->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group" id="err_name">
                    <!-- <label>Project Name</label> -->

                    <input type="hidden" name="project_id" value="{{ $project_spec_category[0]->project_id }}">
                </div>
                <div class="form-group">
                    <label for="">Priority</label>
                    <input type="text" class="form-control" value="{{ $project_spec_category[0]->priority}}" name="priority">
                </div>
                <div class="form-group">
                    <label>Title</label>
                    <input name="title" type="text"value="{{ $project_spec_category[0]->title}}" class="form-control">

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