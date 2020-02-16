<?php

namespace App\Http\Controllers\Blog;

use App\Post;
use App\Category;
use App\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostsController extends Controller
{
    public function show(Post $post)
{
    return view('blog.show')
        ->with('tags',$post->tags()->get())
        ->with('post',$post);
}
public function category(Category $category)
{
    //No need for this any more since we added the query search scopeto the model
//    $search = request()->query('search');
//
//    if ($search)
//    {
//        $posts = $category->posts()->where('title','like',"%{$search}%")->simplePaginate(1);
//    }else{
//        $posts = $category->posts()->simplePaginate(2);
//    }
 return view('blog.category')
     ->with('category' , $category)
     ->with('categories' , Category::all())
     ->with('tags' , Tag::all())
     ->with('posts',$category->posts()->searched()->simplePaginate(2));
}

    public function tag(Tag $tag)
    {
        return view('blog.tag')
            ->with('tag' , $tag)
            ->with('categories' , Category::all())
            ->with('tags' , Tag::all())
            ->with('posts', $tag->posts()->searched()->simplePaginate(2));
    }
}
