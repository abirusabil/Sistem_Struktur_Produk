<?php

namespace App\Http\Controllers;

use App\Models\MasterPlywoodMdf;
use Illuminate\Http\Request;
use App\Models\Suplier;
use App\Exports\MasterPlywoodMdfExport;
use App\Imports\MasterPlywoodMdfImport;
use Maatwebsite\Excel\Facades\Excel;

// untuk mengatasi bruteforce
use Illuminate\Cache\RateLimiter;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Auth\Access\AuthorizationException;

class MasterPlywoodMdfController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('pages.Data-Materials.Plywood_MDF.Master-Plywood-Mdf' , 
        [
            'type_menu'=>'Plywood_MDF',
            'PlywoodMDF' => MasterPlywoodMdf::with('Suplier')->filter(request(['search']))->paginate(10),
        ]
    );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(RateLimiter $limiter)
    {
        try {
            if (!in_array(auth()->user()->akses, [1, 2])) {
                throw new AuthorizationException();
            }

            // Check for brute force attacks
            $key = 'login.' . request()->ip();
            $maxAttempts = 5;
            $decayMinutes = 1;

            if ($limiter->tooManyAttempts($key, $maxAttempts)) {
                throw new HttpException(Response::HTTP_TOO_MANY_REQUESTS, 'Too many attempts. Please try again later.');
            }

            $limiter->hit($key, $decayMinutes * 60);

            return view('pages.Data-Materials.Plywood_MDF.Tambah_Plywood_MDF' , 
                [
                    'type_menu'=>'Plywood_MDF',
                    'supliers'=>Suplier::all()
                ]
            );

        } catch (AuthorizationException $exception) {
            throw new AuthorizationException('Halaman Ini Tidak Boleh Diakses', 403);
        }
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
            'id'=>'required|unique:master_plywood_mdfs',
            'Nama_Plywood_MDF'=>'required',
            'Tebal_Plywood_MDF'=>'required',
            'Panjang_Plywood_MDF'=>'required',
            'Lebar_Plywood_MDF'=>'required',
            'Harga_Plywood_MDF'=>'required',
            'Satuan_Plywood_MDF'=>'required',
            'Suplier_Id'=>'required',
        ],[
            'required' => 'Kolom tidak boleh kosong',
            'unique' => 'Kode Sudah Digunakan , Silahkan Gunakan Kode Lain'
            ]
        );
        // return $validatedData;
        MasterPlywoodMdf::Create($validatedData);
        return redirect('/Plywood_MDF')->with('success','Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MasterPlywoodMdf  $masterPlywoodMdf
     * @return \Illuminate\Http\Response
     */
    public function show(MasterPlywoodMdf $masterPlywoodMdf)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MasterPlywoodMdf  $masterPlywoodMdf
     * @return \Illuminate\Http\Response
     */
    public function edit(MasterPlywoodMdf $Plywood_MDF)
    {
        // return $Plywood_MDF;
        // dd();
        return view('pages/Data-Materials/Plywood_MDF/Edit_Plywood_MDF' ,
            [
                "type_menu" => "Kayu" ,
                'Plywood_MDF'=> $Plywood_MDF,
                'supliers'=>Suplier::all()
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MasterPlywoodMdf  $masterPlywoodMdf
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MasterPlywoodMdf $Plywood_MDF)
    {
        $validatedData = $request->validate([
            'id'=>'required',
            'Nama_Plywood_MDF'=>'required',
            'Tebal_Plywood_MDF'=>'required',
            'Panjang_Plywood_MDF'=>'required',
            'Lebar_Plywood_MDF'=>'required',
            'Harga_Plywood_MDF'=>'required',
            'Satuan_Plywood_MDF'=>'required',
            'Suplier_Id'=>'required',
        ],[
            'required' => 'Kolom tidak boleh kosong',
            ]
        );
        // log activity

        $originalData = $Plywood_MDF->getOriginal();

        activity()
            ->causedBy(auth()->user())
            ->performedOn($Plywood_MDF)
            ->inLog('Master Pendukung Packing')
            ->withProperties([
                'old' => $originalData,
                'new' => $validatedData
                ])
            ->event('Update')
            ->log('This Model has been Update');

        //end log activity   
        // return $validatedData;
        MasterPlywoodMdf::where('id',$Plywood_MDF->id)
        ->update($validatedData);
        return redirect('/Plywood_MDF')->with('success','Data Berhasil Dirubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MasterPlywoodMdf  $masterPlywoodMdf
     * @return \Illuminate\Http\Response
     */
    public function destroy(MasterPlywoodMdf $Plywood_MDF)
    {
        MasterPlywoodMdf::destroy($Plywood_MDF->id);
        return redirect('/Plywood_MDF')->with('success','Data Berhasil Dihapus');
    }

    public function export()
    {
        return Excel::download(new MasterPlywoodMdfExport, 'Master_Plywood_Mdf.xlsx');
    }

    public function import(Request $request)
    {
         // Validasi file Excel
         $request->validate([
            'excel_file' => 'required|mimes:xls,xlsx'
        ]);

        // Import data dari file Excel
        $import = new MasterPlywoodMdfImport();
        Excel::import($import, $request->file('excel_file'));

        // Redirect kembali ke halaman awal
        return redirect('/Plywood_MDF')->with('success', 'Data Plywood MDF berhasil diimport!');
    }

    
}
