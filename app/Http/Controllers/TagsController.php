<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;
use App\Http\Requests\Tags\CreateTagRequest;
use App\Http\Requests\Tags\UpdateTagRequest;

class TagsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $tags =Tag::all();


        return view('tags.index')->with('tags',$tags);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('tags.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateTagRequest $request)
    {

//        Tag::create(
//            $request->all()
//        );
        $Tag = new Tag();
        $Tag->name = $request->name;

        $Tag->save();
        session()->flash('success','Tag added');
        return redirect(route('tags.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tag  $Tag
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        $tag = Tag::find($id);

        return view('tags.create')->with('tag',$tag);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTagRequest $request,Tag $tag )
    {
        // There is so many ways to update information , i kind of lost count, this is just one of them
        $tag->update([
            'name' => $request->name
        ]);
        $tag->save();
        session()->flash('success','Tag Updated Successfully');

        return redirect('home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,Tag $tag)
    {
        if($tag->posts()->count()>0) {
            session()->flash('error','Tag can not be deleted because it is tied to some posts');
            return redirect()->back();
        }
        $tag->delete();
        session()->flash('success','Tag Deleted Successfully');

        return redirect(route('tags.index'))->with('success' ,'Tag deleted');
    }
}
