<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\BlogCategory;
Use Illuminate\Support\Carbon;
Use Image;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class BlogController extends Controller
{

public function AllBlog(){
   
    $blogs = Blog::latest()->get();
    return view('admin.blogs.blog_all',compact('blogs'));

    } // endmethod



public function AddBlog()
   {
     $categories = BlogCategory::orderBy('blog_category','ASC')->get();
    return view('admin.blogs.blog_add',compact('categories'));
   }// end method


public function StoreBlog(Request $request){
// $request->validate([
        
//         'blog_title' =>'required',
        
//     ], 
//     [

//          'blog_title.required'=> 'The Portfolio Title Is Required', 
        

//     ]);


      $image = $request->file('blog_image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();

            Image::make($image)->resize(430,327)->save('upload/blog/'.$name_gen);
            $save_url = 'upload/blog/'.$name_gen;

            Blog::insert([
                'blog_category_id' => $request->blog_category_id ,
                'user_id' => auth()->user()->id,
                'blog_title' => $request->blog_title ,
                'blog_description' => $request->blog_description ,
                'blog_tags' => $request->blog_tags ,
                'blog_image' => $save_url ,
                'created_at'=> Carbon::now()
            ]);

             $notification = array(
             'message' => 'Blog inserted successfuly',
             'alert-type' => 'success'
            );

            return redirect()->route('all.blog')->with($notification);



   }// end method

   public function EditBlog($id){

     $blog = Blog::findOrFail($id);
     $categories = BlogCategory::orderBy('blog_category','ASC')->get();

       return view('admin.blogs.blog_edit',compact('blog','categories'));



   }// end method


   public function UpdateBlog(Request $request){

        $blog_id = $request->id;


        if ($request->file('blog_image')) {
            $image = $request->file('blog_image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();

            Image::make($image)->resize(430,327)->save('upload/blog/'.$name_gen);
            $save_url = 'upload/blog/'.$name_gen;

            Blog::findOrFail($blog_id)->update([
               'blog_category_id' => $request->blog_category_id ,
                'blog_title' => $request->blog_title ,
                'blog_description' => $request->blog_description ,
                'blog_tags' => $request->blog_tags ,
                'blog_image' => $save_url ,
                'created_at'=> Carbon::now()
            ]);

             $notification = array(
             'message' => 'Blog Updated with image successfuly',
             'alert-type' => 'success'
            );

            return redirect()->route('all.blog')->with($notification);

            }
            else{

               Blog::findOrFail($blog_id)->update([
               'blog_category_id' => $request->blog_category_id ,
                'blog_title' => $request->blog_title ,
                'blog_description' => $request->blog_description ,
                'blog_tags' => $request->blog_tags ,
            
            ]);
             $notification = array(
             'message' => 'Blog Updated without image successfuly',
             'alert-type' => 'success'
            );

             return redirect()->route('all.blog')->with($notification);

            }   //end else


  }// end method


  public function DeleteBlog($id){

        $blog = Blog::findOrFail($id);
        $img = $blog->blog_image;
        unlink($img);

        Blog::findOrFail($id)->delete();

         $notification = array(
            'message' => 'Blog Deleted Successfully', 
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);



     }// End Method 

     public function BlogDetails($id){
        $allblogs = Blog::latest()->limit(5)->get();
        $blogs= Blog::findOrFail($id);
        $categories = BlogCategory::orderBy('blog_category','ASC')->get();

        return view('frontend.blog_details',compact('blogs','allblogs','categories'));

     }// End Method 

     public function CategoryBlog($id){
         $allblogs = Blog::latest()->limit(5)->get();
         $blogpost = Blog::where('blog_category_id',$id)->orderBy('id','DESC')->paginate(3) ;
         $categories = BlogCategory::orderBy('blog_category','ASC')->get();
         $catname = BlogCategory::findOrFail($id);
        return view ('frontend.cat_blog_details',compact('blogpost','allblogs','categories','catname'));
     }// End Method 


public function HomeBlog(){
    
$allblogs = Blog::latest()->paginate(3);    
$categories = BlogCategory::orderBy('blog_category','ASC')->get();
return view ('frontend.blog',compact('allblogs','categories'));

}//endmethod


}
