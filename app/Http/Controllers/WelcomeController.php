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
        if ($search)
        {
            $posts = Post::where('title','LIKE',"%{$search}%")->Simplepaginate(1);
        }
        else{
            $posts = Post::Simplepaginate(2);
        }
        return view('welcome')
            ->with('categories',Category::all())
            ->with('tags' ,Tag::all())
            ->with('posts',$posts);
    }
}
