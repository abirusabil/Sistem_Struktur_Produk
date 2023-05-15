<?php

namespace App\Http\Controllers;

use App\Exports\KebutuhanPlywoodMDFItemExport;
use App\Imports\KebutuhanPlywoodMDFItemImport;
use App\Models\KebutuhanPlywoodMdfItem;
use App\Models\MasterPlywoodMdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

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
    public function create(Request $request)
    {
        return view('pages.Data_Barang.Item.Kebutuhan_Plywood_MDF.Tambah_Kebutuhan_Plywood_MDF',
        [
            'type_menu' => 'Item',
            'Item'=>$request,
                'PlywoodMDF'=>MasterPlywoodMdf::all(),
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
                'id'=>'required|unique:kebutuhan_kayu_items',
                'Item_Id.*'=>'required',
                'Plywood_MDF_Id.*'=>'required',
                'KP_Kebutuhan_Plywood_MDF_Item.*'=>'required',
                'Keterangan_Kebutuhan_Plywood_MDF_Item.*'=>'required',
                'Grade_Kebutuhan_Plywood_MDF_Item.*'=>'required',
                'Lebar_Kebutuhan_Plywood_MDF_Item.*'=>'required',
                'Panjang_Kebutuhan_Plywood_MDF_Item.*'=>'required',
                'Quantity_Kebutuhan_Plywood_MDF_Item.*'=>'required',
                
    
            ],[
                'required'=>'Kolom Tidak Boleh Kosong',
                'unique'=>'Kode Telah Digunakan Silahkan Gunakan Kode Lain'
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
    public function edit(KebutuhanPlywoodMdfItem $Kebutuhan_Plywood_MDF_Item)
    {
        return view('pages.Data_Barang.Item.Kebutuhan_Plywood_MDF.Edit_Kebutuhan_Plywood_MDF',
        [
            'type_menu'=>'item',
            'Kebutuhan_Plywood_MDF_Items'=> $Kebutuhan_Plywood_MDF_Item ,
            'PlywoodMDF'=>MasterPlywoodMdf::all()

        ]);
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
                'id'=>'required',
                'Item_Id'=>'required',
                'Plywood_MDF_Id'=>'required',
                'KP_Kebutuhan_Plywood_MDF_Item'=>'required',
                'Keterangan_Kebutuhan_Plywood_MDF_Item'=>'required',
                'Grade_Kebutuhan_Plywood_MDF_Item'=>'required',
                'Lebar_Kebutuhan_Plywood_MDF_Item'=>'required',
                'Panjang_Kebutuhan_Plywood_MDF_Item'=>'required',
                'Quantity_Kebutuhan_Plywood_MDF_Item'=>'required',
                
    
            ],[
                'required'=>'Kolom Tidak Boleh Kosong',
                
            ]
            );
            // return $validatedData;
            KebutuhanPlywoodMdfItem::where('id',$Kebutuhan_Plywood_MDF_Item->id)->update($validatedData);
            return redirect("/Item/$Kebutuhan_Plywood_MDF_Item->Item_Id")->with('success_plywood_mdf', 'Data Berhasil Ditambahkan');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KebutuhanPlywoodMdfItem  $kebutuhanPlywoodMdfItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(KebutuhanPlywoodMdfItem $Kebutuhan_Plywood_MDF_Item)
    {
        // return $Kebutuhan_Plywood_MDF_Item;
        KebutuhanPlywoodMdfItem::destroy($Kebutuhan_Plywood_MDF_Item->id);
        return redirect("Item/$Kebutuhan_Plywood_MDF_Item->Item_Id")->with('success_plywood_mdf', 'Data Berhasil Dihapus');
    }

    public function export($itemId)
    {
        // return KebutuhanPlywoodMDFItem::with('Item','MasterPlywoodMDF')
        //         ->where('Item_Id',$itemId)->get();
        return Excel::download(new KebutuhanPlywoodMDFItemExport($itemId) , 'Kebutuhan_Plywood_MDF_Item.xlsx');
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
