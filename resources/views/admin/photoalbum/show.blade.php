@extends('layouts.master')
@section('title', 'Photo Album')
@section('content')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2> {{ $photo->caption }}</h2>
        <img src="{{ Storage::url($photo->image) }}" width="150" alt="">
    </div>
        <div class="col-lg-2">
            @permission('create.photo.album') 
           <a data-toggle="modal" data-url="{{ route('photo.store') }}" data-title="Photo" href=".custom-modal" class="mt-3 pull-right btn btn-outline btn-success modal-open"><i class="fa fa-plus"></i> Add New Photo</a>
            @endpermission
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>View</h5>
                <div class="ibox-tools">
                {{-- BreadCrumb --}}
                </div>
            </div>
            <div class="ibox-content">

                        
             <table class="table table-striped table-bordered table-hover dataTables-example" >
            <thead>
            <tr>
                <th>Sl No</th>
                <!-- <th>Caption</th> -->
                <th>Image</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>

            @foreach ($photoAlbums as $i=> $photoImage)
                <tr class="gradeX">
                      <td>{{ ($photoAlbums->currentpage()-1) * $photoAlbums->perpage() + $i + 1 }}</td>
                
                    <td>
                        <img src="{{ asset(Storage::url($photoImage->image)) }}" width="40" alt="">
                    </td>
                   
                    <td><span class="label label-success">{{ ($photoImage->active==true) ? 'Active': 'Inactive' }}</span></td>
                    <td>
        
                        <a href=".custom-modal" data-url="{{ route('photo.update',$photoImage->id) }}" data-toggle="modal" data-title="Update Gallery" class="btnEditRow btn table-action-btn modal-open" title="Edit"><i class="fa fa-pencil-square-o"></i> </a> 


                        <a href="" data-url="{{ route('photo.destroy',$photoImage->id) }}" class="btn table-action-btn btnDeleteRow" title="Delete"> <i class="fa fa-times-circle"></i></a> 

                        <form action="" class="deleteForm">
                            @method('DELETE')
                            @csrf
                        </form>
                        
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
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <center><h2 class="head m-t-none m-b"> </h2></center>

                                <form class="form-horizontal" id="create_form" role="form" method="POST" action="" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="_method">
                                    
                                    <!-- <input type="hidden" name="caption" > -->
                                <!-- <div class="form-group" id="err_name">
                                    <label>Caption <span style="color:red;">*</span> </label> 
                                    <input id="caption" required type="text" class="form-control" name="caption">
                                </div> -->

                                {{-- <div class="form-group" id="err_name">
                                    <label>Image</label> 
                                    <input name="image" type="file" class="form-control">
                                    
                                </div> --}}
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

                                <div class="form-group" id="err_name">
                                   <input type="hidden" name="parent_id" value="{{ $photo->id }}">
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
