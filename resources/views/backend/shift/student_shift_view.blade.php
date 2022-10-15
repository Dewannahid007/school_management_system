@extends('admin.admin_master')
@section('admin')
<div class="content-wrapper">
	  <div class="container-full">
		<!-- Content Header (Page header) -->

		<!-- Main content -->
		<section class="content">
		  <div class="row">
			<div class="col-12">

			 <div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">Student Shifts</h3>
                  <a href="{{route('student.shift.add')}}" style="float: right;" class="btn btn-rounded btn-success mb-5">Add Shift</a>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th width="5%">SL</th>
								<th>Name</th>
								<th width="25%">Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($records as $key=> $record)
							<tr>
								<td>{{$key+1}}</td>
								<td>{{$record->name}}</td>
								<td> 
                                    <a href="{{route('student.shift.edit',$record->id)}}" class="btn btn-primary">Edit</a> 
                                    <a href="{{route('student.shift.delete',$record->id)}}" class="btn btn-danger" id="delete">Delete</a>
                                </td>
							</tr>
                            @endforeach
						</tbody>
						<tfoot>
							
						</tfoot>
					  </table>
					</div>
				</div>
				<!-- /.box-body -->
			  </div>
			  <!-- /.box -->
			  <!-- /.box -->          
			</div>
			<!-- /.col -->
		  </div>
		  <!-- /.row -->
		</section>
		<!-- /.content -->
	  
	  </div>
  </div> 

@endsection