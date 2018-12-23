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
            ->paginate(3);

        $category = DB::table('category')->paginate(10);
        $archives = DB::table('posts')->orderBy('postID', 'description')->get();

        $data = array(
            'posts' => $posts,
            'archives' => $archives
        );
        return view('post/index', $data, ['category' => $category]);
    }



    public function getCategoryPosts($category_id) {
        $posts = DB::table('posts')
            ->leftjoin('authors', 'authors.authorID', '=', 'posts.authors_authorID')
            ->leftjoin('category', 'category.categoryID', '=', 'posts.category_categoryID')
            ->where('is_published', '=' ,"1" )
            ->where('category.categoryID', '=' , $category_id)
            ->paginate(3);

        $category = DB::table('category')->paginate(10);
        $archives = DB::table('posts')->orderBy('postID', 'description')->get();

        $data = array(
            'posts' => $posts,
            'archives' => $archives
        );
        return view('post/index', $data, ['category' => $category]);
    }

    public function getFullPost($post_id) {
        $post = DB::table('posts')
            ->leftjoin('authors', 'authors.authorID', '=', 'posts.authors_authorID')
            ->leftjoin('category', 'category.categoryID', '=', 'posts.category_categoryID')
            ->where('postid', '=' , $post_id)
            ->first();

//dd($post);

        return view('post/read', ['post' => $post]);
    }
}
