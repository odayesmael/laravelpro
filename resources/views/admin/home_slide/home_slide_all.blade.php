@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

<div class="page-content">
   <div class="container-fluid">


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Home Slide Page</h4>
                    <br><br>
                    <form method="POST" action="{{ route('update.slider') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ $homeslide->id }}">
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Title</label>
                            <div class="col-sm-10">
                                <input class="form-control" name="title" type="text" value="{{$homeslide->title}}" id="example-text-input">
                            </div>
                        </div>
                        <!-- end row -->
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Short Title</label>
                            <div class="col-sm-10">
                                <input class="form-control" name="short_title" type="text" value="{{$homeslide->short_title}}" id="example-text-input">
                            </div>
                        </div>
                        <!-- end row -->
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2  col-form-label">Video Url</label>
                            <div class="col-sm-10">
                                <input class="form-control" name="video_url" type="url" id="video_url" value="{{$homeslide->video_url}}">
                            </div>
                        </div>
                        <!-- end row -->
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2  col-form-label">Slider Image </label>
                            <div class="col-sm-10">
                                <input class="form-control" name="home_slide" type="file" value="{{$homeslide->home_slide}}" id="home_slide">
                            </div>
                        </div>
                        <!-- end row -->
                        
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label"> </label>
                            <div class="col-sm-10">
                                <img class="rounded avatar-lg" id="ShowImage" src="{{(!empty($homeslide->home_slide))? url($homeslide->home_slide):url('upload/no_image.jpg') }}
                                " width="100px" height="100px" alt="Card image cap">
                            </div>
                        </div>
                        <!-- end row -->
                        <input type="submit" class="btn btn-info btn-rounded waves-effect waves-light" value="Update Profile">
                    </form>
                </div>
            </div>
        </div> <!-- end col -->
    </div>


</div>
</div>


<script type="text/javascript">
    
    $(document).ready(function(){
        $('#home_slide').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#ShowImage').attr('src',e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>
@endsection