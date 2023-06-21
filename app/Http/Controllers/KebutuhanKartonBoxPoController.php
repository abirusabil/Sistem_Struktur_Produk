<?php

namespace App\Http\Controllers;

use App\Exports\KebutuhanKartonBoxPoExport;
use App\Models\KebutuhanKartonBoxPo;
use Illuminate\Http\Request;
use Illuminate\Auth\Access\AuthorizationException;
// untuk mengatasi bruteforce
use Illuminate\Cache\RateLimiter;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class KebutuhanKartonBoxPoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    //    return KebutuhanKartonBoxPo::with('PurchaseOrder')->get();
       return view('pages.Data-Materials.Karton_Box.List_Kebutuhan_Karton_Box',
       [
        'type_menu'=>'Karton_Box',
        'KebutuhanKartonBox'=>KebutuhanKartonBoxPo::with('PurchaseOrder')->filter(request(['search']))->paginate(40)
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
     * @param  \App\Models\KebutuhanKartonBoxPo  $kebutuhanKartonBoxPo
     * @return \Illuminate\Http\Response
     */
    public function show(KebutuhanKartonBoxPo $kebutuhanKartonBoxPo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KebutuhanKartonBoxPo  $kebutuhanKartonBoxPo
     * @return \Illuminate\Http\Response
     */
    public function edit(KebutuhanKartonBoxPo $Kebutuhan_Karton_Box , RateLimiter $limiter)
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

            return view('pages.Data-Materials.Karton_Box.Edit_Kebutuhan_Karton_Box',
                [
                    'type_menu'=>'PurchaseOrder',
                    'KebutuhanKartonBox'=>$Kebutuhan_Karton_Box
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
     * @param  \App\Models\KebutuhanKartonBoxPo  $kebutuhanKartonBoxPo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KebutuhanKartonBoxPo $Kebutuhan_Karton_Box)
    {
        $validetedData = $request->validate(
            [
                'id'=>'required',
                'Job_Order'=>'required',
                'Nama_Item'=>'required',
                'Quantity_Purchase_Order'=>'required',
                'No_Cutting'=>'required',
                'Jenis_Kebutuhan_Karton_Box'=>'required',
                'Keterangan_Kebutuhan_Karton_Box_Item'=>'required',
                'Tinggi_Kebutuhan_Karton_Box_Item'=>'required',
                'Lebar_Kebutuhan_Karton_Box_Item'=>'required',
                'Panjang_Kebutuhan_Karton_Box_Item'=>'required',
                'Quantity_Kebutuhan_Karton_Box_Item'=>'required'
                
            ]
        );

        // return $validetedData;

        KebutuhanKartonBoxPo::where('id',$Kebutuhan_Karton_Box->id)->update($validetedData);
        return redirect()->route('purchase_order.detailkebutuhan', ['Purchase_Order' =>$Kebutuhan_Karton_Box->Job_Order])->with('success_karton_box', 'Data Berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KebutuhanKartonBoxPo  $kebutuhanKartonBoxPo
     * @return \Illuminate\Http\Response
     */
    public function destroy(KebutuhanKartonBoxPo $kebutuhanKartonBoxPo)
    {
        //
    }
    public function export($JobOrder)
    {
        return Excel::download(new KebutuhanKartonBoxPoExport($JobOrder), 'Kebutuhan Karton Box JO '.$JobOrder.'.xlsx');
    }
}
