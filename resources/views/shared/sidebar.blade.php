@extends('shared.master')

@section('layout')
            <!-- page content -->
<!-- top navigation -->
                    <div class="top_nav">

                        <div class="nav_menu">
                            <nav class="" role="navigation">
                                <div class="navbar nav_title" style="border: 0;">
                                    <a href="/dashboard" class="site_title"><span>{{layout.consts.siteName | uppercase}}</span></a>
                                </div>
                                <ul class="nav navbar-nav navbar-right">
                                    @if (Auth::check())
                                    <li class="">
                                        <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                            
                                            <span><cdn-image
                                                cdn-src="user/[[Auth::user()->id]]"
                                                cdn-file="[[Auth::user()->profile_image]]" />
                                            </span>
                                            [[Auth::user()->firstname]] [[Auth::user()->surname]]
                                            <span class=" fa fa-angle-down"></span>
                                        </a>
                                        <ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
                                             <li>
                                                <a href="/dashboard">  Dashboard</a>
                                            </li>
                                            <li>
                                                <a href="/settings">  Profile Settings</a>
                                            </li>
                                            <li><a href="#" ng-click="layout.logout()"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                                            </li>
                                        </ul>
                                    </li>
                                    @else
                                        <li><a href="/register" class="button">Register</a></li>
                                        <li><a href="/login" class="button">Login</a></li>
                                    @endif
                                    

                                </ul>
                            </nav>
                        </div>

                    </div>
                    <!-- /top navigation -->
            <div class="col-md-3 left_col" ng-controller="sideNavController">
                <div class="left_col scroll-view">
                    <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                    </div>
                    
                    <div class="clearfix"></div>

                    @if (Auth::check())
                    <!-- menu profile quick info -->
                      <div class="profile">
                          <div class="profile_pic">
                            <cdn-image cdn-class="img-circle profile_img"
                                                cdn-src="user/[[Auth::user()->id]]"
                                                cdn-file="[[Auth::user()->profile_image]]" />
                            </div>
                          <div class="profile_info">
                              <h2>[[Auth::user()->firstname]] [[Auth::user()->surname]]</h2>
                          </div>
                      </div>
                    <!-- /menu prile quick info -->
                    @endif
                    <br />

                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

                        <div class="menu_section">
                            <span>
                                <select ng-options="obj.name for obj in sideNav.userPortfolios" ng-model="sideNav.portfolio" class="form-control" ng-change="sideNav.change()">
                                </select>
                                <h3>$10,630</h3>
                            </span>
                            <ul class="nav side-menu">
                                <li>
                                    <a href="/dashboard"><i class="fa fa-bar-chart-o"></i>  Dashboard</a>
                                </li>
                                
                                <li>
                                    <a href="/leagues"><i class="fa fa-table"></i>  Leagues</a>
                                </li>
                                
                                <li>
                                    <a href="/hashtags"><i class="fa fa-line-chart"></i>  Find Hashtags</a>
                                </li>
                            </ul>
                        </div>

                    </div>
                    <!-- /sidebar menu -->



                </div>
            </div>
            <div class="right_col" role="main">
                <div class="">

                    @yield('content')

                </div>
            </div>
            <!-- /page content -->
@stop