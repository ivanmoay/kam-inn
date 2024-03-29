<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('users.index', [
            'users' => User::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'username' => ['required', Rule::unique('users', 'username')],            
            'password' => 'required|min:6|confirmed',
            'userlevel' => 'required'
        ]);        

        $formFields['password'] = Hash::make($formFields['password']);
        User::create($formFields);

        return redirect('/users')->with('message', 'User created successfully!');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ]);

        if(!auth()->attempt($request->only('username','password'),$request->remember)){
            return back()->with('status', 'Invalid login details');
        }

        return redirect('/');
    }

    public function logout()
    {
        auth()->logout();

        return redirect('/');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('users.edit', [
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, user $user)
    {
        $formFields = $request->validate([        
            'password' => 'required|min:6|confirmed',
            'userlevel' => 'required'
        ]);        

        $formFields['password'] = Hash::make($formFields['password']);
        $user->update($formFields);

        return redirect('/users')->with('message', 'User updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {       
        $user->delete();
        return redirect('/users')->with('message', 'User deleted successfully');
    }
}
