<?php

namespace App\Http\Controllers;

use App\Models\GambarKerja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GambarKerjaController extends Controller
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
        return view(
            'pages.Data_Barang.Item.Gambar_Kerja.Tambah_Gambar_Kerja',
            [
                'type_menu' => 'Item',
                'Item' => $request->itemId,
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
        $validatedData = $request->validate([
            'Item_Id' => 'required',
            'pdf_file' => 'required|mimes:pdf|max:2048',
        ]);

        $pdf_file = new GambarKerja;
        $pdf_file->Item_Id = $request->Item_Id;

        $file = $request->file('pdf_file');
        $filename = time() . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('public/gambar_kerjas', $filename);

        $pdf_file->pdf_file = $filename;
        $pdf_file->save();

        return redirect("/Item/{$validatedData['Item_Id']}")->with('success_gambar_item', 'Data Berhasil Ditambahkan');
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GambarKerja  $gambarKerja
     * @return \Illuminate\Http\Response
     */
    public function show(GambarKerja $gambarKerja)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GambarKerja  $gambarKerja
     * @return \Illuminate\Http\Response
     */
    public function edit(GambarKerja $gambarKerja)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GambarKerja  $gambarKerja
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GambarKerja $gambarKerja)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GambarKerja  $gambarKerja
     * @return \Illuminate\Http\Response
     */
    public function destroy(GambarKerja $Gambar_Kerja)
    {
        $gambarkerja = GambarKerja::find($Gambar_Kerja->id);

        // Hapus file gambar dari storage
        $path = 'public/gambar_kerjas/' . $gambarkerja->pdf_file;
        Storage::delete($path);

        // Hapus data gambar item dari database
        $gambarkerja->delete();

        return redirect("/Item/$Gambar_Kerja->Item_Id")->with('success_gambar_item', 'Data Berhasil Diubah');
    }


}
