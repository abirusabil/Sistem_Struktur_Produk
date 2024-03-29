<?php

namespace App\Http\Controllers;

use App\Exports\CollectionExport;
use App\Imports\CollectionImport;
use App\Models\Buyer;
use App\Models\Collection;
use App\Models\Item;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

// untuk mengatasi bruteforce
use Illuminate\Cache\RateLimiter;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Auth\Access\AuthorizationException;

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
        return view(
            'pages.Data_Barang.Collection.Master_Collection',
            [
                'type_menu' => 'Collection',
                'Collection' => Collection::with('Buyer')->filter(request(['search']))->paginate(10)
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
            if (!in_array(auth()->user()->akses, [1, 2, 3, 6])) {
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
                'pages.Data_Barang.Collection.Tambah_Collection',
                [
                    'type_menu' => 'Collection',
                    'buyers' => Buyer::all()
                ]
            );

            // Jika tidak memimiliki akses
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
                'Nama_Collection' => 'required',
                'Buyer_Id' => 'required'
            ],
            [
                'required' => 'Kolom Tidak Boleh Kosong'
            ]
        );
        // return $validatedData;
        Collection::create($validatedData);
        return redirect('/Collection')->with('success', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Collection  $collection
     * @return \Illuminate\Http\Response
     */
    public function show(Collection $Collection)
    {
        return view(
            'pages.Data_Barang.Collection.Detail_Collection',
            [
                'type_menu' => 'Collection',
                'Collection' => $Collection,
                'items' => Item::where('Collection_Id', $Collection->id)->get()
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Collection  $collection
     * @return \Illuminate\Http\Response
     */
    public function edit(Collection $Collection,RateLimiter $limiter)
    {
        try {
            if (!in_array(auth()->user()->akses, [1, 2, 3, 6])) {
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

            return view('pages.Data_Barang.Collection.Edit_Collection', [
                'type_menu' => 'Collection',
                'Collection' => $Collection,
                'buyers' => Buyer::all()
            ]);

            // Jika tidak memimiliki akses
        } catch (AuthorizationException $exception) {
            throw new AuthorizationException('Halaman Ini Tidak Boleh Diakses', 403);
        }
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
                'id' => 'required|unique:collections',
                'Nama_Collection' => 'required',
                'Buyer_Id' => 'required'
            ],
            [
                'required' => 'Kolom Tidak Boleh Kosong',
                'unique' => 'Kode Telah Digunakan , Silahkan Gunakan Kode Lain'
            ]
        );
        // log activity

        $originalData = $Collection->getOriginal();

        activity()
            ->causedBy(auth()->user())
            ->performedOn($Collection)
            ->inLog('Collection')
            ->withProperties([
                'old' => $originalData,
                'new' => $validatedData
            ])
            ->event('Update')
            ->log('This Model has been Update');

        //end log activity
        // return $validatedData;
        Collection::where('id', $Collection->id)->update($validatedData);
        return redirect('/Collection')->with('success', 'Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Collection  $collection
     * @return \Illuminate\Http\Response
     */
    public function destroy(Collection $Collection ,RateLimiter $limiter)
    {
        try {
            if (!in_array(auth()->user()->akses, [1, 2, 3, 6])) {
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

            Collection::destroy($Collection->id);
            return redirect('/Collection')->with('success', 'Data Berhasil Dihapus');
            
            // Jika tidak memimiliki akses
        } catch (AuthorizationException $exception) {
            throw new AuthorizationException('Halaman Ini Tidak Boleh Diakses', 403);
        }
    }

    public function export()
    {
        // return Collection::with('buyer')->get();
        return Excel::download(new CollectionExport, 'Collection.xlsx');
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
