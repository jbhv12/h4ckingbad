@extends('layouts.app')

@section('title', 'Rules')

@section('content-header')
	<b>Rules for this the Event...
@endsection
 
@section('content')
	@php
	  use Carbon\Carbon;  
	@endphp
  
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-dnager">
            <div class="box-header with-border">
              <i class="fa fa-bomb"></i>

              <h3 class="box-title">General Instructions for H<b>4</b>cking Bad : </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="callout callout-danger">
                <h4>READ THESE INSTRUCTIONS CAREFULLY BEFORE STARTING CONTEST. Once started, timer cannot be paused or reset.</h4>
              </div>

              <div class="box-group" id="accordion">
                <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                
                  <div class="panel box">
                    <div class="box-header with-border text-center">
                      <h4 class="box-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#General">
                          General Instructions
                        </a>
                      </h4>
                    </div>
                    <div id="General" class="panel-collapse collapse in">
                      <div class="box-body">
                        <div class="row">
                          <div class="col-sm-12">
                            <p>
                            	Each problem has one or more hints associated with it. And each hint has a cost. Taking a hint will reduce the points the problem has to offer by its hint cost. For ex. Let’s say some problem offers 100 points and a hint costs 10 points. If you take hint and manage to solve the problem, you will be awarded with 90 points (100-10). If you can’t solve it, then there are no negative points.
                            </p>
                            <p>
                            	When you press a hint button, the value of problem will be reduced immediately. So, make sure you don’t “accidently push the button”. However, if you ask for same hint multiple time, it will cost you only once.
                            </p>
                            <ul>
                            	<li>Visit this URL: http://h4ckingbad.eastus.cloudapp.azure.com</li>
                            	<li>Register yourself on our domain (first time only).<li>
                            	<li>Make sure your email id matches with the one provided at the time of registration to be eligible to get GTU certificate.</li>
                            	<li>Login with the email id of team leader.</li>
                            	<li>You are allowed to browse internet for reference. However, you cannot install any third party software on college computers.</li>
                            </ul>
                            <p>
                            </p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="panel box">
                    <div class="box-header with-border text-center">
                      <h4 class="box-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#level1">
                          Level 1
                        </a>
                      </h4>
                    </div>
                    <div id="level1" class="panel-collapse collapse">
                      <div class="box-body">
                        <div class="row">
                          <div class="col-sm-12">
                            <ul>
                            	<li>Open Chrome and visit problems page.</li>
                            	<li>Read the problem specific instructions and submit the flag once you solve it.</li>
                            </ul>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="panel box">
                    <div class="box-header with-border text-center">
                      <h4 class="box-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#level2">
                          Level 2
                        </a>
                      </h4>
                    </div>
                    <div id="level2" class="panel-collapse collapse">
                      <div class="box-body">
                        <div class="row">
                          <div class="col-sm-12">
                            <ul>
                            	<li>Use following credentials to connect to remote shell. Use putty to do so.
                            	<br>http://h4ckingbad.eastus.cloudapp.azure.com:22</li>
                            	<li>/tmp directory is public. You may use this to store your temp file. However, this directory is visible to everyone. So, don’t leave secret files here. It is advised to create working directory with a hard-to-guess name.</li>
                            	<li>You are given source code as hint. Whenever you see ‘<flag_here>’ in source, it means that it is “blurred out” intentionally.</li>
                            	<li>Play nice. Don't leave orphan processes running. Don't annoy other players (It may result in disqualification).</li>
                            	<li>For your convenience we have installed a few useful tools including gcc and gdb.</li>
                            </ul>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                	
                	<div class="panel box">
                    <div class="box-header with-border text-center">
                      <h4 class="box-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#level3">
                          Level 3
                        </a>
                      </h4>
                    </div>
                    <div id="level3" class="panel-collapse collapse">
                      <div class="box-body">
                        <div class="row">
                          <div class="col-sm-12">
                            <ul>
                            	<li>Read the problem specific instructions. You may need to write code.</li>
                            </ul>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="panel box">
                    <div class="box-header with-border text-center">
                      <h4 class="box-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#level4">
                          Judging Criteria
                        </a>
                      </h4>
                    </div>
                    <div id="level4" class="panel-collapse collapse">
                      <div class="box-body">
                        <div class="row">
                          <div class="col-sm-12">
                            <p>
                            	Evaluation is fully automated. In case of same score, rank is give by FCFS. Number of participants eligible for next leveled will vary according to total no. of participants, overall score, time constraints etc. If you are leveled up, you will be notified by email. In case of any dispute, decision on management team is final.
                            </p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                
              </div>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
    </div>
  </div>    

@endsection