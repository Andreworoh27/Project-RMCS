<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\MessageBag;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view("Account.profilePage");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('Authentication.register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            "username" => "required",
            "email" => "required|unique:users,email",
            "password" => "required | min:8 |alpha_num",
            "gender" => "required",
            "dob" => "required"
        ]);

        $dob = $request->dob;
        if ($dob >= now()) {
            return redirect()->back()->withErrors(new MessageBag(['Date of bith not valid']));
        }

        $username = $request->username;
        $email = $request->email;
        $password = $request->password;
        $confirmpassword = $request->confirmpassword;
        $telephone = $request->telephone;
        $gender = $request->gender;

        if ($password != $confirmpassword) {
            return redirect()->back()->withErrors(new MessageBag(['Confirm password does not match the password']));
        }

        DB::table('users')->insert([
            'name' => $username,
            'email' => $email,
            'gender' => $gender,
            'dob' => $dob,
            'password' => bcrypt($password),
            'profile_image' => "default profile.png",
            'role' => 'Member',
            'created_at' => now(),
        ]);

        return redirect('login');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
