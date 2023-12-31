<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class blog extends Model
{
    use HasFactory;
     protected $guarded =[];

     public function category(){

        return $this->belongsTo(BlogCategory::class,'blog_category_id','id');
     }

     public function user(){

        return $this->belongsTo(User::class,'user_id','id');
     }
}
