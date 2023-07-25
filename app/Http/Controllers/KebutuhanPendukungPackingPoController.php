<?php

namespace App\Http\Controllers;

use App\Exports\KebutuhanPendukungPackingPoExport;
use App\Models\KebutuhanPendukungPackingPo;
use Illuminate\Http\Request;
use Illuminate\Auth\Access\AuthorizationException;
// untuk mengatasi bruteforce
use Illuminate\Cache\RateLimiter;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;


class KebutuhanPendukungPackingPoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return KebutuhanPendukungPackingPo::with('PurchaseOrder')->get();
        return view('pages.Data-Materials.Pendukung_Packing.List_Kebutuhan_Pendukung_Packing',[
            'type_menu'=>'Pendukung_Packing',
            'KebutuhanPendukungPacking'=>KebutuhanPendukungPackingPo::with('PurchaseOrder')->filter(request(['search']))->paginate(40)
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
     * @param  \App\Models\KebutuhanPendukungPackingPo  $kebutuhanPendukungPackingPo
     * @return \Illuminate\Http\Response
     */
    public function show(KebutuhanPendukungPackingPo $kebutuhanPendukungPackingPo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KebutuhanPendukungPackingPo  $kebutuhanPendukungPackingPo
     * @return \Illuminate\Http\Response
     */
    public function edit(KebutuhanPendukungPackingPo $Kebutuhan_Pendukung_Packing , RateLimiter $limiter)
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

            return view('pages.Data-Materials.Pendukung_Packing.Edit_Kebutuhan_Pendukung_Packing',
                [
                    'type_menu'=>'PurchaseOrder',
                    'KebutuhaPendukungPacking'=>$Kebutuhan_Pendukung_Packing
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
     * @param  \App\Models\KebutuhanPendukungPackingPo  $kebutuhanPendukungPackingPo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KebutuhanPendukungPackingPo $Kebutuhan_Pendukung_Packing)
    {
        $validatedData = $request->validate(
            [
                'id'=>'required',
                'Job_Order'=>'required',
                'Nama_Item'=>'required',
                'Quantity_Purchase_Order'=>'required',
                'No_Cutting'=>'required',
                'Pendukung_Packing_Id'=>'required',
                'Nama_Pendukung_Packing'=>'required',
                'Lebar_Kebutuhan_Pendukung_Packing_Item'=>'',
                'Panjang_Kebutuhan_Pendukung_Packing_Item'=>'',
                'Keterangan_Kebutuhan_Pendukung_Packing_Item'=>'',
                'Quantity_Kebutuhan_Pendukung_Packing_Item'=>'required',
                'Tebal_Pendukung_Packing'=>'',
                'Harga_Pendukung_Packing'=>'required'
            ]
        );
        $validatedData2 = $request->validate(
            [
                'Harga_Pendukung_Packing'=>'required'
            ]
        );
        KebutuhanPendukungPackingPo::where([ 
            ['Pendukung_Packing_Id',$Kebutuhan_Pendukung_Packing->Pendukung_Packing_Id],
            ['Job_Order',$Kebutuhan_Pendukung_Packing->Job_Order]
        ])->update($validatedData2);
        // log activity

        $originalData = $Kebutuhan_Pendukung_Packing->getOriginal();

        activity()
            ->causedBy(auth()->user())
            ->performedOn($Kebutuhan_Pendukung_Packing)
            ->inLog('Kebutuhan Pendukung Packing PO')
            ->withProperties([
                'old' => $originalData,
                'new' => array_merge($validatedData, $validatedData2)
                ])
            ->event('Update')
            ->log('This Model has been Update');

        //end log activity
        KebutuhanPendukungPackingPo::where('id',$Kebutuhan_Pendukung_Packing->id)->update($validatedData);
        return redirect()->route('purchase_order.detailkebutuhan', ['Purchase_Order' =>$Kebutuhan_Pendukung_Packing->Job_Order])->with('success_pendukung_packing', 'Data Berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KebutuhanPendukungPackingPo  $kebutuhanPendukungPackingPo
     * @return \Illuminate\Http\Response
     */
    public function destroy(KebutuhanPendukungPackingPo $kebutuhanPendukungPackingPo)
    {
        //
    }
    public function export($JobOrder)
    {
        return Excel::download(new KebutuhanPendukungPackingPoExport($JobOrder), 'Kebutuhan Pendukung Packing JO '.$JobOrder.'.xlsx');
    }
}
