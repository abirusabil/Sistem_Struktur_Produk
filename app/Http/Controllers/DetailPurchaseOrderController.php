<?php

namespace App\Http\Controllers;

use App\Models\BoronganDalamPo;
use App\Models\BoronganLuarPo;
use App\Models\DetailPurchaseOrder;
use App\Models\Item;
use App\Models\KebutuhanAccessoriesHardwarePo;
use App\Models\KebutuhanKartonBoxPo;
use App\Models\KebutuhanKayuPo;
use App\Models\KebutuhanKomponenFinishingPo;
use App\Models\KebutuhanPendukungPackingPo;
use App\Models\KebutuhanPlywoodMdfPo;
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
        return view('pages.Purchase_order.Detail_Purchase_Order.Tambah_Detail_Purchase_Order',
        [
            'type_menu' => 'PurchaseOrder',
            'Items'=>Item::whereHas('Collection', function ($query) use ($request) {
                $query->where('Buyer_Id', $request->buyer_id);
            })
            ->with('Collection')
            ->get(),
            'loop_count' => $request->loop_count,
            'job_order'=>$request->id,
            ''
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
            // return $validatedData;
            // return $request->input('Item_Id.0');
            for ($i = 0; $i < count($request->Quantity_Purchase_Order); $i++) {
                DetailPurchaseOrder::create([
                    'Job_Order' => $validatedData['Job_Order'][$i],
                    'Item_Id' => $validatedData['Item_Id'][$i],
                    'Quantity_Purchase_Order' => $validatedData['Quantity_Purchase_Order'][$i],
                ]);
            }
            return redirect("/Purchase_Order/{$request->input('Job_Order.0')}")->with('success', 'Data Berhasil Ditambahkan');
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
    public function edit(DetailPurchaseOrder $Detail_Purchase_Order)
    {
        // return $Detail_Purchase_Order;
        return view('pages.Purchase_order.Detail_Purchase_Order.Edit_Detail_Purchase_Order',
        [
            'type_menu' => 'PurchaseOrder',
                'Detail_Purchase_Order' => $Detail_Purchase_Order,
                'Items' => Item::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DetailPurchaseOrder  $detailPurchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DetailPurchaseOrder $Detail_Purchase_Order)
    {
        $validatedData = $request->validate(
            [
                'Quantity_Purchase_Order'=>'required',
                
            ],[
                'required'=>'Kolom Tidak Boleh Kosong',
                'unique'=>'Kode Telah Digunakan Silahkan Gunakan Kode Lain'
            ]
        );
        // log activity

        $originalData = $Detail_Purchase_Order->getOriginal();

        activity()
            ->causedBy(auth()->user())
            ->performedOn($Detail_Purchase_Order)
            ->inLog('Detail Purchase Order')
            ->withProperties([
                'old' => $originalData,
                'new' => $validatedData
                ])
            ->event('Update')
            ->log('This Model has been Update');

        //end log activity
        // return $validatedData;
        DetailPurchaseOrder::where('id', $Detail_Purchase_Order->id)->update($validatedData);
        KebutuhanKayuPo::where(
            [
                ['Item_Id', $Detail_Purchase_Order->Item_Id],
                ['Job_Order',$Detail_Purchase_Order->Job_Order]
            ]
        )->update($validatedData);
        KebutuhanPlywoodMdfPo::where(
            [
                ['Item_Id', $Detail_Purchase_Order->Item_Id],
                ['Job_Order',$Detail_Purchase_Order->Job_Order]
            ]
        )->update($validatedData);
        KebutuhanAccessoriesHardwarePo::where(
            [
                ['Item_Id', $Detail_Purchase_Order->Item_Id],
                ['Job_Order',$Detail_Purchase_Order->Job_Order]
            ]
        )->update($validatedData);
        KebutuhanKomponenFinishingPo::where(
            [
                ['Item_Id', $Detail_Purchase_Order->Item_Id],
                ['Job_Order',$Detail_Purchase_Order->Job_Order]
            ]
        )->update($validatedData);
        KebutuhanPendukungPackingPo::where(
            [
                ['Item_Id', $Detail_Purchase_Order->Item_Id],
                ['Job_Order',$Detail_Purchase_Order->Job_Order]
            ]
        )->update($validatedData);
        KebutuhanKartonBoxPo::where(
            [
                ['Item_Id', $Detail_Purchase_Order->Item_Id],
                ['Job_Order',$Detail_Purchase_Order->Job_Order]
            ]
        )->update($validatedData);
        BoronganDalamPo::where(
            [
                ['Item_Id', $Detail_Purchase_Order->Item_Id],
                ['Job_Order',$Detail_Purchase_Order->Job_Order]
            ]
        )->update($validatedData);
        BoronganLuarPo::where(
            [
                ['Item_Id', $Detail_Purchase_Order->Item_Id],
                ['Job_Order',$Detail_Purchase_Order->Job_Order]
            ]
        )->update($validatedData);
        return redirect("/Purchase_Order/$Detail_Purchase_Order->Job_Order")->with('success', 'Data Berhasil Dihapus');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DetailPurchaseOrder  $detailPurchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy(DetailPurchaseOrder $Detail_Purchase_Order)
    {
        // return $Detail_Purchase_Order;
        DetailPurchaseOrder::destroy($Detail_Purchase_Order->id);
        KebutuhanKayuPo::where(
            [
                ['Item_Id', $Detail_Purchase_Order->Item_Id],
                ['Job_Order',$Detail_Purchase_Order->Job_Order]
            ]
        )->delete();
        KebutuhanPlywoodMdfPo::where(
            [
                ['Item_Id', $Detail_Purchase_Order->Item_Id],
                ['Job_Order',$Detail_Purchase_Order->Job_Order]
            ]
        )->delete();
        KebutuhanAccessoriesHardwarePo::where(
            [
                ['Item_Id', $Detail_Purchase_Order->Item_Id],
                ['Job_Order',$Detail_Purchase_Order->Job_Order]
            ]
        )->delete();
        KebutuhanKomponenFinishingPo::where(
            [
                ['Item_Id', $Detail_Purchase_Order->Item_Id],
                ['Job_Order',$Detail_Purchase_Order->Job_Order]
            ]
        )->delete();
        KebutuhanPendukungPackingPo::where(
            [
                ['Item_Id', $Detail_Purchase_Order->Item_Id],
                ['Job_Order',$Detail_Purchase_Order->Job_Order]
            ]
        )->delete();
        KebutuhanKartonBoxPo::where(
            [
                ['Item_Id', $Detail_Purchase_Order->Item_Id],
                ['Job_Order',$Detail_Purchase_Order->Job_Order]
            ]
        )->delete();
        BoronganDalamPo::where(
            [
                ['Item_Id', $Detail_Purchase_Order->Item_Id],
                ['Job_Order',$Detail_Purchase_Order->Job_Order]
            ]
        )->delete();
        BoronganLuarPo::where(
            [
                ['Item_Id', $Detail_Purchase_Order->Item_Id],
                ['Job_Order',$Detail_Purchase_Order->Job_Order]
            ]
        )->delete();
        return redirect("/Purchase_Order/$Detail_Purchase_Order->Job_Order")->with('success', 'Data Berhasil Dihapus');
    }
}
