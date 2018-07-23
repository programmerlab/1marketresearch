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
                                    <a href="{{ url('/')}}" class="nav-link ">
                                        <i class="icon-bar-chart"></i>
                                        <span class="title">Dashboard</span>
                                        <span class="selected"></span>
                                    </a>
                                </li> 
                                </ul>
                        </li> 
                                
                         
                                
                        <li class="nav-item  {{ (isset($page_title) && $page_title=='Category')?'open':'' }}">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                        <i class="glyphicon glyphicon-th"></i>
                                        <span class="title">Research Category</span>
                                        <span class="arrow {{ (isset($page_title) && $page_title=='Category')?'open':'' }}"></span>
                                    </a>    

                            <ul class="sub-menu" style="display: {{ (isset($sub_page_title) && $sub_page_title=='Group Category')?'block':'' }}">
                                <li class="nav-item {{ (isset($page_action) && $page_action=='Create Category')?'open':'' }}">
                                    <a href="{{ route('category.create') }}" class="nav-link "  > 

                                    <i class="glyphicon glyphicon-plus-sign"></i> 
                                        <span class="title">
                                          Create Category 
                                        </span> 
                                    </a>
                                </li>
                                <li class="nav-item {{ (isset($page_action) && $page_action=='View Group Category')?'open':'' }}">
                                    <a href="{{ route('category') }}" class="nav-link " >
                                        <i class="glyphicon glyphicon-eye-open"></i> 
                                        <span class="title">
                                         View Category 
                                        </span> 
                                    </a> 
                                </li>
                                
                            </ul>
                        </li>
                                 
 


                                <li class="nav-item start active {{ (isset($page_title) && $page_title=='Article Type')?'open':'' }}">
                                    <a href="javascript:;" class="nav-link nav-toggle">
                                        <i class="glyphicon glyphicon-th"></i>
                                        <span class="title">Article Category</span>
                                        <span class="arrow {{ (isset($page_title) && $page_title=='Article Type')?'open':'' }}"></span>
                                    </a>
                                    <ul class="sub-menu" style="display: {{ (isset($page_title) && $page_title=='Article Type')?'block':'none' }}">
                                        <li class="nav-item  {{ (isset($page_title) && $page_action=='View Article Type')?'active':'' }}">
                                            <a href="{{ route('articleType') }}" class="nav-link ">
                                               <i class="glyphicon glyphicon-eye-open"></i> 
                                                <span class="title">
                                                    View Article Type 
                                                </span>
                                            </a>
                                        </li> 

                                         <li class="nav-item  {{ (isset($page_title) && $page_action=='Create Article Type')?'active':'' }}">
                                            <a href="{{ route('articleType.create') }}" class="nav-link ">
                                               <i class="glyphicon glyphicon-plus-sign"></i> 
                                                <span class="title">
                                                    Create Article Type 
                                                </span>
                                            </a>
                                        </li> 
                                    </ul>
                                </li>



                                <li class="nav-item start active {{ (isset($page_title) && $page_title=='Article')?'open':'' }}">
                                    <a href="javascript:;" class="nav-link nav-toggle">
                                        <i class="glyphicon glyphicon-th"></i>
                                        <span class="title">Article</span>
                                        <span class="arrow {{ (isset($page_title) && $page_title=='Article')?'open':'' }}"></span>
                                    </a>
                                    <ul class="sub-menu" style="display: {{ (isset($page_title) && $page_title=='Article')?'block':'none' }}">
                                        <li class="nav-item  {{ (isset($page_title) && $page_action=='View Article')?'active':'' }}">
                                            <a href="{{ route('article') }}" class="nav-link ">
                                               <i class="glyphicon glyphicon-eye-open"></i> 
                                                <span class="title">
                                                    View Article 
                                                </span>
                                            </a>
                                        </li> 

                                         <li class="nav-item  {{ (isset($page_title) && $page_action=='Create Article')?'active':'' }}">
                                            <a href="{{ route('article.create') }}" class="nav-link ">
                                               <i class="glyphicon glyphicon-plus-sign"></i> 
                                                <span class="title">
                                                    Create Article 
                                                </span>
                                            </a>
                                        </li> 
                                    </ul>
                                </li> 

                                <!-- <li class="nav-item start active {{ (isset($page_title) && $page_title=='Support Ticket')?'open':'' }}">
                                    <a href="javascript:;" class="nav-link nav-toggle">
                                        <i class="glyphicon glyphicon-th"></i>
                                        <span class="title">Support Ticket</span>
                                        <span class="arrow {{ (isset($page_title) && $page_title=='Article')?'open':'' }}"></span>
                                    </a>
                                    <ul class="sub-menu" style="display: {{ (isset($page_title) && $page_title=='Support Ticket')?'block':'none' }}">
                                        <li class="nav-item  {{ (isset($page_title) && $page_action=='View Article')?'active':'' }}">
                                            <a href="{{ route('supportTicket') }}" class="nav-link ">
                                               <i class="glyphicon glyphicon-eye-open"></i> 
                                                <span class="title">
                                                    Support Ticket 
                                                </span>
                                            </a>
                                        </li> 
                                    </ul>
                                </li>  -->

                               <!--  <li class="nav-item start active {{ (isset($page_title) && $page_title=='Reason')?'open':'' }}">
                                    <a href="javascript:;" class="nav-link nav-toggle">
                                        <i class="glyphicon glyphicon-th"></i>
                                        <span class="title">Reason</span>
                                        <span class="arrow {{ (isset($page_title) && $page_title=='Reason')?'open':'' }}"></span>
                                    </a>
                                    <ul class="sub-menu" style="display: {{ (isset($page_title) && $page_title=='Reason')?'block':'none' }}">
                                        <li class="nav-item  {{ (isset($page_title) && $page_action=='View Reason')?'active':'' }}">
                                            <a href="{{ route('reason') }}" class="nav-link ">
                                               <i class="glyphicon glyphicon-eye-open"></i> 
                                                <span class="title">
                                                    View Reason 
                                                </span>
                                            </a>
                                        </li> 
                                        <li class="nav-item  {{ (isset($page_title) && $page_action=='Create Reason')?'active':'' }}">
                                            <a href="{{ route('reason.create') }}" class="nav-link ">
                                               <i class="glyphicon glyphicon-eye-open"></i> 
                                                <span class="title">
                                                    Create Reason
                                                </span>
                                            </a>
                                        </li> 
                                    </ul>
                                </li>  -->

                                <li class="nav-item start active {{ (isset($page_title) && $page_title=='Press')?'open':'' }}">
                                    <a href="javascript:;" class="nav-link nav-toggle">
                                        <i class="glyphicon glyphicon-th"></i>
                                        <span class="title">Press</span>
                                        <span class="arrow {{ (isset($page_title) && $page_title=='Press')?'open':'' }}"></span>
                                    </a>
                                    <ul class="sub-menu" style="display: {{ (isset($page_title) && $page_title=='Press')?'block':'none' }}">
                                        <li class="nav-item  {{ (isset($page_title) && $page_action=='View Press')?'active':'' }}">
                                            <a href="{{ route('press') }}" class="nav-link ">
                                               <i class="glyphicon glyphicon-eye-open"></i> 
                                                <span class="title">
                                                    View Press 
                                                </span>
                                            </a>
                                        </li> 
                                        <li class="nav-item  {{ (isset($page_title) && $page_action=='Create Press')?'active':'' }}">
                                            <a href="{{ route('press.create') }}" class="nav-link ">
                                               <i class="glyphicon glyphicon-eye-open"></i> 
                                                <span class="title">
                                                    Create Press
                                                </span>
                                            </a>
                                        </li> 
                                    </ul>
                                </li> 


                             <li class="nav-item start active {{ (isset($page_title) && $page_title=='Page')?'open':'' }}">
                                    <a href="javascript:;" class="nav-link nav-toggle">
                                        <i class="glyphicon glyphicon-th"></i>
                                        <span class="title">Page Content </span>
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


                            <li class="nav-item start active {{ (isset($page_title) && $page_title=='setting')?'open':'' }}">
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


                        <!-- posttask end-->
                    </ul>
                    <!-- END SIDEBAR MENU -->
                </div>
                <!-- END SIDEBAR -->
            </div>