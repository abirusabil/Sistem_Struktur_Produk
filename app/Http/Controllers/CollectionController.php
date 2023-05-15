<?php

namespace App\Http\Controllers;

use App\Exports\CollectionExport;
use App\Imports\CollectionImport;
use App\Models\Buyer;
use App\Models\Collection;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class CollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return Collection::with('Buyer')->paginate(10);
        // dd();
       return view('pages.Data_Barang.Collection.Master_Collection',
        [
            'type_menu'=>'Collection',
            'Collection'=>Collection::with('Buyer')->filter(request(['search']))->paginate(10)
        ]
       );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.Data_Barang.Collection.Tambah_Collection',
            [
              'type_menu'=>'Collection' ,
              'buyers'=>Buyer::all() 
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
              'id'=>'required',
              'Nama_Collection' =>'required' ,
              'Buyer_Id'=>'required'
            ],[
                'required'=>'Kolom Tidak Boleh Kosong'
            ]
        );
        // return $validatedData;
        Collection::create($validatedData);
        return redirect('/Collection')->with('success','Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Collection  $collection
     * @return \Illuminate\Http\Response
     */
    public function show(Collection $Collection)
    {
        // return $Collection;
        // dd();
        return view('pages.Data_Barang.Collection.Detail_Collection',
            [
                'type_menu'=>'Collection',
                'Collection'=>$Collection
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Collection  $collection
     * @return \Illuminate\Http\Response
     */
    public function edit(Collection $Collection)
    { 
        
        return view('pages.Data_Barang.Collection.Edit_Collection',[
            'type_menu'=>'Collection',
            'Collection'=>$Collection,
            'buyers'=>Buyer::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Collection  $collection
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Collection $Collection)
    {
        $validatedData = $request->validate(
            [
              'id'=>'required|unique:collections',
              'Nama_Collection' =>'required' ,
              'Buyer_Id'=>'required'
            ],[
                'required'=>'Kolom Tidak Boleh Kosong',
                'unique'=>'Kode Telah Digunakan , Silahkan Gunakan Kode Lain'
            ]
        );
        // return $validatedData;
        Collection::where('id',$Collection->id)->update($validatedData);
        return redirect('/Collection')->with('success','Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Collection  $collection
     * @return \Illuminate\Http\Response
     */
    public function destroy(Collection $Collection)
    {
        Collection::destroy($Collection->id);
        return redirect('/Collection')->with('success','Data Berhasil Dihapus');
    }

    public function export()
    {
        // return Collection::with('buyer')->get();
        return Excel::download(new CollectionExport , 'Collection.xlsx');
    }

    public function import(Request $request)
    {
         // Validasi file Excel
         $request->validate([
            'excel_file' => 'required|mimes:xls,xlsx'
        ]);

        // Import data dari file Excel
        $import = new CollectionImport();
        Excel::import($import, $request->file('excel_file'));

        // Redirect kembali ke halaman awal
        return redirect('/Collection')->with('success', 'Data Kayu berhasil diimport!');
    }
}
