@extends('layouts.master')
@section('title', 'Update Project Specification')
@section('content')

<div class="wrapper wrapper-content">
    <div class="animated fadeInRightBig">
        <div class="container">
            <form class="form-horizontal" method="POST" action="{{ route('project_spec.update',$project_spec->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group" id="err_name">
                    <!-- <label>Project Name</label> -->

                    <input type="hidden" name="project_id" value="{{ $project_spec->project_id }}">
                </div>
                <div class="form-group">
                    <label for="">Priority</label>
                    <input type="text" class="form-control" value="{{ $project_spec->priority}}" name="priority">
                </div>
                <div class="form-group">
                    <label class=" control-label"><strong>Select Book Category<font color="#FF0000">*</font></strong></label>
                    <div class="control">
                        <select class="form-control" data-placeholder="Select Book Category" name="specification_category_id" id='book_category_id' style="height: 35px;" required>

                           @foreach($specs as $i=> $spec)
                           @if($project_spec->specification_category_id ==$spec->id)
                                   
                            <option label="" value="{{$spec->id}}"> {{$spec->title}}</option>
                            @endif
                            @endforeach
                            @foreach($specs as $i=> $spec)
                            <option label="" value="{{$spec->id }}">{{$spec->title }}</option>
                            @endforeach
                        </select>
                    </div>


                </div>
                <!-- <div class="form-group" >
                                                    <label>Title</label>
                                                    <input name="specification_title" type="text" class="form-control">

                                                </div> -->
                <div class="form-group">
                    <label>Content</label>
                    <textarea id="description" name="content" class="form-control" rows="3">{{ $project_spec->content}}</textarea>
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