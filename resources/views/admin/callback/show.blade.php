@extends('layouts.master')
@section('title', 'Customer Request')
@section('content')





<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2> {{ $callback_request->name }}</h2>

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
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-md-3">
                            <span>Name : {{ $callback_request->name }}</span>
                            <p>Phone : {{ $callback_request->phone }}</p>
                            <p>Email: {{ $callback_request->email }}</p>
                            <p>Status: {{ $callback_request->status }}</p>
                            <p>
                                <h4>Change Status: <input type="checkbox">
                                    <h4>
                            </p>
                        </div>
                        <div class="col-md-9">
                            <p> Message : {{ $callback_request->message }}</p>
                        </div>
                        <div class="col-sm-8 text-sm-left" id="status" style="display:none">
                            <dd class="mb-1">
                                <form action="{{ route('customer_requests.update',$callback_request->id) }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="approve" value="approve">
                                    <input type="hidden" name="is_callback" value="{{$callback_request->is_callback}}">
                                    <div class="col-md-6 form-group">
                                        <label class=" control-label"><strong>Select Status<font color="#FF0000">*</font></strong></label>
                                        <div class="control">
                                            <select class="form-control" data-placeholder="Select status" name="status" id='staus' style="height: 35px;" required>

                                                <option label="" value=""> Select Status </option>

                                                <option value="New">New </option>
                                                <option value="Under Discussion">Under Discussion </option>
                                                <option value="closed">Closed</option>

                                            </select>
                                        </div>


                                    </div>
                                    <input type="submit" class="btn btn">
                                </form>
                            </dd>
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
    $(document).ready(function() {
        $('input[type="checkbox"]').click(function() {
            if ($(this).prop("checked") == true) {
                $('#status').show();
            } else if ($(this).prop("checked") == false) {
                $('#status').hide();
            }
        });
    });
    $(document).ready(function() {

        @if(Session::has('message'))
        toastr.success('{{ Session::get('
            message ') }}', 'Successful');
        @endif

        dataTableObject = $('.dataTables-example').DataTable({
            pageLength: 10,
            responsive: true,
            "fnDrawCallback": function(oSettings) {
                $('td input:checkbox').iCheck({
                    checkboxClass: 'icheckbox_square-green'
                });
                $('.chkRowSelect').on('ifClicked', function(e) {
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
            buttons: [],
            order: [
                [2, 'asc']
            ]
        });





        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });

        $('.i-checks').on('ifClicked', function(e) {
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
        registerForm.submit(function(e) {
            e.preventDefault();
            var formData = registerForm.serialize();
            $("#err_name").removeClass("has-error");
            $('body').toggleClass('sk-loading');

            $.ajax({
                url: '/creategroup',
                type: 'POST',
                data: formData,
                success: function(data) {
                    $('body').toggleClass('sk-loading');
                    if (data.success == true) {
                        $('#modal-form').modal('hide');
                        toastr.success(data.message, 'Successful');
                        setTimeout(function() {
                            location.reload(true);
                        }, 2000);

                        return false;
                    } else {
                        toastr.error('Someting Went Wrong', 'Error!');
                        return false;
                    }
                },
                error: function(data) {
                    //console.log(data.responseText);
                    $('body').toggleClass('sk-loading');
                    var obj = jQuery.parseJSON(data.responseText);
                    if (obj.name) {
                        $("#err_name").addClass("has-error");
                        $('#name').html(obj.name);
                    }
                }
            });
        });

        $('#chkSelectAll').on('ifClicked', function(e) {
            var table = $('#access_container');
            if ($(this).is(':checked'))
                $('input:checkbox', table).iCheck('uncheck');
            else
                $('input:checkbox', table).iCheck('check');
        });

        $('.chkSelectAllSubs').on('ifClicked', function(e) {
            var table = $(this).closest('.row');
            if ($(this).is(':checked'))
                $('input:checkbox', table).iCheck('uncheck');
            else
                $('input:checkbox', table).iCheck('check');
        });

        $('.chkSubModules').on('ifClicked', function(e) {
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
                    success: function(res) {
                        $('body').toggleClass('sk-loading');
                        if (res.success == false) {
                            toastr.error(res.data, 'Error!');
                        } else {
                            dataTableObject.row(cur_row).remove().draw(false);
                            toastr.success(res.data, 'Success!');
                        }
                    },
                    error: function() {
                        $('body').toggleClass('sk-loading');
                        toastr.error('Something Went Wrong', 'Error!');
                    }
                });
            }

        }

        $('#deleteItem').click(function(e) {
            e.preventDefault();
            if (confirm('Are you sure to delete.?')) {
                $('body').toggleClass('sk-loading');
                $.ajax({
                    type: "POST",
                    url: "{!! url('/admin/deletecontactrow') !!}",
                    data: $('#checksForm').serialize(),
                    success: function(res) {
                        $('body').toggleClass('sk-loading');
                        if (res.success == false) {
                            toastr.error(res.data, 'Error!');
                        } else {
                            //dataTableObject.row('.selected').remove().draw(false);
                            location.reload(true);
                            toastr.success(res.data, 'Success!');
                        }
                    },
                    error: function() {
                        $('body').toggleClass('sk-loading');
                        toastr.error('Something Went Wrong', 'Error!');
                    }
                });
            }
        });

        $('#enableItem').click(function(e) {
            e.preventDefault();
            if (confirm('Are you sure to enable.?')) {
                $('body').toggleClass('sk-loading');
                $.ajax({
                    type: "POST",
                    url: "{!! url('/admin/enableclientrow') !!}",
                    data: $('#checksForm').serialize(),
                    success: function(res) {
                        $('body').toggleClass('sk-loading');
                        if (res.success == false) {
                            toastr.error(res.data, 'Error!');
                        } else {
                            location.reload(true);
                            toastr.success(res.data, 'Success!');
                        }
                    },
                    error: function() {
                        $('body').toggleClass('sk-loading');
                        toastr.error('Something Went Wrong', 'Error!');
                    }
                });
            }
        });


        $('#disableItem').click(function(e) {
            e.preventDefault();
            if (confirm('Are you sure to disable.?')) {
                $('body').toggleClass('sk-loading');
                $.ajax({
                    type: "POST",
                    url: "{!! url('/admin/disableclientrow') !!}",
                    data: $('#checksForm').serialize(),
                    success: function(res) {
                        $('body').toggleClass('sk-loading');
                        if (res.success == false) {
                            toastr.error(res.data, 'Error!');
                        } else {
                            location.reload(true);
                            toastr.success(res.data, 'Success!');
                        }
                    },
                    error: function() {
                        $('body').toggleClass('sk-loading');
                        toastr.error('Something Went Wrong', 'Error!');
                    }
                });
            }
        });

    });
</script>

@endsection