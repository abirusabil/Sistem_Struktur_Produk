<?php

namespace App\Http\Controllers;

use App\Exports\ItemExport;
use App\Imports\ItemImport;
use App\Models\BoronganDalamItem;
use App\Models\BoronganLuarItem;
use App\Models\Collection;
use App\Models\Item;
use App\Models\Buyer;
use App\Models\GambarItem;
use App\Models\GambarKerja;
use App\Models\KebutuhanAccessoriesHardwareItem;
use App\Models\KebutuhanKartonBoxItem;
use App\Models\KebutuhanKayuItem;
use App\Models\KebutuhanKomponenFinishingItem;
use App\Models\KebutuhanPendukungPackingItem;
use App\Models\KebutuhanPlywoodMdfItem;
use App\Models\MasterKayu;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

// untuk mengatasi bruteforce
use Illuminate\Cache\RateLimiter;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Auth\Access\AuthorizationException;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('pages.Data_Barang.Item.Master_Item',
        [
            'type_menu'=>'Item',
            'items'=>Item::with('Collection.Buyer')->filter(request(['search']))->paginate(50)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(RateLimiter $limiter)
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

            return view('pages.Data_Barang.Item.Tambah_Item',
            [
                'type_menu'=>'Item',
                'collections'=> Collection::with('Buyer')->get()
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
        // return $request;
        $validatedData = $request->validate(
            [
                'id'=>'required|unique:items',
                'Collection_Id'=>'required',
                'Nama_Item'=>'required',
                'Tinggi_Item'=>'required',
                'Lebar_Item'=>'required',
                'Panjang_Item'=>'required',
                'Berat_Item'=>'required',
                'Warna_Item'=>'required'
            ] ,[
                'required'=>'Kolom Tidak Boleh Kosong',
                'unique'=>'Kode Telah Digunakan , Silahkan Gunakan Kode Lain'
            ]
            );
        Item::create($validatedData);
        return redirect('/Item')->with('success','Item Berhasil Ditambahkan ');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $Item)
    {
        // return GambarKerja::where('Item_id',$Item->id)->get();
        // return GambarItem::where('Item_id',$Item->id)->get();
        return view('pages.Data_Barang.Item.Detail_Item',
            [
                'type_menu'=>'Item',
                'Item'=>$Item,
                'kebutuhan_kayus'=> KebutuhanKayuItem::with('MasterKayu')->where('Item_id',$Item->id)->get(),
                'kebutuhan_plywood_mdfs' => KebutuhanPlywoodMdfItem::with('MasterPlywoodMDF')->where('Item_id',$Item->id)->get(),
                'kebutuhan_accessories_hardwares' => KebutuhanAccessoriesHardwareItem::with('MasterAccessoriesHardware')->where('Item_id',$Item->id)->get(),
                'kebutuhan_komponen_finishings' => KebutuhanKomponenFinishingItem::with('MasterKomponenFinishing')->where('Item_id',$Item->id)->get(),
                'kebutuhan_pendukung_packings' => KebutuhanPendukungPackingItem::with('MasterPendukungPacking')->where('Item_id',$Item->id)->get(),
                'kebutuhan_karton_boxs' => KebutuhanKartonBoxItem::where('Item_id',$Item->id)->get(),
                'borongan_dalams' => BoronganDalamItem::where('Item_id',$Item->id)->get(),
                'Borongan_Luars' => BoronganLuarItem::where('Item_id',$Item->id)->get(),
                'gambarItems' => GambarItem::where('Item_id',$Item->id)->get(),
                'gambarKerjas' => GambarKerja::where('Item_id',$Item->id)->get(),
                
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $Item)
    {
        // return Collection::all();
        return view('pages.Data_Barang.Item.Edit_Item',
        [
            'type_menu'=>'Item',
            'Item'=>$Item,
            'collections'=>Collection::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $Item)
    {
        $validatedData = $request->validate(
            [
                'id'=>'required',
                'Collection_Id'=>'required',
                'Nama_Item'=>'required',
                'Tinggi_Item'=>'required',
                'Lebar_Item'=>'required',
                'Panjang_Item'=>'required',
                'Berat_Item'=>'required',
                'Warna_Item'=>'required'
            ] ,[
                'required'=>'Kolom Tidak Boleh Kosong',
                'unique'=>'Kode Telah Digunakan , Silahkan Gunakan Kode Lain'
            ]
            );
        // log activity

        $originalData = $Item->getOriginal();

        activity()
            ->causedBy(auth()->user())
            ->performedOn($Item)
            ->inLog('Item')
            ->withProperties([
                'old' => $originalData,
                'new' => $validatedData
                ])
            ->event('Update')
            ->log('This Model has been Update');

        //end log activity
        Item::where('id',$Item->id)->update($validatedData);
        return redirect("/Item/$Item->id")->with('success','Item Berhasil Diubah ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $Item)
    {
        Item::destroy($Item->id);
        return redirect('/Item')->with('success','Data Berhasil Dihapus');
    }

    public function export()
    {
        return Excel::download(new ItemExport,('Item.xlsx'));
    }

    public function import(Request $request)
    {
         // Validasi file Excel
         $request->validate([
            'excel_file' => 'required|mimes:xls,xlsx'
        ]);

        // Import data dari file Excel
        $import = new ItemImport();
        Excel::import($import, $request->file('excel_file'));

        // Redirect kembali ke halaman awal
        return redirect('/Item')->with('success', 'Item berhasil diimport!');
    }
    

    
}
