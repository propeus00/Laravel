<?php

namespace App\Http\Middleware;

use Closure;
use App\Category;

class DeleteAllPostsBeforeDeleteCategory
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


        $category = Category::where('id', '=', $request->category->id)->first();
        if ($category->posts->count() >= 1) {
            session()->flash("error", "Delete all the posts that belong to the category before deleting the category.");
            return redirect(route("categories.index"));
        }
        return $next($request);
    }
}
