<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Requests\CreateCategoryRequest;

class CategoriesController extends Controller
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
        $categories =Category::all();


        return view('categories.index')->with('categories',$categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('categories.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCategoryRequest $request)
    {

//        Category::create(
//            $request->all()
//        );

        $category = new Category();
        $category->name = $request->name;

        $category->save();
        session()->flash('success','Category added');
        return redirect(route('categories.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(category $category)
{
    //
}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        $category = Category::find($id);

        return view('categories.update')->with('category',$category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Category $category )
    {
        // There is so many ways to update information , i kind of lost count, this is just one of them
        $category->update([
            'name' => $request->name
        ]);
        $category->save();
        session()->flash('success','Category Updated Successfully');

        return redirect('home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,Category $category)
    {

        if($category->posts()->count()>0) {
            session()->flash('error','Category can not be deleted because its has posts');
            return redirect()->back();
        }
        $category->delete();
        session()->flash('success','Category Deleted Successfully');

        return redirect(route('categories.index'))->with('success' ,'Category deleted');
    }
}
