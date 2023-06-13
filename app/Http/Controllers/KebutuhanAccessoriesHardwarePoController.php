<?php

namespace App\Http\Controllers;

use App\Exports\KebutuhanAccessoriesHardwarePoExport;
use App\Models\KebutuhanAccessoriesHardwarePo;
use Illuminate\Http\Request;
use Illuminate\Auth\Access\AuthorizationException;
// untuk mengatasi bruteforce
use Illuminate\Cache\RateLimiter;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class KebutuhanAccessoriesHardwarePoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return KebutuhanAccessoriesHardwarePo::with('PurchaseOrder')->get();
        return view('pages.Data-Materials.Accessories_Hardware.List_Kebutuhan_Accessories_Hardware',[
            'type_menu'=>'Accessories_Hardware',
            'KebutuhanAccessoriesHardware'=> KebutuhanAccessoriesHardwarePo::with('PurchaseOrder')->filter(request(['search']))->paginate(40)
           ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\KebutuhanAccessoriesHardwarePo  $kebutuhanAccessoriesHardwarePo
     * @return \Illuminate\Http\Response
     */
    public function show(KebutuhanAccessoriesHardwarePo $kebutuhanAccessoriesHardwarePo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KebutuhanAccessoriesHardwarePo  $kebutuhanAccessoriesHardwarePo
     * @return \Illuminate\Http\Response
     */
    public function edit(KebutuhanAccessoriesHardwarePo $Kebutuhan_Accessories_Hardware , RateLimiter $limiter)
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
            
            // jika memiliki Akses

            return view('pages.Data-Materials.Accessories_Hardware.Edit_Kebutuhan_Accessories_Hardware',
                [
                    'type_menu'=>'Purchase_Order',
                    'KebutuhanAccessoriesHardware'=>$Kebutuhan_Accessories_Hardware
                ]
            );  

        } catch (AuthorizationException $exception) {
            throw new AuthorizationException('Halaman Ini Tidak Boleh Diakses', 403);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\KebutuhanAccessoriesHardwarePo  $kebutuhanAccessoriesHardwarePo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KebutuhanAccessoriesHardwarePo $Kebutuhan_Accessories_Hardware)
    {
        $validatedData = $request->validate(
            [
                'id'=>'required',
                'Job_Order'=>'required',
                'Nama_Item'=>'required',
                'Quantity_Purchase_Order'=>'required',
                'No_Cutting'=>'required',
                'Accessories_Hardware_Id'=>'required',
                'Nama_Accessories_Hardware'=>'required',
                'Keterangan_Kebutuhan_Accessories_Hardware_Item'=>'required',
                'Ukuran_Accessories_Hardware'=>'required',
                'Quantity_Kebutuhan_Accessories_Hardware_Item'=>'required',
            ],
            [
                'required'=>'Kolom Tidak Boleh Kosong',
            ]
        );
        $validatedData2 = $request->validate(
            [
                'Harga_Accessories_Hardware'=>'required'
            ],
            [
                'required'=>'Kolom Tidak Boleh Kosong',
            ]
        );
        KebutuhanAccessoriesHardwarePo::where(
            [
                ['Accessories_Hardware_Id', $Kebutuhan_Accessories_Hardware->Accessories_Hardware_Id],
                ['Job_Order',$Kebutuhan_Accessories_Hardware->Job_Order]
            ]
        )->update($validatedData2);
        KebutuhanAccessoriesHardwarePo::where('id', $Kebutuhan_Accessories_Hardware->id)->update($validatedData);
        return redirect()->route('purchase_order.detailkebutuhan', ['Purchase_Order' => $Kebutuhan_Accessories_Hardware->Job_Order])->with('success_accessories_hardware', 'Data Berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KebutuhanAccessoriesHardwarePo  $kebutuhanAccessoriesHardwarePo
     * @return \Illuminate\Http\Response
     */
    public function destroy(KebutuhanAccessoriesHardwarePo $kebutuhanAccessoriesHardwarePo)
    {
        //
    }
    public function export($JobOrder)
    {
        
        return Excel::download(new KebutuhanAccessoriesHardwarePoExport($JobOrder), 'Kebutuhan Accessories Hardware JO '.$JobOrder.'.xlsx');
    }
}
