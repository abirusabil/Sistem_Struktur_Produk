<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
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
        return view('pages.User.list_user', [
            'title' => "Daftar User",
            "User" =>  User::all(),
            'type_menu' => 'User'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.User.Tambah_User', [
            'type_menu' => 'User'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name'=> 'required|max:200',
            'email'=>'required|email:dns|unique:users',
            'password'=>'required|min:8|max:255',
            'akses'=>'required'
        ],[
            'required'=>'Kolom Tidak Boleh Kosong',
            'email'=>'Email Salah',
            'password.min'=>'Password Terlalu Singkat'
        ]);
        
        $validatedData['password'] = Hash::make($validatedData['password']) ;
        // return $validatedData;
        User::Create($validatedData);
        return redirect('/User')->with('success', 'Pendaftaran User Baru Sukses');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $User)
    {
        return view('pages.User.Edit_User',
            [
                'type_menu'=>'User',
                'User'=>$User
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $User)
    {
        $validatedData = $request->validate([
            'name'=> 'required|max:200',
            'email'=>'required|email:dns',
            'akses'=>'required'
        ],[
            'required'=>'Kolom Tidak Boleh Kosong',
            'email'=>'Email Salah'
        ]);
        User::where('id',$User->id)->update($validatedData);
        return redirect('/User')->with('success', 'Pendaftaran User Baru Sukses');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $User)
    {
        User::destroy($User->id);
        return redirect('/User')->with('success','Data Telah Dihapus');
    }
}
