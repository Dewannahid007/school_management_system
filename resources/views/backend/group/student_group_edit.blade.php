@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

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
                     <h4 class="box-title">Edit group </h4>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                     <div class="row">
                        <div class="col">
                           <form action="{{route('student.group.update',$records->id)}}" method="post">
                              @csrf
                              <div class="row">
                                 <div class="col-md-12">
                                          <div class="form-group">
                                             <h5>User Name <span class="text-danger">*</span></h5>
                                             <div class="controls">
                                                <input type="text" name="name" value="{{$records->name}}" class="form-control" required="" />
                                             </div>
                                          </div>                            
                                 </div>
                                 <div class="text-xs-right">
                                    <input type="submit" class="btn btn-rounded btn-info mb-5" value="Update" />
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
<script type="text/javascript">
    $(document).ready(function(){
        $('#image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImage').attr('src',e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });

</script>
@endsection