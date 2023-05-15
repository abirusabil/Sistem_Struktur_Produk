<?php

namespace App\Http\Controllers;

use App\Exports\KebutuhanAccessoriesHardwareItemExport;
use App\Imports\KebutuhanAccessoriesHardwareItemImport;
use App\Models\KebutuhanAccessoriesHardwareItem;
use App\Models\MasterAccessoriesHardware;
use App\Models\MasterKayu;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class KebutuhanAccessoriesHardwareItemController extends Controller
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
    public function create(Request $request)
    {
        // return MasterAccessoriesHardware::all();
        return view('pages.Data_Barang.Item.Kebutuhan_Accessories_Hardware.Tambah_Kebutuhan_Accessories_Hardware',
            [
                'type_menu'=>'Item',
                'Item'=>$request,
                'AccessoriesHardware'=>MasterAccessoriesHardware::all(),
                // 'loopCount' => $loopCount
            ]
        );
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
                'id'=>'required|unique:kebutuhan_accessories_hardware_items',
                'Item_Id.*'=>'required',
                'Accessories_Hardware_Id.*'=>'required',
                'Keterangan_Kebutuhan_Accessories_Hardware_Item.*'=>'required',
                'Quantity_Kebutuhan_Accessories_Hardware_Item.*'=>'required',
                
    
            ],[
                'required'=>'Kolom Tidak Boleh Kosong',
                'unique'=>'Kode Telah Digunakan Silahkan Gunakan Kode Lain'
            ]
        );
        
        // return $validatedData;
            for ($i = 0; $i < count($request->Accessories_Hardware_Id); $i++) {
                KebutuhanAccessoriesHardwareItem::create([
                    'id' => $validatedData['id'][$i],
                    'Item_Id' => $validatedData['Item_Id'][$i],
                    'Accessories_Hardware_Id' => $validatedData['Accessories_Hardware_Id'][$i],
                    'Keterangan_Kebutuhan_Accessories_Hardware_Item' => $validatedData['Keterangan_Kebutuhan_Accessories_Hardware_Item'][$i],
                    'Quantity_Kebutuhan_Accessories_Hardware_Item' => $validatedData['Quantity_Kebutuhan_Accessories_Hardware_Item'][$i],
                ]);
            }
        
            return redirect("/Item/{$request->input('Item_Id.0')}")->with('success_accessories_hardware', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\KebutuhanAccessoriesHardwareItem  $kebutuhanAccessoriesHardwareItem
     * @return \Illuminate\Http\Response
     */
    public function show(KebutuhanAccessoriesHardwareItem $kebutuhanAccessoriesHardwareItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KebutuhanAccessoriesHardwareItem  $kebutuhanAccessoriesHardwareItem
     * @return \Illuminate\Http\Response
     */
    public function edit(KebutuhanAccessoriesHardwareItem $Kebutuhan_Accessories_Item)
    {
        return view('pages.Data_Barang.Item.Kebutuhan_Accessories_Hardware.Edit_Kebutuhan_Accessories_Hardware',
            [
                'type_menu'=>'Item',
                'Kebutuhan_Accessories_Hardware_Item'=>$Kebutuhan_Accessories_Item,
                'Accessories_Hardwares'=>MasterAccessoriesHardware::all(),
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\KebutuhanAccessoriesHardwareItem  $kebutuhanAccessoriesHardwareItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KebutuhanAccessoriesHardwareItem $Kebutuhan_Accessories_Item)
    {
        $validatedData = $request->validate(
            [
                'id'=>'required',
                'Item_Id'=>'required',
                'Accessories_Hardware_Id'=>'required',
                'Keterangan_Kebutuhan_Accessories_Hardware_Item'=>'required',
                'Quantity_Kebutuhan_Accessories_Hardware_Item'=>'required',
                
    
            ],[
                'required'=>'Kolom Tidak Boleh Kosong',
            ]
        );
        // return $validatedData;
        KebutuhanAccessoriesHardwareItem::where('id',$Kebutuhan_Accessories_Item->id)->update($validatedData);
        return redirect("/Item/$Kebutuhan_Accessories_Item->Item_Id")->with('success_accessories_hardware','Data Berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KebutuhanAccessoriesHardwareItem  $kebutuhanAccessoriesHardwareItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(KebutuhanAccessoriesHardwareItem $Kebutuhan_Accessories_Item)
    {
        KebutuhanAccessoriesHardwareItem::destroy($Kebutuhan_Accessories_Item->id);
        return redirect("/Item/$Kebutuhan_Accessories_Item->Item_Id")->with('success_accessories_hardware','Data Berhasil Dihapus');
    }

    public function export($itemId)
    {
        // return $itemId;
        //    return KebutuhanKayuItem::with('Item', 'MasterKayu')
        //         ->where('Item_id', $itemId)
        //         ->get();
        // return Excel::download(new KebutuhanKayuItemExport($request->input('search')),'KebutuhanKayu.xlsx');
        return Excel::download(new KebutuhanAccessoriesHardwareItemExport($itemId), 'Kebuttuhan Accessories Hardware.xlsx');
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
        $import = new KebutuhanAccessoriesHardwareItemImport($itemId);
        Excel::import($import, $request->file('excel_file'));

        // Redirect kembali ke halaman awal
        return redirect("/Item/$itemId")->with('success_accessories_hardware', 'Item berhasil diimport!');
    }
}
