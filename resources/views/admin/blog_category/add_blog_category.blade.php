@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

<div class="page-content">
   <div class="container-fluid">


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Add blog category Page</h4>
                    <br><br>
                    <form method="POST" id="myform" action="{{route('store.blog.category')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Blog Category Name</label>
                            <div class="form-group col-sm-10">
                                <input class="form-control" name="blog_category_name" type="text" value="" id="example-text-input">
                                <!-- @error('blog_category_name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror -->
                            </div>
                        </div>
                        

                        
                        <!-- end row -->
                        <input type="submit" class="btn btn-info btn-rounded waves-effect waves-light" value="Insert Blog Catgory Data">
                    </form>
                </div>
            </div>
        </div> <!-- end col -->
    </div>


</div>
</div>

<script type="text/javascript">
    $(document).ready(function (){
        $('#myform').validate({
            rules: {
                blog_category_name: {
                    required : true,
                }, 
            },
            messages :{
                blog_category_name: {
                    required : 'Please Enter Blog Category',
                },
            },
            errorElement : 'span', 
            errorPlacement: function (error,element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight : function(element, errorClass, validClass){
                $(element).addClass('is-invalid');
            },
            unhighlight : function(element, errorClass, validClass){
                $(element).removeClass('is-invalid');
            },
        });
    });
    
</script>
@endsection