@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

<div class="page-content">
   <div class="container-fluid">


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Edit blog category Page</h4>
                    <br><br>
                    <form method="POST" action="{{route('update.blog.category')}}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{$blogcategory->id}}">
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Blog Category Name</label>
                            <div class="col-sm-10">
                                <input class="form-control" name="blog_category_name" type="text" value="{{$blogcategory->blog_category}}" id="example-text-input">
                                @error('blog_category_name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        

                        
                        <!-- end row -->
                        <input type="submit" class="btn btn-info btn-rounded waves-effect waves-light" value="Update Blog Catgory Data">
                    </form>
                </div>
            </div>
        </div> <!-- end col -->
    </div>


</div>
</div>


<script type="text/javascript">
    
    $(document).ready(function(){
        $('#portfolio_image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#ShowImage').attr('src',e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>
@endsection