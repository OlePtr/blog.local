<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Auth\Guard;

class Admin_users extends Controller
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
    public function index(Guard $auth)
    {

        $users = DB::table('users')->get();
//        $category = DB::table('category')->get() ;
//        $archives = DB::table('posts')->orderBy('postID', 'description')->get();

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
            'users' => $users,
 //           'archives' => $archives,
 //           'selectedcat'=>0,
 //           'category' => $category,
 //           'postincategorycount'=>$postincategorycount,
            'currentuser' => $auth->user()
        );

        return view('admin_users', $data );
    }

    public function getAdmForm() {
        return view('user/adm_form');
    }

    public function createAdm(Request $request){
        $user = User::create(array(
            'name' => Input::get('name'),
            'email' => Input::get('email'),
            'password' => Hash::make(Input::get('pass'))
        ));
        return redirect()->route('index_users')->with('success', 'Post has been successfully added!');
    }

    public function getPost($id){
        $post = Post::find($id);
        return view('post/post_detail', ['post' => $post]);
    }

    public function editUser($id) {
        $user = User::find($id);
        return view('user/edit_user', ['user' => $user]);
    }

    public function updateUser(Request $request, $id) {

        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->pass);
        $user->save();

        return redirect()->route('index_users')->with('success', 'Has been updated successfully!');
    }

    public function deleteUser($id) {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('index_users')->with('success', 'Has been deleted successfully!');
    }

}
