<?php

namespace App\Http\Controllers;

use App\Exports\KebutuhanKartonBoxItemExport;
use App\Imports\KebutuhanKartonBoxItemImport;
use App\Models\KebutuhanKartonBoxItem;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class KebutuhanKartonBoxItemController extends Controller
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
        // return $request;
        return view('pages.Data_Barang.Item.Kebutuhan_Karton_Box.Tambah_Kebutuhan_Karton_Box',
        [
            'type_menu' => 'Item',
            'Item'=>$request,
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
                'id'=>'required|unique:kebutuhan_karton_box_items',
                'Item_Id.*'=>'required',
                'Jenis_Kebutuhan_Karton_Box.*'=>'required',
                'Keterangan_Kebutuhan_Karton_Box_Item.*'=>'required',
                'Tinggi_Kebutuhan_Karton_Box_Item.*'=>'required',
                'Lebar_Kebutuhan_Karton_Box_Item.*'=>'required',
                'Panjang_Kebutuhan_Karton_Box_Item.*'=>'required',
                'Quantity_Kebutuhan_Karton_Box_Item.*'=>'required',
                'Harga_Kebutuhan_Karton_Box_Item.*'=>'required',
            ],[
                'required'=>'Kolom Tidak Boleh Kosong',
                'unique'=>'Kode Telah Digunakan Silahkan Gunakan Kode Lain'
            ]
            );
            // return $validatedData;
            // return $request->input('Item_Id.0');
            for ($i = 0; $i < count($request->Tinggi_Kebutuhan_Karton_Box_Item); $i++) {
                KebutuhanKartonBoxItem::create([
                    'id' => $validatedData['id'][$i],
                    'Item_Id' => $validatedData['Item_Id'][$i],
                    'Jenis_Kebutuhan_Karton_Box' => $validatedData['Jenis_Kebutuhan_Karton_Box'][$i],
                    'Keterangan_Kebutuhan_Karton_Box_Item' => $validatedData['Keterangan_Kebutuhan_Karton_Box_Item'][$i],
                    'Tinggi_Kebutuhan_Karton_Box_Item' => $validatedData['Tinggi_Kebutuhan_Karton_Box_Item'][$i],
                    'Lebar_Kebutuhan_Karton_Box_Item' => $validatedData['Lebar_Kebutuhan_Karton_Box_Item'][$i],
                    'Panjang_Kebutuhan_Karton_Box_Item' => $validatedData['Panjang_Kebutuhan_Karton_Box_Item'][$i],
                    'Quantity_Kebutuhan_Karton_Box_Item' => $validatedData['Quantity_Kebutuhan_Karton_Box_Item'][$i],
                    'Harga_Kebutuhan_Karton_Box_Item' => $validatedData['Harga_Kebutuhan_Karton_Box_Item'][$i],
                ]);
            }
        
            return redirect("/Item/{$request->input('Item_Id.0')}")->with('success_karton_box', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\KebutuhanKartonBoxItem  $kebutuhanKartonBoxItem
     * @return \Illuminate\Http\Response
     */
    public function show(KebutuhanKartonBoxItem $Kebutuhan_Karton_Box_Item)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KebutuhanKartonBoxItem  $kebutuhanKartonBoxItem
     * @return \Illuminate\Http\Response
     */
    public function edit(KebutuhanKartonBoxItem $Kebutuhan_Karton_Box_Item)
    {
        return view('pages.Data_Barang.Item.Kebutuhan_Karton_Box.Edit_Kebutuhan_Karton_Box',
        [
            'type_menu'=>'item',
            'Kebutuhan_Karton_Box_Items'=> $Kebutuhan_Karton_Box_Item ,

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\KebutuhanKartonBoxItem  $kebutuhanKartonBoxItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KebutuhanKartonBoxItem $Kebutuhan_Karton_Box_Item)
    {
        $validatedData = $request->validate(
            [
                'id'=>'required',
                'Item_Id'=>'required',
                'Jenis_Kebutuhan_Karton_Box'=>'required',
                'Keterangan_Kebutuhan_Karton_Box_Item'=>'required',
                'Tinggi_Kebutuhan_Karton_Box_Item'=>'required',
                'Lebar_Kebutuhan_Karton_Box_Item'=>'required',
                'Panjang_Kebutuhan_Karton_Box_Item'=>'required',
                'Quantity_Kebutuhan_Karton_Box_Item'=>'required',
                'Harga_Kebutuhan_Karton_Box_Item'=>'required',
                
    
            ],[
                'required'=>'Kolom Tidak Boleh Kosong',
                
            ]
            );
            // return $validatedData;
            KebutuhanKartonBoxItem::where('id',$Kebutuhan_Karton_Box_Item->id)->update($validatedData);
            return redirect("/Item/$Kebutuhan_Karton_Box_Item->Item_Id")->with('success_karton_box', 'Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KebutuhanKartonBoxItem  $kebutuhanKartonBoxItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(KebutuhanKartonBoxItem $Kebutuhan_Karton_Box_Item)
    {
        KebutuhanKartonBoxItem::destroy($Kebutuhan_Karton_Box_Item->id);
        return redirect("/Item/$Kebutuhan_Karton_Box_Item->Item_Id")->with('success_karton_box', 'Data Berhasil Diubah');
    }
    public function export($itemId)
    {
        // return $itemId;
        //    return KebutuhanKayuItem::with('Item', 'MasterKayu')
        //         ->where('Item_id', $itemId)
        //         ->get();
        // return Excel::download(new KebutuhanKayuItemExport($request->input('search')),'KebutuhanKayu.xlsx');
        return Excel::download(new KebutuhanKartonBoxItemExport($itemId), 'Kebutuhan Karton Box.xlsx');
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
        $import = new KebutuhanKartonBoxItemImport($itemId);
        Excel::import($import, $request->file('excel_file'));

        // Redirect kembali ke halaman awal
        return redirect("/Item/$itemId")->with('success_accessories_hardware', 'Item berhasil diimport!');
    }
}
