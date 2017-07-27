@extends('layouts.master')

@section('page-title', 'Grade')

@section('meta')
	<meta name="csrf-token" content="{{csrf_token()}}">
@endsection

@section('page-css')
	<!-- Animate css -->
	<link href="{{ asset("/bower_components/AdminLTE/plugins/animate/animate.min.css") }}" rel="stylesheet" type="text/css" />

	<!-- swal alert css -->
	<link href="{{ asset("/bower_components/AdminLTE/plugins/sweetalert-master/dist/sweetalert.css") }}" rel="stylesheet" type="text/css" />
@endsection

@section('page-header', 'Grade')


@section('content')

	<!-- grades modal form start -->
	@include('grades.edit')
	<!-- grades modal form end -->

	<div class="row">
		<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
			<div class="box box-primary collapsed-box box-solid">
				<div class="box-header with-border">
	              	<h3 class="box-title">Grades</h3>

		            <div class="box-tools pull-right">
		            	<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
		            </div>
		        </div>

	            <div class="box-body container-fluid text-center">
					<form action="" method="POST" class="form-inline" role="form" id="add-form">
						<p class="name-error text-danger hidden"></p>
						<div class="form-group">
							<label for="name">Name</label>
							<input type="text" name="name" id="name" class="form-control" placeholder="Grade/class name">
						</div>
						<div class="form-group">

                            <label for="division">Division</label>
                            <p class="division-error text-danger hidden"></p>
                            <select class="form-control" name="division_id" id="division" required="">
                                 @foreach($divisions as $division)
                                    <option value="{{$division->id}}">{{$division->name}}</option>
                                @endforeach
                            </select>
                
                        </div>
						<button type="submit" id="insert-grade" class="btn btn-success form-control">Save</button>
					</form>
				</div>

				<div class="panel-body">
					<!-- Table -->
					<table class="table table-bordered table-condensed table-striped" id="grades-table">
						<thead>
							<tr>
								<th>Name</th>
								<th>Divison</th>
								<th colspan="2">Actions</th>
							</tr>
						</thead>
						<tbody>
							@foreach($grades as $grade)
								<tr class="grade{{$grade->id}}">
									<td>{{$grade->name}}</td>
									<td>{{$grade->division->name}}</td>
									<td>
										<a id="edit-grade" data-id="{{$grade->id}}" data-name="{{$grade->name}}" data-toggle="tooltip" title="Edit" href="#" role="button">
											<i class="glyphicon glyphicon-edit text-info"></i>
										</a>
									</td>
									<td>
										<a id="delete-grade" data-id="{{$grade->id}}" data-toggle="tooltip" title="Delete" href="#" role="button">
											<i class="glyphicon glyphicon-trash text-danger"></i>
										</a>
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>	
	</div>

@endsection

