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
            'akses'=>'required|max:200'
        ]);
        
        $validatedData['password'] = Hash::make($validatedData['password']) ;
        // return $validatedData;
        User::Create($validatedData);
        return redirect('/Register')->with('success', 'Pendaftaran User Baru Sukses');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Register  $register
     * @return \Illuminate\Http\Response
     */
    public function show(User $register)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Register  $register
     * @return \Illuminate\Http\Response
     */
    public function edit(User $register )
    {
        // return $register;
        // return view('pages.User.Edit_User', [
        //     'type_menu'=>'User',
        //     'User' => $Register
        // ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Register  $register
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $register)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Register  $register
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $register)
    {
       return $register;
        // User::destroy($user);
        // return redirect('/Register')->with('success','Data Telah Dihapus');
    }
}
