<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Applicant;
use Illuminate\Support\Str;
use App\Mail\AddNewUserMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('admin.pages.users.index', compact("users"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.pages.users.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $password =  Str::random(10);
        $fixedPassword = Hash::make($password);

        $user = new User();
        $user->name = $request->name;
        $user->password = $fixedPassword;
        $user->email =  $request->email;
        $user->type = 'admin';
        $user->save();
        Mail::to($user->email)->send(new AddNewUserMail($user, $password));


        return redirect()->route("user.index")->with("done", "Create User Successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show($id) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route("user.index")->with("done", "Delete User Successfully");
    }
}
