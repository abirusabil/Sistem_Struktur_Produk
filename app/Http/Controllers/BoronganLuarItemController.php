<?php

namespace App\Http\Controllers;

use App\Exports\BoronganLuarItemExport;
use App\Models\BoronganLuarItem;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class BoronganLuarItemController extends Controller
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
        return view('pages.Data_Barang.Item.Borongan_Luar.Tambah_Borongan_Luar', [
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
                'Anyam'=>'required',
                'Ukir'=>'required',
                'Handle'=>'required',
                'Bubut'=>'required',
                'Pirelly_Jok'=>'required',
                'Sterofoam'=>'required',
            ],[
                'required'=>'Kolom Tidak Boleh Kosong',
            ]
            );
            // return $validatedData;
            BoronganLuarItem::Create($validatedData);
            return redirect("/Item/{$request->input('Item_Id')}")->with('success_Borongan_Luar', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BoronganLuarItem  $boronganLuarItem
     * @return \Illuminate\Http\Response
     */
    public function show(BoronganLuarItem $boronganLuarItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BoronganLuarItem  $boronganLuarItem
     * @return \Illuminate\Http\Response
     */
    public function edit(BoronganLuarItem $Borongan_Luar_Item)
    {
        return view('pages.Data_Barang.Item.Borongan_Luar.Edit_Borongan_Luar',
        [
            'type_menu'=>'Item',
            'Borongan_Luar_Item'=>$Borongan_Luar_Item,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BoronganLuarItem  $boronganLuarItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BoronganLuarItem $Borongan_Luar_Item)
    {
        $validatedData = $request->validate(
            [
                'Item_Id'=>'required',
                'Anyam'=>'required',
                'Ukir'=>'required',
                'Handle'=>'required',
                'Bubut'=>'required',
                'Pirelly_Jok'=>'required',
                'Sterofoam'=>'required',
            ],[
                'required'=>'Kolom Tidak Boleh Kosong',
            ]
            );

            BoronganLuarItem::where('id',$Borongan_Luar_Item->id)->update($validatedData);
            return redirect("/Item/{$request->input('Item_Id')}")->with('success_Borongan_Luar', 'Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BoronganLuarItem  $boronganLuarItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(BoronganLuarItem $boronganLuarItem)
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
        return Excel::download(new BoronganLuarItemExport($itemId), 'Ongkos Kerja Borongan Luar.xlsx');
    }
}
