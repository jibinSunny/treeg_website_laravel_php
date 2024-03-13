@extends('layouts.master')
@section('title', 'Users')
@section('content')

<style>
    #cropContainerEyecandy{ width:241px; height:241px; position: relative; border:1px solid #ccc;} 

</style>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Users</h2>

    </div>
    <div class="col-lg-2">
    <br/>
    @permission('create.users')
        <a data-toggle="modal" data-url="{{ route('users.store') }}" title="New User" href="#modal-form" class="btn btn-outline btn-success modal-open"><i class="fa fa-plus"></i> New User</a>
    @endpermission    

        <div id="modal-form" class="modal fade" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <center><h2 class="m-t-none m-b head"></h2></center>
             <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">

                @csrf
                <input type="hidden" name="_method">
                <div class="form-group" id="err_name"><label>Name</label> <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Name" ></div>

                <div class="form-group" id="err_email"><label>Email</label> <input id="email" type="text" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email" ></div>

                <div class="form-group" id="err_pass"><label>Password</label> <input id="password" type="password" class="form-control" name="password" placeholder="Password" ></div>

                <div class="form-group" id="err_conf_pass"><label>Confirm Password</label> <input  id="password_confirmation" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" ></div>

                <div class="form-group" id="err_role"><label>Role</label>
                <select name="role_id" class="form-control" id="role_group">
                    <option value="">Select Role</option>
                    @foreach(@$roles as $role)
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @endforeach
                </select>
                </div>

                <div class="form-group"><label>Is enabled ? <input type="checkbox" class="i-checks" name="is_enabled" id="is_enabled" value="1" checked></label> </div>
                <!-- <div class="form-group">
                            <label>Profile Pic</label>  
                            <div id="cropContainerEyecandy">
                                <img src="img/default_image.jpg" style="width: 241px;height: 241px" >
                            </div>
                </div> -->
                <input type="hidden" name="id" id="id"  value="0"/>
                <input id="hidImageFile" name="hidImageFile" type="hidden"/>
                <input id="hidImageUploaded" name="hidImageUploaded" type="hidden" value="0"/>
                <div>
                    <button class="btn btn-outline btn-primary"><i class="fa fa-check"></i> Save</button>

                    <button type="reset" class="btn btn-danger btn-outline"><i class="fa fa-refresh"></i> Reset</button>

                    <a class="btn btn-default btn-outline pull-right" onclick="$('#modal-form').modal('hide');"><i class="fa fa-times"></i> Close</a>


                </div>
            </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>List</h5>
                <div class="ibox-tools">

                
                </div>
            </div>
            <div class="ibox-content">
  
            <div class="table-responsive">
            <form action="#" id="checksForm">
            <table class="table table-striped table-bordered table-hover dataTables-example" >
            <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>User Role</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($users as $user)
                <tr class="gradeX">
                   
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ (count($user->Role)!=0) ? $user->Role[0]->name : '' }}</td>
                    <td class="status">{!!($user->active == 1)?'<span class="label label-primary">Enabled</span>':'<span class="label label-danger">Disabled</span>' !!}</td>
                    <td>
                        @permission('edit.users')
                        <a href="#modal-form" data-url="{{ route('users.update',$user->id) }}" data-toggle="modal" data-title="User Update" class="modal-open btn table-action-btn btnEditRow" title="Edit"><i class="fa fa-pencil-square-o"></i> </a> &nbsp;
                        @endpermission
                        @permission('delete.users')
                       
                        <a href="" data-url="{{ route('users.destroy',$user->id) }}"
                                        class="btn table-action-btn btnDeleteRow" title="Delete"> <i
                                        class="fa fa-times-circle"></i></a>


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
            </form>
                </div>
        {{ $users->links() }}

            

            </div>
        </div>
    </div>
    </div>
</div>
@endsection

@section('scripts')

<script>
    $(document).ready(function () {

            @if(Session::has('success'))
                toastr.success('{{ Session::get('success') }}', 'Successful');
            @endif


            @if(Session::has('errors'))
                @foreach($errors->all() as $error)  
                    toastr.error('{{ $error }}', 'Error');
                @endforeach
            @endif    
        
       

    });
</script>

@endsection
