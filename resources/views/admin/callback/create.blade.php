@extends('layouts.master')
@section('title', 'Add New Article')
@section('content')

<div class="wrapper wrapper-content">
    <div class="animated fadeInRightBig">
        <div class="container">
            <form action="/admin/article" method="POST">
            <div class="row">
                        
                    @csrf        
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" name="title" class="form-control">
                            <input type="hidden" name="article_category_id" value="1">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                         <label for="Designation">Designation</label>
                            <input type="text" class="form-control" name="slug">
                        </div>
                    </div>
              
                    <div class="col-lg-12">
                        <label for="">Description</label>
                       <textarea name="description" id="editor1" rows="10" cols="80"> </textarea>
                    </div>
                    </div>

                    <div class="col-lg-12">
                        <button type="submit" class="mt-3 btn btn-primary btn-outline" ><i class="fa fa-plus"></i> Save</button>
                    </div>
                </form>    
            
        </div>
    </div>
</div>
@endsection