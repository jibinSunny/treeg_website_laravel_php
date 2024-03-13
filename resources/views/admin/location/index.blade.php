@extends('layouts.master')
@section('title', 'Project Types')
@section('content')

<style>
    #cropContainerEyecandy{ width:241px; height:241px; position: relative; border:1px solid #ccc;} 

</style>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Types</h2>
    </div>
    <div class="col-lg-2">
    <br/>
        <a data-toggle="modal" href="#modal-form" class="btn btn-outline btn-success"><i class="fa fa-plus"></i>Add New Location</a>

        <div id="modal-form" class="modal fade" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <center><h2 class="m-t-none m-b">New Location</h2></center>

        <form class="form-horizontal" id="create_form" role="form" method="POST" action="{{ route('location.store') }}">
                @csrf
                <div class="form-group" id="err_name">
                    <label>Location</label> 
                    <input id="name" type="text" class="form-control" name="location" value="{{ old('location') }}" placeholder="Name" ></div>
               

                
                <div>
                    <button type="submit" class="btn btn-outline btn-primary"><i class="fa fa-check"></i> Save</button>

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
        <div class="col-md-8 offset-2">
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
                {{-- <th>Description</th> --}}
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($locations as $loc)
                <tr class="gradeX">
                    
                    <td>{{ $loc->location }}</td>
         
                    <td colspan="2">
                                <a href="{{ route('location.edit',$loc->id) }}" class="btn table-action-btn " title="Edit"><i class="fa fa-pencil-square-o"></i> </a>
                                @permission('edit.location')
                                    <a href="" data-url="{{ route('location.destroy',$loc->id) }}" class="btn table-action-btn btnDeleteRow" title="Delete"> <i class="fa fa-times-circle"></i></a>

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
        
        dataTableObject =  $('.dataTables-example').DataTable({
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
                $('.btnEditRow').unbind('click', editCurrentRow);
                $('.btnEditRow').bind('click', editCurrentRow);
            },
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                ],
                order:[[1,'asc']]
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

var croppicContainerModalOptions = {
        uploadUrl: '/upload',
        cropUrl: '/crop',
        imgEyecandy: false,
        outputUrlId: 'hidImageFile',
        //imgEyecandyOpacity:0.4,
        loaderHtml: '<div class="loader bubblingG"><span id="bubblingG_1"></span><span id="bubblingG_2"></span><span id="bubblingG_3"></span></div> ',
        onAfterImgUpload: function () {
            $('.cropImgWrapper').touchit();
            $('#hidImageUploaded').val(1);
        },
        onAfterImgCrop: function () {
            $('#hidImageUploaded').val(0);
        },
        onReset: function () {
            //alert('hi..');
            $('#cropContainerEyecandy').html(' <img src="img/default-profile.jpg" style="width: 241px;height: 241px" >');
            $('#hidImageUploaded').val(0);
            this.init();
        },
        onRemoveImage: function () {
            $('#cropContainerEyecandy').html(' <img src="img/default_image.jpg" style="width: 241px;height: 241px" >');
            this.init();
        }
        
    }
    cropContainerModal = new Croppic('cropContainerEyecandy', croppicContainerModalOptions);



        var registerForm = $("#create_form");
        registerForm.submit(function(e){
            e.preventDefault();
            var formData = registerForm.serialize();
            $("#err_name").removeClass("has-error");
            $("#err_email").removeClass("has-error");
            $("#err_pass").removeClass("has-error");
            $("#err_conf_pass").removeClass("has-error");
            $("#err_role").removeClass("has-error");
            var id = $('#id').val();

            $.ajax({
     
                    url: "{!! url('/admin/signup') !!}",
                type:'POST',
                data:formData,
                success:function(data){
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

                  

                    var obj = jQuery.parseJSON( data.responseText );
                   if(obj.name){
                        $("#err_name").addClass("has-error");
                        $( '#name' ).html( obj.name );
                    }
                    if(obj.email){
                        $("#err_email").addClass("has-error");
                        $( '#email' ).html( obj.email );
                    }
                    if(id == 0)
                    {
                        if(obj.password){
                            $("#err_pass").addClass("has-error");
                            $( '#password' ).html( obj.password );
                        }
                        if(obj.password_confirmation){
                            $("#err_conf_pass").addClass("has-error");
                            $( '#password_confirmation' ).html( obj.password_confirmation );
                        } 
                    }
                    
                    if(obj.role_group){
                        $("#err_role").addClass("has-error");
                        $( '#role_group' ).html( obj.role_group );
                    }

                    toastr.error(data.message, 'Error!');
                }
            });
        });


        function editCurrentRow(e) {
            e.preventDefault();
            cur_row = $(this).closest('tr');
            cur_id = cur_row.find('.chkRowSelect').val();
            
            $.ajax({
                url: "{!! url('/admin/edituserrow') !!}/"+ cur_id,
                success: function (res) {
                    //alert(JSON.stringify(data));
                    //alert(res.data.name);

                    var modelbox = $('#modal-form');
                    $('#name', modelbox).val(res.data.name);
                    $('#email', modelbox).val(res.data.email);
                    $('#role_group', modelbox).val(res.data.user_group);
                    $('#id', modelbox).val(res.data.id);
                    $('#is_enabled', modelbox).iCheck(res.data.is_enabled == 1 ? 'check' : 'uncheck');                   

                    modelbox.modal('show');                   
                },
                error: function () {
                   toastr.error('Something Went Wrong', 'Error');
                }
            });
        }

        function deleteCurrentRow(e) {
            e.preventDefault();
            cur_row = $(this).closest('tr');
            cur_id = cur_row.find('.chkRowSelect').val();
            if (confirm('Are you sure to delete.?')) {
                $('body').toggleClass('sk-loading');
                $.ajax({
                    type: "POST",
           
                    url: "{!! url('/admin/deleteuserrow') !!}",
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
                     url: "{!! url('/admin/deleteuserrow') !!}",
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
                
                      url: "{!! url('/admin/enableuserrow') !!}",
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
                  
                      url: "{!! url('/admin/disableuserrow') !!}",
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
