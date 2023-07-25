<?php

namespace App\Http\Controllers;

use App\Exports\KebutuhanPlywoodMdfPoExport;
use App\Models\KebutuhanPlywoodMdfPo;
use Illuminate\Http\Request;
use Illuminate\Auth\Access\AuthorizationException;
// untuk mengatasi bruteforce
use Illuminate\Cache\RateLimiter;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class KebutuhanPlywoodMdfPoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return KebutuhanPlywoodMdfPo::with('PurchaseOrder')->get();
        return view('pages.Data-Materials.Plywood_MDF.List_Kebutuhan_Plywood_Mdf',
            [
                "type_menu" => "Plywood_MDF" ,
                // 'KebutuhanPlywoodMdf' => KebutuhanPlywoodMdfPo::with('PurchaseOrder')->filter(request(['search']))->paginate(40),
                'KebutuhanPlywoodMdf' => KebutuhanPlywoodMdfPo::with('PurchaseOrder')->filter(request(['search']))->paginate(40)
                
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
     * @param  \App\Models\KebutuhanPlywoodMdfPo  $kebutuhanPlywoodMdfPo
     * @return \Illuminate\Http\Response
     */
    public function show(KebutuhanPlywoodMdfPo $kebutuhanPlywoodMdfPo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KebutuhanPlywoodMdfPo  $kebutuhanPlywoodMdfPo
     * @return \Illuminate\Http\Response
     */
    public function edit(KebutuhanPlywoodMdfPo $Kebutuhan_Plywood_MDF , RateLimiter $limiter)
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

            return view('pages.Data-Materials.Plywood_MDF.Edit_Kebutuhan_Plywood_MDF',
                [
                    'type_menu'=>'PurchaseOrder',
                    'KebutuhanPlywoodMDF'=>$Kebutuhan_Plywood_MDF
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
     * @param  \App\Models\KebutuhanPlywoodMdfPo  $kebutuhanPlywoodMdfPo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KebutuhanPlywoodMdfPo $Kebutuhan_Plywood_MDF)
    {
        
        $validatedData = $request->validate(
            [
                        'id' => 'required',
                        'Job_Order' => 'required',
                        'Nama_Item' => 'required',
                        'Quantity_Purchase_Order' => 'required',
                        'No_Cutting' => 'required',
                        'Plywood_MDF_Id' => 'required',
                        'Nama_Plywood_MDF' => 'required',
                        'KP_Kebutuhan_Plywood_MDF_Item' => 'required',
                        'Keterangan_Kebutuhan_Plywood_MDF_Item' => 'required',
                        'Grade_Kebutuhan_Plywood_MDF_Item' => 'required',
                        'Tebal_Plywood_MDF' => 'required',
                        'Lebar_Kebutuhan_Plywood_MDF_Item' => 'required',
                        'Panjang_Kebutuhan_Plywood_MDF_Item' => 'required',
                        'Quantity_Kebutuhan_Plywood_MDF_Item' => 'required',
                        'Luas_Plywood_MDF' => 'required',
            ],
            [
                        'require'=>'Kolom Tidak Boleng Kosong'
            ]
        );
        $validatedData2 = $request->validate(
            [
                        'Harga_Plywood_MDF' => 'required',
            ],
            [
                        'require'=>'Kolom Tidak Boleng Kosong'
            ]
        );

         // log activity

         $originalData = $Kebutuhan_Plywood_MDF->getOriginal();

         activity()
             ->causedBy(auth()->user())
             ->performedOn($Kebutuhan_Plywood_MDF)
             ->inLog('Kebutuhan Plywood MDF PO')
             ->withProperties([
                 'old' => $originalData,
                 'new' => array_merge($validatedData, $validatedData2)
                 ])
             ->event('Update')
             ->log('This Model has been Update');
 
         //end log activity

        // return $validatedData2;
        KebutuhanPlywoodMdfPo::where(
            [
                ['Plywood_MDF_Id', $Kebutuhan_Plywood_MDF->Plywood_MDF_Id],
                ['Job_Order',$Kebutuhan_Plywood_MDF->Job_Order]
            ]
        )->update($validatedData2);
        KebutuhanPlywoodMdfPo::where('id', $Kebutuhan_Plywood_MDF->id)->update($validatedData);
        return redirect()->route('purchase_order.detailkebutuhan', ['Purchase_Order' => $Kebutuhan_Plywood_MDF->Job_Order])->with('success_plywood_mdf', 'Data Berhasil diubah');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KebutuhanPlywoodMdfPo  $kebutuhanPlywoodMdfPo
     * @return \Illuminate\Http\Response
     */
    public function destroy(KebutuhanPlywoodMdfPo $kebutuhanPlywoodMdfPo)
    {
        //
    }
    public function export($JobOrder)
    {
        
        return Excel::download(new KebutuhanPlywoodMdfPoExport($JobOrder), 'Kebutuhan Plywood MDF JO '.$JobOrder.'.xlsx');
    }
}
