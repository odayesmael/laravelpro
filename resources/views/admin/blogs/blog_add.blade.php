@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<style type="text/css">
    .bootstrap-tagsinput .tag{
        margin-right: 2px;
        color: #b70000;
        font-weight: 700px;
    } 
</style>
<div class="page-content">
   <div class="container-fluid">


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Blog Page</h4>
                    <br><br>
                    <form method="POST" id="myform" action="{{ route('store.blog') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Blog Category</label>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Select</label>
                                <div class="col-sm-10">
                                    <select name="blog_category_id" class="form-select" aria-label="Default select example">
                                        <option selected="">Open this select menu</option>
                                        @foreach($categories as $cat)
                                        <option value="{{$cat->id}}">{{$cat->blog_category}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- end row -->
                        </div>
                        <!-- end row -->
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Blog Title</label>
                            <div class="form-group col-sm-10">
                                <input class="form-control" name="blog_title" type="text" value="" id="example-text-input">
                               <!--  @error('blog_title')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror -->
                            </div>
                        </div>
                        <!-- end row -->

                        
                        <!-- end row -->
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Blog Tags </label>
                            <div class="col-sm-10">
                                <input name="blog_tags" value="home,tech" class="form-control" type="text" data-role="tagsinput"> 
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2  col-form-label">Blog Description</label>
                            <div class="col-sm-10">
                               <textarea id="elm1" name="blog_description">
                                
                               </textarea>

                           </div>
                       </div>

                       <!-- end row -->
                       <div class="row mb-3">
                        <label for="example-text-input" class="col-sm-2  col-form-label">blog Image </label>
                        <div class="col-sm-10">
                            <input class="form-control" name="blog_image" type="file" value="" id="blog_image">
                        </div>
                    </div>
                    <!-- end row -->
                    
                    <div class="row mb-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label"> </label>
                        <div class="col-sm-10">
                            <img class="rounded avatar-lg" id="ShowImage" src="{{ url('upload/no_image.jpg') }}
                            " width="100px" height="100px" alt="Card image cap">
                        </div>
                    </div>
                    <!-- end row -->

                    
                    <input type="submit" class="btn btn-info btn-rounded waves-effect waves-light" value="Insert blog Data">
                </form>
            </div>
        </div>
    </div> <!-- end col -->
</div>


</div>
</div>


<script type="text/javascript">
    
    $(document).ready(function(){
        $('#blog_image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#ShowImage').attr('src',e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>


<script type="text/javascript">
    $(document).ready(function (){
        $('#myform').validate({
            rules: {
                blog_title: {
                    required : true,
                }, 
            },
            messages :{
                blog_title: {
                    required : 'Please Enter The Blog Title',
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