<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogCategory;
Use Illuminate\Support\Carbon;


class BlogCategoryController extends Controller
{
    //

    public function AllBlogCategory(){

         $blogcategory = BlogCategory::latest()->get();
    return view('admin.blog_category.blog_category_all',compact('blogcategory'));




    } // endmethod



     public function AddBlogCategory()
   {

    return view('admin.blog_category.add_blog_category');


   }// end method




    public function StoreBlogCategory (Request $request){

    // $request->validate([
    //     'blog_category_name' =>'required',
    // ], 
    // [
    //     'blog_category_name.required'=> 'The Blog Category Name Is Required',
        

    // ]);

            BlogCategory::insert([
                'blog_category' => $request->blog_category_name,
                'created_at'=> Carbon::now()
            ]);

             $notification = array(
             'message' => 'Blog Category inserted successfuly',
             'alert-type' => 'success'
            );

            return redirect()->route('all.blog.category')->with($notification);


  }// end method


    public function EditBlogCategory($id){

     $blogcategory = BlogCategory::findOrFail($id);
       return view('admin.blog_category.blog_category_edit',compact('blogcategory'));


  }// end method




  public function UpdateBlogCategory(Request $request){

        $blog_id = $request->id;

            BlogCategory::findOrFail($blog_id)->update([
               'blog_category' => $request->blog_category_name,
            ]);

             $notification = array(
             'message' => 'Blog Category Updated successfuly',
             'alert-type' => 'success'
            );

            return redirect()->route('all.blog.category')->with($notification);


  }// end method


 public function DeleteBlogCategory($id){

        BlogCategory::findOrFail($id)->delete();
         $notification = array(
            'message' => 'Blog Category Deleted Successfully', 
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);



     }// End Method 


}
