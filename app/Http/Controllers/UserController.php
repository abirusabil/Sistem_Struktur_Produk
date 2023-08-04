<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use Illuminate\Cache\RateLimiter;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Auth\Access\AuthorizationException;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   
    public function index( RateLimiter $limiter)
    {
        try {
            if (!in_array(auth()->user()->akses, [1])) {
                throw new AuthorizationException();
            }

            // Check for brute force attacks
            $key = 'login.' . request()->ip();
            $maxAttempts = 5;
            $decayMinutes = 1;

            if ($limiter->tooManyAttempts($key, $maxAttempts)) {
                throw new HttpException(Response::HTTP_TOO_MANY_REQUESTS, 'Too many attempts. Please try again later.');
            }

            $limiter->hit($key, $decayMinutes * 60);

            // Jika memiliki akses
            // return $request;
            return view('pages.User.list_user', [
                'title' => "Daftar User",
                "User" =>  User::all(),
                'type_menu' => 'User'
            ]);
            
        } catch (AuthorizationException $exception) {
            throw new AuthorizationException('Halaman Ini Tidak Boleh Diakses', 403);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create( RateLimiter $limiter)
    {
        try {
            if (!in_array(auth()->user()->akses, [1])) {
                throw new AuthorizationException();
            }

            // Check for brute force attacks
            $key = 'login.' . request()->ip();
            $maxAttempts = 5;
            $decayMinutes = 1;

            if ($limiter->tooManyAttempts($key, $maxAttempts)) {
                throw new HttpException(Response::HTTP_TOO_MANY_REQUESTS, 'Too many attempts. Please try again later.');
            }

            $limiter->hit($key, $decayMinutes * 60);

            // Jika memiliki akses
            // return $request;
            return view('pages.User.Tambah_User', [
                'type_menu' => 'User'
            ]);
            
        } catch (AuthorizationException $exception) {
            throw new AuthorizationException('Halaman Ini Tidak Boleh Diakses', 403);
        }
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
    public function edit(User $User ,RateLimiter $limiter)
    {
        try {
            if (!in_array(auth()->user()->akses, [1])) {
                throw new AuthorizationException();
            }

            // Check for brute force attacks
            $key = 'login.' . request()->ip();
            $maxAttempts = 5;
            $decayMinutes = 1;

            if ($limiter->tooManyAttempts($key, $maxAttempts)) {
                throw new HttpException(Response::HTTP_TOO_MANY_REQUESTS, 'Too many attempts. Please try again later.');
            }

            $limiter->hit($key, $decayMinutes * 60);

            // Jika memiliki akses
            return view('pages.User.Edit_User',
                [
                    'type_menu'=>'User',
                    'User'=>$User
                ]
            );
            
            // Jika tidak memiliki akses 
        } catch (AuthorizationException $exception) {
            throw new AuthorizationException('Halaman Ini Tidak Boleh Diakses', 403);
        }
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
         // log activity

         $originalData = $User->getOriginal();

         activity()
             ->causedBy(auth()->user())
             ->inLog('User')
             ->performedOn($User)
             ->withProperties([
                 'old' => $originalData,
                 'new' => $validatedData
                 ])
             ->event('Update')
             ->log('This Model has been Update');
             
 
          //end log activity
        User::where('id',$User->id)->update($validatedData);
        return redirect('/User')->with('success', 'Data User Berhasil Dirubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $User , RateLimiter $limiter)
    {
        try {
            if (!in_array(auth()->user()->akses, [1])) {
                throw new AuthorizationException();
            }

            // Check for brute force attacks
            $key = 'login.' . request()->ip();
            $maxAttempts = 5;
            $decayMinutes = 1;

            if ($limiter->tooManyAttempts($key, $maxAttempts)) {
                throw new HttpException(Response::HTTP_TOO_MANY_REQUESTS, 'Too many attempts. Please try again later.');
            }

            $limiter->hit($key, $decayMinutes * 60);

            // Jika memiliki akses
            User::destroy($User->id);
            return redirect('/User')->with('success','Data Telah Dihapus');
            // Jika tidak memiliki akses 
        } catch (AuthorizationException $exception) {
            throw new AuthorizationException('Halaman Ini Tidak Boleh Diakses', 403);
        }
    }
}
