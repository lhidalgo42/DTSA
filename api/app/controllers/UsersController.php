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
        return View::make('user.profile');
    }
}