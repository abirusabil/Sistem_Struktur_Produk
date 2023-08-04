<?php

namespace App\Http\Controllers;

use App\Exports\MasterPendukungPackingExport;
use App\Imports\MasterPendukungPackingImport;
use App\Models\MasterPendukungPacking;
use App\Models\Suplier;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

// untuk mengatasi bruteforce
use Illuminate\Cache\RateLimiter;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Auth\Access\AuthorizationException;


class MasterPendukungPackingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view(
            'pages.Data-Materials.Pendukung_Packing.Master_Pendukung_Packing',
            [
                'type_menu' => 'Pendukung_Packing',
                'Pendukung_Packing' => MasterPendukungPacking::with('Suplier')->filter(request(['search']))->paginate(50),
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
            if (!in_array(auth()->user()->akses, [1, 2, 4, 6])) {
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

            return view(
                'pages.Data-Materials.Pendukung_Packing.Tambah_Pendukung_Packing',
                [
                    'type_menu' => 'Pendukung_Packing',
                    'supliers' => Suplier::all()
                ]
            );

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
        $validatedData = $request->validate(
            [
                'id' => 'required',
                'Nama_Pendukung_Packing' => 'required',
                'Tebal_Pendukung_Packing' => 'required',
                'Lebar_Pendukung_Packing' => 'required',
                'Panjang_Pendukung_Packing' => 'required',
                'Satuan_Pendukung_Packing' => 'required',
                'Harga_Pendukung_Packing' => 'required',
                'Suplier_Id' => 'required',
            ],
            [
                'required' => 'Kolom Tidak Boleh Kosong',
                'unique' => 'Kode Telah Digunakan'
            ]
        );
        // return $validatedData;
        MasterPendukungPacking::create($validatedData);
        return redirect('Pendukung_Packing')->with('success', 'Data Pendukung Packing Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MasterPendukungPacking  $masterPendukungPacking
     * @return \Illuminate\Http\Response
     */
    public function show(MasterPendukungPacking $masterPendukungPacking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MasterPendukungPacking  $masterPendukungPacking
     * @return \Illuminate\Http\Response
     */
    public function edit(MasterPendukungPacking $Pendukung_Packing, RateLimiter $limiter)
    {
        try {
            if (!in_array(auth()->user()->akses, [1, 2, 4, 6])) {
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
            return  view(
                'pages.Data-Materials.Pendukung_Packing.Edit_Pendukung_Packing',
                [
                    'type_menu' => 'Pendukung_Packing',
                    'Pendukung_Packing' => $Pendukung_Packing,
                    'supliers' => Suplier::all()
                ]
            );

            // Jika tidak memiliki akses
        } catch (AuthorizationException $exception) {
            throw new AuthorizationException('Halaman Ini Tidak Boleh Diakses', 403);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MasterPendukungPacking  $masterPendukungPacking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MasterPendukungPacking $Pendukung_Packing)
    {
        $validatedData = $request->validate(
            [
                'id' => 'required',
                'Nama_Pendukung_Packing' => 'required',
                'Tebal_Pendukung_Packing' => 'required',
                'Lebar_Pendukung_Packing' => 'required',
                'Panjang_Pendukung_Packing' => 'required',
                'Satuan_Pendukung_Packing' => 'required',
                'Harga_Pendukung_Packing' => 'required',
                'Suplier_Id' => 'required',
            ],
            [
                'required' => 'Kolom Tidak Boleh Kosong',
            ]
        );
        // log activity

        $originalData = $Pendukung_Packing->getOriginal();

        activity()
            ->causedBy(auth()->user())
            ->performedOn($Pendukung_Packing)
            ->inLog('Master Pendukung Packing')
            ->withProperties([
                'old' => $originalData,
                'new' => $validatedData
            ])
            ->event('Update')
            ->log('This Model has been Update');

        //end log activity 
        // return $validatedData;
        MasterPendukungPacking::where('id', $Pendukung_Packing->id)->update($validatedData);
        return redirect('/Pendukung_Packing')->with('success', 'Data Pendukung Packing Telah Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MasterPendukungPacking  $masterPendukungPacking
     * @return \Illuminate\Http\Response
     */
    public function destroy(MasterPendukungPacking $Pendukung_Packing, RateLimiter $limiter)
    {
        try {
            if (!in_array(auth()->user()->akses, [1, 2, 4, 6])) {
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
            MasterPendukungPacking::destroy($Pendukung_Packing->id);
            return redirect('/Pendukung_Packing')->with('success', 'Data Berhasil Dihapus');
            
            // Jika tidak memiliki akses
        } catch (AuthorizationException $exception) {
            throw new AuthorizationException('Halaman Ini Tidak Boleh Diakses', 403);
        }
    }

    public function export()
    {
        return Excel::download(new MasterPendukungPackingExport, 'PendukungPacking.xlsx');
    }

    public function import(Request $request)
    {
        // Validasi file Excel
        $request->validate([
            'excel_file' => 'required|mimes:xls,xlsx'
        ]);

        // Import data dari file Excel
        $import = new MasterPendukungPackingImport();
        Excel::import($import, $request->file('excel_file'));

        // Redirect kembali ke halaman awal
        return redirect('/Pendukung_Packing')->with('success', 'Data Pendukung Packing berhasil diimport!');
    }
}
