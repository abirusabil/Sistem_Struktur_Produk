<?php

namespace App\Http\Controllers;

use App\Models\KebutuhanKayuItem;
use App\Models\Item;
use App\Models\MasterKayu;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\KebutuhanKayuItemExport;
use App\Imports\KebutuhanKayuItemImport;
use App\Imports\KebutuhanPlywoodMDFItemImport;
use Illuminate\Cache\RateLimiter;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Auth\Access\AuthorizationException;

class KebutuhanKayuItemController extends Controller
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
    public function create(Request $request, KebutuhanKayuItem $Kebutuhan_Kayu_Item, RateLimiter $limiter)
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
                'pages.Data_Barang.Item.Kebutuhan_Kayu.Tambah_Kebutuhan_Kayu',
                [
                    'type_menu' => 'Item',
                    'Item' => $request,
                    'kayus' => MasterKayu::all(),
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
                // 'id'=>'required|unique:kebutuhan_kayu_items',
                'id' => 'required',
                'Item_Id.*' => 'required',
                'Kayu_Id.*' => 'required',
                'KP_Kebutuhan_Kayu_Item.*' => 'required',
                'Keterangan_Kebutuhan_Kayu_Item.*' => 'required',
                'Grade_Kebutuhan_Kayu_Item.*' => 'required',
                'Tebal_Kebutuhan_Kayu_Item.*' => 'required',
                'Lebar_Kebutuhan_Kayu_Item.*' => 'required',
                'Panjang_Kebutuhan_Kayu_Item.*' => 'required',
                'Quantity_Kebutuhan_Kayu_Item.*' => 'required',


            ],
            [
                'required' => 'Kolom Tidak Boleh Kosong',
                'unique' => 'Kode Telah Digunakan Silahkan Gunakan Kode Lain'
            ]
        );

        for ($i = 0; $i < count($request->Kayu_Id); $i++) {
            KebutuhanKayuItem::create([
                'id' => $validatedData['id'][$i],
                'Item_Id' => $validatedData['Item_Id'][$i],
                'Kayu_Id' => $validatedData['Kayu_Id'][$i],
                'KP_Kebutuhan_Kayu_Item' => $validatedData['KP_Kebutuhan_Kayu_Item'][$i],
                'Keterangan_Kebutuhan_Kayu_Item' => $validatedData['Keterangan_Kebutuhan_Kayu_Item'][$i],
                'Grade_Kebutuhan_Kayu_Item' => $validatedData['Grade_Kebutuhan_Kayu_Item'][$i],
                'Tebal_Kebutuhan_Kayu_Item' => $validatedData['Tebal_Kebutuhan_Kayu_Item'][$i],
                'Lebar_Kebutuhan_Kayu_Item' => $validatedData['Lebar_Kebutuhan_Kayu_Item'][$i],
                'Panjang_Kebutuhan_Kayu_Item' => $validatedData['Panjang_Kebutuhan_Kayu_Item'][$i],
                'Quantity_Kebutuhan_Kayu_Item' => $validatedData['Quantity_Kebutuhan_Kayu_Item'][$i],
            ]);
        }

        return redirect("/Item/{$request->input('Item_Id.0')}")->with('success_kayu', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\KebutuhanKayuItem  $kebutuhanKayuItem
     * @return \Illuminate\Http\Response
     */
    public function show(KebutuhanKayuItem $kebutuhanKayuItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KebutuhanKayuItem  $kebutuhanKayuItem
     * @return \Illuminate\Http\Response
     */
    public function edit(KebutuhanKayuItem $Kebutuhan_Kayu_Item, RateLimiter $limiter)
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
            // return $Kebutuhan_Kayu_Item;
            return view(
                'pages.Data_Barang.Item.Kebutuhan_Kayu.Edit_Kebutuhan_Kayu',
                [
                    'type_menu' => 'Item',
                    'Kebutuhan_Kayu_Item' => $Kebutuhan_Kayu_Item,
                    'kayus' => MasterKayu::all(),
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
     * @param  \App\Models\KebutuhanKayuItem  $kebutuhanKayuItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KebutuhanKayuItem $Kebutuhan_Kayu_Item)
    {
        // return $Kebutuhan_Kayu_Item;
        $validatedData = $request->validate(
            [
                'id' => 'required',
                'Item_Id' => 'required',
                'Kayu_Id' => 'required',
                'KP_Kebutuhan_Kayu_Item' => 'required',
                'Keterangan_Kebutuhan_Kayu_Item' => 'required',
                'Grade_Kebutuhan_Kayu_Item' => 'required',
                'Tebal_Kebutuhan_Kayu_Item' => 'required',
                'Lebar_Kebutuhan_Kayu_Item' => 'required',
                'Panjang_Kebutuhan_Kayu_Item' => 'required',
                'Quantity_Kebutuhan_Kayu_Item' => 'required',


            ],
            [
                'required' => 'Kolom Tidak Boleh Kosong',
            ]
        );
        // return $request->Item_Id;
        // log activity

        $originalData = $Kebutuhan_Kayu_Item->getOriginal();

        activity()
            ->causedBy(auth()->user())
            ->performedOn($Kebutuhan_Kayu_Item)
            ->inLog('Kebutuhan_Kayu_Item')
            ->withProperties([
                'old' => $originalData,
                'new' => $validatedData
            ])
            ->event('Update')
            ->log('This Model has been Update');

        //end log activity

        // return $validatedData;
        KebutuhanKayuItem::where('id', $Kebutuhan_Kayu_Item->id)->update($validatedData);
        return redirect("/Item/$Kebutuhan_Kayu_Item->Item_Id")->with('success_kayu', 'Data Berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KebutuhanKayuItem  $kebutuhanKayuItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(KebutuhanKayuItem $Kebutuhan_Kayu_Item,RateLimiter $limiter)
    {
        // return $Kebutuhan_Kayu_Item;
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
            KebutuhanKayuItem::destroy($Kebutuhan_Kayu_Item->id);
            return redirect("/Item/$Kebutuhan_Kayu_Item->Item_Id");
            
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
        return Excel::download(new KebutuhanKayuItemExport($itemId), 'KebutuhanKayuitem.xlsx');
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
        $import = new KebutuhanKayuItemImport($itemId);
        Excel::import($import, $request->file('excel_file'));

        // Redirect kembali ke halaman awal
        return redirect("/Item/$itemId")->with('success_kayu', 'Item berhasil diimport!');
    }
}
