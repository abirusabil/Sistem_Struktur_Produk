<?php

namespace App\Http\Controllers;

use App\Models\Buyer;
use App\Models\Suplier;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SuplierExport;
use App\Imports\SuplierImport;

class SuplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages/Pembelian/Suplier/List_Suplier',[
            "type_menu"=>"Suplier",
            "suplier"=> Suplier::filter(request(['search']))->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages/Pembelian/Suplier/Tambah_Suplier',[
            "type_menu"=>"Suplier",
            "Suplier"=> Suplier::all()
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
        $validatedData = $request->validate([
            'nama_suplier'=>'required',
            'alamat_suplier'=>'required',
            'kontak_suplier'=>'required'
        ]);
        // return ($validatedData);
        Suplier::Create($validatedData);
        return redirect('/Suplier')->with('success','Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Suplier  $suplier
     * @return \Illuminate\Http\Response
     */
    public function show(Suplier $suplier)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Suplier  $suplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Suplier  $Suplier)
    {
       
        // dd($Suplier);
        return view('pages/Pembelian/Suplier/Ubah_Suplier',[
            "type_menu"=>"Suplier",
            'suplier' => $Suplier
        ]);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Suplier  $suplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Suplier $Suplier)
    {
        $validatedData = $request->validate([
            'nama_suplier'=>'required',
            'alamat_suplier'=>'required',
            'kontak_suplier'=>'required',
            

        ]);

        Suplier::where('id',$Suplier->id)
        ->update($validatedData);

        return redirect('/Suplier')->with('success','Data Telah Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Suplier  $suplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Suplier $Suplier )
    {
        // return ($supliers);
        Suplier::destroy($Suplier->id);
        return redirect('/Suplier')->with('success','Data Berhasil Dihapus');
    }

    public function export()
	{
		return Excel::download(new SuplierExport, 'Suplier.xlsx');
	}

        public function import(Request $request)
    {
        // Validasi file Excel
        $request->validate([
            'excel_file' => 'required|mimes:xls,xlsx'
        ]);

        // Import data dari file Excel
        $import = new SuplierImport();
        Excel::import($import, $request->file('excel_file'));

        // Redirect kembali ke halaman awal
        return redirect('/Suplier')->with('success', 'Data Suplier berhasil diimport!');
    }
}
