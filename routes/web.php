<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Home\HomeSliderController;
use App\Http\Controllers\Home\AboutController;
use App\Http\Controllers\Home\BlogCategoryController;
use App\Http\Controllers\Home\BlogController;
use App\Http\Controllers\Home\FooterController;
use App\Http\Controllers\Home\ContactController;
use App\Http\Controllers\Home\PortfolioController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('frontend.index');

});



Route::controller(AdminController::class)->group(function()
{

    Route::get('/admin/logout','destroy')->name('admin.logout');
    Route::get('/admin/profile','Profile')->name('admin.profile')->middleware('auth');
    Route::get('/edit/profile','EditProfile')->name('edit.profile')->middleware('auth');
    Route::post('/store/profile','StoreProfile')->name('store.profile')->middleware('auth');
    Route::get('/change/password','ChangePassword')->name('change.password')->middleware('auth');
    Route::post('/update/password','UpdatePassword')->name('update.password')->middleware('auth');

});


Route::controller(HomeSliderController::class)->group(function()
{
    Route::get('/','HomeMain')->name('home');
    Route::get('/home/slide','HomeSlider')->name('home.slide')->middleware('auth');
    Route::post('/update/slider','UpdateSlider')->name('update.slider')->middleware('auth');

});

Route::controller(AboutController::class)->group(function()
{
Route::get('/about/page','AboutPage')->name('about.page')
->middleware('auth');
Route::post('/update/about','UpdateAbout')->name('update.about')
->middleware('auth');
Route::get('/about','HomeAbout')->name('home.about');
Route::get('/about/multi/image','AboutMultiImage')->name('about.multi.images')
->middleware('auth');
Route::post('/store/multi/image','StoreMultiImage')->name('store.multi.image')
->middleware('auth');
Route::get('/all/multi/image','AllMultiImage')->name('all.multi.images')
->middleware('auth');
Route::get('/delete/multi/image/{id}','DeleteMultiImage')->name('delete.multi.image')
->middleware('auth');
Route::get('/edit/multi/image/{id}','EditMultiImage')->name('edit.multi.image')
->middleware('auth');
Route::post('/update/multi/image','UpdateMultiImage')->name('update.multi.image')
->middleware('auth');

});


Route::controller(PortfolioController::class)->group(function()
{

Route::get('/all/portfolio','AllPortfolio')->name('all.portfolio')
->middleware('auth');
Route::get('/add/portfolio','AddPortfolio')->name('add.portfolio')
->middleware('auth');
Route::post('/store/portfolio','StorePortfolio')->name('store.portfolio')
->middleware('auth');
Route::get('/edit/portfolio/{id}','EditPortfolio')->name('edit.portfolio')
->middleware('auth');
Route::post('/update/portfolio/','UpdatePortfolio')->name('update.portfolio')
->middleware('auth');
Route::get('/delete/portfolio/{id}','DeletePortfolio')->name('delete.portfolio')
->middleware('auth');
Route::get('/portfolio/details/{id}','PortfolioDetails')->name('portfolio.detalis');
Route::get('/portfolio','HomePortfolio')->name('home.portfolio');

});



Route::controller(BlogCategoryController::class)->group(function()
{

Route::get('/all/blog/category','AllBlogCategory')->name('all.blog.category')
->middleware('auth');
Route::get('/add/blog/category','AddBlogCategory')->name('add.blog.category')
->middleware('auth');
Route::post('/store/blog/category','StoreBlogCategory')->name('store.blog.category')
->middleware('auth');
Route::get('/edit/blog/category/{id}','EditBlogCategory')->name('edit.blog.category')
->middleware('auth');
Route::post('/update/blog/category','UpdateBlogCategory')->name('update.blog.category')
->middleware('auth');
Route::get('/delete/blog/category/{id}','DeleteBlogCategory')->name('delete.blog.category')
->middleware('auth');

});


Route::controller(BlogController::class)->group(function()
{

 Route::get('/all/blog','AllBlog')->name('all.blog')->middleware('auth');
 Route::get('/add/blog','AddBlog')->name('add.blog')->middleware('auth');
 Route::post('/store/blog','StoreBlog')->name('store.blog')->middleware('auth');
 Route::get('/edit/blog/{id}','EditBlog')->name('edit.blog')->middleware('auth');
 Route::post('/update/blog','UpdateBlog')->name('update.blog')->middleware('auth');
 Route::get('/delete/blog/{id}','DeleteBlog')->name('delete.blog')->middleware('auth');
 Route::get('/blog/details/{id}','BlogDetails')->name('blog.details');
 Route::get('/category/blog/{id}','CategoryBlog')->name('category.blog');
 Route::get('/blog','HomeBlog')->name('home.blog');

});






Route::controller(FooterController::class)->group(function()
{

  Route::get('/footer/setup','FooterSetup')->name('footer.setup')->middleware('auth');
  Route::post('/update/footer/','UpdateFooter')->name('update.footer')->middleware('auth');

});


Route::controller(ContactController::class)->group(function()
{

  Route::get('/contact','Contact')->name('contact.me');
  Route::post('/store/message','StoreMessage')->name('store.message')->middleware('auth');
  Route::get('/contact/message','ContactMessage')->name('contact.message')->middleware('auth');
  Route::get('/delete/message/{id}','DeleteMessage')->name('delete.message')->middleware('auth');


});


// Route::group(['middleware' => ['auth']], function () {


// });

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.index');
    })->name('dashboard');
});
