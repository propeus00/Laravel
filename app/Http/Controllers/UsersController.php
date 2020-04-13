<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {
        return view("users.index", ["users" => User::all()]);
    }

    public function makeAdmin(User $user)
    {

        $user["role"] = "admin";
        $user->save();

        session()->flash("success", "User " . '"' . "$user->name" . '"' . " have been made admin.");

        return redirect(route("users.index"));
    }

    public function removeAdmin(User $user)
    {

        $user["role"] = "writer";
        $user->save();

        session()->flash("success", "User " . '"' . "$user->name" . '"' . " have been removed admin rights.");

        return redirect(route("users.index"));
    }
}
