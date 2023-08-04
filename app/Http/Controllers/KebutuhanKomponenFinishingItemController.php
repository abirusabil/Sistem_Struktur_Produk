<?php

namespace App\Http\Controllers;

use App\Exports\KebutuhanKomponenFinishingItemExport;
use App\Imports\KebutuhanKomponenFinishingItemImport;
use App\Models\KebutuhanKomponenFinishingItem;
use App\Models\MasterKomponenFinishing;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Cache\RateLimiter;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Auth\Access\AuthorizationException;

class KebutuhanKomponenFinishingItemController extends Controller
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
            return view(
                'pages.Data_Barang.Item.Kebutuhan_Komponen_Finishing.Tambah_Kebutuhan_Komponen_Finishing',
                [
                    'type_menu' => 'Item',
                    'Item' => $request,
                    'KomponenFinishing' => MasterKomponenFinishing::all(),
                    // 'loopCount' => $loopCount
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
                'id' => 'required|unique:kebutuhan_accessories_hardware_items',
                'Item_Id.*' => 'required',
                'Komponen_Finishing_Id.*' => 'required',
                'Quantity_Kebutuhan_Komponen_Finishing_Item.*' => 'required',


            ],
            [
                'required' => 'Kolom Tidak Boleh Kosong',
                'unique' => 'Kode Telah Digunakan Silahkan Gunakan Kode Lain'
            ]
        );

        // return $validatedData;
        for ($i = 0; $i < count($request->Komponen_Finishing_Id); $i++) {
            KebutuhanKomponenFinishingItem::create([
                'id' => $validatedData['id'][$i],
                'Item_Id' => $validatedData['Item_Id'][$i],
                'Komponen_Finishing_Id' => $validatedData['Komponen_Finishing_Id'][$i],
                'Quantity_Kebutuhan_Komponen_Finishing_Item' => $validatedData['Quantity_Kebutuhan_Komponen_Finishing_Item'][$i],
            ]);
        }

        return redirect("/Item/{$request->input('Item_Id.0')}")->with('success_komponen_finishing', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\KebutuhanKomponenFinishingItem  $kebutuhanKomponenFinishingItem
     * @return \Illuminate\Http\Response
     */
    public function show(KebutuhanKomponenFinishingItem $kebutuhanKomponenFinishingItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KebutuhanKomponenFinishingItem  $kebutuhanKomponenFinishingItem
     * @return \Illuminate\Http\Response
     */
    public function edit(KebutuhanKomponenFinishingItem $Kebutuhan_Finishing_Item, RateLimiter $limiter)
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
                'pages.Data_Barang.Item.Kebutuhan_Komponen_Finishing.Edit_Kebutuhan_Komponen_Finishing',
                [
                    'type_menu' => 'Item',
                    'Kebutuhan_Komponen_Finishing_Item' => $Kebutuhan_Finishing_Item,
                    'Komponen_Finishings' => MasterKomponenFinishing::all(),
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
     * @param  \App\Models\KebutuhanKomponenFinishingItem  $kebutuhanKomponenFinishingItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KebutuhanKomponenFinishingItem $Kebutuhan_Finishing_Item)
    {
        $validatedData = $request->validate(
            [
                'id' => 'required',
                'Item_Id' => 'required',
                'Komponen_Finishing_Id' => 'required',
                'Quantity_Kebutuhan_Komponen_Finishing_Item' => 'required',


            ],
            [
                'required' => 'Kolom Tidak Boleh Kosong',
            ]
        );
        // log activity

        $originalData = $Kebutuhan_Finishing_Item->getOriginal();

        activity()
            ->causedBy(auth()->user())
            ->performedOn($Kebutuhan_Finishing_Item)
            ->inLog('Kebutuhan Finishing Item')
            ->withProperties([
                'old' => $originalData,
                'new' => $validatedData
            ])
            ->event('Update')
            ->log('This Model has been Update');

        //end log activity
        // return $validatedData;
        KebutuhanKomponenFinishingItem::where('id', $Kebutuhan_Finishing_Item->id)->update($validatedData);
        return redirect("/Item/$Kebutuhan_Finishing_Item->Item_Id")->with('success_komponen_finishing', 'Data Berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KebutuhanKomponenFinishingItem  $kebutuhanKomponenFinishingItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(KebutuhanKomponenFinishingItem $Kebutuhan_Finishing_Item, RateLimiter $limiter)
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

            KebutuhanKomponenFinishingItem::destroy($Kebutuhan_Finishing_Item->id);
            return redirect("/Item/$Kebutuhan_Finishing_Item->Item_Id")->with('success_komponen_finishing', 'Data Berhasil Dihapus');
                
            // Jika tidak memiliki akses 
        } catch (AuthorizationException $exception) {
            throw new AuthorizationException('Halaman Ini Tidak Boleh Diakses', 403);
        }
    }
    public function export($itemId)
    {
        // return $itemId;
        //    return KebutuhanKayuItem::with('Item', 'MasterKayu')
        //         ->where('Item_id', $itemId)
        //         ->get();
        // return Excel::download(new KebutuhanKayuItemExport($request->input('search')),'KebutuhanKayu.xlsx');
        return Excel::download(new KebutuhanKomponenFinishingItemExport($itemId), 'Kebutuhan Komponen Finishing.xlsx');
    }

    public function import(Request $request, $itemId)
    {
        // return $request;
        // $item_id = $request->input('item_id');
        // Validasi file Excel
        $request->validate([
            'excel_file' => 'required|mimes:xls,xlsx'
        ]);

        // Import data dari file Excel
        $import = new KebutuhanKomponenFinishingItemImport($itemId);
        Excel::import($import, $request->file('excel_file'));

        // Redirect kembali ke halaman awal
        return redirect("/Item/$itemId")->with('success_komponen_finishing', 'Item berhasil diimport!');
    }
}
