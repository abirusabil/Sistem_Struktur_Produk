<?php

namespace App\Http\Controllers;

use App\Models\BoronganDalamPo;
use App\Models\BoronganLuarPo;
use App\Models\Buyer;
use App\Models\DetailPurchaseOrder;
use App\Models\Item;
use App\Models\KebutuhanAccessoriesHardwarePo;
use App\Models\KebutuhanKartonBoxPo;
use App\Models\KebutuhanKayuPo;
use App\Models\KebutuhanKomponenFinishingPo;
use App\Models\KebutuhanPendukungPackingPo;
use App\Models\KebutuhanPlywoodMdfPo;
use App\Models\PurchaseOrder;
use Illuminate\Http\Request;
use Illuminate\Auth\Access\AuthorizationException;
// untuk mengatasi bruteforce
use Illuminate\Cache\RateLimiter;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Dompdf\Dompdf;
use Carbon\Carbon;

// use Illuminate\Support\Facades\RateLimiter;

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

            // Jika memiliki akses
            return view('pages.Purchase_order.Tambah_Purchase_Order', [
                'type_menu' => 'PurchaseOrder',
                'buyers' => Buyer::all()
            ]);
            
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
        return redirect("/Purchase_Order/$request->id")->with('success','Item Berhasil Ditambahkan ');
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
        return view('pages.Purchase_Order.Detail_Purchase_Order.Detail_Purchase_Order',
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
    public function edit(PurchaseOrder $Purchase_Order , RateLimiter $limiter)
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

            return view('pages.Purchase_order.Edit_Purchase_Order',
                [
                    'type_menu' => 'PurchaseOrder',
                    'buyers'=>Buyer::all(),
                    'Purchase_Orders'=>$Purchase_Order
                
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
        
    public function destroy(PurchaseOrder $Purchase_Order , RateLimiter $limiter)
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

            // Jika Memiliki Akses
            $Purchase_Order->delete();
            return redirect('/Purchase_Order')->with('success', 'Purchase order deleted successfully');

        } catch (AuthorizationException $exception) {
            throw new AuthorizationException('Halaman Ini Tidak Boleh Diakses', 403);
        }
    }

     public function detailkebutuhan(PurchaseOrder $Purchase_Order , RateLimiter $limiter)
    {

        $DetailKebutuhanKayuPo = KebutuhanKayuPo::where('Job_Order',$Purchase_Order->id)->get();
        $DetailKebutuhanPlywoodMdfPo = KebutuhanPlywoodMdfPo::where('Job_Order',$Purchase_Order->id)->get();
        $DetailKebutuhanAccessoriesHardwarePo = KebutuhanAccessoriesHardwarePo::where('Job_Order',$Purchase_Order->id)->get();
        $DetailKebutuhanKomponenFinishingPo = KebutuhanKomponenFinishingPo::where('Job_Order',$Purchase_Order->id)->get();
        $DetailKebutuhanPendukungPackingPo = KebutuhanPendukungPackingPo::where('Job_Order',$Purchase_Order->id)->get();
        $DetailKebutuhanKartonBoxPo = KebutuhanKartonBoxPo::where('Job_Order',$Purchase_Order->id)->get();
        $DetailBoronganDalamPo = BoronganDalamPo::where('Job_Order',$Purchase_Order->id)->get();
        $DetailBoronganLuarPo = BoronganLuarPo::where('Job_Order',$Purchase_Order->id)->get();
        $isi = count($DetailKebutuhanKayuPo);
        
        if ($isi >= 1 ) {
                return view('pages.Purchase_Order.Detail_Kebutuhan_Purchase_Order.Detail_Kebutuhan_Purchase_Order',
            [
                'type_menu'=>'PurchaseOrder',
                'Purchase_Order'=>$Purchase_Order,
                'DetailKebutuhanKayuPo'=>$DetailKebutuhanKayuPo,
                'DetailKebutuhanPlywoodMdfPo'=>$DetailKebutuhanPlywoodMdfPo,
                'DetailKebutuhanAccessoriesHardwarePo'=>$DetailKebutuhanAccessoriesHardwarePo,
                'DetailKebutuhanKomponenFinishingPo'=>$DetailKebutuhanKomponenFinishingPo,
                'DetailKebutuhanPendukungPackingPo'=>$DetailKebutuhanPendukungPackingPo,
                'DetailKebutuhanKartonBoxPo'=>$DetailKebutuhanKartonBoxPo,
                'DetailBoronganDalamPo'=>$DetailBoronganDalamPo,
                'DetailBoronganLuarPo'=>$DetailBoronganLuarPo,
            
            ]);
        } else {
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
    
                // Jika Memiliki Akses
                $DetailKebutuhanPurchaseOrders = DetailPurchaseOrder::with('Item.KebutuhanKayuItem.MasterKayu' , 'Item.KebutuhanPlywoodMdfItem.MasterPlywoodMdf','Item.KebutuhanAccessoriesHardwareItem.MasterAccessoriesHardware','Item.KebutuhanKomponenFinishingItem.MasterKomponenFinishing','Item.KebutuhanPendukungPackingItem.MasterPendukungPacking','Item.KebutuhanKartonBoxItem','Item.BoronganDalamItem','Item.BoronganLuarItem')->where('Job_Order',$Purchase_Order->id)->get();
            $KebutuhanKayuPOs = [];
            $kebutuhanPlywoodMdfPOs = []; 
            $kebutuhanKomponenFinishingPOs = []; 
            $KebutuhanAccesoriesHardwarePos = [];
            $KebutuhanPendukungPackingPOs = [];
            $BoronganDalamPos = [];
            $BoronganLuarPos = [];
            $KebutuhanKartonBoxPOs = [];

            foreach($DetailKebutuhanPurchaseOrders as $detailPurchaseOrder){
                foreach($detailPurchaseOrder->Item->KebutuhanPlywoodMdfItem as $kebutuhanplywoodmdfitem){
                    $kebutuhanPlywoodMdfPO = new KebutuhanPlywoodMdfPo();
                    $kebutuhanPlywoodMdfPO->Job_Order = $detailPurchaseOrder->Job_Order ;
                    $kebutuhanPlywoodMdfPO->Nama_Item = $detailPurchaseOrder->Item->Nama_Item ;
                    $kebutuhanPlywoodMdfPO->Quantity_Purchase_Order = $detailPurchaseOrder->Quantity_Purchase_Order ;
                    $kebutuhanPlywoodMdfPO->No_Cutting = $kebutuhanplywoodmdfitem->id ;
                    $kebutuhanPlywoodMdfPO->Plywood_MDF_Id = $kebutuhanplywoodmdfitem->Plywood_MDF_Id ;
                    $kebutuhanPlywoodMdfPO->Nama_Plywood_MDF = $kebutuhanplywoodmdfitem->MasterPlywoodMdf->Nama_Plywood_MDF ;
                    $kebutuhanPlywoodMdfPO->KP_Kebutuhan_Plywood_MDF_Item = $kebutuhanplywoodmdfitem->KP_Kebutuhan_Plywood_MDF_Item ;
                    $kebutuhanPlywoodMdfPO->Keterangan_Kebutuhan_Plywood_MDF_Item = $kebutuhanplywoodmdfitem->Keterangan_Kebutuhan_Plywood_MDF_Item ;
                    $kebutuhanPlywoodMdfPO->Grade_Kebutuhan_Plywood_MDF_Item = $kebutuhanplywoodmdfitem->Grade_Kebutuhan_Plywood_MDF_Item ;
                    $kebutuhanPlywoodMdfPO->Tebal_Plywood_MDF = $kebutuhanplywoodmdfitem->MasterPlywoodMdf->Tebal_Plywood_MDF ;
                    $kebutuhanPlywoodMdfPO->Lebar_Kebutuhan_Plywood_MDF_Item = $kebutuhanplywoodmdfitem->Lebar_Kebutuhan_Plywood_MDF_Item ;
                    $kebutuhanPlywoodMdfPO->Panjang_Kebutuhan_Plywood_MDF_Item = $kebutuhanplywoodmdfitem->Panjang_Kebutuhan_Plywood_MDF_Item ;
                    $kebutuhanPlywoodMdfPO->Quantity_Kebutuhan_Plywood_MDF_Item = $kebutuhanplywoodmdfitem->Quantity_Kebutuhan_Plywood_MDF_Item ;
                    $kebutuhanPlywoodMdfPO->Luas_Plywood_MDF = $kebutuhanplywoodmdfitem->MasterPlywoodMdf->Lebar_Plywood_MDF * $kebutuhanplywoodmdfitem->MasterPlywoodMdf->Panjang_Plywood_MDF / 1000000;
                    $kebutuhanPlywoodMdfPO->Harga_Plywood_MDF = $kebutuhanplywoodmdfitem->MasterPlywoodMdf->Harga_Plywood_MDF ;
                    $kebutuhanPlywoodMdfPOs[] = $kebutuhanPlywoodMdfPO;
                    $kebutuhanPlywoodMdfPO->save();
                    }
                }
            foreach($DetailKebutuhanPurchaseOrders as $detailPurchaseOrder){
                foreach($detailPurchaseOrder->Item->KebutuhanKayuItem as $kebutuhankayuitem){
                    $KebutuhanKayuPO = new KebutuhanKayuPo();
                    $KebutuhanKayuPO->Job_Order = $detailPurchaseOrder->Job_Order ;
                    $KebutuhanKayuPO->Nama_Item = $detailPurchaseOrder->Item->Nama_Item ;
                    $KebutuhanKayuPO->Quantity_Purchase_Order = $detailPurchaseOrder->Quantity_Purchase_Order ;
                    $KebutuhanKayuPO->No_Cutting = $kebutuhankayuitem->id ;
                    $KebutuhanKayuPO->Kayu_Id = $kebutuhankayuitem->Kayu_Id ;
                    $KebutuhanKayuPO->Nama_Kayu = $kebutuhankayuitem->MasterKayu->Nama_Kayu ;
                    $KebutuhanKayuPO->KP_Kebutuhan_Kayu_Item = $kebutuhankayuitem->KP_Kebutuhan_Kayu_Item ;
                    $KebutuhanKayuPO->Keterangan_Kebutuhan_Kayu_Item = $kebutuhankayuitem->Keterangan_Kebutuhan_Kayu_Item ;
                    $KebutuhanKayuPO->Grade_Kebutuhan_Kayu_Item = $kebutuhankayuitem->Grade_Kebutuhan_Kayu_Item ;
                    $KebutuhanKayuPO->Tebal_Kebutuhan_Kayu_Item = $kebutuhankayuitem->Tebal_Kebutuhan_Kayu_Item ;
                    $KebutuhanKayuPO->Lebar_Kebutuhan_Kayu_Item = $kebutuhankayuitem->Lebar_Kebutuhan_Kayu_Item ;
                    $KebutuhanKayuPO->Panjang_Kebutuhan_Kayu_Item = $kebutuhankayuitem->Panjang_Kebutuhan_Kayu_Item ;
                    $KebutuhanKayuPO->Quantity_Kebutuhan_Kayu_Item = $kebutuhankayuitem->Quantity_Kebutuhan_Kayu_Item ;
                    $KebutuhanKayuPO->Harga_Kayu = $kebutuhankayuitem->MasterKayu->Harga_Kayu ;
                    $KebutuhanKayuPOs[] = $KebutuhanKayuPO;
                    // Simpan entitas KebutuhanKayuPO
                    $KebutuhanKayuPO->save();
                }
            }
            foreach($DetailKebutuhanPurchaseOrders as $detailPurchaseOrder){
                foreach($detailPurchaseOrder->Item->KebutuhanAccessoriesHardwareItem as $kebutuhanaccessorieshardwareitem){
                    $KebutuhanAccesoriesHardwarePo = new KebutuhanAccessoriesHardwarePo();
                    $KebutuhanAccesoriesHardwarePo->Job_Order = $detailPurchaseOrder->Job_Order ;
                    $KebutuhanAccesoriesHardwarePo->Nama_Item = $detailPurchaseOrder->Item->Nama_Item ;
                    $KebutuhanAccesoriesHardwarePo->Quantity_Purchase_Order = $detailPurchaseOrder->Quantity_Purchase_Order ;
                    $KebutuhanAccesoriesHardwarePo->No_Cutting = $kebutuhanaccessorieshardwareitem->id ;
                    $KebutuhanAccesoriesHardwarePo->Accessories_Hardware_Id = $kebutuhanaccessorieshardwareitem->Accessories_Hardware_Id ;
                    $KebutuhanAccesoriesHardwarePo->Nama_Accessories_Hardware = $kebutuhanaccessorieshardwareitem->MasterAccessoriesHardware->Nama_Accessories_Hardware ;
                    $KebutuhanAccesoriesHardwarePo->Keterangan_Kebutuhan_Accessories_Hardware_Item = $kebutuhanaccessorieshardwareitem->Keterangan_Kebutuhan_Accessories_Hardware_Item ;
                    $KebutuhanAccesoriesHardwarePo->Ukuran_Accessories_Hardware = $kebutuhanaccessorieshardwareitem->MasterAccessoriesHardware->Ukuran_Accessories_Hardware ;
                    $KebutuhanAccesoriesHardwarePo->Quantity_Kebutuhan_Accessories_Hardware_Item = $kebutuhanaccessorieshardwareitem->Quantity_Kebutuhan_Accessories_Hardware_Item ;
                    $KebutuhanAccesoriesHardwarePo->Satuan_Accessories_Hardware = $kebutuhanaccessorieshardwareitem->MasterAccessoriesHardware->Satuan_Accessories_Hardware ;
                    $KebutuhanAccesoriesHardwarePo->Harga_Accessories_Hardware = $kebutuhanaccessorieshardwareitem->MasterAccessoriesHardware->Harga_Accessories_Hardware ;
                    $KebutuhanAccesoriesHardwarePos[] = $KebutuhanAccesoriesHardwarePo;
                    // Simpan entitas KebutuhanKayuPO
                    $KebutuhanAccesoriesHardwarePo->save();
                }
            }
            foreach($DetailKebutuhanPurchaseOrders as $detailPurchaseOrder){
                foreach($detailPurchaseOrder->Item->KebutuhanKomponenFinishingItem as $kebutuhanKomponenfinishingitem){
                    $KebutuhanKomponenFinishingPo = new KebutuhanKomponenFinishingPo();
                    $KebutuhanKomponenFinishingPo->Job_Order = $detailPurchaseOrder->Job_Order ;
                    $KebutuhanKomponenFinishingPo->Nama_Item = $detailPurchaseOrder->Item->Nama_Item ;
                    $KebutuhanKomponenFinishingPo->Quantity_Purchase_Order = $detailPurchaseOrder->Quantity_Purchase_Order ;
                    $KebutuhanKomponenFinishingPo->No_Cutting = $kebutuhanKomponenfinishingitem->id ;
                    $KebutuhanKomponenFinishingPo->Komponen_Finishing_Id = $kebutuhanKomponenfinishingitem->Komponen_Finishing_Id ;
                    $KebutuhanKomponenFinishingPo->Nama_Komponen_Finishing = $kebutuhanKomponenfinishingitem->MasterKomponenFinishing->Nama_Komponen_Finishing ;
                    $KebutuhanKomponenFinishingPo->Quantity_Kebutuhan_Komponen_Finishing_Item = $kebutuhanKomponenfinishingitem->Quantity_Kebutuhan_Komponen_Finishing_Item ;
                    $KebutuhanKomponenFinishingPo->Quantity_Komponen_Finishing = $kebutuhanKomponenfinishingitem->MasterKomponenFinishing->Quantity_Komponen_Finishing ;
                    $KebutuhanKomponenFinishingPo->Satuan_Komponen_Finishing = $kebutuhanKomponenfinishingitem->MasterKomponenFinishing->Satuan_Komponen_Finishing ;
                    $KebutuhanKomponenFinishingPo->Harga_Komponen_Finishing = $kebutuhanKomponenfinishingitem->MasterKomponenFinishing->Harga_Komponen_Finishing ;
                    $kebutuhanKomponenFinishingPOs[] = $KebutuhanKomponenFinishingPo;
                    // Simpan entitas KebutuhanKayuPO
                    $KebutuhanKomponenFinishingPo->save();
                }
            }
            foreach($DetailKebutuhanPurchaseOrders as $detailPurchaseOrder){
                foreach($detailPurchaseOrder->Item->KebutuhanPendukungPackingItem as $kebutuhanpendukungpackingitem){
                    $KebutuhanPendukungPackingPo = new KebutuhanPendukungPackingPo();
                    $KebutuhanPendukungPackingPo->Job_Order = $detailPurchaseOrder->Job_Order ;
                    $KebutuhanPendukungPackingPo->Nama_Item = $detailPurchaseOrder->Item->Nama_Item ;
                    $KebutuhanPendukungPackingPo->Quantity_Purchase_Order = $detailPurchaseOrder->Quantity_Purchase_Order ;
                    $KebutuhanPendukungPackingPo->No_Cutting = $kebutuhanpendukungpackingitem->id ;
                    $KebutuhanPendukungPackingPo->Pendukung_Packing_Id = $kebutuhanpendukungpackingitem->Pendukung_Packing_Id ;
                    $KebutuhanPendukungPackingPo->Nama_Pendukung_Packing = $kebutuhanpendukungpackingitem->MasterPendukungPacking->Nama_Pendukung_Packing ;
                    $KebutuhanPendukungPackingPo->Lebar_Kebutuhan_Pendukung_Packing_Item = $kebutuhanpendukungpackingitem->Lebar_Kebutuhan_Pendukung_Packing_Item ;
                    $KebutuhanPendukungPackingPo->Panjang_Kebutuhan_Pendukung_Packing_Item = $kebutuhanpendukungpackingitem->Panjang_Kebutuhan_Pendukung_Packing_Item ;
                    $KebutuhanPendukungPackingPo->Quantity_Kebutuhan_Pendukung_Packing_Item = $kebutuhanpendukungpackingitem->Quantity_Kebutuhan_Pendukung_Packing_Item ;
                    $KebutuhanPendukungPackingPo->Tebal_Pendukung_Packing = $kebutuhanpendukungpackingitem->MasterPendukungPacking->Tebal_Pendukung_Packing ;
                    $KebutuhanPendukungPackingPo->Luas_Pendukung_Packing = $kebutuhanpendukungpackingitem->MasterPendukungPacking->Lebar_Pendukung_Packing * $kebutuhanpendukungpackingitem->MasterPendukungPacking->Panjang_Pendukung_Packing / 1000000;
                    $KebutuhanPendukungPackingPo->Satuan_Pendukung_Packing = $kebutuhanpendukungpackingitem->MasterPendukungPacking->Satuan_Pendukung_Packing ;
                    $KebutuhanPendukungPackingPo->Harga_Pendukung_Packing = $kebutuhanpendukungpackingitem->MasterPendukungPacking->Harga_Pendukung_Packing ;
                    $KebutuhanPendukungPackingPOs[] = $KebutuhanPendukungPackingPo;
                    // Simpan entitas KebutuhanKayuPO
                    $KebutuhanPendukungPackingPo->save();
                }
            }
            foreach($DetailKebutuhanPurchaseOrders as $detailPurchaseOrder){
                foreach($detailPurchaseOrder->Item->KebutuhanKartonBoxItem as $kebutuhankartonboxitem){
                    $KebutuhanKartonBoxPo = new KebutuhanKartonBoxPo();
                    $KebutuhanKartonBoxPo->Job_Order = $detailPurchaseOrder->Job_Order ;
                    $KebutuhanKartonBoxPo->Nama_Item = $detailPurchaseOrder->Item->Nama_Item ;
                    $KebutuhanKartonBoxPo->Quantity_Purchase_Order = $detailPurchaseOrder->Quantity_Purchase_Order ;
                    $KebutuhanKartonBoxPo->No_Cutting = $kebutuhankartonboxitem->id ;
                    $KebutuhanKartonBoxPo->Jenis_Kebutuhan_Karton_Box = $kebutuhankartonboxitem->Jenis_Kebutuhan_Karton_Box ;
                    $KebutuhanKartonBoxPo->Keterangan_Kebutuhan_Karton_Box_Item = $kebutuhankartonboxitem->Keterangan_Kebutuhan_Karton_Box_Item ;
                    $KebutuhanKartonBoxPo->Tinggi_Kebutuhan_Karton_Box_Item = $kebutuhankartonboxitem->Tinggi_Kebutuhan_Karton_Box_Item ;
                    $KebutuhanKartonBoxPo->Lebar_Kebutuhan_Karton_Box_Item = $kebutuhankartonboxitem->Lebar_Kebutuhan_Karton_Box_Item ;
                    $KebutuhanKartonBoxPo->Panjang_Kebutuhan_Karton_Box_Item = $kebutuhankartonboxitem->Panjang_Kebutuhan_Karton_Box_Item ;
                    $KebutuhanKartonBoxPo->Quantity_Kebutuhan_Karton_Box_Item = $kebutuhankartonboxitem->Quantity_Kebutuhan_Karton_Box_Item ;
                    $KebutuhanKartonBoxPo->Harga_Kebutuhan_Karton_Box_Item = $kebutuhankartonboxitem->Harga_Kebutuhan_Karton_Box_Item ;
                    $KebutuhanKartonBoxPOs[] = $KebutuhanKartonBoxPo;
                    // Simpan entitas KebutuhanKayuPO
                    $KebutuhanKartonBoxPo->save();
                }
            }
            foreach($DetailKebutuhanPurchaseOrders as $detailPurchaseOrder){
                foreach($detailPurchaseOrder->Item->BoronganDalamItem as $borongandalamitem){
                    $BoronganDalamPo = new BoronganDalamPo();
                    $BoronganDalamPo->Job_Order = $detailPurchaseOrder->Job_Order ;
                    $BoronganDalamPo->Nama_Item = $detailPurchaseOrder->Item->Nama_Item ;
                    $BoronganDalamPo->Quantity_Purchase_Order = $detailPurchaseOrder->Quantity_Purchase_Order ;
                    $BoronganDalamPo->No_Cutting = $borongandalamitem->id ;
                    $BoronganDalamPo->Bahan_1 = $borongandalamitem->Bahan_1 ;
                    $BoronganDalamPo->Bahan_2 = $borongandalamitem->Bahan_2 ;
                    $BoronganDalamPo->Sanding_1 = $borongandalamitem->Sanding_1 ;
                    $BoronganDalamPo->Sanding_2 = $borongandalamitem->Sanding_2 ;
                    $BoronganDalamPo->Proses_Assembling = $borongandalamitem->Proses_Assembling ;
                    $BoronganDalamPo->Finishing = $borongandalamitem->Finishing ;
                    $BoronganDalamPo->Packing = $borongandalamitem->Packing ;
                    $BoronganDalamPos[] = $BoronganDalamPo;
                    // Simpan entitas KebutuhanKayuPO
                    $BoronganDalamPo->save();
                }
            }
            foreach($DetailKebutuhanPurchaseOrders as $detailPurchaseOrder){
                foreach($detailPurchaseOrder->Item->BoronganLuarItem as $boronganluaritem){
                    $BoronganLuarPo = new BoronganLuarPo();
                    $BoronganLuarPo->Job_Order = $detailPurchaseOrder->Job_Order ;
                    $BoronganLuarPo->Nama_Item = $detailPurchaseOrder->Item->Nama_Item ;
                    $BoronganLuarPo->Quantity_Purchase_Order = $detailPurchaseOrder->Quantity_Purchase_Order ;
                    $BoronganLuarPo->No_Cutting = $boronganluaritem->id ;
                    $BoronganLuarPo->Anyam = $boronganluaritem->Anyam ;
                    $BoronganLuarPo->Ukir = $boronganluaritem->Ukir ;
                    $BoronganLuarPo->Handle = $boronganluaritem->Handle ;
                    $BoronganLuarPo->Bubut = $boronganluaritem->Bubut ;
                    $BoronganLuarPo->Pirelly_Jok = $boronganluaritem->Pirelly_Jok ;
                    $BoronganLuarPo->Sterofoam = $boronganluaritem->Sterofoam ;
                    $BoronganLuarPos[] = $BoronganLuarPo;
                    // Simpan entitas KebutuhanKayuPO
                    $BoronganLuarPo->save();
                }
            }
                    // return $KebutuhanPendukungPackingPOs ;
                    return redirect()->route('purchase_order.detailkebutuhan', ['Purchase_Order' => $Purchase_Order->id])->with('success','Item Berhasil Ditambahkan ');
    
            } catch (AuthorizationException $exception) {
                throw new AuthorizationException('Cutting List Belum dibuat', 403);
            }
            
        }
        
        

        
    }

    public function exportToPDF(PurchaseOrder $Purchase_Order)
{
    // Ambil data DetailPurchaseOrder yang ingin diekspor
    $detailPurchaseOrders = DetailPurchaseOrder::with('Item.Collection')->where('Job_Order', $Purchase_Order->id)->get()->groupBy('Item.Collection.Nama_Collection');

    $Purchase_Order = $Purchase_Order;

    // Buat objek Dompdf
    $dompdf = new Dompdf();

    // Generate HTML untuk ditampilkan di PDF
    $html = view('pages.Purchase_Order.Detail_Purchase_Order.export', [
        'detailPurchaseOrders' => $detailPurchaseOrders,
        'Purchase_Order' => $Purchase_Order,
        'schedule_kirim' => Carbon::parse($Purchase_Order->Schedule_Kirim)->locale('id')->isoFormat('D MMMM Y'),
        'tanggal_masuk' => Carbon::parse($Purchase_Order->Tanggal_Masuk)->locale('id')->isoFormat('D MMMM Y'),
    ]);

    // Load HTML ke Dompdf
    $dompdf->loadHtml($html);

    // Render PDF
    $dompdf->render();

    // Tampilkan file PDF di browser
    $dompdf->stream();
}




}
