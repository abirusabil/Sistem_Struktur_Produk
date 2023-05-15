<?php

namespace App\Http\Controllers;

use App\Exports\BuyerExport;
use App\Imports\BuyerImport;
use App\Models\Buyer;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class BuyerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return Buyer::all();
        return view('pages/Data_Barang/Buyer/List_Buyer',
            [
             'type_menu'=>'Buyer',
             "Buyer" => Buyer::filter(request(['search']))->paginate(10)
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
        return view('pages/Data_Barang/Buyer/Tambah_Buyer',
         [ 'type_menu'=>'Buyer']
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
        // return $request->all()
        $validatedData = $request->validate([
            'id'=>'required',
            'Nama_Buyer'=> 'required',
            'Alamat_Buyer'=> 'required',
            'Kontak_Buyer'=> 'required'
           ],[
                'required'=>'Kolom Tidak Boleh Kosong'
           ]
        );
        // return $validatedData;
        // dd();
        Buyer::Create($validatedData);
        return redirect('/Buyer')->with('success', 'Penambahan Buyer Baru Sukses');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Buyer  $buyer
     * @return \Illuminate\Http\Response
     */
    public function show(Buyer $buyer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Buyer  $buyer
     * @return \Illuminate\Http\Response
     */
    public function edit(Buyer $Buyer)
    {
        return view('pages.Data_Barang.Buyer.Edit_Buyer',
            [
                'type_menu'=>'Buyer',
                'Buyer'=>$Buyer,
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Buyer  $buyer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Buyer $Buyer)
    {
        $validatedData = $request->validate([
            'id'=>'required',
            'Nama_Buyer'=> 'required',
            'Alamat_Buyer'=> 'required',
            'Kontak_Buyer'=> 'required'
           ],[
                'required'=>'Kolom Tidak Boleh Kosong'
           ]
        );
        // return $validatedData;
        Buyer::where('id',$Buyer->id)->update($validatedData);
        return redirect('/Buyer')->with('success','Data Buyer Telah Diubah');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Buyer  $buyer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Buyer $Buyer)
    {
        // return $Buyer;
        // dd();
        Buyer::destroy($Buyer->id);
        return redirect('/Buyer')->with('success','Data Telah Dihapus');
    }

    public function export()
    {
        return Excel::download(new BuyerExport , 'Buyer.xlsx');
    }

    public function import(Request $request)
    {
         // Validasi file Excel
         $request->validate([
            'excel_file' => 'required|mimes:xls,xlsx'
        ]);

        // Import data dari file Excel
        $import = new BuyerImport();
        Excel::import($import, $request->file('excel_file'));

        // Redirect kembali ke halaman awal
        return redirect('/Buyer')->with('success', 'Data Buyer berhasil diimport!');
    }
}
