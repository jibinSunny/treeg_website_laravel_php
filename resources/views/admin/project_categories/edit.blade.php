@extends('layouts.master')
@section('title', 'Update Photo Album')
@section('content')

<div class="wrapper wrapper-content">
    <div class="animated fadeInRightBig">
        <div class="container">
        <form class="form-horizontal" id="create_form" role="form" method="POST" action="{{ route('project_categories.update',$projectType[0]->id) }}">
                      @csrf  
                    @method('PUT')      

                <div class="form-group" id="err_name">
                    <label>Type Name</label> 
                    <input id="name" type="text" class="form-control" name="name" value="{{ $projectType[0]->name}}" placeholder="Name" >
                    <input id="name" type="hidden" class="form-control" name="id" value="{{ $projectType[0]->id}}" placeholder="Name" ></div>
               

                <div class="form-group" id="description">
                    <label>Description</label> 
                   <textarea name="description" id="" class="form-control" rows="3">{{ $projectType[0]->description}}</textarea>
                 </div>  
                <div>
                    <button type="submit" class="btn btn-outline btn-primary"><i class="fa fa-check"></i> Save</button>

                    <button type="reset" class="btn btn-danger btn-outline"><i class="fa fa-refresh"></i> Reset</button>

                </div>
            </form>
            
        </div>
    </div>
</div>
@endsection

