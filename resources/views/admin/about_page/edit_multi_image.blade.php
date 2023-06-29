@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

<div class="page-content">
   <div class="container-fluid">


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Update Multi Image</h4>
                    <br><br>
                    <form method="POST" action="{{ route('update.multi.image') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{$multiImage->id}}">                         
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2  col-form-label">About Multi Image </label>
                            <div class="col-sm-10">
                                <input class="form-control" name="multi_image" type="file" multiple="" id="multi_image">
                            </div>
                        </div>
                        <!-- end row -->
                        
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label"> </label>
                            <div class="col-sm-10">
                                <img class="rounded avatar-lg" id="ShowImage" src="{{asset ($multiImage->multi_image)}}
                                " width="100px" height="100px" alt="Card image cap">
                            </div>
                        </div>
                        <!-- end row -->
                        <input type="submit" class="btn btn-info btn-rounded waves-effect waves-light" value="Update Multi Image">
                    </form>
                </div>
            </div>
        </div> <!-- end col -->
    </div>


</div>
</div>


<script type="text/javascript">
    
    $(document).ready(function(){
        $('#multi_images').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#ShowImage').attr('src',e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>
@endsection