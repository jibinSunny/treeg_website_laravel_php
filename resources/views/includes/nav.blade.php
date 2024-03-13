<nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element">
                        <img width="60" alt="image" class="rounded-circle" src="{{ asset(auth()->user()->profile_pic) }}"/>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="block m-t-xs font-bold">
                                {{ auth()->user()->name }}
                            </span>
                            <span class="text-muted text-xs block">
                                {{ auth()->user()->email }}
                                {{-- <b class="caret"></b> --}}
                                
                            </span>
                        </a>
                    </div>
                    <div class="logo-element">
                        IN+
                    </div>
                </li>
                @permission('view.dashboard')
                <li class="active">
                    <a href="{{ asset('/') }}"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span> </a>
                </li>
                @endpermission
                @permission('view.projects')
                <li>
                    <a href="#"><i class="fa fa-picture-o"></i> <span class="nav-label">Project Management</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        @permission('create.projects')
                        <li><a href="{{ asset('admin/projects/create') }}">Add New Project</a>
                        </li>
                        @endpermission
                        @permission('view.projects')
                        <li><a href="{{ asset('admin/projects') }}">Projects List</a></li>
                        @endpermission
                        @permission('create.project.category')
                        <li><a href="{{ asset('admin/project_categories') }}">Project Type</a></li>
                        @endpermission
                        <!-- @permission('create.project.amenities')
                        <li><a href="{{ asset('admin/project_amenity') }}">Project Amenities</a></li>
                        @endpermission -->
                        @permission('create.location')
                        <li><a href="{{ asset('admin/location') }}">Location Master</a></li>
                        @endpermission
                    </ul>
                </li>
                @endpermission
                @permission('view.newsandevents')
                <li>
                     
                    <a href="#"><i class="fa fa-globe"></i> <span class="nav-label">News And Events</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        @permission('create.newsandevents')
                        <li><a href="{{ asset('admin/newsandevents/create') }}">Add News/Event</a></li>
                        @endpermission
                        @permission('view.newsandevents')
                        <li><a href="{{ asset('admin/newsandevents') }}">News And Event list</a></li>
                        @endpermission
                    </ul>
                </li>
                 @endpermission
                @permission('view.testimonials')
                <li>
                    <a href="#"><i class="fa fa-globe"></i> <span class="nav-label">Testimonials</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        @permission('create.testimonials')
                        <li><a href="{{ asset('admin/testimonial/create') }}">Add New Testimonial</a></li>
                        @endpermission
                        @permission('view.testimonials')
                        <li><a href="{{ asset('admin/testimonial') }}">Testimonial list</a></li>
                        @endpermission
                    </ul>
                </li>
                @endpermission
                @permission('view.video.album')
                <li>
                    <a href="#"><i class="fa fa-picture-o"></i> <span class="nav-label">Photo Albums</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        @permission('create.photo.album')
                        <li><a href="{{ asset('admin/photo/create') }}">Add New Album</a></li>
                        @endpermission
                        @permission('view.photo.album')
                        <li><a href="{{ asset('admin/photo') }}">Photo Album List</a></li>
                        @endpermission
                    </ul>
                </li>
                @endpermission
                @permission('view.photo.album')
                <li>
                    <a href="#"><i class="fa fa-picture-o"></i> <span class="nav-label">Video Albums</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        @permission('create.video.album')
                        <li><a href="{{ asset('admin/video/create') }}">Add New Video</a></li>
                        @endpermission
                        @permission('view.video.album')
                        <li><a href="{{ asset('admin/video') }}">Video Album List</a></li>
                        @endpermission
                        
                    </ul>
                </li>
                @endpermission
                
                <!-- <li>
                    <a href="#"><i class="fa fa-picture-o"></i> <span class="nav-label">About</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                   
                        <li><a href="{{ asset('admin/about/create') }}">Add New Abpou</a></li>
                        
                      
                        <li><a href="{{ asset('admin/about/list') }}">About List</a></li>
                       
                    </ul>
                </li> -->
                
                @permission('view.customer.requests')
                <li>
                    <a href="{{ asset('admin/customer_requests') }}"><i class="fa fa-th-large"></i> <span class="nav-label">Customers Requests</span></a>

                </li>
                @endpermission
                @permission('view.users')
                <li>
                    <a href="#"><i class="fa fa-users"></i> <span class="nav-label">Users</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        {{-- @permission('create.users')
                        <li><a href="{{ asset('admin/users/create') }}">Add New User</a></li>
                        @endpermission --}}
                        @permission('view.users')
                        <li><a href="{{ asset('admin/users') }}">Users List</a></li>
                        @endpermission
                    </ul>
                </li>
                @endpermission
                @permission('view.online.enquiries')
                <li>
                    <a href="{{ asset('admin/enquiries') }}"><i class="fa fa-phone"></i> <span class="nav-label">Online Enquiries</span></a>

                </li>
                @endpermission
                @permission('view.settings')
                <li>
                    <a href="#"><i class="fa fa-cog"></i> <span class="nav-label">Settings</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        
                        <li><a href="{{ asset('admin/permission') }}">Permissions</a></li>
                        
                        <li><a href="{{ asset('admin/roles') }}">User Roles</a>
                        </li>
                        
                      {{--   <li><a href="{{ asset('admin/permission_roles') }}">Permission To Roles</a></li> --}}
                       
                    </ul>
                </li>
                @endpermission
               
                
            </ul>

        </div>
    </nav>