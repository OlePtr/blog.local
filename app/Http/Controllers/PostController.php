<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function getIndex() {

        //$posts = DB::table('users')
//        $posts = DB::table('posts')
//        ->leftjoin('posts', 'users.id', '=', 'posts.authors_authorID')->paginate(4)
//        ->leftjoin('authors', 'authors.authorID', '=', 'posts.authors_authorID');

        $posts = DB::table('posts')

            ->leftjoin('authors', 'authors.authorID', '=', 'posts.authors_authorID')
            ->leftjoin('category', 'category.categoryID', '=', 'posts.category_categoryID')
            ->where('is_published', '=' ,"1" )
            //->orderBy('authors.authorID')
            ->orderBy('posts.postid')
            ->paginate(4);

        $category = DB::table('category')->get() ;
        $archives = DB::table('posts')
            ->orderBy('postID', 'description')->get()
            ->where('is_published', '=' ,"1" );
        $selectedcat = 0;

        $postincategorycount=DB::table('posts')
            ->leftjoin('authors', 'authors.authorID', '=', 'posts.authors_authorID')
            ->leftjoin('category', 'category.categoryID', '=', 'posts.category_categoryID')
            ->where('is_published', '=' ,"1")
            ->where("category", "!=", null)
            ->selectRaw('category,categoryURL, count(*) as cnt')
            ->groupBy("posts.category_categoryID")
            ->orderBy('authors.authorID')
            ->get();

        $data = array(
            'posts' => $posts,
            'archives' => $archives,
            'selectedcat'=>0,
            'category' => $category,
            'postincategorycount'=>$postincategorycount
        );
//dd($data);
        return view('index', $data );
    }



    public function getCategoryPosts($category_url) {
        $posts = DB::table('posts')
            ->leftjoin('authors', 'authors.authorID', '=', 'posts.authors_authorID')
            ->leftjoin('category', 'category.categoryID', '=', 'posts.category_categoryID')
            ->where('is_published', '=' ,"1" )
            ->where('category.categoryID', '=', $category_url->categoryID)
            ->orderBy('authors.authorID')
            ->paginate(4);

        $category = DB::table('category')->paginate(10);
        $archives = DB::table('posts')
            ->orderBy('postID', 'description')
            ->where('is_published', '=' ,"1" )
            ->get();

        $postincategorycount=DB::table('posts')
            ->leftjoin('authors', 'authors.authorID', '=', 'posts.authors_authorID')
            ->leftjoin('category', 'category.categoryID', '=', 'posts.category_categoryID')
            ->where('is_published', '=' ,"1")
            ->where("category", "!=", null)
            ->selectRaw('category,categoryURL, count(*) as cnt')
            ->groupBy("posts.category_categoryID")
            ->orderBy('authors.authorID')
            ->get();

        $var= $category_url->categoryID;
        $data = array(
            'posts' => $posts,
            'archives' => $archives,
            'selectedcat'=>$var,
            'selectedcatDesk'=>$category_url->categoryDESCRIPTION,
            'category' => $category,
            'postincategorycount'=>$postincategorycount
        );
        //$selectedcat=$category_url;
        return view('index', $data);
    }



    public function getFullPost($post_id) {
        $post = DB::table('posts')
            ->leftjoin('authors', 'authors.authorID', '=', 'posts.authors_authorID')
            ->leftjoin('category', 'category.categoryID', '=', 'posts.category_categoryID')
            ->where('postURL', '=' , $post_id)
            ->first();
//dd($post);
        return view('post/read', ['post' => $post]);
    }
}
