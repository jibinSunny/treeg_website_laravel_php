@extends('admin.master')
@section('pageTitle', 'Category View')
@section('content')





<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2> {{ $module_caption }}</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ url('/admin/home') }}">Home</a>
            </li>
            <li>
                <a>Category</a>
            </li>
            <li class="active">
                <strong>View</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">
   
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>View</h5>
                <div class="ibox-tools">
                   <!--  <div class="input-group-btn">
                        <button data-toggle="dropdown" class="btn btn-white dropdown-toggle" type="button">Action <span class="caret"></span></button>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="#" id="enableItem">Enable</a></li>
                            <li><a href="#" id="disableItem">Disable</a></li>
                            <li><a href="#" id="deleteItem">Delete</a></li>
                            
                        </ul>
                    </div> -->
                </div>
            </div>
            <div class="ibox-content" >          
                        
           <div class="row m-t">
                                <div class="col-lg-6 b-r">
                                <div class="feed-activity-list">
                                            <h4>Product View</h4>
                                            
                                            <dl class="dl-horizontal" style="margin-left: 10%; margin-top: 3%;">
                              
                                                <input type="hidden" name="booking_id" id="booking_id" value=""/>
                                                 <dt>Name :</dt><dd style="width: 50%; word-wrap:break-word;"><?php echo @$product_view->name; ?></dd>
                                                 <dt>Description :</dt><dd style="width: 50%; word-wrap:break-word;"><?php echo @$product_view->description; ?></dd>
                                                 <dt>Prize :</dt><dd style="width: 50%; word-wrap:break-word;"><?php echo @$product_view->prize; ?></dd>
                                                 <dt>Category :</dt><dd style="width: 50%; word-wrap:break-word;"><?php echo @$product_view->category->name; ?></dd>
                                                 <dt>Size :</dt><dd style="width: 50%; word-wrap:break-word;"><?php echo @$product_view->size->name; ?></dd>
                                                 <!--<dt>Ingredient :</dt><dd style="width: 50%; word-wrap:break-word;"><?php echo @$product_view->ingredient; ?></dd>-->
                                                 <dt>Icon :</dt><dd style="width: 50%; word-wrap:break-word;">
                                                 <td><img src="{{ url('/admin/getproductimage/'.$product_view->image) }}" style="max-width:150px"/></td>                  
                                                 </dd>



                                                 <dt>Status :</dt><dd style="width: 50%; word-wrap:break-word;"><?php if($product_view->is_enabled == 1)
                                                 echo "Enabled" ;
                                                 if($product_view->is_enabled  == 0)
                                                 echo "Disabled" ;
                                                 ?></dd>
                                                 <dt>Priority :</dt><dd style="width: 50%; word-wrap:break-word;"><?php echo @$product_view->priority; ?></dd>
                                                

                                                 
                                             </dl>
                                         </div>
                                     </div>
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
