<?php

namespace App\Http\Controllers;

use App\Exports\BoronganLuarItemExport;
use App\Models\BoronganLuarItem;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Cache\RateLimiter;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Auth\Access\AuthorizationException;

class BoronganLuarItemController extends Controller
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
    public function create(Request $request, RateLimiter $limiter)
    {
        try {
            if (!in_array(auth()->user()->akses, [1, 2,6,7])) {
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
            return view('pages.Data_Barang.Item.Borongan_Luar.Tambah_Borongan_Luar', [
                'type_menu' => 'Item',
                'itemId' => $request->itemId,
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
        $validatedData = $request->validate(
            [
                'Item_Id'=>'required',
                'Anyam'=>'required',
                'Ukir'=>'required',
                'Handle'=>'required',
                'Bubut'=>'required',
                'Pirelly_Jok'=>'required',
                'Sterofoam'=>'required',
            ],[
                'required'=>'Kolom Tidak Boleh Kosong',
            ]
            );
            // return $validatedData;
            BoronganLuarItem::Create($validatedData);
            return redirect("/Item/{$request->input('Item_Id')}")->with('success_Borongan_Luar', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BoronganLuarItem  $boronganLuarItem
     * @return \Illuminate\Http\Response
     */
    public function show(BoronganLuarItem $boronganLuarItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BoronganLuarItem  $boronganLuarItem
     * @return \Illuminate\Http\Response
     */
    public function edit(BoronganLuarItem $Borongan_Luar_Item , RateLimiter $limiter)
    {
        try {
            if (!in_array(auth()->user()->akses, [1, 2,6,7])) {
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
            
            return view('pages.Data_Barang.Item.Borongan_Luar.Edit_Borongan_Luar',
                [
                    'type_menu'=>'Item',
                    'Borongan_Luar_Item'=>$Borongan_Luar_Item,
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
     * @param  \App\Models\BoronganLuarItem  $boronganLuarItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BoronganLuarItem $Borongan_Luar_Item)
    {
        $validatedData = $request->validate(
            [
                'Item_Id'=>'required',
                'Anyam'=>'required',
                'Ukir'=>'required',
                'Handle'=>'required',
                'Bubut'=>'required',
                'Pirelly_Jok'=>'required',
                'Sterofoam'=>'required',
            ],[
                'required'=>'Kolom Tidak Boleh Kosong',
            ]
            );

            // log activity

            $originalData = $Borongan_Luar_Item->getOriginal();

            activity()
                ->causedBy(auth()->user())
                ->performedOn($Borongan_Luar_Item)
                ->inLog('Borongan Luar Item')
                ->withProperties([
                    'old' => $originalData,
                    'new' => $validatedData
                    ])
                ->event('Update')
                ->log('This Model has been Update');

            //end log activity

            BoronganLuarItem::where('id',$Borongan_Luar_Item->id)->update($validatedData);
            return redirect("/Item/{$request->input('Item_Id')}")->with('success_Borongan_Luar', 'Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BoronganLuarItem  $boronganLuarItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(BoronganLuarItem $boronganLuarItem)
    {
        //
    }

    public function export($itemId)
    {
        // return $itemId;
        //    return KebutuhanKayuItem::with('Item', 'MasterKayu')
        //         ->where('Item_id', $itemId)
        //         ->get();
        // return Excel::download(new KebutuhanKayuItemExport($request->input('search')),'KebutuhanKayu.xlsx');
        return Excel::download(new BoronganLuarItemExport($itemId), 'Ongkos Kerja Borongan Luar.xlsx');
    }
}
