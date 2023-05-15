<?php

namespace App\Http\Controllers;

use App\Exports\BoronganDalamItemExport;
use App\Models\BoronganDalamItem;
use App\Models\Item;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

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
    public function create(Request $request)
    {
    // return $request;
    //   dd($request);
        return view('pages.Data_Barang.Item.Borongan_Dalam.Tambah_Borongan_Dalam', [
            'type_menu' => 'Item',
            'itemId' => $request->itemId,
        ]);
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
                'Bahan_1'=>'required',
                'Bahan_2'=>'required',
                'Sanding_1'=>'required',
                'Sanding_2'=>'required',
                'Proses_Assembling'=>'required',
                'Finishing'=>'required',
                'Packing'=>'required',
            ],[
                'required'=>'Kolom Tidak Boleh Kosong',
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
    public function edit(BoronganDalamItem $Borongan_Dalam_Item)
    {
        return view('pages.Data_Barang.Item.Borongan_Dalam.Edit_Borongan_Dalam',
        [
            'type_menu'=>'Item',
            'Borongan_Dalam_Item'=>$Borongan_Dalam_Item,
        ]);
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
                'Item_Id'=>'required',
                'Bahan_1'=>'required',
                'Bahan_2'=>'required',
                'Sanding_1'=>'required',
                'Sanding_2'=>'required',
                'Proses_Assembling'=>'required',
                'Finishing'=>'required',
                'Packing'=>'required',
            ],[
                'required'=>'Kolom Tidak Boleh Kosong',
            ]
            );
            // return $validatedData;
            BoronganDalamItem::where('id',$Borongan_Dalam_Item->id)->update($validatedData);
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
