<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Filesystem\FilesystemServiceProvider;
use App\Http\Controllers\Controller;
use File;
use Illuminate\Support\Facades\Storage;

class Admin_posts extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $catSearch = $request->catSearch;
        $titleSearch = $request->titleSearch;
        $contentSearch = $request->contentSearch;
        $publishedSearch = $request->publishedSearch;

        $posts = DB::table('posts')
            ->leftjoin('authors', 'authors.authorID', '=', 'posts.authors_authorID')
            ->leftjoin('category', 'category.categoryID', '=', 'posts.category_categoryID')
//            ->where('is_published', '=' ,"1" )
            ->where('is_published', 'like', '%' . $publishedSearch . '%')
            ->where('category', 'like', '%' . $catSearch . '%')
            ->where('title', 'like', '%' . $titleSearch . '%')
            ->where('content', 'like', '%' . $contentSearch . '%')
            ->orderBy('posts.postid')
            ->paginate(8);

        $category = DB::table('category')->get();
        $archives = DB::table('posts')->orderBy('postID', 'description')->get();
        $selectedcat = 0;

        $postincategorycount = DB::table('posts')
            ->leftjoin('authors', 'authors.authorID', '=', 'posts.authors_authorID')
            ->leftjoin('category', 'category.categoryID', '=', 'posts.category_categoryID')
            ->where('is_published', '=', "1")
            ->where("category", "!=", null)
            ->selectRaw('category,categoryURL, count(*) as cnt')
            ->groupBy("posts.category_categoryID")
            ->orderBy('authors.authorID')
            ->get();

        $data = array(
            'posts' => $posts,
            $catSearch = $request->catSearch,
            $titleSearch = $request->titleSearch,
            $contentSearch = $request->contentSearch,
            $publishedSearch = $request->publishedSearch
        );

        session()->flashInput($request->input());
        return view('admin_posts', $data);
    }


    public function getPostForm()
    {
        return view('post/post_form');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function createPost(Request $request)
    {
        //dump($request);
        $validator = $this->validate($request, [
            'title' => 'required|unique:posts|max:255',
            'postURL' => 'required|unique:posts|max:15',
            'category' => 'required:category|max:15',
            'description' => 'required|unique:posts|max:150',
            'postURL' => 'required|unique:posts|max:15',
            'isPublished' => 'boolean:posts',
            'content' => 'required:posts|max:15000'

        ]);

        $data = array(
            'title' => Input::get('title'),
            'postURL' => Input::get('postURL'),
            'category_categoryID' => Input::get('category'),
            'description' => Input::get('description'),
            'authors_authorID' => Auth::user()->id,
            'image' => '',
            'is_published' => Input::get('isPublished'),
            'content' => Input::get('content')
        );;
        if ($request->has("imageUpload")) {

            $data["image"] = $request->imageUpload->store("public/images");
        }
        $post = Post::create($data);
        $urlp = $request->input('urlp');


        if ($validator) {
            if ($urlp) {
                if (strpos($urlp, '/author/post') !== false) {
                    echo 'true';
                    return redirect()->route('index_posts')->with('success', 'Post has been successfully added!');
                } else {
                    return redirect($urlp)->with('success', 'Post has been successfully added!');
                }
            } else {
                return redirect()->route('index_posts')->with('success', 'Post has been successfully added!');
            }

        } else {
        }


    }

    public function getPost($id)
    {
        $post = Post::find($id);
        return view('post/post_detail', ['post' => $post]);
    }

    public function editPost($id)
    {
        $post = Post::find($id);
        return view('post/edit_post', ['post' => $post]);
    }

    public function updatePost(Request $request, $id)
    {
        $validator = $this->validate($request, [
            'title' => 'required:posts|max:255',
            'postURL' => 'required:posts|max:15',
            'category' => 'required:category|max:15',
            'description' => 'required:posts|max:150',
            'postURL' => 'required:posts|max:15',
            'isPublished' => 'boolean:posts',
            'content' => 'required:posts|max:15000'
        ]);
        $post = Post::find($id);
        $post->title = $request->title;
        $post->description = $request->description;
        $post->postURL = $request->postURL;
        $post->is_published = $request->isPublished;
        $post->category_categoryID = $request->category;

        dump($request->imageUpload);
        if ($request->has("imageUpload")) {
            $post["image"] = $request->imageUpload->store("public/images");
        }
        $file = (basename($post["image"]));
        // то же самое
        //dump(asset("storage/images/$file")); === dd(Storage::url($post->image));

        if (file_exists(public_path("storage/images/$file"))) {
            //dd('File is exists.');
        } else {
            //dd('File is not exists.');
        }

        $post->save();
        $request->flash();
        //$post = Post::create::create($data);
        $urlp = $request->input('urlp');
        if ($validator) {
            if ($urlp) {
                if (strpos($urlp, '/author/post') !== false) {
                    echo 'true';
                    return redirect()->route('index_posts')->with('success', 'Post has been successfully updated!');
                } else {
                    return redirect($urlp)->with('success', 'Post has been successfully updated!');
                }
            } else {
                return redirect()->route('index_posts')->with('success', 'Post has been successfully updated!');
            }
        } else {
        }
    }

    public function deletePost($id)
    {
        $post = Post::find($id);
        $post->delete();
        return redirect()->route('index_posts')->with('success', 'Post has been deleted successfully!');
    }

}
