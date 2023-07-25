<?php

namespace App\Http\Controllers;

use App\Models\BoronganLuarPo;
use Illuminate\Http\Request;
use Illuminate\Auth\Access\AuthorizationException;
// untuk mengatasi bruteforce
use Illuminate\Cache\RateLimiter;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class BoronganLuarPoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BoronganLuarPo  $boronganLuarPo
     * @return \Illuminate\Http\Response
     */
    public function show(BoronganLuarPo $boronganLuarPo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BoronganLuarPo  $boronganLuarPo
     * @return \Illuminate\Http\Response
     */
    public function edit(BoronganLuarPo $Borongan_Luar_Po , RateLimiter $limiter)
    {
        try {
            if (!in_array(auth()->user()->akses, [1, 2])) {
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
            
            // jika memiliki Akses
            // dd($Borongan_Luar_Po);
            return view('pages.Data_Barang.Item.Borongan_Luar.Edit_Borongan_Luar_Po',
                [
                    'type_menu'=>'PurchaseOrder',
                    'BoronganLuarPo'=>$Borongan_Luar_Po
                ]
            );

        } catch (AuthorizationException $exception) {
            throw new AuthorizationException('Halaman Ini Tidak Boleh Diakses', 403);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BoronganLuarPo  $boronganLuarPo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BoronganLuarPo $Borongan_Luar_Po)
    {
        $validatedData = $request->validate(
            [
                'Job_Order'=>'required',
                'Nama_Item'=>'required',
                'Quantity_Purchase_Order'=>'required',
                'No_Cutting'=>'required',
                'Anyam'=>'required',
                'Ukir'=>'required',
                'Handle'=>'required',
                'Bubut'=>'required',
                'Pirelly_Jok'=>'required',
                'Sterofoam'=>'required',
            ]
        );
        // log activity

        $originalData = $Borongan_Luar_Po->getOriginal();

        activity()
            ->causedBy(auth()->user())
            ->performedOn($Borongan_Luar_Po)
            ->inLog('Borongan Luar PO')
            ->withProperties([
                'old' => $originalData,
                'new' => $validatedData
                ])
            ->event('Update')
            ->log('This Model has been Update');

        //end log activity
        // dd($validatedData);
        BoronganLuarPo::where('id',$Borongan_Luar_Po->id)->update($validatedData);
        return redirect()->route('purchase_order.detailkebutuhan', ['Purchase_Order' => $Borongan_Luar_Po->Job_Order])->with('success_borongan_luar', 'Data Berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BoronganLuarPo  $boronganLuarPo
     * @return \Illuminate\Http\Response
     */
    public function destroy(BoronganLuarPo $boronganLuarPo)
    {
        //
    }
}
