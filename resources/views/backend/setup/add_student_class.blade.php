@extends('admin.admin_master')
 @section('admin')
<div class="content-wrapper">
    <div class="container-full">
        <div class="content-wrapper">
            <div class="container-full">
                <!-- Content Header (Page header) -->

                <!-- Main content -->
                <section class="content">
                    <!-- Basic Forms -->
                    <div class="box">
                        <div class="box-header with-border">
                            <h4 class="box-title">Add Class</h4>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col">
                                    <form action="{{route('student.class.store')}}" method="post">
                                        @csrf
                                        <div class="row">
                                            <div class="col-12">
                                                
                                                        <div class="form-group">
                                                            <h5>Class Name <span class="text-danger">*</span></h5>
                                                            <div class="controls">
                                                                <input type="text" name="name"  class="form-control" required />
                                                                 @error('oldpassword')
                                                                 <span class="text-danger">{{$message}}</span>

                                                                 @enderror
                                                            </div>
                                                        </div>

                                                <div class="text-xs-right">
                                                    <input type="submit" class="btn btn-rounded btn-info mb-5" value="Submit" />
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
    </div>
</div>
@endsection
