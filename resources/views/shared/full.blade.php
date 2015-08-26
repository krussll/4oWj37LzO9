@extends('shared.master')
@section('layout')
            <div class="top_nav full">
                <div class="nav_menu">
                    <nav class="" role="navigation">
                        <div class="navbar nav_title" style="border: 0;">
                            <a href="/" class="site_title"><span>{{layout.consts.siteName | uppercase}}</span></a>
                        </div>
                        <ul class="nav navbar-nav navbar-right">
                            @if (Auth::check())
                            <li class="">
                                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <span>
                                        <cdn-image
                                            cdn-src="user/[[Auth::user()->id]]"
                                            cdn-file="[[Auth::user()->profile_image]]" />
                                    </span>
                                    [[Auth::user()->firstname]] [[Auth::user()->surname]]
                                    <span class=" fa fa-angle-down"></span>
                                </a>
                                <ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
                                    <li><a href="/dashboard">  Dashboard</a>
                                    </li>
                                    <li><a href="/settings">  Profile Settings</a>
                                    </li>
                                    <li><a href="#" ng-click="layout.logout()"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                                    </li>
                                </ul>
                            </li>
                            @else
                                <li><a href="/register">Register</a></li>
                                <li><a  href="#login-modal" data-toggle="modal">Login</a></li>
                            @endif
                            

                        </ul>
                    </nav>
                </div>

            </div>
            <!-- /top navigation -->


            <!-- page content -->
            <div class="right_col full" role="main">
                <div class="">

                    @yield('content')

                </div>
            </div>
            <!-- /page content -->
@stop