@section('page-scripts')

	<script src="{{ asset ("/bower_components/AdminLTE/plugins/sweetalert-master/dist/sweetalert.min.js") }}"></script>
	<script type="text/javascript">
		$(document).ready(function($) {

			$.ajaxSetup({
			    headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    }
			});

			// inserting class/grade
			$(document).on('click', '#insert-grade', function(event) {
				event.preventDefault();
				/* Act on the event */
				var name = $('#name').val();
				var division = $('#division').val();

				if (name.length == 0 || name == null) {
					$('.name-error').removeClass('hidden');
					$('.name-error').show().html('Please enter a class/grade name.'); 
				}
				if (division == null){
					$('.division-error').removeClass('hidden');
					$('.division-error').show().html('Please select a division the subject is taught in.');
				} else {
					$.post('/grades', $("#add-form").serialize())
					.done(function (data) {
						// body...

						// if the validator bag returns error display error in modal
						if (data.errors) {
			        		$('.errors').removeClass('hidden');
			    			var errors = '';
			                for(datum in data.errors){
			                    errors += data.errors[datum] + '<br>';
			                }
			                $('.errors').show().html(errors); 

			            } else {
			            	console.log(data);
			            	// reset the form
			            	$("#add-form")[0].reset();

			            	// prepare row of grade details to append to table
			            	var row = '<tr class="grade'+data[0].id+'">';

			            	row += '<td>'+data[0].name+'</td>';

			            	row += '<td>'+data[0].division.name+'</td>';

			            	row += '<td><a id="edit-grade" data-id="'+data[0].id+'" data-name="'+data[0].name+'" data-toggle="tooltip" title="Edit" href="#" role="button"><i class="glyphicon glyphicon-edit text-info"></i></a></td>';

			            	row += '<td><a id="delete-grade" data-id="'+data[0].id+'" data-toggle="tooltip" title="Delete" href="#" role="button"><i class="glyphicon glyphicon-trash text-danger"></i></a></td>';

			            	row += '</tr>';
					
							// append row of grade details to table
					        $("#grades-table").append(row);

					        // notify that the grade was created
					        var message = '<b>'+data[0].name+'</b>'+ ' save!!';
					        notify(message);
			            }		 
					})
					.fail(function (data) {
						// body...
						$('#subject-modal').modal('hide');
			            	// display error

			        	$('.errors').removeClass('hidden');
			    		$('.errors').text('There was an error. Please try again, and if error persits contact administrator');
					});
				}
				
			});


			// prepare edit modal
			$(document).on('click', '#edit-grade', function(event) {
				event.preventDefault();
				/* Act on the event */
				// hide all errors

				//set the name field with the subject name
				$('#edit-name').val($(this).data('name'));

				// set the hidden input field value with the grade id
				$('#edit-id').val($(this).data('id'));

				// subject to be edited id
				var id = $(this).attr('data-id');

				$('.name-error').addClass('hidden');
				$('.errors').addClass('hidden');

				// an ajax call the get the division assigned to the class/grade to be edited
				$.get('/grades/edit/'+id)
				.done(function (data) {
					// body...
					$("#grade-select").replaceWith(data);

				})
				.fail(function (data) {
					// body...
					$('.errors').removeClass('hidden');
					$('.errors').html('Sorry! The was a problem retrieving details of class please try again and if problem persists contact administrator.')
				});

				// display the add modal
				$('#edit-modal').modal({
					show: true,
					backdrop:'static',
					keyboard:false
				});
			});

			// editing a class/grade
			$(document).on('click', '#update-grade', function(event) {
				event.preventDefault();
				/* Act on the event */

				var id = $('#edit-id').val();
				var name = $('#edit-name').val();

				// check if name is null befor submiting to server
				if (name.length == 0 || name == null) {
					$('.name-error').removeClass('hidden');
					$('.name-error').show().html('Please check if the name field is fill in.'); 
				} else {
					$.ajax({
						url: '/grades/update/'+id,
						type: 'PUT',
						data: $("#edit-form").serialize(),
					})
					.done(function(data) {

						// if the validator bag returns error display error in modal
						if (data.errors) {
			        		$('.errors').removeClass('hidden');
			    			var errors = '';
			                for(datum in data.errors){
			                    errors += data.errors[datum] + '<br>';
			                }
			                $('.errors').show().html(errors); 

			            } else {
			       			
			       			console.log(data);
			            	// hide the bootstrap dialog
			            	$("#edit-form")[0].reset();

			            	$('#edit-modal').modal('hide');

			            	// prepare updated subject details to replace old one
			            	var row = '<tr class="grade'+data[0].id+'">';

			            	row += '<td>'+data[0].name+'</td>';

			            	row += '<td>'+data[0].division.name+'</td>';

			            	row += '<td><a id="edit-grade" data-id="'+data[0].id+'" data-name="'+data[0].name+'" data-toggle="tooltip" title="Edit" href="#" role="button"><i class="glyphicon glyphicon-edit text-info"></i></a></td>';

			            	row += '<td><a id="delete-grade" data-id="'+data[0].id+'" data-toggle="tooltip" title="Delete" href="#" role="button"><i class="glyphicon glyphicon-trash text-danger"></i></a></td>';

			            	row += '</tr>';

			            	// replace subject row with updated details of subject
			            	$(".grade" + data[0].id).replaceWith(row);


			            	// notify the record was updated
			            	var message = '<b>'+data[0].name+'</b>'+ ' updated!!';
			            	notify(message);
			            }
						
					})
					.fail(function(data) {
						$('.errors').removeClass('hidden');
						$('.errors').text('There was an error. Please try again, and if error persits contact administrator');
					});
				}	
			});

			// deleting a class/grade
			$(document).on('click', '#delete-grade', function(event) {
				event.preventDefault();
				/* Act on the event */

				// id of the row to be deleted
				var id = $(this).attr('data-id');

			    // row to be deleted
			    var row = $(this).parent("td").parent("tr");

				var message = "grade/class";

				var route = "/grades/delete/"+id;

				swal_delete(message, route, row);
				
			});	

		});
	</script>
@endsection