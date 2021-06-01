<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    //
    public function edit() 
    {
        return Inertia::render('Users/Edit', [
            'user' => auth()->user()
        ]);
    }

    public function update(UserRequest $request) 
    {
        auth()->user()->update($request->all());
        return Redirect::route('edit-profile');//->with('success', 'Profile Updated');
    }
}
