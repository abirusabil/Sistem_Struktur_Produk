<?php

namespace App\Http\Controllers;

use App\Exports\KebutuhanPlywoodMDFItemExport;
use App\Imports\KebutuhanPlywoodMDFItemImport;
use App\Models\KebutuhanPlywoodMdfItem;
use App\Models\MasterPlywoodMdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Cache\RateLimiter;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Auth\Access\AuthorizationException;

class KebutuhanPlywoodMdfItemController extends Controller
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
            // return $Kebutuhan_Kayu_Item;
            return view(
                'pages.Data_Barang.Item.Kebutuhan_Plywood_MDF.Tambah_Kebutuhan_Plywood_MDF',
                [
                    'type_menu' => 'Item',
                    'Item' => $request,
                    'PlywoodMDF' => MasterPlywoodMdf::all(),
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
                'id' => 'required|unique:kebutuhan_kayu_items',
                'Item_Id.*' => 'required',
                'Plywood_MDF_Id.*' => 'required',
                'KP_Kebutuhan_Plywood_MDF_Item.*' => 'required',
                'Keterangan_Kebutuhan_Plywood_MDF_Item.*' => 'required',
                'Grade_Kebutuhan_Plywood_MDF_Item.*' => 'required',
                'Lebar_Kebutuhan_Plywood_MDF_Item.*' => 'required',
                'Panjang_Kebutuhan_Plywood_MDF_Item.*' => 'required',
                'Quantity_Kebutuhan_Plywood_MDF_Item.*' => 'required',


            ],
            [
                'required' => 'Kolom Tidak Boleh Kosong',
                'unique' => 'Kode Telah Digunakan Silahkan Gunakan Kode Lain'
            ]
        );
        // return $validatedData;

        for ($i = 0; $i < count($request->Plywood_MDF_Id); $i++) {
            KebutuhanPlywoodMDFItem::create([
                'id' => $validatedData['id'][$i],
                'Item_Id' => $validatedData['Item_Id'][$i],
                'Plywood_MDF_Id' => $validatedData['Plywood_MDF_Id'][$i],
                'KP_Kebutuhan_Plywood_MDF_Item' => $validatedData['KP_Kebutuhan_Plywood_MDF_Item'][$i],
                'Keterangan_Kebutuhan_Plywood_MDF_Item' => $validatedData['Keterangan_Kebutuhan_Plywood_MDF_Item'][$i],
                'Grade_Kebutuhan_Plywood_MDF_Item' => $validatedData['Grade_Kebutuhan_Plywood_MDF_Item'][$i],
                'Lebar_Kebutuhan_Plywood_MDF_Item' => $validatedData['Lebar_Kebutuhan_Plywood_MDF_Item'][$i],
                'Panjang_Kebutuhan_Plywood_MDF_Item' => $validatedData['Panjang_Kebutuhan_Plywood_MDF_Item'][$i],
                'Quantity_Kebutuhan_Plywood_MDF_Item' => $validatedData['Quantity_Kebutuhan_Plywood_MDF_Item'][$i],
            ]);
        }

        return redirect("/Item/{$request->input('Item_Id.0')}")->with('success_plywood_mdf', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\KebutuhanPlywoodMdfItem  $kebutuhanPlywoodMdfItem
     * @return \Illuminate\Http\Response
     */
    public function show(KebutuhanPlywoodMdfItem $Kebutuhan_Plywood_MDF_Item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KebutuhanPlywoodMdfItem  $kebutuhanPlywoodMdfItem
     * @return \Illuminate\Http\Response
     */

    public function edit(KebutuhanPlywoodMdfItem $Kebutuhan_Plywood_MDF_Item, RateLimiter $limiter)
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
                'pages.Data_Barang.Item.Kebutuhan_Plywood_MDF.Edit_Kebutuhan_Plywood_MDF',
                [
                    'type_menu' => 'item',
                    'Kebutuhan_Plywood_MDF_Items' => $Kebutuhan_Plywood_MDF_Item,
                    'PlywoodMDF' => MasterPlywoodMdf::all()

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
     * @param  \App\Models\KebutuhanPlywoodMdfItem  $kebutuhanPlywoodMdfItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KebutuhanPlywoodMdfItem $Kebutuhan_Plywood_MDF_Item)
    {
        // return $Kebutuhan_Plywood_MDF_Item;
        $validatedData = $request->validate(
            [
                'id' => 'required',
                'Item_Id' => 'required',
                'Plywood_MDF_Id' => 'required',
                'KP_Kebutuhan_Plywood_MDF_Item' => 'required',
                'Keterangan_Kebutuhan_Plywood_MDF_Item' => 'required',
                'Grade_Kebutuhan_Plywood_MDF_Item' => 'required',
                'Lebar_Kebutuhan_Plywood_MDF_Item' => 'required',
                'Panjang_Kebutuhan_Plywood_MDF_Item' => 'required',
                'Quantity_Kebutuhan_Plywood_MDF_Item' => 'required',


            ],
            [
                'required' => 'Kolom Tidak Boleh Kosong',

            ]
        );
        // log activity

        $originalData = $Kebutuhan_Plywood_MDF_Item->getOriginal();

        activity()
            ->causedBy(auth()->user())
            ->performedOn($Kebutuhan_Plywood_MDF_Item)
            ->inLog('Kebutuhan Plywood MDF Item')
            ->withProperties([
                'old' => $originalData,
                'new' => $validatedData
            ])
            ->event('Update')
            ->log('This Model has been Update');

        //end log activity   
        // return $validatedData;
        KebutuhanPlywoodMdfItem::where('id', $Kebutuhan_Plywood_MDF_Item->id)->update($validatedData);
        return redirect("/Item/$Kebutuhan_Plywood_MDF_Item->Item_Id")->with('success_plywood_mdf', 'Data Berhasil Ditambahkan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KebutuhanPlywoodMdfItem  $kebutuhanPlywoodMdfItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(KebutuhanPlywoodMdfItem $Kebutuhan_Plywood_MDF_Item, RateLimiter $limiter)
    {
        // return $Kebutuhan_Plywood_MDF_Item;
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
            
            KebutuhanPlywoodMdfItem::destroy($Kebutuhan_Plywood_MDF_Item->id);
            return redirect("Item/$Kebutuhan_Plywood_MDF_Item->Item_Id")->with('success_plywood_mdf', 'Data Berhasil Dihapus');
           
            // Jika tidak memiliki akses
        } catch (AuthorizationException $exception) {
            throw new AuthorizationException('Halaman Ini Tidak Boleh Diakses', 403);
        }
    }

    public function export($itemId)
    {
        // return KebutuhanPlywoodMDFItem::with('Item','MasterPlywoodMDF')
        //         ->where('Item_Id',$itemId)->get();
        return Excel::download(new KebutuhanPlywoodMDFItemExport($itemId), 'Kebutuhan_Plywood_MDF_Item.xlsx');
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
        $import = new KebutuhanPlywoodMDFItemImport($itemId);
        Excel::import($import, $request->file('excel_file'));

        // Redirect kembali ke halaman awal
        return redirect("/Item/$itemId")->with('success_plywood_mdf', 'Item berhasil diimport!');
    }
}
