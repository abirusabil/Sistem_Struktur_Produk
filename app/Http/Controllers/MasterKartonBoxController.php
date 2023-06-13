<?php

namespace App\Http\Controllers;

use App\Exports\MasterKartonBoxExport;
use App\Imports\MasterKartonBoxImport;
use App\Models\MasterKartonBox;
use App\Models\Suplier;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class MasterKartonBoxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return view('pages.Data-Materials.Karton_Box.Master_Karton_Box' , 
        //     [
        //         'type_menu'=>'Karton_Box',
        //         'Karton_Box'=>MasterKartonBox::with('Suplier')->filter(request(['search']))->paginate(10),
        //     ]
        // );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view('pages.Data-Materials.Karton_Box.Tambah_Karton_Box',
        //     [
        //         'type_menu'=>'Karton_Box',
        //         'supliers'=>Suplier::all()
        //     ]
        // );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $validatedData = $request->validate(
        //     [
        //         'id'=>'required|unique:master_karton_boxes',
        //         'Jenis_Karton_Box'=>'required',
        //         'Satuan_Karton_Box'=>'required',
        //         'Harga_Karton_Box'=>'required',
        //         'Suplier_Id'=>'required'
        //     ],[
        //         'required'=>'Kolom Tidak Boleh Kosong',
        //         'unique'=>'Kode Telah Digunakan , Silahkan Gunakan Kode Lain'
        //     ]
        // );
        // // return $validatedData;
        // MasterKartonBox::create($validatedData);
        // return redirect('/Karton_Box')->with('success','Data Karton Box Telah Ditambahkan');
        

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MasterKartonBox  $masterKartonBox
     * @return \Illuminate\Http\Response
     */
    public function show(MasterKartonBox $masterKartonBox)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MasterKartonBox  $masterKartonBox
     * @return \Illuminate\Http\Response
     */
    public function edit(MasterKartonBox $Karton_Box)
    {
        // return view('pages.Data-Materials.Karton_Box.Edit_Karton_Box',
        //     [
        //         'type_menu'=>'Karton_Box',
        //         'Karton_Box'=>$Karton_Box,
        //         'supliers'=>Suplier::all()
        //     ]
        // );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MasterKartonBox  $masterKartonBox
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MasterKartonBox $Karton_Box)
    {
        // $validatedData = $request->validate(
        //     [
        //         'id'=>'required',
        //         'Jenis_Karton_Box'=>'required',
        //         'Satuan_Karton_Box'=>'required',
        //         'Harga_Karton_Box'=>'required',
        //         'Suplier_Id'=>'required'
        //     ],[
        //         'required'=>'Kolom Tidak Boleh Kosong'
        //     ]
        // );
        // // return $validatedData;
        // MasterKartonBox::where('id',$Karton_Box->id)->update($validatedData);
        // return redirect('/Karton_Box')->with('success','Data Karton Box Telah Ditambahkan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MasterKartonBox  $masterKartonBox
     * @return \Illuminate\Http\Response
     */
    public function destroy(MasterKartonBox $Karton_Box)
    {
        MasterKartonBox::destroy($Karton_Box->id);
        return redirect('/Karton_Box')->with('success','Data Berhasil Dihapus');
    }

    // public function export()
    // {
    //     return Excel::download(new MasterKartonBoxExport , 'KartonBox.xlsx');
    // }

    // public function import(Request $request)
    // {
    //      // Validasi file Excel
    //      $request->validate([
    //         'excel_file' => 'required|mimes:xls,xlsx'
    //     ]);

    //     // Import data dari file Excel
    //     $import = new MasterKartonBoxImport();
    //     Excel::import($import, $request->file('excel_file'));

    //     // Redirect kembali ke halaman awal
    //     return redirect('/Karton_Box')->with('success', 'Data Kayu berhasil diimport!');
    // }
}
