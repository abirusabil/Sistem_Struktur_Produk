<?php

namespace App\Http\Controllers;

use App\Exports\MasterKomponenFinishingExport;
use App\Imports\MasterKomponenFinishingImport;
use App\Models\MasterKomponenFinishing;
use App\Models\Suplier;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class MasterKomponenFinishingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('pages.Data-Materials.Komponen_Finishing.Master_Komponen_Finishing',
            [
                'type_menu'=>'Komponen_Finishing',
                'Komponen_Finishing'=>MasterKomponenFinishing::with('Suplier')->filter(request(['search']))->paginate(10)
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
        return view('pages.Data-Materials.Komponen_Finishing.Tambah_Komponen_Finishing',
            [
                'type_menu'=>'Komponen_Finishing',
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
        // 
        $validatedData = $request->validate(
            [
                'id'=>'required|unique:master_komponen_finishings',
                'Nama_Komponen_Finishing'=>'required',
                'Quantity_Komponen_Finishing'=>'required',
                'Satuan_Komponen_Finishing'=>'required',
                'Harga_Komponen_Finishing'=>'required',
                'Suplier_Id'=>'required'
            ],[
                'required' => 'Kolom tidak boleh kosong',
                'unique' => 'Kode sudah digunakan , Silahkan Gunakan Kode Lain'
            ]
        ) ;
        // return $validatedData;
        MasterKomponenFinishing::create($validatedData);
        return redirect('/Komponen_Finishing')->with('success','Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MasterKomponenFinishing  $masterKomponenFinishing
     * @return \Illuminate\Http\Response
     */
    public function show(MasterKomponenFinishing $Komponen_Finishing)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MasterKomponenFinishing  $masterKomponenFinishing
     * @return \Illuminate\Http\Response
     */
    public function edit(MasterKomponenFinishing $Komponen_Finishing)
    {
        return view('pages.Data-Materials.Komponen_Finishing.Edit_Komponen_Finishing',
        [
            'type_menu'=>'Komponen_Finishing',
            'Komponen_Finishing'=>$Komponen_Finishing,
            'supliers'=>Suplier::all()
        ]
    );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MasterKomponenFinishing  $masterKomponenFinishing
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MasterKomponenFinishing $Komponen_Finishing)
    {
        $validatedData = $request->validate(
            [
                'id'=>'required',
                'Nama_Komponen_Finishing'=>'required',
                'Quantity_Komponen_Finishing'=>'required',
                'Satuan_Komponen_Finishing'=>'required',
                'Harga_Komponen_Finishing'=>'required',
                'Suplier_Id'=>'required'
            ],[
                'required' => 'Kolom tidak boleh kosong',
             
            ]
        ) ;
        // return $validatedData;
        MasterKomponenFinishing::where('id',$Komponen_Finishing->id)->update($validatedData);
        return redirect('/Komponen_Finishing')->with('success','Data Berhasil Diubah');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MasterKomponenFinishing  $masterKomponenFinishing
     * @return \Illuminate\Http\Response
     */
    public function destroy(MasterKomponenFinishing $Komponen_Finishing)
    {
        // return $Komponen_Finishing;
        MasterKomponenFinishing::destroy($Komponen_Finishing->id);
        return redirect('/Komponen_Finishing')->with('success','Data Berhasil Dihapus');
    }

    public function export()
    {
        return Excel::download(new MasterKomponenFinishingExport ,'Master_Komponen_Finishing.xlsx');
    }

    public function import(Request $request)
    {
         // Validasi file Excel
         $request->validate([
            'excel_file' => 'required|mimes:xls,xlsx'
        ]);

        // Import data dari file Excel
        $import = new MasterKomponenFinishingImport();
        Excel::import($import, $request->file('excel_file'));

        // Redirect kembali ke halaman awal
        return redirect('/Komponen_Finishing')->with('success', 'Data Komponen Finishing berhasil diimport!');
    }
}
