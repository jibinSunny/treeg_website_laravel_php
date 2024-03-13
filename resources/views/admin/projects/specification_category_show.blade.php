@extends('layouts.master')
@section('title', $project_spec_category[0]->title)
@section('content')

<div class="wrapper wrapper-content">
    <div class="animated fadeInRightBig">
        <div class="container">
            <div class="row">
                <div class="col-md-12 ibox-title">

                    <div class="row">
                        <div class="col-lg-6">
                            <dl class="row mb-0">
                                <div class="col-sm-6 text-sm-right">
                                    <dt>
                                        <h>Specification Category Name:
                                    </dt>
                                </div>
                                <div class="col-sm-6 text-sm-left">
                                    <dd class="mb-1">
                                        <h3>{{ $project_spec_category[0]->title }}</h3>
                                    </dd>
                                </div>
                            </dl>
       
         
     
                            <dl class="row mb-0">
                                <div class="col-sm-4 text-sm-right">
                                    <dt>Priority:</dt>
                                </div>
                                <div class="col-sm-8 text-sm-left">
                                    <dd class="mb-1">{{ $project_spec_category[0]->priority }}</dd>
                                </div>
                            </dl>
       
       

                
                       

                        </div>

                    </div>

                    <a href="{{ route('specification_category.edit',$project_spec_category[0]->id) }}" class="pull-right btn btn-outline btn btn-success " title="Edit"><i class="fa fa-pencil-square-o"></i>Edit</a>
                </div>
         
           
             
            

                <div class="mt-2 col-md-12 ibox-title">
                    <h2>Specification</h2>
                    <!-- <a data-toggle="modal" data-url="{{ route('project_spec.store') }}" data-title="Create Specification" href=".custom-modal" class="pull-right btn btn-outline btn-success modal-open"><i class="fa fa-plus"></i> Add</a> -->
                    <button type="button" class="pull-right btn btn-outline btn btn-success" data-toggle="modal" data-target="#myModal_specification"><i class="fa fa-plus"></i> Add</button>
                    <!-- <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button> -->

                    <!-- Modal -->
                    <div id="myModal_specification" class="modal fade" role="dialog">
                        <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
                                    <center>
                                        <h2 class="modal-title"> Specification</h2>
                                    </center>
                                    <!-- <h4 class="modal-title">Modal Header</h4> -->
                                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i>Close</button>
                                </div>
                                <div class="modal-body">
                                    <form class="form-horizontal" method="POST" action="{{ route('project_spec.store') }}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group" id="err_name">
                                            <label>Specification Category Name</label>
                                            <input id="name" type="text" class="form-control" value="{{ $project_spec_category[0]->title }}" disabled placeholder="Name">
                                            <input type="hidden" name="specification_category_id" value="{{ $project_spec_category[0]->id }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Priority</label>
                                            <input type="number" class="form-control" name="priority">
                                        </div>

                                        <div class="form-group">
                                            <label>Content</label>
                                            <textarea id="description" name="content" class="form-control" rows="3"></textarea>
                                        </div>

                                        <div>
                                            <button type="submit" class="btn btn-outline btn-primary"><i class="fa fa-check"></i> Save</button>

                                            <button type="reset" class="btn btn-danger btn-outline"><i class="fa fa-refresh"></i> Reset</button>

                                            <!-- <a class="btn btn-default btn-outline pull-right" onclick="$('#modal-form').modal('hide');"><i class="fa fa-times"></i> Close</a> -->


                                        </div>
                                    </form>

                                </div>
                                <!-- <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div> -->
                            </div>

                        </div>
                    </div>

                    <table class="table table-striped table-bordered table-hover dataTables-example">
                        <thead>
                            <tr>
                                <th>SL No.</th>

                                <th>Content</th>
                                <th>priority</th>
                                <th>Actions</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($specs as $i=> $spec)
                            <tr>
                                <td>{{ $i+1 }}</td>
                                <!-- <td>{{ $spec->priority }}</td> -->
                                <td>{{ $spec->content }}</td>
                                <td>{{ $spec->priority}}</td>
                                <td colspan="2">
                                    <a href="{{ route('project_spec.edit',$spec->id) }}" class="btn table-action-btn " title="Edit"><i class="fa fa-pencil-square-o"></i> </a>
                                    <!-- <a  href="{{ route('project_spec.edit',$spec->id) }}" class="btnEditRow btn table-action-btn" title="Edit"> -->
                                    <!-- <a data-toggle="modal" data-url="{{ route('project_spec.update',$spec->id) }}" data-title="Edit Key Information" href=".custom-modal" href="" class="btnEditRow btn table-action-btn modal-open" title="Edit"> -->



                                    {{-- <form action="/admin/project_spec/{{ $spec->id }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="id" value="{{ $spec->id }}">
                                    <button type=""></button>
                                    </form> --}}

                                    @permission('delete.projects')
                                    <a href="" data-url="{{ route('project_spec.destroy',$spec->id) }}" class="btn table-action-btn btnDeleteRow" title="Delete"> <i class="fa fa-times-circle"></i></a>

                                    <form action="" class="deleteForm">
                                        @method('DELETE')
                                        @csrf
                                    </form>
                                    @endpermission
                                </td>
                            </tr>

                            @endforeach

                        </tbody>
                    </table>
                </div>

                {{ $specs->links() }}

   

            </div>
        </div>
    </div>
</div>









@endsection