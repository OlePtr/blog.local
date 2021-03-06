<?php

namespace App;
//
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

   public $timestamps = false;
   protected $primaryKey = 'postid';
   //protected $table = "posts";
   protected $fillable = ['postID', 'title', 'description', 'authors_authorID', 'category_categoryID', 'content',  'image', 'publishedDATA', 'postURL'];

    public function scopeSearch ($query, $s){
        return $query->where('content', 'like', '%' .$s.  '%')->orWhere('description', 'like', '%' .$s.  '%');
    }
}


