<?php

namespace App\Http\Controllers;

use App\Exports\KebutuhanPendukungPackingItemExport;
use App\Imports\KebutuhanPendukungPackingItemImport;
use App\Models\KebutuhanPendukungPackingItem;
use App\Models\MasterPendukungPacking;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;


use Illuminate\Cache\RateLimiter;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Auth\Access\AuthorizationException;

class KebutuhanPendukungPackingItemController extends Controller
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
                'pages.Data_Barang.Item.Kebutuhan_Pendukung_Packing.Tambah_Kebutuhan_Pendukung_Packing',
                [
                    'type_menu' => 'Item',
                    'Item' => $request,
                    'PendukungPacking' => MasterPendukungPacking::all(),
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
                'id' => 'required|unique:kebutuhan_pendukung_packing_items',
                'Item_Id.*' => 'required',
                'Pendukung_Packing_Id.*' => 'required',
                'Keterangan_Kebutuhan_Pendukung_Packing_Item.*' => 'required',
                'Lebar_Kebutuhan_Pendukung_Packing_Item.*' => 'required',
                'Panjang_Kebutuhan_Pendukung_Packing_Item.*' => 'required',
                'Quantity_Kebutuhan_Pendukung_Packing_Item.*' => 'required',
            ],
            [
                'required' => 'Kolom Tidak Boleh Kosong',
                'unique' => 'Kode Telah Digunakan Silahkan Gunakan Kode Lain'
            ]
        );
        // return $validatedData;
        // return $request->input('Item_Id.0');
        $pendukungPackingItems = [];
        for ($i = 0; $i < count($request->Pendukung_Packing_Id); $i++) {
            KebutuhanPendukungPackingItem::create([
                'id' => $validatedData['id'][$i],
                'Item_Id' => $validatedData['Item_Id'][$i],
                'Pendukung_Packing_Id' => $validatedData['Pendukung_Packing_Id'][$i],
                'Keterangan_Kebutuhan_Pendukung_Packing_Item' => $validatedData['Keterangan_Kebutuhan_Pendukung_Packing_Item'][$i],
                'Lebar_Kebutuhan_Pendukung_Packing_Item' => $validatedData['Lebar_Kebutuhan_Pendukung_Packing_Item'][$i],
                'Panjang_Kebutuhan_Pendukung_Packing_Item' => $validatedData['Panjang_Kebutuhan_Pendukung_Packing_Item'][$i],
                'Quantity_Kebutuhan_Pendukung_Packing_Item' => $validatedData['Quantity_Kebutuhan_Pendukung_Packing_Item'][$i],
            ]);
        }

        return redirect("/Item/{$request->input('Item_Id.0')}")->with('success_pendukung_packing', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\KebutuhanPendukungPackingItem  $kebutuhanPendukungPackingItem
     * @return \Illuminate\Http\Response
     */
    public function show(KebutuhanPendukungPackingItem $kebutuhanPendukungPackingItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KebutuhanPendukungPackingItem  $kebutuhanPendukungPackingItem
     * @return \Illuminate\Http\Response
     */
    public function edit(KebutuhanPendukungPackingItem $Kebutuhan_Packing_Item, RateLimiter $limiter)
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
                'pages.Data_Barang.Item.Kebutuhan_Pendukung_Packing.Edit_Kebutuhan_Pendukung_Packing',
                [
                    'type_menu' => 'item',
                    'Kebutuhan_Pendukung_Packing_Items' => $Kebutuhan_Packing_Item,
                    'PendukungPacking' => MasterPendukungPacking::all()

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
     * @param  \App\Models\KebutuhanPendukungPackingItem  $kebutuhanPendukungPackingItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KebutuhanPendukungPackingItem $Kebutuhan_Packing_Item)
    {
        $validatedData = $request->validate(
            [
                'id' => 'required',
                'Item_Id' => 'required',
                'Pendukung_Packing_Id' => 'required',
                'Keterangan_Kebutuhan_Pendukung_Packing_Item' => 'required',
                'Lebar_Kebutuhan_Pendukung_Packing_Item' => 'required',
                'Panjang_Kebutuhan_Pendukung_Packing_Item' => 'required',
                'Quantity_Kebutuhan_Pendukung_Packing_Item' => 'required',

            ],
            [
                'required' => 'Kolom Tidak Boleh Kosong',

            ]
        );
        // log activity

        $originalData = $Kebutuhan_Packing_Item->getOriginal();

        activity()
            ->causedBy(auth()->user())
            ->performedOn($Kebutuhan_Packing_Item)
            ->inLog('Kebutuhan Pendukung Packing Item')
            ->withProperties([
                'old' => $originalData,
                'new' => $validatedData
            ])
            ->event('Update')
            ->log('This Model has been Update');

        //end log activity
        // return $validatedData;
        KebutuhanPendukungPackingItem::where('id', $Kebutuhan_Packing_Item->id)->update($validatedData);
        return redirect("/Item/$Kebutuhan_Packing_Item->Item_Id")->with('success_pendukung_packing', 'Data Berhasil Ditambahkan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KebutuhanPendukungPackingItem  $kebutuhanPendukungPackingItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(KebutuhanPendukungPackingItem $Kebutuhan_Packing_Item, RateLimiter $limiter)
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
            
            KebutuhanPendukungPackingItem::destroy($Kebutuhan_Packing_Item->id);
            return redirect("/Item/$Kebutuhan_Packing_Item->Item_Id")->with('success_pendukung_packing', 'Data Berhasil Ditambahkan');
            
            // Jika tidak memiliki akses

        } catch (AuthorizationException $exception) {
            throw new AuthorizationException('Halaman Ini Tidak Boleh Diakses', 403);
        }
    }
    public function export($itemId)
    {
        // return KebutuhanPlywoodMDFItem::with('Item','MasterPlywoodMDF')
        //         ->where('Item_Id',$itemId)->get();
        return Excel::download(new KebutuhanPendukungPackingItemExport($itemId), 'Kebutuhan_Pendukung_Packing_Item.xlsx');
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
        $import = new KebutuhanPendukungPackingItemImport($itemId);
        Excel::import($import, $request->file('excel_file'));

        // Redirect kembali ke halaman awal
        return redirect("/Item/$itemId")->with('success_pendukung_packing', 'Item berhasil diimport!');
    }
}
