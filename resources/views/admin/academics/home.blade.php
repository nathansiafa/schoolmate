@extends('layouts.master')

@section('page-title', 'Academics')

@section('page-css')
<!-- date picker -->
<link href="{{ asset("/bower_components/AdminLTE/plugins/datepicker/bootstrap-datepicker.css") }}" rel="stylesheet" type="text/css" />
<!-- swal alert css -->
<link href="{{ asset("/bower_components/AdminLTE/plugins/sweetalert-master/dist/sweetalert.css") }}" rel="stylesheet" type="text/css" />
<!-- Animate css -->
<link href="{{ asset("/bower_components/AdminLTE/plugins/animate/animate.min.css") }}" rel="stylesheet" type="text/css" />
@endsection

@section('user-logout')
  @component('components.user-logout')
      @slot('user_name')
          {{Auth::guard('admin')-> user()->user_name}}
      @endslot
      {{route('admin.logout')}}
  @endcomponent
@endsection


@section('page-header', 'Academics Details')

@section('sidebar-navigation')
<!-- Sidebar Menu -->
<ul class="sidebar-menu">
  <li class="header">ADMIN NAVIGATION</li>

  <li class="">
    <a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i> <span>Dashboard</span>
    </a>
  </li>

  <!-- guardians -->
  <li class="treeview">
    <a href="#"><i class="fa fa-user"></i> <span>Guardians</span>
      <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span>
    </a>
    <ul class="treeview-menu">
      <li><a href="{{route('guardians.home')}}"><i class="glyphicon glyphicon-th-list"></i> <span>Guardians</span></a></li>
      <li><a href="{{route('guardians.form')}}"><i class="glyphicon glyphicon-pencil"></i>New Guardian</a></li>
    </ul>
  </li>

  <!-- teachers -->
  <li class="treeview">
    <a href="#"><i class="glyphicon glyphicon-education"></i> <span>Teachers</span>
      <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span>
    </a>
    <ul class="treeview-menu">
      <li><a href="{{route('teachers.home')}}"><i class="glyphicon glyphicon-th-list"></i> <span>Teachers</span></a></li>
      <li><a href="{{route('teachers.form')}}"><i class="fa fa-pencil"></i>New Teacher</a></li>
      <li><a href="{{route('admin-gradesTeacher.home')}}"><i class="glyphicon glyphicon-align-left""></i>Teacher Grades</a></li>
      <li><a href="{{route('admin-gradesTeacher.form')}}"><i class="fa fa-pencil"></i>New Teacher Grade</a></li>
      <li><a href="{{route('admin.ponsor.home')}}"><i class="glyphicon glyphicon-knight"></i>Sponsors</a></li>
    </ul>
  </li>

  <!-- Settings -->
  <li class="active treeview">
    <a href="#"><i class="fa fa-cogs"></i> <span>Settings</span>
      <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span>
    </a>
    <ul class="treeview-menu">
      <li><a href="/institution"><i class="fa fa-edit"></i>Institution</a></li>
      <li class="active"><a href="/academics"><i class="fa fa-edit"></i>Academic</a></li>
      <li><a href="/subjects"><i class="fa fa-edit"></i>Subjects</a></li>
      <li><a href="/grades"><i class="fa fa-edit"></i>Grades</a></li>
      <li><a href="/divisions"><i class="fa fa-edit"></i>Divisions</a></li>
      <li><a href="/semesters"><i class="fa fa-edit"></i>Semesters</a></li>
      <li><a href="/terms"><i class="fa fa-edit"></i>Terms</a></li>
    </ul>
  </li>

  <!-- student -->
  <li class="treeview">
    <a href="#">
      <i class="fa fa-users"></i><span>Students</span>
      <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span>
    </a>
    <ul class="treeview-menu">
      <li><a href="{{route('students.home')}}"><i class="glyphicon glyphicon-list-alt"></i>Student List</a></li>
      <li><a href="{{route('students.create')}}"><i class="glyphicon glyphicon-pencil"></i>Student Admission</a></li>
      <li><a href="{{route('enrollments.home')}}"><i class="glyphicon glyphicon-saved"></i>Student Enrollment</a></li>
    </ul>
  </li>

  	<!-- attendence -->
  	<li class="treeview">
	  <a href="#">
	    <i class="glyphicon glyphicon-stats"></i><span>Attendence</span>
	    <span class="pull-right-container">
	      <i class="fa fa-angle-left pull-right"></i>
	    </span>
	  </a>
	  <ul class="treeview-menu">
	    <li><a href="{{route('attendence')}}"><i class="glyphicon glyphicon-list-alt"></i>Manage Attendence</a></li>
	    <li><a href="{{route('attendence.create')}}"><i class="glyphicon glyphicon-pencil"></i>New Attendence</a></li>      
	  </ul>
	</li>

	<!-- users -->
	<li class="treeview">
	  <a href="#">
	    <i class="glyphicon glyphicon-user"></i><span>Users</span>
	    <span class="pull-right-container">
	      <i class="fa fa-angle-left pull-right"></i>
	    </span>
	  </a>
	  <ul class="treeview-menu">
	    <li><a href="{{route('users.home')}}"><i class="glyphicon glyphicon-list-alt"></i>User List</a></li>
	    <li><a href="{{route('users.form')}}"><i class="glyphicon glyphicon-pencil"></i>New User</a></li>
	    <li><a href="{{route('roles.home')}}"><i class="glyphicon glyphicon-tasks"></i>Roles</a></li>
	    <li><a href="{{route('roles.form')}}"><i class="glyphicon glyphicon-pencil"></i>New Role</a></li>
	  </ul>
	</li>

  <!-- score -->
  <li class="treeview">
    <a href="#">
      <i class="fa fa-fax"></i><span>Scores</span>
      <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span>
    </a>
    <ul class="treeview-menu">
      <li><a href="/scores"><i class="glyphicon glyphicon-list-alt"></i>Score Tables</a></li>
      <li><a href="/scores/master"><i class="glyphicon glyphicon-pencil"></i>Enter Score</a></li>
    </ul>
  </li>

  <!-- reports -->
  <li class="treeview">
    <a href="#">
      <i class="fa fa-folder-open-o"></i>
      <span>Scores Reports</span>
      <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span>
    </a>
    <ul class="treeview-menu">
      <li><a href="/scores/report/terms"><i class="fa fa-file-text-o"></i>Term Report</a></li>
      <li><a href="/scores/report/semesters"><i class="fa fa-file-text-o"></i>Semester Report</a></li>
      <li><a href="{{route('annual-scores')}}"><i class="fa fa-file-text-o"></i>Annual Report</a></li>
    </ul>
  </li>
  <!-- transcript -->
  <li>
    <a href="{{route('transcripts.home')}}"><i class="fa fa-file-text-o"></i> <span>Student Transcript</span>
    </a>
  </li>
