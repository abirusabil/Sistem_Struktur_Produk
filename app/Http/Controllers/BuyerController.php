<?php

namespace App\Http\Controllers;

use App\Exports\BuyerExport;
use App\Imports\BuyerImport;
use App\Models\Buyer;
use App\Models\Collection;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

// untuk mengatasi bruteforce
use Illuminate\Cache\RateLimiter;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Auth\Access\AuthorizationException;


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

            return view('pages/Data_Barang/Buyer/Tambah_Buyer',
                [ 'type_menu'=>'Buyer']
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
    public function show(Buyer $Buyer)
    {
        
        return view('pages.Data_Barang.Buyer.Detail_Buyer',
                [
                    'type_menu' => "Buyer",
                    'Buyer' => $Buyer,
                    'Collection'=> Collection::where('Buyer_Id',$Buyer->id)->get()
                ]
        );
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
         // log activity

         $originalData = $Buyer->getOriginal();

         activity()
             ->causedBy(auth()->user())
             ->performedOn($Buyer)
             ->inLog('Buyer')
             ->withProperties([
                 'old' => $originalData,
                 'new' => $validatedData
                 ])
             ->event('Update')
             ->log('This Model has been Update');
 
         //end log activity
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
