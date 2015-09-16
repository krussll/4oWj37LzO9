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
                            <li>
                              <a href="#contact-modal" data-toggle="modal">Contact Us</a>
                            </li>
                            <li class="">
                                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">

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
                                <!--<li><a href="/register">Register</a></li>-->
                                <li><a  href="#login-modal" data-toggle="modal">Login</a></li>
                            @endif


                        </ul>
                    </nav>
                </div>

            </div>
            <!-- /top navigation -->


            <!-- page content -->
            <div class="full" role="main">
                <div class="">

                  <div class="wide">
                      <div class="header-content">
                        <div class="home-container">
                          <div class="col-xs-12 site_title">
                            <h1>START TRADING TODAY</h1>
                            <h2>Free Hashtag Trading Leagues</h2>
                          </div>
                        </div>
                      </div>
                  </div>

                  <div class="full-width light">
                  <div class="home-container light" ng-controller="homeController" ng-init="home.init()">
                    <div class="row">
                      <div class="col-xs-12 col-md-4">
                        <p class="top-margin-large">
                          Tagdaq is a free to play hashtag trading game, where to play against your friends to make the most on your portfolio. Buy low, sell high - or hold on and pick up the dividends.
                        </p>
                      </div>
                      <div class="col-xs-12 col-md-8">
                        <img class="medium" src="/cdn/responsive.jpg" />
                      </div>

                    </div>
                  </div>
                </div>
                  <div class="home-container" ng-controller="betaWaitController">
                    <div class="row">
                      <p>
                        We are currently in a closed beta test, but if you'd like us to let you know when we move to the open beta please fill in the form below.
                      </p>

                      <p>
                        <div ng-show="betaWait.message != ''">
                                <div class="col-md-12">
                                  <div class="alert alert-success">{{betaWait.message}}</div>
                                </div>
                              </div>
                        <form data-parsley-validate ng-submit="betaWait.submit()" class="form-horizontal form-label-left">

                                <div class="item form-group" ng-class="{bad: !betaWait.validation.email.isValid}">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Email <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="email" required="required" ng-model="betaWait.inputs.email" type="text" class="form-control col-md-7 col-xs-12" />
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <button type="submit" class="btn btn-success">Submit</button>
                                    </div>
                                </div>

                              </form>
                      </p>
                    </div>
                  </div>

                </div>
            </div>
            <!-- /page content -->
@stop