</ul>
@endsection


@section('content')

    <div class="row">
    	<!-- Custom Tabs -->
    	<div class="col-md-9 col-md-offset-1">
	        <div class="nav-tabs-custom">
		        <ul class="nav nav-tabs">
	              <li class="active"><a href="#tab_details" data-toggle="tab">Details</a></li>
	              <li><a href="#tab_settings" data-toggle="tab">Settings</a></li>
	            </ul>
	            <div class="tab-content">
		            <div class="tab-pane active" id="tab_details">
		                <!-- Table -->
	                	<table class="table table-bordered">
	                		<thead>
	                			<tr>
	                				<th>Year Start</th>
	                				<th>Year End</th>
	                				<th>Status</th>
	                				<th colspan="2">Actions</th>
	                			</tr>
	                		</thead>
	                		<tbody>
	                			@foreach($academics as $academic)
	                				<tr class="academic{{$academic->id}}">
	                					<td>{{$academic->year_start}}</td>
	                					<td>{{$academic->year_end}}</td>
	                					@if($academic->status)
	                						<td><span class="label label-info">Active</span></td>
	                					@else
	                						<td><span class="label label-warning">Inactive</span></td>
	                					@endif
	                					<td>
	                						<a href="/academics/edit/{{$academic->id}}">
	                							<i class="glyphicon glyphicon-edit text-info" ></i>
	                						</a>
	                					</td>

	                					<td><a href="" id="delete-academic" data-id="{{$academic->id}}" data-toggle="tooltip" title="Delete"><i class="glyphicon glyphicon-trash text-danger"></i></a></td>
	                				</tr>
	                			@endforeach
	                		</tbody>
	                	</table>
		            </div>
		             <!-- /.tab-pane -->
		            <div class="tab-pane" id="tab_settings">
	                	@include('admin.academics.create')
		            </div>
		            <!-- /.tab-pane -->
	            </div>
	            <!-- /.tab-content -->
		    </div>
		    <!-- nav-tabs-custom -->
	    </div>
    </div>

@endsection


@section('page-scripts')
	
	<script src="{{ asset ("/bower_components/AdminLTE/plugins/sweetalert-master/dist/sweetalert.min.js") }}"></script>

    <script src="{{ asset ("/bower_components/AdminLTE/plugins/datepicker/bootstrap-datepicker.js") }}"></script>

    <script type="text/javascript" src="{{asset("/js/academics/home.js")}}"></script>

    @if($flash = session('message'))
	    <script type="text/javascript">
	        var message = "Academic year: <b>{{$flash}}</b>";
	        notify(message);
	    </script>
	@endif

@endsection
