<?php

namespace App\Http\Controllers;

use App\Models\MasterAccessoriesHardware;
use App\Models\Suplier;
use App\Exports\MasterAccessoriesHardwareExport;
use App\Imports\MasterAccessoriesHardwareImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

// untuk mengatasi bruteforce
use Illuminate\Cache\RateLimiter;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Auth\Access\AuthorizationException;

class MasterAccessoriesHardwareController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view(
            'pages.Data-Materials.Accessories_Hardware.Master_Accessories_Hardware',
            [
                'type_menu' => 'Accessories_Hardware',
                'AccessoriesHardware' => MasterAccessoriesHardware::with('Suplier')->filter(request(['search']))->paginate(50),
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
                'pages.Data-Materials.Accessories_Hardware.Tambah_Accessories_Hardware',
                [
                    'type_menu' => 'Accessories_Hardware',
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
                'id' => 'required|unique:master_accessories_hardware',
                'Nama_Accessories_Hardware' => 'required',
                'Ukuran_Accessories_Hardware' => 'required',
                'Satuan_Accessories_Hardware' => 'required',
                'Harga_Accessories_Hardware' => 'required',
                'Suplier_Id' => 'required',
            ],
            [
                'required' => 'Kolom tidak boleh kosong',
                'unique' => 'Kode sudah digunakan , Silahkan Gunakan Kode Lain'
            ]
        );
        // return $validatedData;
        MasterAccessoriesHardware::create($validatedData);
        return redirect('/Accessories_Hardware')->with('success', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MasterAccessoriesHardware  $masterAccessoriesHardware
     * @return \Illuminate\Http\Response
     */
    public function show(MasterAccessoriesHardware $masterAccessoriesHardware)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MasterAccessoriesHardware  $masterAccessoriesHardware
     * @return \Illuminate\Http\Response
     */
    public function edit(MasterAccessoriesHardware $Accessories_Hardware, RateLimiter $limiter)
    {
        // return $Accessories_Hardware;
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
            return view('pages.Data-Materials.Accessories_Hardware.Edit_Accessories_Hardware', [
                'type_menu' => 'Accessories_Hardware',
                'Accessories_Hardware' => $Accessories_Hardware,
                'supliers' => Suplier::all()
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
     * @param  \App\Models\MasterAccessoriesHardware  $masterAccessoriesHardware
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MasterAccessoriesHardware $Accessories_Hardware)
    {
        $validatedData = $request->validate(
            [
                'id' => 'required',
                'Nama_Accessories_Hardware' => 'required',
                'Ukuran_Accessories_Hardware' => 'required',
                'Satuan_Accessories_Hardware' => 'required',
                'Harga_Accessories_Hardware' => 'required',
                'Suplier_Id' => 'required',
            ],
            [
                'required' => 'Kolom tidak boleh kosong',
                'unique' => 'Data sudah digunakan'
            ]
        );
        // log activity

        $originalData = $Accessories_Hardware->getOriginal();

        activity()
            ->causedBy(auth()->user())
            ->performedOn($Accessories_Hardware)
            ->inLog('Master Accessories Hardware')
            ->withProperties([
                'old' => $originalData,
                'new' => $validatedData
            ])
            ->event('Update')
            ->log('This Model has been Update');

        //end log activity  
        // return $validatedData;
        MasterAccessoriesHardware::where('id', $Accessories_Hardware->id)
            ->update($validatedData);
        return redirect('/Accessories_Hardware')->with('success', 'Data Berhasil Ditambahkan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MasterAccessoriesHardware  $masterAccessoriesHardware
     * @return \Illuminate\Http\Response
     */
    public function destroy(MasterAccessoriesHardware $Accessories_Hardware, RateLimiter $limiter)
    {
        // return $Accessories_Hardware;
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
            MasterAccessoriesHardware::destroy($Accessories_Hardware->id);
            return redirect('Accessories_Hardware')->with('success', 'Data Berhasil Dihapus');
            
            // Jika tidak memiliki akses 
        } catch (AuthorizationException $exception) {
            throw new AuthorizationException('Halaman Ini Tidak Boleh Diakses', 403);
        }
    }

    public function export()
    {

        return Excel::download(new MasterAccessoriesHardwareExport, 'Master_Accessories_Hardware.xlsx');
    }

    public function import(Request $request)
    {
        // Validasi file Excel
        $request->validate([
            'excel_file' => 'required|mimes:xls,xlsx'
        ]);

        // Import data dari file Excel
        $import = new MasterAccessoriesHardwareImport();
        Excel::import($import, $request->file('excel_file'));

        // Redirect kembali ke halaman awal
        return redirect('/Accessories_Hardware')->with('success', 'Data Suplier berhasil diimport!');
    }
}
