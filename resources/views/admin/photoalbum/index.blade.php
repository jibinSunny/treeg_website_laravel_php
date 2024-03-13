@extends('layouts.master')
@section('title', 'Photo Album List')
@section('content')


<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2> {{ 'Photos' }}</h2>
    </div>
    <div class="col-lg-2">
            @permission('create.photo.album')
           <a href="{{ route('photo.create') }}" class="pull-right btn btn-outline btn-success modal-open"><i class="fa fa-plus"></i> Add New</a>
            @endpermission
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>List</h5>
          {{--       <div class="ibox-tools">
                    <div class="input-group-btn">
                        <button data-toggle="dropdown" class="btn btn-white dropdown-toggle" type="button">Action <span class="caret"></span></button>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="#" id="enableItem">Enable</a></li>
                            <li><a href="#" id="disableItem">Disable</a></li>
                            <li><a href="#" id="deleteItem">Delete</a></li>
                            
                        </ul>
                    </div>
                </div> --}}
            </div>
            <div class="ibox-content" >          
                        
             <table class="table table-striped table-bordered table-hover dataTables-example" >
            <thead>
            <tr>
                <th>Sl No</th>
                <th>Caption</th>
                <th>Image</th>
                <th>Priority</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>

            @foreach ($photoAlbums as $i=> $photo)
                <tr class="gradeX">
                      <td>{{ ($photoAlbums->currentpage()-1) * $photoAlbums->perpage() + $i + 1 }}</td>
                    <td>{{ $photo->caption }}</td>
                    <td>
                        <img src="{{ asset(Storage::url($photo->image)) }}" width="40" alt="">
                    </td>
                    <td>{{$photo->priority}}</td>
                    <td><span class="label label-success">{{ ($photo->active==true) ? 'Active': 'Inactive' }}</span></td>
                    <td>
                        @permission('view.photo.album')
                        <a href="{{ asset('admin/photo/'.$photo->id) }}" class="btn table-action-btn "><i class="fa fa-eye"></i> </a>

                        @endpermission
                        @permission('edit.photo.album')
                        <a href="{{ route('photo.edit',$photo->id) }}"   class="btn table-action-btn" title="Edit"><i class="fa fa-pencil-square-o"></i> </a> 
                        @endpermission
                        @permission('delete.photo.album')

                        <a href="" data-url="{{ route('photo.destroy',$photo->id) }}" class="btn table-action-btn btnDeleteRow" title="Delete"> <i class="fa fa-times-circle"></i></a> 

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

            {{ $photoAlbums->links() }}
            </div>
        </div>
    </div>
    </div>
</div>

<div class="modal fade custom-modal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <center><h2 class="head m-t-none m-b"> </h2></center>

                                <form class="form-horizontal" id="create_form" role="form" method="POST" action="" enctype="multipart/form-data">
                                    @csrf

                                    <input type="hidden" name="_method">
                                    
                                <div class="form-group" id="err_name">
                                    <label>Caption</label> 
                                    <input id="caption" type="text" class="form-control" name="caption" placeholder="Name">
                                </div>

                                <div class="form-group" id="err_name">
                                    <label>Image</label> 
                                    <input name="image" type="file" class="form-control">
                                    
                                </div>

                                <div class="form-group" id="err_name">
                                   <input type="hidden" name="parent_id" value="0">
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
                $('.btnEditRow').unbind('click', editCurrentRow);
                $('.btnEditRow').bind('click', editCurrentRow);
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
               
                  url: "{!! url('/admin/creategroup') !!}",
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

        function editCurrentRow(e) {
            e.preventDefault();
            cur_row = $(this).closest('tr');
            cur_id = cur_row.find('.chkRowSelect').val();
            
            $.ajax({

             
                 url: "{!! url('/admin/album/edit') !!}/"+ cur_id,
                success: function (res) {
                   
                    var modelbox = $('#modal-form');
                    $('#name', modelbox).val(res.data.group.group_name);
                    $('#description', modelbox).val(res.data.group.group_description);
                    $('#group_id', modelbox).val(res.data.group.group_id);

                    $('#is_enabled', modelbox).iCheck(res.data.group.is_enabled == 1 ? 'check' : 'uncheck');

                    $.each(res.data.modules, function(index , value) {
                        $('#chk' + value.module_id, modelbox).iCheck('check');

                        $.each(value.parent, function(key , val) {
                            $('#chek' + val.parent_module, modelbox).iCheck('check');
                        });

                    });                    

                    modelbox.modal('show');                   
                },
                error: function (error) {

                    console.log(error);
                   //toastr.error('Something Went Wrong', 'Error');
                    toastr.error(error.message, 'Error!');
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
                 
                    url: "{!! url('/admin/deleteproductrow') !!}",
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
                     url: "{!! url('/admin/deleteproductrow') !!}",
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
          
                     url: "{!! url('/admin/enableproductrow') !!}",
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
                 
                     url: "{!! url('/admin/disableproductrow') !!}",
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
