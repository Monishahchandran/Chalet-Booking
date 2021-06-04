<div class="col-md-3 left_col">
                <div class="left_col scroll-view">
                    <div class="clearfix"></div>
                    <!-- menu profile quick info -->
                    <div class="profile clearfix">
                        <div class="profile_pic">
                            <img src="{{url('images/img.jpg')}}" alt="..." class="img-circle profile_img">
                        </div>
                        <div class="profile_info">
                            <span>Welcome,</span>
                            <h2>Admin</h2>
                        </div>
                    </div>
                    <!-- /menu profile quick info -->
                    <br />
                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                        <div class="menu_section">
                            <ul class="nav side-menu">
                                <li><a><i class="glyphicon glyphicon-home"></i> Home <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="{{ url('/Dashboard') }}">Dashboard</a></li>
                                        <li><a href="{{ url('/Rejected-List') }}">Rejected List</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a><i class="glyphicon glyphicon-user"></i> Users <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="{{ url('/Owner') }}">Owners</a></li>
                                        <li><a href="{{ url('/users') }}">Users</a></li>
                                        <li><a href="{{ url('/users-blocked') }}">Blocked</a></li>
                                    </ul>
                                </li>
                                <li><a><i class="glyphicon glyphicon-map-marker"></i> Chalet <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="{{ url('/Chalet-List-All') }}">Chalet List</a></li>
                                        <li><a href="{{ url('/Season-Prices-List') }}">Season Prices</a></li>
                                        <li><a>Holidays and Events<span class="fa fa-chevron-down"></span></a>
                                            <ul class="nav child_menu">
                                                <li class="sub_menu"><a href="{{ url('/Holidays-and-events') }}">List</a></li>
                                                <?php $event_result = (new \App\Helper)->get_events();?>
                                                @if($event_result->isEmpty())
                                                @endif
                                                @if(!empty($event_result))
                                                @foreach($event_result as $event)
                                                <?php $id = base64_encode($event->id);?>
                                                <li class="sub_menu"><a href="{{ url('/Add-Events-To-Chalet') }}/<?php echo $id; ?>">{{$event->event_name}}</a></li>
                                                <!-- <li class="sub_menu"><a href="{{ url('/Add-Events-To-Chalet') }}">Event Name 1</a></li>
                                                <li class="sub_menu"><a href="{{ url('/Add-Events-To-Chalet') }}">Event Name 2</a></li> -->
                                                @endforeach
                                                @endif
                                            </ul>
                                        </li>
                                        <li><a href="{{ url('/Offers') }}">Offers</a></li>
                                    </ul>
                                </li>
                                <li><a><i class="glyphicon glyphicon-bullhorn"></i> Notifications <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="{{ url('/notifications') }}">Notifications</a></li>
                                        <li><a href="{{ url('/notifications-Auto') }}">Auto Notifications</a></li>
                                        <li><a href="{{ url('/notifications-System') }}">System Notifications</a></li>
                                    </ul>
                                </li>
                                <li><a><i class="glyphicon glyphicon-tasks"></i> Invoices <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="{{ url('/Chalet-Invoices-Total') }}">All Invoices</a></li>
                                        <li><a href="{{ url('/Chalet-Invoices-Total-PAID') }}">Paid</a></li>
                                        <li><a href="{{ url('/Chalet-Invoices-Total-UnPaid') }}">UnPaid</a></li>
                                        <li><a href="{{ url('/Chalet-Invoices-Total-Deposits') }}">Deposit</a></li>
                                        <li><a href="{{ url('/Chalet-Invoices-Total-Refund-Money') }}">Refund Money</a></li>
                                        <li><a href="{{ url('/Deposited-Money-To-Owner') }}">Deposited Money To Owner</a></li>
                                    </ul>
                                </li>
                                <li><a href="{{ url('/Chalet-Agreement') }}"><i class="glyphicon glyphicon-pencil"></i> Agreement</a></li>
                                <li><a href="{{ url('/Chalet-Contact-Us') }}"><i class="glyphicon glyphicon-earphone"></i> Contact-Us</a></li>

                                <li><a href="{{ url('/Settings') }}"><i class="glyphicon glyphicon-cog"></i> Settings</a></li>
                                <li><a href="{{ url('logout') }}"><i class="fa fa-sign-out"></i> Log Out</a>
                                    <ul class="nav child_menu">
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- /sidebar menu -->
                    <!-- /menu footer buttons -->
                    <!-- /menu footer buttons -->
                </div>
            </div>
            <!-- top navigation -->
            <div class="top_nav">
                <div class="nav_menu">
                    <nav>
                        <div class="nav toggle">
                            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                        </div>
                    </nav>
                </div>
            </div>
            <!-- /top navigation -->