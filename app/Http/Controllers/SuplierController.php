<?php

namespace App\Http\Controllers;

use App\Models\Buyer;
use App\Models\Suplier;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SuplierExport;
use App\Imports\SuplierImport;
use App\Models\MasterAccessoriesHardware;
use App\Models\MasterKayu;
use App\Models\MasterKomponenFinishing;
use App\Models\MasterPendukungPacking;
use App\Models\MasterPlywoodMdf;
use Illuminate\Auth\Access\AuthorizationException;
// untuk mengatasi bruteforce
use Illuminate\Cache\RateLimiter;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class SuplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages/Pembelian/Suplier/List_Suplier', [
            "type_menu" => "Suplier",
            "suplier" => Suplier::filter(request(['search']))->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(RateLimiter $limiter)
    {
        try {
            if (!in_array(auth()->user()->akses, [1, 2, 4])) {
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

            // Jika memiliki akses
            return view('pages/Pembelian/Suplier/Tambah_Suplier', [
                "type_menu" => "Suplier",
                "Suplier" => Suplier::all()
            ]);

            // Jika tidak memiliki akses
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
        $validatedData = $request->validate([
            'nama_suplier' => 'required',
            'alamat_suplier' => 'required',
            'kontak_suplier' => 'required'
        ]);
        // return ($validatedData);
        Suplier::Create($validatedData);
        return redirect('/Suplier')->with('success', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Suplier  $suplier
     * @return \Illuminate\Http\Response
     */
    public function show(Suplier $Suplier)
    {
        // return  count(MasterAccessoriesHardware::where('Suplier_Id',$Suplier->id)->get());
        // dd();
        $Kayu =  MasterKayu::where('Suplier_Id', $Suplier->id)->get();
        $Plywood_MDF = MasterPlywoodMdf::where('Suplier_Id', $Suplier->id)->get();
        $AccessoriesHardware =  MasterAccessoriesHardware::where('Suplier_Id', $Suplier->id)->get();
        $Komponen_Finishing = MasterKomponenFinishing::where('Suplier_Id', $Suplier->id)->get();
        $Pendukung_Packing =  MasterPendukungPacking::where('Suplier_Id', $Suplier->id)->get();

        return view(
            'pages.Pembelian.Suplier.Detail_Suplier',
            [
                "type_menu" => "Suplier",
                "Suplier" => $Suplier,
                "Kayu" => $Kayu,
                "Plywood_MDF" => $Plywood_MDF,
                "Accessories_Hardware" => $AccessoriesHardware,
                "Komponen_Finishing" => $Komponen_Finishing,
                "Pendukung_Packing" => $Pendukung_Packing
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Suplier  $suplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Suplier  $Suplier, RateLimiter $limiter)
    {
        // dd($Suplier);
        try {
            if (!in_array(auth()->user()->akses, [1, 2, 4])) {
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

            // Jika memiliki akses
            return view('pages/Pembelian/Suplier/Ubah_Suplier', [
                "type_menu" => "Suplier",
                'suplier' => $Suplier
            ]);

            // Jika tidak memiliki akses
        } catch (AuthorizationException $exception) {
            throw new AuthorizationException('Halaman Ini Tidak Boleh Diakses', 403);
        }
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
            'nama_suplier' => 'required',
            'alamat_suplier' => 'required',
            'kontak_suplier' => 'required',


        ]);

        // log activity

        $originalData = $Suplier->getOriginal();

        activity()
            ->causedBy(auth()->user())
            ->inLog('Suplier')
            ->performedOn($Suplier)
            ->withProperties([
                'old' => $originalData,
                'new' => $validatedData
            ])
            ->event('Update')
            ->log('This Model has been Update');


        //end log activity

        Suplier::where('id', $Suplier->id)
            ->update($validatedData);

        return redirect('/Suplier')->with('success', 'Data Telah Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Suplier  $suplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Suplier $Suplier, RateLimiter $limiter)
    {
        // return ($supliers);
        try {
            if (!in_array(auth()->user()->akses, [1, 2, 4])) {
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

            // Jika memiliki akses
            Suplier::destroy($Suplier->id);
            return redirect('/Suplier')->with('success', 'Data Berhasil Dihapus');
            // Jika tidak memiliki akses
        } catch (AuthorizationException $exception) {
            throw new AuthorizationException('Halaman Ini Tidak Boleh Diakses', 403);
        }
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
