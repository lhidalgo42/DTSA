<?php

class UsersController extends BaseController
{

    public function index()
    {
        if (Auth::check()) {
            $coordinator = Coordinator::where('users_id',Auth::user()->id)->get();
            $receptors = Receptor::where('coordinators_id', $coordinator[0]->id)->get();
            return View::make('dashboard', compact('receptors'));
        }
    }
    public function profile()
    {
        $user = Auth::user();
        return View::make('user.profile',compact('user'));
    }
    public function profileUpdate()
    {
        $user = User::where('email',Auth::user()->email);
        /* $user->email =
        $user = Auth::user(); */
        return View::make('user.profile',compact('user'));
    }

    public function settings()
    {
        $types = Type::all();
        /* $user->email =
        $user = Auth::user(); */
        return View::make('user.settings',compact('types'));
    }
}