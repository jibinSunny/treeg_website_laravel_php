@extends('layouts.master')
@section('title', 'about List')
@section('content')


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-8">
            <h2>About List</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="#">Home</a> 
                </li>
                <li class="breadcrumb-item ">
                    <a href="#"> About</a> 
                </li>

                <li class=" breadcrumb-item active">
                <strong>LIst</strong>
                </li>
            </ol>
        </div>
        <div class="col-sm-4">
            <div class="title-action">
                
            <a href="{{url('admin/about/create')}}" class="btn btn-primary"><i class="fa fa-plus"></i> &nbsp;Add</a>
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
                            <table class="table table-striped table-bordered table-hover dataTables-example" >
                                <thead>
                                <tr>
                                    <th>Sl.No</th>
                                    <th>Discription</th>
                                  
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach ($about as $key=>$about)
                                    <tr class="gradeX">
                                    <td>{{$key+1}}</td>
                                        <td>{{$about->description}}</td>
                                       
                                            
                                       
                                       
                                                <td>
                                                    <a href="{{ asset('about/actions/'.$about->id) }}"
                                               class="btn table-action-btn " title="Edit"><i
                                                        class="fa fa-pencil-square-o"></i> </a>


                                            <a href="{{ url('about/delete/') }}/{{ $about->id }}" data-url=""
                                               class="btn" title="Delete"> <i class="fa fa-times-circle"></i></a>

                                            <form action="{{ url('about/delete/') }}/{{ $about->id }}" class="deleteForm">
                                            <input type="hidden" name="_method" value="GET">
                                                @csrf
                                            </form>

                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>

                            </table>
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
            $('.dataTables-example').DataTable({
                pageLength: 25,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    { extend: 'copy'},
                    {extend: 'csv'},
                    {extend: 'excel', title: 'ExampleFile'},
                    {extend: 'pdf', title: 'ExampleFile'},

                    {extend: 'print',
                        customize: function (win){
                            $(win.document.body).addClass('white-bg');
                            $(win.document.body).css('font-size', '10px');

                            $(win.document.body).find('table')
                                    .addClass('compact')
                                    .css('font-size', 'inherit');
                        }
                    }
                ]

            });

        });

        $('#btn-filter').click(function(e){
            e.preventDefault();
            $("#filter-box").toggle('slow');

        });
        $('.chosen-select').chosen({width: "100%"});
        function hideshow() {

            document.getElementById('hidden-div').style.display = 'block';
            this.style.display = 'none'
        }
    </script>
@endsection

