<?php

namespace App\Http\Controllers;

use App\Exports\KebutuhanKayuPoExport;
use App\Models\KebutuhanKayuPo;
use App\Models\PurchaseOrder;
use Illuminate\Http\Request;
use Illuminate\Auth\Access\AuthorizationException;
// untuk mengatasi bruteforce
use Illuminate\Cache\RateLimiter;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class KebutuhanKayuPoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return KebutuhanKayuPo::with('PurchaseOrder')->get();
        return view('pages.Data-Materials.Kayu.List_Kebutuhan_Kayu',
        [
            "type_menu" => "Kayu" ,
            'KebutuhanKayu' => KebutuhanKayuPo::with('PurchaseOrder')->filter(request(['search']))->paginate(100),
            // 'KebutuhanKayu' => KebutuhanKayuPo::with('PurchaseOrder')->get(),
            // 'Suplier'=>Suplier::all()
        ]
    );
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
     * @param  \App\Models\KebutuhanKayuPo  $kebutuhanKayuPo
     * @return \Illuminate\Http\Response
     */
    public function show(KebutuhanKayuPo $Kebutuhan_Kayu)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KebutuhanKayuPo  $kebutuhanKayuPo
     * @return \Illuminate\Http\Response
     */
    public function edit(KebutuhanKayuPo $Kebutuhan_Kayu , RateLimiter $limiter)
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

            return view('pages.Data-Materials.Kayu.Edit_Kebutuhan_Kayu',
                [
                    'type_menu'=>'PurchaseOrder',
                    'KebutuhanKayu'=>$Kebutuhan_Kayu
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
     * @param  \App\Models\KebutuhanKayuPo  $kebutuhanKayuPo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KebutuhanKayuPo $Kebutuhan_Kayu)
    {
        $validatedData = $request->validate(
            [
                'id'=>'required',
                'Job_Order'=>'required',
                'Nama_Item'=>'required',
                'Quantity_Purchase_Order'=>'required',
                'No_Cutting'=>'required',
                'Kayu_Id'=>'required',
                'Nama_Kayu'=>'required',
                'KP_Kebutuhan_Kayu_Item'=>'required',
                'Keterangan_Kebutuhan_Kayu_Item'=>'required',
                'Grade_Kebutuhan_Kayu_Item'=>'required',
                'Tebal_Kebutuhan_Kayu_Item'=>'required',
                'Lebar_Kebutuhan_Kayu_Item'=>'required',
                'Panjang_Kebutuhan_Kayu_Item'=>'required',
                'Quantity_Kebutuhan_Kayu_Item'=>'required'
            ],
            [
                'required' => 'Kolom Tidak Boleh Kosong'
            ]
        );
        $validatedData2 = $request->validate(
            [
                'Harga_Kayu'=>'required',
            ],
            [
                'required' => 'Kolom Tidak Boleh Kosong'
            ]
        );
         // log activity

         $originalData = $Kebutuhan_Kayu->getOriginal();

         activity()
             ->causedBy(auth()->user())
             ->performedOn($Kebutuhan_Kayu)
             ->inLog('Kebutuhan Kayu PO')
             ->withProperties([
                 'old' => $originalData,
                 'new' => array_merge($validatedData, $validatedData2)
                 ])
             ->event('Update')
             ->log('This Model has been Update');
 
        //end log activity
        KebutuhanKayuPo::where(
            [
                ['Kayu_Id', $Kebutuhan_Kayu->Kayu_Id],
                ['Job_Order',$Kebutuhan_Kayu->Job_Order]
            ]
        )->update($validatedData2);
        KebutuhanKayuPo::where('id', $Kebutuhan_Kayu->id)->update($validatedData);
        return redirect()->route('purchase_order.detailkebutuhan', ['Purchase_Order' => $Kebutuhan_Kayu->Job_Order])->with('success_kayu', 'Data Berhasil diubah');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KebutuhanKayuPo  $kebutuhanKayuPo
     * @return \Illuminate\Http\Response
     */
    public function destroy(KebutuhanKayuPo $kebutuhanKayuPo)
    {
        //
    }

    public function export($JobOrder)
    {
        
        return Excel::download(new KebutuhanKayuPoExport($JobOrder), 'Kebutuhan Kayu JO '.$JobOrder.'.xlsx');
    }
}
