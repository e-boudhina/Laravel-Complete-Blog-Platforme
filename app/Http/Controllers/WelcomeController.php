<?php

namespace App\Http\Controllers;
use App\Category;
use App\Tag;
use App\Post;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public  function index(Request $request)
    {
        $search = $request->query('search');
        //No need for this any more since we added the query search to the model
//        if ($search)
//        {
//            $posts = Post::where('title','LIKE',"%{$search}%")->Simplepaginate(1);
//        }
//        else{
//            $posts = Post::Simplepaginate(2);
//        }


        return view('welcome')
            ->with('categories',Category::all())
            ->with('tags' ,Tag::all())
//            ->with('posts',$posts);
            ->with('posts', Post::searched()->simplepaginate(2));
    }
}
