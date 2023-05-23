<?php

namespace App\Http\Controllers;

use App\Models\Buyer;
use App\Models\DetailPurchaseOrder;
use App\Models\PurchaseOrder;
use Illuminate\Http\Request;

class PurchaseOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.Purchase_order.List_Purchase_Order',
            [   
                'type_menu' => 'PurchaseOrder',
                // 'Purchase_Orders'=>PurchaseOrder::with('Buyer')
                'Purchase_Orders'=>PurchaseOrder::with('Buyer')->filter(request(['search']))->paginate(20)
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
        return view('pages.Purchase_order.Tambah_Purchase_Order',
            [
                'type_menu' => 'PurchaseOrder',
                'buyers'=>Buyer::all()
            
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
                'id'=>'required|unique:purchase_orders',
                'Dasar_Po'=>'required',
                'Buyer_Id'=>'required',
                'Tanggal_Masuk'=>'required',
                'Schedule_Kirim'=>'required'
            ] ,[
                'required'=>'Kolom Tidak Boleh Kosong',
                'unique'=>'Kode Telah Digunakan , Silahkan Gunakan Kode Lain'
            ]
        
            );
            // return $validatedData;
        PurchaseOrder::create($validatedData);
        // return redirect("{{$request->id}}")->with('success','Item Berhasil Ditambahkan ');
        return redirect("/Purchase_Order/{{$request->id}}")->with('success','Item Berhasil Ditambahkan ');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PurchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function show(PurchaseOrder $Purchase_Order)
    {
        // return $Purchase_Order;
        // return DetailPurchaseOrder::with('Item.Collection')->where('Job_Order',$Purchase_Order->id)->get()->groupBy('Item.Collection_Id') ;
        return view('pages.Purchase_Order.Detail_Purchase_Order',
            [
                'type_menu'=>'PurchaseOrder',
                'Purchase_Order'=>$Purchase_Order,
                'detailPurchaseOrders'=> DetailPurchaseOrder::with('Item.Collection')->where('Job_Order',$Purchase_Order->id)->get()->groupBy('Item.Collection.Nama_Collection') 
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PurchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function edit(PurchaseOrder $Purchase_Order)
    {
        return view('pages.Purchase_order.Edit_Purchase_Order',
            [
                'type_menu' => 'PurchaseOrder',
                'buyers'=>Buyer::all(),
                'Purchase_Orders'=>$Purchase_Order
            
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PurchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PurchaseOrder $Purchase_Order)
    {
        $validatedData = $request->validate(
            [
                'id'=>'required',
                'Dasar_Po'=>'required',
                'Buyer_Id'=>'required',
                'Tanggal_Masuk'=>'required',
                'Schedule_Kirim'=>'required'
            ] ,[
                'required'=>'Kolom Tidak Boleh Kosong',
                'unique'=>'Kode Telah Digunakan , Silahkan Gunakan Kode Lain'
            ]
        
            );
            
            // return $validatedData;
            PurchaseOrder::where('id', $Purchase_Order->id)->update($validatedData);
            return redirect("/Purchase_Order/$Purchase_Order->id")->with('success','Item Berhasil Ditambahkan ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PurchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\Response
     */
        public function destroy(PurchaseOrder $Purchase_Order)
    {
        // return $Purchase_Order;
        $Purchase_Order->delete();
        return redirect('/Purchase_Order')->with('success', 'Purchase order deleted successfully');
    }

}
