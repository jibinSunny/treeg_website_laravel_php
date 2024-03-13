@extends('layouts.master')
@section('title', $project->title)
@section('content')

<div class="wrapper wrapper-content">
    <div class="animated fadeInRightBig">
        <div class="container">
            <div class="row">
                <div class="col-md-12 ibox-title">

                    <div class="row">
                        <div class="col-lg-6">
                            <dl class="row mb-0">
                                <div class="col-sm-4 text-sm-right">
                                    <dt>
                                        <h>Project Name:
                                    </dt>
                                </div>
                                <div class="col-sm-8 text-sm-left">
                                    <dd class="mb-1">
                                        <h3>{{ $project->title }}</h3>
                                    </dd>
                                </div>
                            </dl>
                            <dl class="row mb-0">
                                <div class="col-sm-4 text-sm-right">
                                    <dt>Caption:</dt>
                                </div>
                                <div class="col-sm-8 text-sm-left">
                                    <dd class="mb-1">{{ $project->caption }}</dd>
                                </div>
                            </dl>
                            <dl class="row mb-0">
                                <div class="col-sm-4 text-sm-right">
                                    <dt>Location:</dt>
                                </div>
                                <div class="col-sm-8 text-sm-left">
                                    @foreach($location as $location)
                                    @if($location->id == $project->location )
                                    <dd class="mb-1">{{ $location->location }}</dd>
                                    @endif
                                    @endforeach
                                </div>
                            </dl>
                            <dl class="row mb-0">
                                <div class="col-sm-4 text-sm-right">
                                    <dt>Status:</dt>
                                </div>
                                <div class="col-sm-8 text-sm-left">
                                    @if($project->status=="1")
                                    <dd class="mb-1">Ongoing</dd>
                                    @elseif($project->status=="2")
                                    <dd class="mb-1">Completed</dd>
                                    @elseif($project->status=="3")
                                    <dd class="mb-1">Upcoming</dd>
                                    @endif


                                </div>
                            </dl>
                            <dl class="row mb-0">
                                <div class="col-sm-4 text-sm-right">
                                    <dt>Phone:</dt>
                                </div>
                                <div class="col-sm-8 text-sm-left">
                                    <dd class="mb-1">{{ $project->phone }}</dd>
                                </div>
                            </dl>
                            <dl class="row mb-0">
                                <div class="col-sm-4 text-sm-right">
                                    <dt>Priority:</dt>
                                </div>
                                <div class="col-sm-8 text-sm-left">
                                    <dd class="mb-1">{{ $project->priority }}</dd>
                                </div>
                            </dl>
                            <dl class="row mb-0">
                                <div class="col-sm-4 text-sm-right">
                                    <dt>Address:</dt>
                                </div>
                                <div class="col-sm-8 text-sm-left">
                                    <dd class="mb-1">{{ $project->address }}</dd>
                                </div>
                            </dl>
                            <dl class="row mb-0">
                                <div class="col-sm-4 text-sm-right">
                                    <dt>Descxription:</dt>
                                </div>
                                <div class="col-sm-8 text-sm-left">
                                    <dd class="mb-1"> {!! $project->description !!}</dd>
                                </div>
                            </dl>
                            <dl class="row mb-0">
                                <div class="col-sm-4 text-sm-right">
                                    <dt>Image:</dt>

                                </div>
                                <div class="col-sm-8 text-sm-left">
                                    <dd class="mb-1">
                                        <img src="{{ asset(Storage::url($project->image)) }}" style="width: 100px;" id="category-icon" data-toggle="modal" data-target="#change_photo" class="img-thumbnail img-hover">

                                    </dd>
                                </div>
                            </dl>
                            <dl class="row mb-0">
                                <div class="col-sm-4 text-sm-right">
                                    <dt>Project Booking Image:</dt>

                                </div>
                                <div class="col-sm-8 text-sm-left">
                                    <dd class="mb-1">
                                        <img src="{{ asset(Storage::url($project->booking_image)) }}" style="width: 100px;" id="category-icon" data-toggle="modal" data-target="#change_photo" class="img-thumbnail img-hover">

                                    </dd>
                                </div>
                            </dl>
                            <dl class="row mb-0">
                                <div class="col-sm-4 text-sm-right">
                                    <dt>Change Project Activity:</dt>

                                </div>
                                <div class="col-sm-8 text-sm-left">
                                    <dd class="mb-1">
                                        <form action="{{ route('projects.update',$project->id) }}" method="post">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="approve" value="{{ ($project->active==true) ? '0' : '1' }}">

                                            <input type="submit" class="btn btn-{{ ($project->active==true) ? 'danger' : 'primary' }}" value="{{ ($project->active==true) ? 'Dissable' : 'Approve' }}">
                                        </form>
                                    </dd>
                                </div>
                            </dl>


                        </div>

                    </div>

                    <a href="{{ asset('admin/projects/'.$project->id.'/edit') }}" class="pull-right btn btn-outline btn btn-success " title="Edit"><i class="fa fa-pencil-square-o"></i>Edit</a>
                </div>
                <!-- Key Information-->
                <div class="mt-2 col-md-12 ibox-title">
                    <h2>Key Information</h2>
                    <!-- <a data-toggle="modal" data-url="{{ route('key_information.store') }}" data-title="Create Key Information" href=".custom-modal" class="pull-right btn btn-outline btn-success modal-open"><i class="fa fa-plus"></i> Add</a> -->
                    <button type="button" class="pull-right btn btn-outline btn btn-success" data-toggle="modal" data-target="#myModal_Key"><i class="fa fa-plus"></i> Add</button>
                    <!-- <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button> -->

                    <!-- Modal -->
                    <div id="myModal_Key" class="modal fade" role="dialog">
                        <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
                                    <center>
                                        <h2 class="modal-title"> Key Information</h2>
                                    </center>
                                    <!-- <h4 class="modal-title">Modal Header</h4> -->
                                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i>Close</button>
                                </div>
                                <div class="modal-body">
                                    <form class="form-horizontal" method="POST" action="{{ route('key_information.store') }}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group" id="err_name">
                                            <label>Project Name</label>
                                            <input id="name" type="text" class="form-control" value="{{ $project->title }}" disabled placeholder="Name">
                                            <input type="hidden" name="project_id" value="{{ $project->id }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Priority</label>
                                            <input type="number" class="form-control" name="priority">
                                        </div>
                                        <div class="form-group">
                                            <label>Title</label>
                                            <input name="title" type="text" class="form-control">

                                        </div>
                                        <div class="form-group">
                                            <label>Select Icon (Size: 50x50)</label>
                                            <input type="file" name="image" class="form-control">
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
                                <th>title</th>
                                <th>Image</th>
                                <th>Priority</th>
                                <th width="10%">Actions</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($keyinformations as $i=> $keys)
                            <tr>
                                <td>{{ $i+1 }}</td>
                                <!-- <td>{{ $keys->priority }}</td> -->
                                <td>{{ $keys->title }}</td>
                                <td>@if($keys->image)
                                    <img src="{{ asset(Storage::url($keys->image)) }}" width="40" alt="">@endif</td>
                                <td>{{ $keys->priority }}</td>
                                <td colspan="2">
                                    <a href="{{ route('key_information.edit',$keys->id) }}" class="btn table-action-btn " title="Edit"><i class="fa fa-pencil-square-o"></i> </a>
                                    <!-- <a data-toggle="modal" data-url="{{ route('key_information.update',$keys->id) }}" data-title="Edit Key Information" href=".custom-modal" href="" class="btnEditRow btn table-action-btn modal-open" title="Edit"><i class="fa fa-pencil-square-o"></i> </a> -->

                                    @permission('delete.projects')
                                    <a href="" data-url="{{ route('key_information.destroy',$keys->id) }}" class="btn table-action-btn btnDeleteRow" title="Delete"> <i class="fa fa-times-circle"></i></a>

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
                {{ $keyinformations->links() }}
                <!-- Floor Plan -->
                <div class="mt-2 col-md-12 ibox-title">
                    <h2>Villa Type Plan</h2>
                    <!-- <a data-toggle="modal" data-url="{{ route('floorplan.store') }}" data-title="Floor Plan" href=".custom-modal" class="pull-right btn btn-outline btn-success modal-open"><i class="fa fa-plus"></i> Add</a> -->
                    <button type="button" class="pull-right btn btn-outline btn btn-success" data-toggle="modal" data-target="#myModal_floor"><i class="fa fa-plus"></i> Add</button>
                    <!-- <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button> -->

                    <!-- Modal -->
                    <div id="myModal_floor" class="modal fade" role="dialog">
                        <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
                                    <center>
                                        <h2 class="modal-title"> Floor Plan</h2>
                                    </center>
                                    <!-- <h4 class="modal-title">Modal Header</h4> -->
                                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i>Close</button>
                                </div>
                                <div class="modal-body">
                                    <form class="form-horizontal" method="POST" action="{{ route('floorplan.store') }}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group" id="err_name">
                                            <label>Project Name</label>
                                            <input id="name" type="text" class="form-control" value="{{ $project->title }}" disabled placeholder="Name">
                                            <input type="hidden" name="project_id" value="{{ $project->id }}">
                                        </div>

                                        <div class="form-group">
                                            <label>Title</label>
                                            <input name="title" type="text" class="form-control">

                                        </div>
                                        <!-- <div class="form-group" >
                                            <label>Area</label>
                                            <input name="area" type="text" class="form-control">

                                        </div> -->
                                        <div class="form-group">
                                            <label for="">Priority</label>
                                            <input type="number" class="form-control" name="priority">
                                        </div>
                                        <div class="form-group">
                                            <label>Select Image (Size: 1920x1080)</label>
                                            <input type="file" name="image" class="form-control">
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
                                <th>Title</th>
                                <th>Priority</th>
                                <th>Image</th>
                                <th>Actions</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($floorplans as $s=> $floorplan)
                            <tr>
                                <td>{{ $s+1 }}</td>
                                <td>{{ $floorplan->title }}</td>
                                <td>{{ $floorplan->priority }}</td>

                                <td>@if($floorplan->image)<img width="40" src="{{ asset(Storage::url($floorplan->image)) }}" alt="">@endif</td>

                                <td colspan="2">
                                    <!-- <a href=".custom-modal" data-url="{{ route('floorplan.update',$floorplan->id) }}" data-toggle="modal" data-title="Floor Plan" class="btnEditRow btn table-action-btn modal-open" title="Edit"><i class="fa fa-pencil-square-o"></i> </a> -->
                                    <a href="{{ route('floorplan.edit',$floorplan->id) }}" class="btn table-action-btn " title="Edit"><i class="fa fa-pencil-square-o"></i> </a>
                                    @permission('delete.projects')
                                    <a href="" data-url="{{ route('floorplan.destroy',$floorplan->id) }}" class="btn table-action-btn btnDeleteRow" title="Delete"> <i class="fa fa-times-circle"></i></a>

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
                {{ $floorplans->links() }}
                <!-- Amenities -->
                <div class="mt-2 col-md-12 ibox-title">
                    <h2>Amenities</h2>
                    <!-- Trigger the modal with a button -->
                    <!-- <a data-toggle="modal" data-url="{{ route('key_information.store') }}" data-title="Create Key Information" href=".custom-modal" class="pull-right btn btn-outline btn-success modal-open"><i class="fa fa-plus"></i> Add</a> -->
                    <button type="button" class="pull-right btn btn-outline btn btn-success" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i> Add</button>
                    <!-- <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button> -->

                    <!-- Modal -->
                    <div id="myModal" class="modal fade" role="dialog">
                        <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
                                    <center>
                                        <h2 class="modal-title"> Amenity</h2>
                                    </center>
                                    <!-- <h4 class="modal-title">Modal Header</h4> -->
                                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i>Close</button>
                                </div>
                                <div class="modal-body">
                                    <form class="form-horizontal" method="POST" action="{{ route('project_amenity.store') }}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group" id="err_name">
                                            <label>Project Name</label>
                                            <input id="name" type="text" class="form-control" value="{{ $project->title }}" disabled placeholder="Name">
                                            <input type="hidden" name="project_id" value="{{ $project->id }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Priority</label>
                                            <input type="number" class="form-control" name="priority">
                                        </div>
                                        <div class="form-group">
                                            <label>Title</label>
                                            <input name="title" type="text" class="form-control">

                                        </div>
                                        <div class="form-group">
                                            <label>Select Image (Size: 307x210)</label>
                                            <input type="file" name="image" class="form-control">
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


                                <th>title</th>
                                <th>Image</th>
                                <th>Priority</th>
                                <th>Actions</th>`
                            </tr>
                        </thead>
                        <tbody>

                            @if($amenities!=null)
                            @foreach($amenities as $k=> $amenity)
                            <tr>
                                <td>{{ $k+1 }}</td>
                                <td>{{ $amenity->title }}</td>
                                <td>@if($amenity->image)
                                    <img src="{{ asset(Storage::url($amenity->image)) }}" width="40" alt="">@endif</td>
                                <td>{{ $amenity->priority }}</td>
                                <td colspan="2">
                                    <!-- <a data-toggle="modal" data-url="{{ route('project_amenity.update',$amenity->id) }}" data-title="Edit Amenity" href=".custom-modal" href="" class="btnEditRow btn table-action-btn modal-open" title="Edit"><i class="fa fa-pencil-square-o"></i> </a> -->

                                    <a href="{{ route('project_amenity.edit',$amenity->id) }}" class="btn table-action-btn " title="Edit"><i class="fa fa-pencil-square-o"></i> </a>
                                    @permission('delete.project.amenities')
                                    <a href="" data-url="{{ route('project_amenity.destroy',$amenity->id) }}"" class=" btn table-action-btn btnDeleteRow" title="Delete"> <i class="fa fa-times-circle fa-lg"></i></a>
                                    <form action="" class="deleteForm">
                                        @method('DELETE')
                                        @csrf
                                    </form>
                                    @endpermission
                                </td>
                            </tr>

                            @endforeach
                            @endif

                        </tbody>
                    </table>
                </div>
                {{ $amenities->links() }}
                <!-- Specification category-->
                <div class="mt-2 col-md-12 ibox-title">
                    <h2>Specification Category</h2>
                    <!-- <a data-toggle="modal" data-url="{{ route('project_spec.store') }}" data-title="Create Specification" href=".custom-modal" class="pull-right btn btn-outline btn-success modal-open"><i class="fa fa-plus"></i> Add</a> -->
                    <button type="button" class="pull-right btn btn-outline btn btn-success" data-toggle="modal" data-target="#myModal_specification_category"><i class="fa fa-plus"></i> Add</button>
                    <!-- <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button> -->

                    <!-- Modal -->
                    <div id="myModal_specification_category" class="modal fade" role="dialog">
                        <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
                                    <center>
                                        <h2 class="modal-title"> Specification Category</h2>
                                    </center>
                                    <!-- <h4 class="modal-title">Modal Header</h4> -->
                                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i>Close</button>
                                </div>
                                <div class="modal-body">
                                    <form class="form-horizontal" method="POST" action="{{ route('specification_category.store') }}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group" id="err_name">
                                            <label>Project Name</label>
                                            <input id="name" type="text" class="form-control" value="{{ $project->title }}" disabled placeholder="Name">
                                            <input type="hidden" name="project_id" value="{{ $project->id }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Priority</label>
                                            <input type="number" class="form-control" name="priority">
                                        </div>
                                        <!-- <div class="form-group" >
                                                    <label>Title</label>
                                                    <input name="specification_title" type="text" class="form-control">

                                                </div> -->
                                        <div class="form-group">
                                            <label for="">title</label>
                                            <input type="text" class="form-control" name="title">
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

                                <th>title</th>
                                <th>priority</th>
                                <!-- <th>View</th> -->
                                <th>Actions</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($specs_category as $i=> $spec)
                            <tr>
                                <td>{{ $i+1 }}</td>
                                <!-- <td>{{ $spec->priority }}</td> -->
                                <td>{{ $spec->title }}</td>
                                <td>{{ $spec->priority}}</td>

                                <td>

                                    <a href="{{ route('specification_category.edit',$spec->id) }}" class="btn table-action-btn " title="Edit"><i class="fa fa-pencil-square-o"></i> </a>



                                    {{-- <form action="/admin/specification_category/{{ $spec->id }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="id" value="{{ $spec->id }}">
                                    <button type=""></button>
                                    </form> --}}

                                    @permission('delete.projects')
                                    <a href="" data-url="{{ route('specification_category.destroy',$spec->id) }}" class="btn table-action-btn btnDeleteRow" title="Delete"> <i class="fa fa-times-circle"></i></a>

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
                {{ $specs_category->links() }}
                <!-- Specification-->


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
                                            <label>Project Name</label>
                                            <input id="name" type="text" class="form-control" value="{{ $project->title }}" disabled placeholder="Name">
                                            <input type="hidden" name="project_id" value="{{ $project->id }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Priority</label>
                                            <input type="number" class="form-control" name="priority">
                                        </div>
                                        <div class="form-group">
                                            <label class=" control-label"><strong>Select Book Category<font color="#FF0000">*</font></strong></label>
                                            <div class="control">
                                                <select class="form-control" data-placeholder="Select Book Category" name="specification_category_id" id='book_category_id' style="height: 35px;" required>


                                                    <option label="" value="">Select Specification Category</option>
                                                    @foreach($specs_category as $i=> $spec)
                                                    <option label="" value="{{$spec->id }}">{{$spec->title }}</option>
                                                    @endforeach
                                                </select>
                                            </div>


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
                                <th>Priority</th>
                                <th>Specification category</th>
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
                                <td>@foreach($specs_category as $i=> $specifi)
                                    @if($spec->specification_category_id ==$specifi->id)
                                    {{$specifi->title}}
                                    @endif
                                @endforeach</td>
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

                <!-- Project Gallery-->

                <div class="mt-2 col-md-12 ibox-title">
                    <h2>Project Gallery</h2>
                    <!-- <a data-toggle="modal" data-url="{{ route('project_gallery.store') }}" data-title="Create Project Gallery" href=".custom-modal" class="pull-right btn btn-outline btn-success modal-open"><i class="fa fa-plus"></i> Add</a> -->
                    <button type="button" class="pull-right btn btn-outline btn btn-success" data-toggle="modal" data-target="#myModal_gallery"><i class="fa fa-plus"></i> Add</button>
                    <!-- <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button> -->
                    <div id="myModal_gallery" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                      <center>
                                        <h2 class="modal-title">Gallery</h2>
                                    </center>

                                <form class="form-horizontal" method="POST" action="{{ route('project_gallery.store') }}" enctype="multipart/form-data">
                                @csrf
                                     <div class="form-group">
                                            <label>Project Name</label>
                                            <input id="name" type="text" class="form-control" value="{{ $project->title }}" disabled placeholder="Name">
                                            <input type="hidden" name="project_id" value="{{ $project->id }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Priority</label>
                                            <input type="number" class="form-control" name="priority">
                                        </div>

                            
                            <div class="row">
                            <div class="col-md-6 text-center">
                                <div id="upload-demo"></div>
                            </div>
                            

                            <div class="col-md-6">
                            <div id="preview-crop-image" style="background:#9d9d9d;width:100%;height:300px;"></div>
                            </div>
                            </div>
                            <div class="col-md-6" style="padding:1%;">
                                <strong>Select image to crop:</strong>
                                <input type="file" name="image" id="image">
                                @if ($errors->has('image'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('image') }}</strong>
                                </span>
                                @endif

                                <button type="button" class="btn btn-primary btn-block upload-image" style="margin-top:2%">Crop Image</button>
                            </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-outline btn-primary"><i class="fa fa-check"></i> Save</button>


                                <button type="reset" class="btn btn-danger btn-outline">
                                        <i class="fa fa-refresh"></i> Reset</button>

                                    <a data-dismiss="modal" class="btn btn-default btn-outline pull-right"><i class="fa fa-times"></i> Close</a>


                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
                    <!-- Modal -->
              
                    <table class="table table-striped table-bordered table-hover dataTables-example">
                        <thead>
                            <tr>
                                <th>SL No.</th>
                                <!-- <th>Title</th> -->
                                <th>Image</th>
                                <th>Priority</th>
                                <th>Actions</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($galleries as $n=> $gallery)
                            <tr>
                                <td>{{ $n+1 }}</td>


                                <td>@if($gallery->image)<img width="40" src="{{ asset(Storage::url($gallery->image)) }}" alt="">@endif</td>
                                <td>{{ $gallery->priority }}</td>
                                <!-- <td>@if($gallery->image) <img src="{{ asset($gallery->thumb) }}" width="40" alt=""> @endif</td> -->
                                <td colspan="2">

                                    <a href="{{ route('project_gallery.edit',$gallery->id) }}" class="btn table-action-btn " title="Edit"><i class="fa fa-pencil-square-o"></i> </a>


                                    @permission('delete.projects')
                                    <a href="" data-url="{{ route('project_gallery.destroy',$gallery->id) }}" class="btn table-action-btn btnDeleteRow" title="Delete"> <i class="fa fa-times-circle"></i></a>

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
                {{ $galleries->links() }}

            </div>
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

            @if(Session::has('errors'))
                @foreach($errors->all() as $error)  
                    toastr.error('{{ $error }}', 'Error');
                @endforeach
            @endif    

    $(document).ready(function () {

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


        $('#image').on('change', function () { 
          var reader = new FileReader();
            reader.onload = function (e) {
              resize.croppie('bind',{
                url: e.target.result
              }).then(function(){
                console.log('jQuery bind complete');
              });
            }
            reader.readAsDataURL(this.files[0]);
        });


       $('.upload-image').on('click', function (ev) {
          resize.croppie('result', {
            type: 'canvas',
            size: 'viewport'
          }).then(function (img) {
            $.ajax({
              url: "{{route('croppie.upload-image')}}",
              type: "POST",
              data: {"image":img},
              success: function (data) {
                html = '<img src="' + img + '" /><input type="hidden" name="thumb" value="'+data.filename+'">';
                $("#preview-crop-image").html(html);
              }
            });
          });
        });
            

    @if(Session::has('message'))
    toastr.success('{{ Session::get('message') }}', 'Successful');
    @endif  
        
        dataTableObject = $('.dataTables-example').DataTable({
                pageLength: 10,
                responsive: true,
                 "fnDrawCallback": function (oSettings) {
                $('td input:checkbox').iCheck({
                    checkboxClass: 'icheckbox_square-green'
                });
                $('.chkRowSelect').on('ifClicked', function (e) {
                    if ($(this).is(':checked')) {
                        $(this).closest('tr').removeClass('selected');
                    } else {
                        $(this).closest('tr').addClass('selected');
                    }
                });
                $('.btnDeleteRow').unbind('click', deleteCurrentRow);
                $('.btnDeleteRow').bind('click', deleteCurrentRow);
            },
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                ],
                order:[[2,'asc']]
        });





        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });

        $('.i-checks').on('ifClicked', function (e) {
            var table = $(e.target).closest('table');
            if ($(this).is(':checked')) {
                $('tr', table).removeClass('selected');
                $('td input:checkbox', table).iCheck('uncheck');
            } else {
                $('tr', table).not(':first').addClass('selected');
                $('td input:checkbox', table).iCheck('check');
            }
        });

        var registerForm = $("#create_form");
        registerForm.submit(function(e){
            e.preventDefault();
            var formData = registerForm.serialize();
            $("#err_name").removeClass("has-error");
            $('body').toggleClass('sk-loading');

            $.ajax({
                url:'/creategroup',
                type:'POST',
                data:formData,
                success:function(data){
                    $('body').toggleClass('sk-loading');
                    if (data.success == true)
                        {
                            $('#modal-form').modal( 'hide' );
                            toastr.success(data.message, 'Successful');
                            setTimeout(function () {
                                location.reload(true);
                            }, 2000);

                            return false;
                        }
                        else
                        {
                            toastr.error('Someting Went Wrong', 'Error!');
                            return false;
                        }
                },
                error: function (data) {
                    //console.log(data.responseText);
                    $('body').toggleClass('sk-loading');
                    var obj = jQuery.parseJSON( data.responseText );
                    if(obj.name){
                        $("#err_name").addClass("has-error");
                        $( '#name' ).html( obj.name );
                    }
                }
            });
        });

        $('#chkSelectAll').on('ifClicked', function (e) {
            var table = $('#access_container');
            if ($(this).is(':checked'))
                $('input:checkbox', table).iCheck('uncheck');
            else
                $('input:checkbox', table).iCheck('check');
        });

        $('.chkSelectAllSubs').on('ifClicked', function (e) {
            var table = $(this).closest('.row');
            if ($(this).is(':checked'))
                $('input:checkbox', table).iCheck('uncheck');
            else
                $('input:checkbox', table).iCheck('check');
        });

        $('.chkSubModules').on('ifClicked', function (e) {
            var table = $(this).closest('.row').parent().closest('.row');
            if ($(this).is(':checked')) {
                len = $(this).closest('.row').find(":checkbox:checked").length;
                if (len <= 1)
                    $('input:checkbox.chkSelectAllSubs', table).iCheck('uncheck');
            } else {
                $('input:checkbox.chkSelectAllSubs', table).iCheck('check');
            }
        });


        function deleteCurrentRow(e) {
            e.preventDefault();
            cur_row = $(this).closest('tr');
            cur_id = cur_row.find('.chkRowSelect').val();
            if (confirm('Are you sure to delete.?')) {
                $('body').toggleClass('sk-loading');
                $.ajax({
                    type: "POST",
                    url: "{!! url('/admin/deletecontactrow') !!}",
                    data: 'chkSelectedRows=' + cur_id,
                    success: function (res) {
                        $('body').toggleClass('sk-loading');
                        if(res.success == false)
                        {
                            toastr.error(res.data,'Error!');
                        } else{
                            dataTableObject.row(cur_row).remove().draw(false);
                            toastr.success(res.data,'Success!');
                        }
                    },
                    error: function () {
                        $('body').toggleClass('sk-loading');
                        toastr.error('Something Went Wrong','Error!');
                    }
                });
            }

        }

       $('#deleteItem').click(function (e) {
            e.preventDefault();
            if (confirm('Are you sure to delete.?')) {
                $('body').toggleClass('sk-loading');
                $.ajax({
                    type: "POST",
                    url: "{!! url('/admin/deletecontactrow') !!}",
                    data: $('#checksForm').serialize(),
                    success: function (res) {
                        $('body').toggleClass('sk-loading');
                        if(res.success == false)
                        {
                            toastr.error(res.data,'Error!');
                        } else{
                            //dataTableObject.row('.selected').remove().draw(false);
                            location.reload(true);
                            toastr.success(res.data,'Success!');
                        }
                    },
                    error: function () {
                        $('body').toggleClass('sk-loading');
                        toastr.error('Something Went Wrong','Error!');
                    }
                });
            }
        });

       $('#enableItem').click(function (e) {
            e.preventDefault();
            if (confirm('Are you sure to enable.?')) {
                $('body').toggleClass('sk-loading');
                $.ajax({
                    type: "POST",
                    url: "{!! url('/admin/enableclientrow') !!}",
                    data: $('#checksForm').serialize(),
                    success: function (res) {
                        $('body').toggleClass('sk-loading');
                        if(res.success == false)
                        {
                            toastr.error(res.data,'Error!');
                        } else{
                            location.reload(true);
                            toastr.success(res.data,'Success!');
                        }
                    },
                    error: function () {
                        $('body').toggleClass('sk-loading');
                        toastr.error('Something Went Wrong','Error!');
                    }
                });
            }
        });


       $('#disableItem').click(function (e) {
            e.preventDefault();
            if (confirm('Are you sure to disable.?')) {
                $('body').toggleClass('sk-loading');
                $.ajax({
                    type: "POST",
                    url: "{!! url('/admin/disableclientrow') !!}",
                    data: $('#checksForm').serialize(),
                    success: function (res) {
                        $('body').toggleClass('sk-loading');
                        if(res.success == false)
                        {
                            toastr.error(res.data,'Error!');
                        } else{
                            location.reload(true);
                            toastr.success(res.data,'Success!');
                        }
                    },
                    error: function () {
                        $('body').toggleClass('sk-loading');
                        toastr.error('Something Went Wrong','Error!');
                    }
                });
            }
        });

    });
</script>

@endsection