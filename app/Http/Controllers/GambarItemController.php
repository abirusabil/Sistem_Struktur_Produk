<?php

namespace App\Http\Controllers;

use App\Models\GambarItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GambarItemController extends Controller
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
        return view('pages.Data_Barang.Item.Gambar_Item.Tambah_Gambar_Item',
        [
            'type_menu' => 'Item',
            'Item'=>$request->itemId,
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
         $request->validate([
            'Item_Id' => 'required',
            'Gambar_Item' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        // return $datavalidated;
        $gambarItem = new GambarItem;
        $gambarItem->Item_Id = $request->Item_Id;

        $file = $request->file('Gambar_Item');
        $filename = time() . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('public/gambar_items', $filename);

        $gambarItem->Gambar_Item = $filename;
        $gambarItem->save();

        return redirect("/Item/{$request->input('Item_Id')}")->with('success_gambar_item', 'Data Berhasil Ditambahkan');
    }
    

    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GambarItem  $gambarItem
     * @return \Illuminate\Http\Response
     */
    public function show(GambarItem $gambarItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GambarItem  $gambarItem
     * @return \Illuminate\Http\Response
     */
    public function edit(GambarItem $gambarItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GambarItem  $gambarItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GambarItem $gambarItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GambarItem  $gambarItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(GambarItem $Gambar_Item)
    {
        $gambarItem = GambarItem::find($Gambar_Item->id);

        // Hapus file gambar dari storage
        $path = 'public/gambar_items/' . $gambarItem->Gambar_Item;
        Storage::delete($path);

        // Hapus data gambar item dari database
        $gambarItem->delete();

        return redirect("/Item/$Gambar_Item->Item_Id")->with('success_gambar_item', 'Data Berhasil Diubah');
    }

    public function downloadGambar($id)
    {
        $gambar = GambarItem::find($id);
        if (!$gambar) {
            abort(404);
        }
        $path = storage_path('app/public/gambar_items/' . $gambar->Gambar_Item);
        return response()->download($path);
    }

}

