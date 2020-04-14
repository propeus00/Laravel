<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Requests\Categories\CreateCategoryRequest;
use App\Http\Requests\Categories\UpdateCategoriesRequest;

class CategoriesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except('show');

        $this->middleware("checkCategory")->only(["destroy"]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view("categories.index")->with("categories", Category::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("categories.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCategoryRequest $request)
    {


        Category::create([
            "name" => $request->name
        ]);

        session()->flash("success", "Category " . "'$request->name'" . " created successfully");

        return redirect("/categories");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view("welcome", [
            "posts" => $category->posts,
            "categories" => Category::all()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view("categories.create")->with("category", $category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoriesRequest $request, Category $category)
    {
        $previouseCategoryName = $category->name;

        // $category->name = $request->name;

        // $category->save();

        $category->update([
            "name" => $request->name
        ]);

        return redirect(route("categories.index"))->with('previouseCategoryName', $previouseCategoryName)->with("afterValue", $request->name);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();

        session()->flash("successDelete", "The " . "$category->name" . " category have been delete.");

        return redirect(route("categories.index"));
    }
}
