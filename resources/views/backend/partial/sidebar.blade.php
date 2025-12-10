<!-- Left Sidebar Start -->
            <div class="app-sidebar-menu">
                <div class="h-100" data-simplebar>

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">

                        <div class="logo-box">
                            <a href="{{ route('admindashboard.get') }}" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="{{ asset('assets/images/logo-sm.png') }}" alt="" height="22">
                                </span>
                                <span class="logo-lg">
                                    <img src="{{ asset('assets/images/logo-light.png') }}" alt="" height="24">
                                </span>
                            </a>
                            <a href="{{ route('admindashboard.get') }}" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="{{ asset('assets/images/logo-sm.png') }}" alt="" height="22">
                                </span>
                                <span class="logo-lg">
                                    <img src="{{ asset('assets/images/logo-dark.png') }}" alt="" height="24">
                                </span>
                            </a>
                        </div>

                        <ul id="side-menu">

                            <li class="menu-title">Menu</li>

                            <li>
                                <a href="{{ route('admindashboard.get') }}" class="tp-link">
                                    <i data-feather="home"></i>
                                    <span> Dashboard </span>
                                </a>
                            </li>

                            <li class="menu-title">Pages</li>

                            <li>
                                <a href="#sidebarAuth" data-bs-toggle="collapse">
                                    <i data-feather="users"></i>
                                    <span> Academic </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarAuth">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="{{ route('courses.index') }}" class="tp-link">Course</a>
                                        </li>
                                        <li>
                                            <a href="" class="tp-link">Branch</a>
                                        </li>
                                        <li>
                                            <a href="" class="tp-link">Semester</a>
                                        </li>
                                        <li>
                                            <a href="" class="tp-link">Annual</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('sessions.index') }}" class="tp-link">Session</a>
                                        </li>
                                        <li>
                                            <a href="" class="tp-link">Scheme</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('institutes.index') }}" class="tp-link">Institue</a>
                                        </li>
                                    </ul>
                                </div>
                            </li> 


                            <li>
                                <a href="#sidebarAuth" data-bs-toggle="collapse">
                                    <i data-feather="users"></i>
                                    <span> Employees </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarAuth">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="{{ route('employee') }}" class="tp-link">Employee List</a>
                                        </li>
                                    </ul>
                                </div>
                            </li> 

                            

                            {{-- <li>
                                <a href="widgets.html" class="tp-link">
                                    <i data-feather="aperture"></i>
                                    <span> Widgets </span>
                                </a>
                            </li> --}}

                            <li>
                                <a href="#sidebarMaps" data-bs-toggle="collapse">
                                    <i data-feather="settings"></i>
                                    <span> Settings </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarMaps">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="{{ route('roles') }}" class="tp-link">Roles</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('permission') }}" class="tp-link">Permissions</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('permission-categories.index') }}" class="tp-link">Permissions Category</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                        </ul>
            
                    </div>
                    <!-- End Sidebar -->

                    <div class="clearfix"></div>

                </div>
            </div>
            <!-- Left Sidebar End -->