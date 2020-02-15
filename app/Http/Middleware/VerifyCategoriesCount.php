<?php

namespace App\Http\Middleware;

use Closure;
use App\Category;

class VerifyCategoriesCount
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Category::all()->count() == 0) {
            session()->flash('error','You must first create at least one category to be able to add posts');
            return redirect(route('categories.create'));
        }
        // else proceed
        return $next($request);
    }
}
