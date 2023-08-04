<?php

namespace App\Http\Controllers;

use App\Exports\BoronganDalamItemExport;
use App\Models\BoronganDalamItem;
use App\Models\Item;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Cache\RateLimiter;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Auth\Access\AuthorizationException;

class BoronganDalamItemController extends Controller
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
            if (!in_array(auth()->user()->akses, [1, 2, 6, 7])) {
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
            return view(
                'pages.Data_Barang.Item.Borongan_Dalam.Tambah_Borongan_Dalam',
                [
                    'type_menu' => 'Item',
                    'itemId' => $request->itemId,
                ]
            );
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
                'Item_Id' => 'required',
                'Bahan_1' => 'required',
                'Bahan_2' => 'required',
                'Sanding_1' => 'required',
                'Sanding_2' => 'required',
                'Proses_Assembling' => 'required',
                'Finishing' => 'required',
                'Packing' => 'required',
            ],
            [
                'required' => 'Kolom Tidak Boleh Kosong',
            ]
        );
        // return $validatedData;
        BoronganDalamItem::Create($validatedData);
        return redirect("/Item/{$request->input('Item_Id')}")->with('success_Borongan_Dalam', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BoronganDalamItem  $boronganDalamItem
     * @return \Illuminate\Http\Response
     */
    public function show(BoronganDalamItem $Borongan_Dalam_Item)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BoronganDalamItem  $boronganDalamItem
     * @return \Illuminate\Http\Response
     */
    public function edit(BoronganDalamItem $Borongan_Dalam_Item, RateLimiter $limiter)
    {
        try {
            if (!in_array(auth()->user()->akses, [1, 2, 6, 7])) {
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

            return view(
                'pages.Data_Barang.Item.Borongan_Dalam.Edit_Borongan_Dalam',
                [
                    'type_menu' => 'Item',
                    'Borongan_Dalam_Item' => $Borongan_Dalam_Item,
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
     * @param  \App\Models\BoronganDalamItem  $boronganDalamItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BoronganDalamItem $Borongan_Dalam_Item)
    {
        $validatedData = $request->validate(
            [
                'Item_Id' => 'required',
                'Bahan_1' => 'required',
                'Bahan_2' => 'required',
                'Sanding_1' => 'required',
                'Sanding_2' => 'required',
                'Proses_Assembling' => 'required',
                'Finishing' => 'required',
                'Packing' => 'required',
            ],
            [
                'required' => 'Kolom Tidak Boleh Kosong',
            ]
        );
        // log activity

        $originalData = $Borongan_Dalam_Item->getOriginal();

        activity()
            ->causedBy(auth()->user())
            ->performedOn($Borongan_Dalam_Item)
            ->inLog('Borongan Dalam Item')
            ->withProperties([
                'old' => $originalData,
                'new' => $validatedData
            ])
            ->event('Update')
            ->log('This Model has been Update');


        //end log activity

        // return $validatedData;
        BoronganDalamItem::where('id', $Borongan_Dalam_Item->id)->update($validatedData);
        return redirect("/Item/{$request->input('Item_Id')}")->with('success_Borongan_Dalam', 'Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BoronganDalamItem  $boronganDalamItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(BoronganDalamItem $boronganDalamItem)
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
        return Excel::download(new BoronganDalamItemExport($itemId), 'Ongkos Kerja Borongan Dalam.xlsx');
    }
}
