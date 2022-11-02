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
				  <h3 class="box-title">Employee Attendance Details</h3>
                  <a href="{{route('employee.attendance.add')}}" style="float: right;" class="btn btn-rounded btn-success mb-5">Add Attendence</a>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
                    <table class="table table-bordered table-striped">
						<thead>
							<tr>
								<th width="5%">SL</th>
								<th>Name</th>
                                <th>ID No</th>
                                <th>Date</th>
                                <th>Attend Status</th>
							</tr>
						</thead>
						<tbody>
							@foreach($details as $key => $attendance)
							<tr>
								<td>{{$key+1}}</td>
								<td>{{$attendance['user']['name']}}</td>
                                <td> {{$attendance['user']['id_no']}} </td>
								<td>{{date('d-m-Y', strtotime($attendance->date))}}</td>
                                <td>{{ $attendance->attend_status}}</td>

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