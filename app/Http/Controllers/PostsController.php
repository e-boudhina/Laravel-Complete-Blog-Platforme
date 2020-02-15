<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\Posts\UpdatePostRequest;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;
use App\Http\Requests\Posts\createPostsRequest;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verifyCategoriesCount')->only(['create','store']);
    }
    public function index(Post $post)
    {
        return view('posts.index')->with('posts',$post->all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create')->with('categories',Category::all())->with('tags',Tag::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostsRequest $request)
    {

        //dd($request->all());
        //Upload the image
 $image =$request->image->store('posts');
        //Create the post
 $post = Post::create([
    'title' => $request->title,
    'description' => $request->description,
    'content' => $request->input('content'),
    'image' => $image,
     'user_id'=> auth()->user()->id,
    'published_at' => $request->published_at,
    'category_id' => $request->category_id
]);
 if ($request->tags)
 {
     $post->tags()->attach($request->tags);
 }
        //Flush the message
session()->flash('success','Post created Successfully');
        //Redirect
        return redirect(route('posts.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.create')
            ->with('post',$post )
            ->with('category',Category::find($post))
            ->with('categories',Category::where('id','<>',$post->category->id)->get())
            ->with('tags',Tag::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $data = $request->only([
            'title' ,'description','published_at','content','category_id'
        ]);
            //Check if there is a new image
if ($request->hasFile('image')){


    //upload it
    $image = $request->image->store('posts');
    //delete old image
   // Storage::delete($post->image);
    $post->deleteImage();
    $post->image = $image;
    $data['image'] = $image;
}
if ($request->tags)
{
    //Syns is method implemented in laravel to check if the attached attributes already exists | if it detects a change it will update it
$post->tags()->sync($request->tags);
}
    //update attributes
    $post->update($data);

    //flush message
    session()->flash('success','Post Updated Successfully');


        //redirect
        return redirect(route('posts.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::withTrashed()->where('id',$id)->firstOrFail();
    if ($post->trashed())
    {
        //Storage::delete($post->image);
        $post->deleteImage();
        $post->forceDelete();
        session()->flash('success','Post Deleted Successfully From Database & No Longer Recoverable ');
    }
    else
    {
        $post->delete();
        session()->flash('success','Post Trashed Successfully ( Post will remain in trash for 72 hours then it will be Permanently Deleted) ');

    }
        return redirect(route('posts.index'));
    }
    /**
     * Display a list of all trashed posts
     *
     */
    public function trashed()
    {
   $trashed = Post::onlyTrashed()->get();
   //with posts is a dynamic method same as => return view('posts.index')->with('posts',$trashed);
    return view('posts.index')->with('posts',$trashed);
    }

    /**
     * Restore trashed post
     */
    //the posts is trashed you can't search it for it using rout model binding cause it does not exist
    public function restore($id)
    {
        $post = Post::withTrashed()->where('id',$id)->firstOrFail();
        $post->restore();
        session()->flash('success','Post Restored Successfully ');
        return redirect()->back();
    }
}
