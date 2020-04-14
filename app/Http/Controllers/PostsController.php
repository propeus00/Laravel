<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\Post;
use App\Http\Requests\Posts\CreatePostsRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;



class PostsController extends Controller
{

    public function __construct()
    {
        $this->middleware("notNullCategory")->only(["create", "store"]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view("posts.index")->with("posts", Post::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("posts.create")->with("categories", Category::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostsRequest $request)
    {
        $image = $request->image->store("posts");

        Post::create([
            "title" => $request->title,
            "description" => $request->description,
            "content" => $request->content,
            "image" => $image,
            "published_at" => $request->published_at,
            "category_id" => $request->category,
            "user_id" => Auth::user()->id
        ]);

        session()->flash("success", "Post " . "'$request->title'" . " created successfully.");

        return redirect(route("posts.index"));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view("posts.show", ["post" => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view("posts.create", [
            "post" => $post,
            "categories" => Category::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {

        $data = $request->all();

        if ($request->hasFile("image")) {

            $image =   $request->image->store("posts");

            Storage::delete($post->image);

            $data["image"] = $image;
        }

        $post->update($data);

        session()->flash("success", "Post " . "'$post->title'" . " updated.");

        return redirect(route("posts.index"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::withTrashed()->where("id", $id)->firstOrFail();

        if ($post->trashed()) {
            Storage::delete($post->image);
            $post->forceDelete();
            session()->flash("success", "Post " . "'$post->title'" . " have been delete it.");
            return redirect(route("trashed-posts"));
        } else {
            $post->delete();
            session()->flash("success", "Post " . "'$post->title'" . " have been trashed.");
            return redirect(route("posts.index"));
        }
    }

    //Display list of all trashed posts
    public function trashed()
    {
        $trashed = Post::onlyTrashed()->get();

        return view("posts.index")->with("posts", $trashed);
    }

    public function restore($id)
    {
        $post = Post::withTrashed()->where("id", $id)->firstOrFail();

        session()->flash("success", "Post " . "'$post->title'" . " restored.");

        $post->restore();

        return redirect(route("posts.index"));
    }
}
