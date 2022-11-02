@extends('admin.admin_master')
 @section('admin')
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

        <div class="content-wrapper">
            <div class="container-full">
                <!-- Content Header (Page header) -->

                <!-- Main content -->
                <section class="content">
                    <!-- Basic Forms -->
                    <div class="box">
                        <div class="box-header with-border">
                            <h4 class="box-title">Edit Attendance</h4>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col">
                                    <form action="{{route('employee.attendance.store')}}"  method="post">
                                        @csrf
                                        <div class="row">
                                            <div class="col-12">
                                               <div class="row">
                                                <div class="col-md-6">
                                                <div class="form-group">
                                                            <h5>Attendance Date <span class="text-danger">*</span></h5>
                                                            <div class="controls">
                                                                <input type="date" name="date" value="{{$editData['0']['date']}}"   class="form-control" required />
                                                            </div>
                                                        </div>

                                               </div>
                                               </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <table class="table table-bordered table-striped" style="width: 100%;" >
                                            <thead>
                                                <tr>
                                                    <th rowspan="2" class="text-center" style="vertical-align:middle;">SL No</th>
                                                    <th rowspan="2" class="text-center" style="vertical-align:middle;">Employee List</th>
                                                    <th colspan="3" class="text-center" style="vertical-align:middle; width:30%">Attendance Status</th>

                                                </tr>
                                                <tr>
                                                    <th class="text-center btn present_all" style="display:table-cell;background-color:black">Present</th>
                                                    <th class="text-center btn leave_all" style="display:table-cell;background-color:black">Leave</th>
                                                    <th class="text-center btn absent_all" style="display:table-cell;background-color:black">Absent</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @foreach($editData as $key => $value )
                                                <tr id="div{{$value->id}}" class="text-center">
                                                    <input type="hidden" name="employee_id[]" value="{{$value->employee_id}}" id="">
                                                    <td>{{$key+1}}</td>
                                                    <Td>{{$value['user']['name']}}</Td>
                                                    <td colspan="3">
                                                        <div class="switch-toggle switch-3 switch-candy">
                                                            <input type="radio" name="attend_status{{$key}}" value="Present" id="present{{$key}}" checked="checked" {{($value->attend_status=='Present')?'checked':''}}>
                                                            <label for="present{{$key}}">Present</label>

                                                            <input type="radio" name="attend_status{{$key}}" value="Leave" id="leave{{$key}}" {{($value->attend_status=='Leave')?'checked':''}}>
                                                            <label for="leave{{$key}}">Leave</label>

                                                            <input type="radio" name="attend_status{{$key}}" value="Absent" id="absent{{$key}}" {{($value->attend_status=='Absent')?'checked':''}}>
                                                            <label for="absent{{$key}}">Absent</label>

                                                        </div>

                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>


                                            </table>
                                        

                                        </div>
                                    </div>
                                     
                                                <div class="text-xs-right">
                                                    <input type="submit" class="btn btn-rounded btn-info mb-5" value="Update" />
                                                </div>
                                            </div>
                                            <!-- /.col -->
                                        </div>
                                        <!-- /.row -->
                                        <!-- /.box-body -->
                                        <!-- /.box -->

                                        <!-- /.content -->
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>

        <script type="text/javascript">
            $(document).ready(function(){
                $(document).on('change','#leave_purpose_id',function(){
                    var leave_purpose_id = $(this).val();
                    if(leave_purpose_id == 0){
                        $('#add_another').show();
                    } else{
                        $('#add_another').hide();
                    }

                });
            });

        </script>
@endsection
