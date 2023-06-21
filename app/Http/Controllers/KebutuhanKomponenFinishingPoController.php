<?php

namespace App\Http\Controllers;

use App\Exports\KebutuhanKomponenFinishingPoExport;
use App\Models\KebutuhanKomponenFinishingPo;
use Illuminate\Http\Request;
use Illuminate\Auth\Access\AuthorizationException;
// untuk mengatasi bruteforce
use Illuminate\Cache\RateLimiter;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class KebutuhanKomponenFinishingPoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return KebutuhanKomponenFinishingPo::with('PurchaseOrder')->get();
        return view('pages.Data-Materials.Komponen_Finishing.List_Kebutuhan_Komponen_finishing' , 
        [
            'type_menu'=>'Komponen_Finishing',
            'KebutuhanKomponenFinishing'=>KebutuhanKomponenFinishingPo::with('PurchaseOrder')->filter(request(['search']))->paginate(40)
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
     * @param  \App\Models\KebutuhanKomponenFinishingPo  $kebutuhanKomponenFinishingPo
     * @return \Illuminate\Http\Response
     */
    public function show(KebutuhanKomponenFinishingPo $kebutuhanKomponenFinishingPo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KebutuhanKomponenFinishingPo  $kebutuhanKomponenFinishingPo
     * @return \Illuminate\Http\Response
     */
    public function edit(KebutuhanKomponenFinishingPo $Kebutuhan_Komponen_Finishing , RateLimiter $limiter)
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

            return view('pages.Data-Materials.Komponen_Finishing.Edit_Kebutuhan_Komponen_Finishing',
                [
                    'type_menu'=>'PurchaseOrder',
                    'KebutuhanKomponenFinishing'=>$Kebutuhan_Komponen_Finishing
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
     * @param  \App\Models\KebutuhanKomponenFinishingPo  $kebutuhanKomponenFinishingPo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KebutuhanKomponenFinishingPo $Kebutuhan_Komponen_Finishing)
    {
        $validatedData = $request->validate(
            [
                'id'=>'required',
                'Job_Order'=>'required',
                'Nama_Item'=>'required',
                'Quantity_Purchase_Order'=>'required',
                'No_Cutting'=>'required',
                'Komponen_Finishing_Id'=>'required',
                'Nama_Komponen_Finishing'=>'required',
                'Quantity_Kebutuhan_Komponen_Finishing_Item'=>'required'
            ],
            [
                'required'=>'Kolom Tidak Boleh Kosong'
            ]
        );
        $validatedData2 = $request->validate(
            [                
                'Harga_Komponen_Finishing'=>'required'
            ],
            [
                'required'=>'Kolom Tidak Boleh Kosong'
            ]
        );
        KebutuhanKomponenFinishingPo::where(
            [
                ['Komponen_Finishing_Id',$Kebutuhan_Komponen_Finishing->Komponen_Finishing_Id],
                ['Job_Order',$Kebutuhan_Komponen_Finishing->Job_Order]
            ]
        )->update($validatedData2);
        KebutuhanKomponenFinishingPo::where('id',$Kebutuhan_Komponen_Finishing->id)->update($validatedData);
        return redirect()->route('purchase_order.detailkebutuhan', ['Purchase_Order' =>$Kebutuhan_Komponen_Finishing->Job_Order])->with('success_komponen_finishing', 'Data Berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KebutuhanKomponenFinishingPo  $kebutuhanKomponenFinishingPo
     * @return \Illuminate\Http\Response
     */
    public function destroy(KebutuhanKomponenFinishingPo $kebutuhanKomponenFinishingPo)
    {
        //
    }
    public function export($JobOrder)
    {
        return Excel::download(new KebutuhanKomponenFinishingPoExport($JobOrder), 'Kebutuhan Komponen Finishing JO '.$JobOrder.'.xlsx');
    }
}
