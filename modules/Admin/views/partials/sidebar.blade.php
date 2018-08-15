 <!-- END HEADER & CONTENT DIVIDER -->
        <!-- BEGIN CONTAINER -->
<div class="page-container">
         
 <div class="page-sidebar-wrapper">
                <!-- BEGIN SIDEBAR --> 
                <div class="page-sidebar navbar-collapse collapse">
                   
                    <ul class="page-sidebar-menu" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
                        <li class="nav-item start active open">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="icon-home"></i>
                                <span class="title">Dashboard</span>
                                <span class="selected"></span>
                                <span class="arrow open"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item start active open">
                                    <a href="{{ url('/')}}" class="nav-link " target="_blank">
                                        <i class="icon-bar-chart"></i>
                                        <span class="title">View Website</span>
                                        <span class="selected"></span>
                                    </a>
                                </li> 
                                </ul>
                        </li> 
                        
                         <li class="nav-item start active {{ (isset($page_title) && $page_title=='Role')?'open':'' }}">
                                    <a href="javascript:;" class="nav-link nav-toggle">
                                        <i class="glyphicon glyphicon-th"></i>
                                        <span class="title">User Type</span>
                                        <span class="arrow {{ (isset($page_title) && $page_title=='Blog')?'open':'' }}"></span>
                                    </a>
                                    <ul class="sub-menu" style="display: {{ (isset($page_title) && $page_title=='View Role')?'block':'none' }}">
                                        <li class="nav-item  {{ (isset($page_title) && $page_action=='View Role')?'active':'' }}">
                                            <a href="{{ route('role') }}" class="nav-link ">
                                               <i class="glyphicon glyphicon-eye-open"></i>
                                                <span class="title">
                                                    View User Type
                                                </span>
                                            </a>
                                        </li>

                                         <li class="nav-item  {{ (isset($page_title) && $page_action=='Create Role')?'active':'' }}">
                                            <a href="{{ route('role.create') }}" class="nav-link ">
                                               <i class="glyphicon glyphicon-eye-open"></i>
                                                <span class="title">
                                                    Create User Type
                                                </span>
                                            </a>
                                        </li>
                                         <li class="nav-item  {{ (isset($page_title) && $page_action=='Update Permission')?'active':'' }}">
                                            <a href="{{ url('admin/permission') }}" class="nav-link ">
                                               <i class="glyphicon glyphicon-eye-open"></i>
                                                <span class="title">
                                                    Set Permission
                                                </span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>


                        <li class="nav-item  start active  {{ (isset($page_title) && ($page_title=='Admin User' || $page_title=='Client User') )?'open':'' }}">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                 <i class="glyphicon glyphicon-user"></i>
                                <span class="title">Manage User</span>
                                <span class="arrow {{ (isset($page_title) && $page_title=='Admin User')?'open':'' }}"></span>
                            </a>

                           <ul class="sub-menu" style="display: {{ (isset($page_title) && ($page_title=='Admin User' OR $page_title=='Client User' ))?'block':'none' }}">

                               <li class="nav-item  {{ (isset($page_title) && $page_title=='Admin User')?'open':'' }}">
                                <a href="javascript:;" class="nav-link nav-toggle">
                                    <i class="icon-user"></i>
                                    <span class="title">Admin User</span>
                                    <span class="arrow {{ (isset($page_title) && $page_title=='Admin User')?'open':'' }}"></span>
                                </a>
                                    <ul class="sub-menu" style="display: {{ (isset($page_title) && $page_title=='Admin User')?'block':'none' }}">
                                        <li class="nav-item  {{ (isset($page_title) && $page_action=='Create Admin User')?'active':'' }}">
                                            <a href="{{ route('user.create') }}" class="nav-link ">
                                                <i class="glyphicon glyphicon-plus-sign"></i>
                                                <span class="title">
                                                    Create User
                                                </span>
                                            </a>
                                        </li>

                                        <li class="nav-item  {{ (isset($page_title) && $page_action=='View Admin User')?'active':'' }}">
                                            <a href="{{ route('user') }}" class="nav-link ">
                                                 <i class="glyphicon glyphicon-eye-open"></i>
                                                <span class="title">
                                                    View Users
                                                </span>
                                            </a>
                                        </li>


                                    </ul>
                                </li>
                               <li class="nav-item  {{ (isset($page_title) && $page_title=='Client User')?'open':'' }}">
                                <a href="javascript:;" class="nav-link nav-toggle">
                                    <i class="icon-user"></i>
                                    <span class="title">Front User</span>
                                    <span class="arrow {{ (isset($page_title) && $page_title=='Client User')?'open':'' }}"></span>
                                </a>
                                    <ul class="sub-menu" style="display: {{ (isset($page_title) && $page_title=='Client User')?'block':'none' }}">
                                        <!-- <li class="nav-item  {{ (isset($page_title) && $page_action=='Create Client User')?'active':'' }}">
                                            <a href="{{ route('clientuser.create') }}" class="nav-link ">
                                                <i class="glyphicon glyphicon-plus-sign"></i>
                                                <span class="title">
                                                    Create User
                                                </span>
                                            </a>
                                        </li> -->

                                        <li class="nav-item  {{ (isset($page_title) && $page_action=='View Client User')?'active':'' }}">
                                            <a href="{{ route('clientuser') }}" class="nav-link ">
                                                 <i class="glyphicon glyphicon-eye-open"></i>
                                                <span class="title">
                                                    View Users
                                                </span>
                                            </a>
                                        </li>


                                    </ul>
                                </li>

                            </ul>
                        </li>
                         
                                
                        <li class="nav-item  {{ (isset($page_title) && $page_title=='Category')?'open':'' }}">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                        <i class="glyphicon glyphicon-th"></i>
                                        <span class="title">Research Category</span>
                                        <span class="arrow {{ (isset($page_title) && $page_title=='Category')?'open':'' }}"></span>
                                    </a>    

                            <ul class="sub-menu" style="display: {{ (isset($page_title) && $page_title=='Category')?'block':'' }}">
                                <li class="nav-item {{ (isset($page_action) && $page_action=='Create Category')?'open':'' }}">
                                    <a href="{{ route('category.create') }}" class="nav-link "  > 

                                    <i class="glyphicon glyphicon-plus-sign"></i> 
                                        <span class="title">
                                          Create Category 
                                        </span> 
                                    </a>
                                </li>
                                <li class="nav-item {{ (isset($page_action) && $page_action=='View Category')?'open':'' }}">
                                    <a href="{{ route('category') }}" class="nav-link " >
                                        <i class="glyphicon glyphicon-eye-open"></i> 
                                        <span class="title">
                                         View Category 
                                        </span> 
                                    </a> 
                                </li>
                                
                            </ul>
                        </li>
                               
 
                                

                                 <li class="nav-item start active {{ (isset($page_title) && $page_title=='Reports')?'open':'' }}">
                                    <a href="javascript:;" class="nav-link nav-toggle">
                                        <i class="glyphicon glyphicon-th"></i>
                                        <span class="title">Reports</span>
                                        <span class="arrow {{ (isset($page_title) && $page_title=='Reports')?'open':'' }}"></span>
                                    </a>
                                    <ul class="sub-menu" style="display: {{ (isset($page_title) && $page_title=='Reports')?'block':'none' }}">
                                        
                                        <li class="nav-item  {{ (isset($page_title) && $page_action=='Create Reports')?'active':'' }}">
                                            <a href="{{ route('reports.create') }}" class="nav-link ">
                                               <i class="glyphicon glyphicon-eye-open"></i> 
                                                <span class="title">
                                                    Create Reports
                                                </span>
                                            </a>
                                        </li> 
                                        <li class="nav-item  {{ (isset($page_title) && $page_action=='View Reports')?'active':'' }}">
                                            <a href="{{ route('reports') }}" class="nav-link ">
                                               <i class="glyphicon glyphicon-eye-open"></i> 
                                                <span class="title">
                                                    View Reports 
                                                </span>
                                            </a>
                                        </li> 

                                        <li class="nav-item  {{ (isset($page_title) && $page_action=='Export Reports')?'active':'' }}">
                                            <a href="{{ url('admin/exportExcel') }}" class="nav-link ">
                                               <i class="glyphicon glyphicon-eye-open"></i> 
                                                <span class="title">
                                                    Export Reports 
                                                </span>
                                            </a>
                                        </li> 
                                    </ul>
                                </li>

                                <li class="nav-item start active {{ (isset($page_title) && $page_title=='Press')?'open':'' }}">
                                    <a href="javascript:;" class="nav-link nav-toggle">
                                        <i class="glyphicon glyphicon-th"></i>
                                        <span class="title">Press Release</span>
                                        <span class="arrow {{ (isset($page_title) && $page_title=='Press')?'open':'' }}"></span>
                                    </a>
                                    <ul class="sub-menu" style="display: {{ (isset($page_title) && $page_title=='Press')?'block':'none' }}">
                                        <li class="nav-item  {{ (isset($page_title) && $page_action=='View Press')?'active':'' }}">
                                            <a href="{{ route('press') }}" class="nav-link ">
                                               <i class="glyphicon glyphicon-eye-open"></i> 
                                                <span class="title">
                                                    View Press  Release
                                                </span>
                                            </a>
                                        </li> 
                                        <li class="nav-item  {{ (isset($page_title) && $page_action=='Create Press')?'active':'' }}">
                                            <a href="{{ route('press.create') }}" class="nav-link ">
                                               <i class="glyphicon glyphicon-eye-open"></i> 
                                                <span class="title">
                                                    Create Release
                                                </span>
                                            </a>
                                        </li> 
                                    </ul>
                                </li> 
                                


                             <li class="nav-item start active {{ (isset($page_title) && $page_title=='Page')?'open':'' }}">
                                    <a href="javascript:;" class="nav-link nav-toggle">
                                        <i class="glyphicon glyphicon-th"></i>
                                        <span class="title">Pages </span>
                                        <span class="arrow {{ (isset($page_title) && $page_title=='Page')?'open':'' }}"></span>
                                    </a>
                                    <ul class="sub-menu" style="display: {{ (isset($page_title) && $page_title=='setting')?'block':'none' }}">
                                        <li class="nav-item  {{ (isset($page_title) && $page_action=='View Page')?'active':'' }}">
                                            <a href="{{ route('content') }}" class="nav-link ">
                                               <i class="glyphicon glyphicon-eye-open"></i> 
                                                <span class="title">
                                                    View Pages
                                                </span>
                                            </a>
                                        </li>

                                        <li class="nav-item  {{ (isset($page_title) && $page_action=='Create Page')?'active':'' }}">
                                            <a href="{{ route('content.create') }}" class="nav-link ">
                                               <i class="glyphicon glyphicon-eye-open"></i> 
                                                <span class="title">
                                                    Add Page
                                                </span>
                                            </a>
                                        </li> 
                                         
                                </ul>
                            </li>

                            <li class="nav-item start active {{ (isset($page_title) && $page_title=='Publisher')?'open':'' }}">
                                    <a href="javascript:;" class="nav-link nav-toggle">
                                        <i class="glyphicon glyphicon-th"></i>
                                        <span class="title">Publisher </span>
                                        <span class="arrow {{ (isset($page_title) && $page_title=='Publisher')?'open':'' }}"></span>
                                    </a>
                                    <ul class="sub-menu" style="display: {{ (isset($page_title) && $page_title=='setting')?'block':'none' }}">
                                        <li class="nav-item  {{ (isset($page_title) && $page_action=='View Publisher')?'active':'' }}">
                                            <a href="{{ route('publisher') }}" class="nav-link ">
                                               <i class="glyphicon glyphicon-eye-open"></i> 
                                                <span class="title">
                                                    View Publisher
                                                </span>
                                            </a>
                                        </li>

                                        <li class="nav-item  {{ (isset($page_title) && $page_action=='Create Publisher')?'active':'' }}">
                                            <a href="{{ route('publisher.create') }}" class="nav-link ">
                                               <i class="glyphicon glyphicon-eye-open"></i> 
                                                <span class="title">
                                                    Add Publisher
                                                </span>
                                            </a>
                                        </li> 
                                         
                                </ul>
                            </li>
                            <li class="nav-item start active">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="glyphicon glyphicon-globe"></i>
                                <span class="title"> Manage Contact </span>
                                <span class=""></span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu" style="display: {{ (isset($page_title) && $page_title=='Contact')?'block':'none' }}">
                                 <li class="nav-item  {{ (isset($page_title) && $page_title=='Contact')?'open':'' }}">
                                    <a href="javascript:;" class="nav-link nav-toggle">
                                        <i class="icon-user"></i>
                                        <span class="title">Contacts</span>
                                        <span class="arrow {{ (isset($page_title) && $page_title=='User')?'open':'' }}"></span>
                                    </a>
                                    <ul class="sub-menu" style="display: {{ (isset($page_title) && $page_title=='Contact')?'block':'none' }}">
                                        <li class="nav-item  {{ (isset($page_title) && $page_action=='Create Contact')?'active':'' }}">
                                            <a href="{{ route('contact.create') }}" class="nav-link ">
                                                 <i class="glyphicon glyphicon-plus-sign"></i> 
                                                <span class="title">
                                                    Create Contact
                                                </span>
                                            </a>
                                        </li>

                                        <li class="nav-item  {{ (isset($page_title) && $page_action=='View Contact')?'active':'' }}">
                                            <a href="{{ route('contact') }}" class="nav-link ">
                                              <i class="glyphicon glyphicon-eye-open"></i> 
                                                <span class="title">
                                                    View Contacts
                                                </span>
                                            </a>
                                        </li> 
                                    </ul>
                                </li> 
                                 

                               
                            </ul>
                             
                        </li>

                            <li class="nav-item start active {{ (isset($page_title) && $page_title=='Coupon')?'open':'' }}">
                                    <a href="javascript:;" class="nav-link nav-toggle">
                                        <i class="glyphicon glyphicon-th"></i>
                                        <span class="title">Website Setting </span>
                                        <span class="arrow {{ (isset($page_title) && $page_title=='setting')?'open':'' }}"></span>
                                    </a>
                                    <ul class="sub-menu" style="display: {{ (isset($page_title) && $page_title=='setting')?'block':'none' }}">
                                        <li class="nav-item  {{ (isset($page_title) && $page_action=='View setting')?'active':'' }}">
                                        <a href="{{ route('setting') }}" class="nav-link ">
                                           <i class="glyphicon glyphicon-eye-open"></i> 
                                            <span class="title">
                                                View Settings
                                            </span>
                                        </a>
                                    </li> 
                                         
                                </ul>
                            </li>

                            <li class="nav-item start active {{ (isset($page_title) && $page_title=='Coupon')?'open':'' }}">
                                <a href="javascript:;" class="nav-link nav-toggle">
                                    <i class="glyphicon glyphicon-th"></i>
                                    <span class="title">Coupon </span>
                                    <span class="arrow {{ (isset($page_title) && $page_title=='Coupon')?'open':'' }}"></span>
                                </a>
                                <ul class="sub-menu" style="display: {{ (isset($page_title) && $page_title=='Coupon')?'block':'none' }}">
                                    <li class="nav-item  {{ (isset($page_title) && $page_action=='View Coupon')?'active':'' }}">
                                        <a href="{{ route('coupan') }}" class="nav-link ">
                                           <i class="glyphicon glyphicon-eye-open"></i> 
                                            <span class="title">
                                                View Coupon
                                            </span>
                                        </a>
                                    </li> 


                                    <li class="nav-item  {{ (isset($page_title) && $page_action=='Create Coupon')?'active':'' }}">
                                        <a href="{{ route('coupan.create') }}" class="nav-link ">
                                           <i class="glyphicon glyphicon-eye-open"></i> 
                                            <span class="title">
                                                Create Coupon
                                            </span>
                                        </a>
                                    </li> 
                                         
                                </ul>
                            </li>


                        <!-- posttask end-->
                    </ul>
                    <!-- END SIDEBAR MENU -->
                </div>
                <!-- END SIDEBAR -->
            </div>