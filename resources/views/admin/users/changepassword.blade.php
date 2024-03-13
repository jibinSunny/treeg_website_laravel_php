@extends('admin.master')
@section('pageTitle', 'Change Password')
@section('content')


<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-6" >
        <h2><?php echo @$module_caption ?></h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ url('/admin/home') }}">Home</a>
            </li>

            <li class="active">
                <strong>{{ $module_caption }}</strong>
            </li>


        </ol>
    </div>
    <div class="col-sm-6">
        <div class="title-action">
           
        </div>
    </div>
</div>  


<div class="wrapper wrapper-content animated fadeInRight">

    @if(session()->has('success'))

         <div class="alert alert-success">{{ session()->get('success') }}<A class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</A></div>
 
    @endif

  

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>{{ $module_caption }}</h5>

                </div>
                <div class="ibox-content">
                   <form method="post" class="form-horizontal" action="{{ url('/admin/changepassword_post') }}" enctype="multipart/form-data">
                    	
                              {{ csrf_field() }}
                              
                    <div class="col-lg-5">
                        <div class="form-group{{ $errors->has('old_password') ? ' has-error' : '' }}">
                               
                                    <label class=" control-label">Old Password <font color="#FF0000">*</font></label>
                                    <input type="text" class="form-control" id="old_password" onmouseover="$('#old_password').tooltip('show')" title="Enter Old Password" placeholder="Old Password" value="{{old('old_password')}}" name="old_password">
                                     @if ($errors->has('old_password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('old_password') }}</strong>
                                        </span>
                                    @endif
                               
                            </div>
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                               
                                    <label class=" control-label">Password <font color="#FF0000">*</font></label>
                                    <input type="text" class="form-control" id="password" onmouseover="$('#password').tooltip('show')" title="Enter Password" placeholder="Password" value="{{old('password')}}" name="password">
                                     @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                               
                            </div>

                            <div class="form-group{{ $errors->has('conf_password') ? ' has-error' : '' }}">
                               
                                    <label class=" control-label">Confirm Password <font color="#FF0000">*</font></label>
                                    <input type="text" class="form-control" id="conf_password" onmouseover="$('#conf_password').tooltip('show')" title="Enter Confirm Password" placeholder="Confirm Password" value="{{old('conf_password')}}" name="conf_password">
                                     @if ($errors->has('conf_password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('conf_password') }}</strong>
                                        </span>
                                    @endif
                               
                            </div>

                             <button class="btn btn-white" type="submit" id="btn" style="background-color: #1ab394; border-color: #1ab394; color: #FFF" onmouseover="$('#btn').tooltip('show')" title="Click to save">Update</button>
                    </div>

                    </form>

                    <div class="clearfix"></div>
                </div>
            
            </div>
        </div>


    </div>
</div>

@endsection

@section('scripts')

@endsection