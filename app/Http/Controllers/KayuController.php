<?php

namespace App\Http\Controllers;

use App\Exports\MasterKayuExport;
use App\Imports\MasterKayuImport;
use App\Models\MasterKayu;
use App\Models\Suplier;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class KayuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return  MasterKayu::with('Suplier')->get();
        // dd();

        return view('pages/Data-Materials/Kayu/Master-Kayu',
            [
                "type_menu" => "Kayu" ,
                'MasterKayu' => MasterKayu::with('Suplier')->filter(request(['search']))->paginate(10),
                // 'Suplier'=>Suplier::all()
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
        // dd(Suplier::all());
        return view ('pages/Data-Materials/Kayu/Tambah_Kayu',
            [
                "type_menu" => "Kayu" ,
                'supliers'=>Suplier::all()
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
            'id'=>'required|unique:master_kayus',
            'Nama_Kayu'=>'required',
            'Satuan'=>'required',
            'Harga_Kayu'=>'required',
            'Suplier_Id'=>'required'
        ],[
            'required' => 'Kolom tidak boleh kosong',
            'unique' => 'Kode sudah digunakan ,Silahkan Gunakan Kode Lain'
        ]
        );  
        // return ($validatedData);
        MasterKayu::Create($validatedData);
        return redirect('/Kayu')->with('success','Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kayu  $kayu
     * @return \Illuminate\Http\Response
     */
    public function show(MasterKayu $Kayu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kayu  $kayu
     * @return \Illuminate\Http\Response
     */
    public function edit(MasterKayu $Kayu)
    {
        
        // return $Kayu;
        return view('pages/Data-Materials/Kayu/Edit_Kayu' ,
            [
                "type_menu" => "Kayu" ,
                'kayu'=> $Kayu,
                'supliers'=>Suplier::all()
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kayu  $kayu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MasterKayu $Kayu)
    {
        $validatedData = $request->validate([
            'id'=>'required',
            'Nama_Kayu'=>'required',
            'Harga_Kayu'=>'required',
            'Satuan'=>'required',
            'Suplier_Id'=>'required'
        ],[
            'required' => 'Kolom tidak boleh kosong',
        ]
    );

        // return $validatedData;
        // dd();

        MasterKayu::where('id',$Kayu->id)
        ->update($validatedData);

        return redirect('/Kayu')->with('success','Data Telah Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kayu  $kayu
     * @return \Illuminate\Http\Response
     */
    public function destroy(MasterKayu $Kayu)
    {
        // return $Kayu;
        MasterKayu::destroy($Kayu->id);
        return redirect('/Kayu')->with('success','Data Berhasil Dihapus');
    }


    public function export()
    {
        
        return Excel::download(new MasterKayuExport, 'master_kayu.xlsx');
    }


    public function import(Request $request)
    {
         // Validasi file Excel
         $request->validate([
            'excel_file' => 'required|mimes:xls,xlsx'
        ]);

        // Import data dari file Excel
        $import = new MasterKayuImport();
        Excel::import($import, $request->file('excel_file'));

        // Redirect kembali ke halaman awal
        return redirect('/Kayu')->with('success', 'Data Kayu berhasil diimport!');
    }
}
