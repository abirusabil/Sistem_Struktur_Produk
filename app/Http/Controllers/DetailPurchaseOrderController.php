<?php

namespace App\Http\Controllers;

use App\Models\DetailPurchaseOrder;
use App\Models\Item;
use Illuminate\Http\Request;

class DetailPurchaseOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // return $request;
        // return Item::with('Collection')->get();
        // return ;
        return view('pages.Purchase_order.Tambah_Detail_PurchaseOrder',
        [
            'type_menu' => 'PurchaseOrder',
            'Items'=>Item::whereHas('Collection', function ($query) use ($request) {
                $query->where('Buyer_Id', $request->buyer_id);
            })
            ->with('Collection')
            ->get(),
            'loop_count' => $request->loop_count,
            'job_order'=>$request->id
        ]
    );
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
                'Job_Order.*'=>'required',
                'Item_Id.*'=>'required',
                'Quantity_Purchase_Order.*'=>'required',
                
            ],[
                'required'=>'Kolom Tidak Boleh Kosong',
                'unique'=>'Kode Telah Digunakan Silahkan Gunakan Kode Lain'
            ]
            );
            return $validatedData;
            // return $request->input('Item_Id.0');
            for ($i = 0; $i < count($request->Tinggi_Kebutuhan_Karton_Box_Item); $i++) {
                DetailPurchaseOrder::create([
                    'id' => $validatedData['id'][$i],
                    'Item_Id' => $validatedData['Item_Id'][$i],
                    'Jenis_Kebutuhan_Karton_Box' => $validatedData['Jenis_Kebutuhan_Karton_Box'][$i],
                    
                ]);
            }
            return redirect("/Item/{$request->input('Item_Id.0')}")->with('success_karton_box', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DetailPurchaseOrder  $detailPurchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function show(DetailPurchaseOrder $detailPurchaseOrder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DetailPurchaseOrder  $detailPurchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function edit(DetailPurchaseOrder $detailPurchaseOrder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DetailPurchaseOrder  $detailPurchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DetailPurchaseOrder $detailPurchaseOrder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DetailPurchaseOrder  $detailPurchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy(DetailPurchaseOrder $detailPurchaseOrder)
    {
        //
    }
}
