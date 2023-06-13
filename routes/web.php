<?php

use App\Http\Controllers\BoronganDalamItemController;
use App\Http\Controllers\BoronganDalamPoController;
use App\Http\Controllers\BoronganLuarItemController;
use App\Http\Controllers\BoronganLuarPoController;
use App\Http\Controllers\BuyerController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\DetailPurchaseOrderController;
use App\Http\Controllers\GambarItemController;
use App\Http\Controllers\GambarKerjaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PurchaseOrderController;
use App\Http\Controllers\SuplierController;
use App\Http\Controllers\KayuController;
use App\Http\Controllers\MasterAccessoriesHardwareController;
use App\Http\Controllers\MasterKartonBoxController;
use App\Http\Controllers\MasterKomponenFinishingController;
use App\Http\Controllers\MasterPendukungPackingController;
use App\Http\Controllers\MasterPlywoodMDFController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\KebutuhanKayuItemController;
use App\Http\Controllers\KebutuhanPlywoodMdfItemController;
use App\Http\Controllers\KebutuhanAccessoriesHardwareItemController;
use App\Http\Controllers\KebutuhanAccessoriesHardwarePoController;
use App\Http\Controllers\KebutuhanKartonBoxItemController;
use App\Http\Controllers\KebutuhanKartonBoxPoController;
use App\Http\Controllers\KebutuhanKayuPoController;
use App\Http\Controllers\KebutuhanKomponenFinishingItemController;
use App\Http\Controllers\KebutuhanKomponenFinishingPoController;
use App\Http\Controllers\KebutuhanPendukungPackingItemController;
use App\Http\Controllers\KebutuhanPendukungPackingPoController;
use App\Http\Controllers\KebutuhanPlywoodMdfPoController;
use App\Models\BoronganDalamPo;
use App\Models\KebutuhanKartonBoxPo;
use App\Models\KebutuhanKayuPo;
use App\Models\KebutuhanPlywoodMdfItem;
use App\Models\KebutuhanPlywoodMdfPo;
use App\Models\MasterKomponenFinishing;
use App\Models\MasterPendukungPacking;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/coba', function () {
    return view('pages.coba', ['type_menu' => 'User']);
});

// Kayu
Route::resource('/Kayu',KayuController::class)->middleware('auth');
Route::post('/Kayu_import', [KayuController::class, 'import'])->name('kayu.import')->middleware('auth');
Route::get('/kayu_export', [KayuController::class, 'export'])->name('kayu.export')->middleware('auth');
// End Kayu

// Kebutuhan Kayu Item
Route::resource('Kebutuhan_Kayu_Item',KebutuhanKayuItemController::class)->middleware('auth');
Route::get('/Kebutuhan_Kayu_Item/export/{itemId}', [KebutuhanKayuItemController::class, 'export'])->name('Kebutuhan_Kayu_Item.export')->middleware('auth');
Route::post('/Kebutuhan_Kayu_Item/import/{itemId}', [KebutuhanKayuItemController::class, 'import'])->name('Kebutuhan_Kayu_Item.import')->middleware('auth');
// End Kebutuhan Kayu Item

// List Kebutuhan Kayu Keseluruhan
Route::resource('Kebutuhan_Kayu',KebutuhanKayuPoController::class)->middleware('auth');
Route::get('/Kebutuhan_Kayu_Po/export/{JobOrder}', [KebutuhanKayuPoController::class, 'export'])->name('Kebutuhan_Kayu_Po.export')->middleware('auth');

// End List kebutuhan kayu keseluruhan 

// Plywood MDF
Route::resource('/Plywood_MDF',MasterPlywoodMDFController::class)->middleware('auth');
Route::post('/Plywood_MDF_import', [MasterPlywoodMDFController::class, 'import'])->name('Plywood_MDF.import')->middleware('auth');
Route::get('/Plywood_MDF_export', [MasterPlywoodMDFController::class, 'export'])->name('Plywood_MDF.export')->middleware('auth');
// End Plywood MDF

// Kebutuhan Plywood MDF Item
Route::resource('/Kebutuhan_Plywood_MDF_Item',KebutuhanPlywoodMdfItemController::class)->middleware('auth');
Route::get('/Kebutuhan_Plywood_MDF_Item/export/{itemId}',[KebutuhanPlywoodMdfItemController::class,'export'])->name('Kebutuhan_Plywood_MDF_Item.export')->middleware('auth');
Route::post('/Kebutuhan_Plywood_MDF_Item/import/{itemId}',[KebutuhanPlywoodMdfItemController::class,'import'])->name('Kebutuhan_Plywood_MDF_Item.import')->middleware('auth');
// End Kebutuhan Plywood MDF Item

// list Kebutuhan Plywood MDF Keseluruhan
Route::resource('/Kebutuhan_Plywood_MDF',KebutuhanPlywoodMdfPoController::class)->middleware('auth');
Route::get('/Kebutuhan_Plywood_MDF_Po/export/{JobOrder}', [KebutuhanPlywoodMdfPoController::class, 'export'])->name('Kebutuhan_Plywood_MDF_Po.export')->middleware('auth');
// end List kebutuhan plywood MDF Keseluruhan

// Accessories Hardware
Route::resource('/Accessories_Hardware',MasterAccessoriesHardwareController::class)->middleware('auth');
Route::get('/Accessories_Hardware_Export',[MasterAccessoriesHardwareController::class,'export'])->name('Accessories_Hardware.export')->middleware('auth');
Route::post('/Accessories_Hardware_Import',[MasterAccessoriesHardwareController::class,'import'])->name('Accessories_Hardware.import')->middleware('auth');
// End AccessoriesHardware

// Kebutuhan Accessories Hardware Item
Route::resource('/Kebutuhan_Accessories_Item',KebutuhanAccessoriesHardwareItemController::class)->middleware('auth');
Route::get('/Kebutuhan_Accessories_Item/export/{itemId}',[KebutuhanAccessoriesHardwareItemController::class,'export'])->name('Kebutuhan_Accessories_Hardware_Item.export')->middleware('auth');
Route::post('/Kebutuhan_Accessories_Item/import/{itemId}',[KebutuhanAccessoriesHardwareItemController::class,'import'])->name('Kebutuhan_Accessories_Hardware_Item.import')->middleware('auth');
// End Kebutuhan Accessries Hardware Item

// list Kebutuhan Accessories Hardware Keseluruhan
Route::resource('/Kebutuhan_Accessories_Hardware',KebutuhanAccessoriesHardwarePoController::class)->middleware('auth');
Route::get('/Kebutuhan_Accessories_Hardware_Po/export/{JobOrder}', [KebutuhanAccessoriesHardwarePoController::class, 'export'])->name('Kebutuhan_Accessories_Hardware_Po.export')->middleware('auth');
// End List Kebutuhan Accessories hardware keseluruhan

// KomponenFinishing
Route::resource('/Komponen_Finishing',MasterKomponenFinishingController::class)->middleware('auth');
Route::get('/Komponen_Finishing_Export',[MasterKomponenFinishingController::class,'export'])->name('Komponen_Finishing.export')->middleware('auth');
Route::post('/Komponen_Finishing_Import',[MasterKomponenFinishingController::class,'import'])->name('Komponen_Finishing.import')->middleware('auth');
// End KomponenFinishing

// Kebutuhan Komponen Finishing Item
Route::resource('/Kebutuhan_Finishing_Item',KebutuhanKomponenFinishingItemController::class)->middleware('auth');
Route::get('/Kebutuhan_Finishing_Item/export/{itemId}',[KebutuhanKomponenFinishingItemController::class,'export'])->name('Kebutuhan_Komponen_Finishing_Item.export')->middleware('auth');
Route::post('/Kebutuhan_Finishing_Item/import/{itemId}',[KebutuhanKomponenFinishingItemController::class,'import'])->name('Kebutuhan_Komponen_Finishing_Item.import')->middleware('auth');
// End Kebutuhan Komponen Finishing Item

// List Kebutuhan Komponen Finishing PO
Route::resource('/Kebutuhan_Komponen_Finishing',KebutuhanKomponenFinishingPoController::class)->middleware('auth');
Route::get('/Kebutuhan_Komponen_Finishing_Po/export/{JobOrder}', [KebutuhanKomponenFinishingPoController::class, 'export'])->name('Kebutuhan_Komponen_Finishing_Po.export')->middleware('auth');
// end List Kebutuhan Komponen Finishing PO

// Pendukung_Packing
Route::resource('/Pendukung_Packing',MasterPendukungPackingController::class)->middleware('auth');
Route::get('Pendukung_Packing_Export',[MasterPendukungPackingController::class,'export'])->name('Pendukung_Packing.export')->middleware('auth');
Route::post('Pendukung_Packing_Import',[MasterPendukungPackingController::class,'import'])->name('Pendukung_Packing.import')->middleware('auth');
// end Pendukung Packing

// Kebutuhan Pendukung Packing
Route::resource('/Kebutuhan_Packing_Item',KebutuhanPendukungPackingItemController::class)->middleware('auth');
Route::get('/Kebutuhan_Packing_Item/export/{itemId}',[KebutuhanPendukungPackingItemController::class,'export'])->name('Kebutuhan_Pendukung_Packing_Item.export')->middleware('auth');
Route::post('/Kebutuhan_Packing_Item/import/{itemId}',[KebutuhanPendukungPackingItemController::class,'import'])->name('Kebutuhan_Pendukung_Packing_Item.import')->middleware('auth');
// End Kebutuhan Pendukung Packing

// List Kebutuhan Pendukukung Packing PO Keseluruhan
Route::resource('Kebutuhan_Pendukung_Packing',KebutuhanPendukungPackingPoController::class)->middleware('auth');
Route::get('/Kebutuhan_Pendukung_Packing_Po/export/{JobOrder}', [KebutuhanPendukungPackingPoController::class, 'export'])->name('Kebutuhan_Pendukung_Packing_Po.export')->middleware('auth');
// End List kebutuhan Pendukung Packing Po Keseluruhan

// KartonBox
Route::resource('/Karton_Box',MasterKartonBoxController::class)->middleware('auth');
Route::get('Karton_Box_Export' ,[MasterKartonBoxController::class,'export'])->name('Karton_Box.export')->middleware('auth');
Route::post('Karton_Box_Import',[MasterKartonBoxController::class,'import'])->name('Karton_Box.import')->middleware('auth');
// End KartonBox

// Kebutuhan Karton Box
Route::resource('/Kebutuhan_Karton_Box_Item',KebutuhanKartonBoxItemController::class)->middleware('auth');
Route::get('/Kebutuhan_Karton_Box_Item/export/{itemId}',[KebutuhanKartonBoxItemController::class,'export'])->name('Kebutuhan_Karton_Box_Item.export')->middleware('auth');
Route::post('/Kebutuhan_Karton_Box_Item/import/{itemId}',[KebutuhanKartonBoxItemController::class,'import'])->name('Kebutuhan_Karton_Box_Item.import')->middleware('auth');
// End Kebutuhan Karton Box

// List Kebutuhan Karton Box PO Keseluruhan
Route::resource('/Kebutuhan_Karton_Box',KebutuhanKartonBoxPoController::class)->middleware('auth');
Route::get('/Kebutuhan_Karton_Box_Po/export/{JobOrder}', [KebutuhanKartonBoxPoController::class, 'export'])->name('Kebutuhan_Karton_Box_Po.export')->middleware('auth');
// end List Kebutuhan Karton Box PO Keseluruhan


// Borongan Dalam
Route::resource('/Borongan_Dalam_Item',BoronganDalamItemController::class)->middleware('auth');
Route::get('/Borongan_Dalam_Item/export/{itemId}',[BoronganDalamItemController::class,'export'])->name('Borongan_Dalam_Item.export')->middleware('auth');
Route::resource('/Borongan_Dalam_Po',BoronganDalamPoController::class)->middleware('auth');
// end Borongan Dalam

// Borongan Luar
Route::resource('/Borongan_Luar_Item',BoronganLuarItemController::class)->middleware('auth');
Route::get('/Borongan_Luar_Item/export/{itemId}',[BoronganLuarItemController::class,'export'])->name('Borongan_Luar_Item.export')->middleware('auth');
Route::resource('/Borongan_Luar_Po',BoronganLuarPoController::class)->middleware('auth');
// end Borongan Luar

// Gambar Item
Route::resource('/Gambar_Item',GambarItemController::class)->middleware('auth');
Route::get('/download-gambar/{id}', [GambarItemController::class, 'downloadGambar'])->name('download.gambar')->middleware('auth');
// End Gambar Item

// Gambar Kerja
Route::resource('/Gambar_Kerja',GambarKerjaController::class)->middleware('auth');

// End Gambar Kerja

// Purchase Order
Route::get('/', [PurchaseOrderController::class, 'index'])->name('home')->middleware('auth')->middleware('auth');
Route::resource('/Purchase_Order', PurchaseOrderController::class)->middleware('auth');
Route::get('/Purchase_Order/Export',[PurchaseOrderController::class,'export'])->name('Purchase_Order.export')->middleware('auth');
Route::get('/Purchase_Order/{Purchase_Order}/detailkebutuhan', [PurchaseOrderController::class, 'detailkebutuhan'])->name('purchase_order.detailkebutuhan')->middleware('auth');
Route::get('/Purchase_Order/{Purchase_Order}/exportToPDF', [PurchaseOrderController::class, 'exportToPDF'])->name('purchase_order.exportToPDF')->middleware('auth');
// End Purchase


// Detail Purchase Order
Route::resource('/Detail_Purchase_Order',DetailPurchaseOrderController::class)->middleware('auth');
// End Detail Purchase Order 

// Item
Route::resource('/Item', ItemController::class)->middleware('auth');
Route::get('/Item_Export',[ItemController::class,'export'])->name('Item.export')->middleware('auth');
Route::post('/Item_Import',[ItemController::class,'import'])->name('Item.import')->middleware('auth');
// End Item

// Collection
Route::resource('/Collection',CollectionController::class)->middleware('auth');
Route::get('Collection_Export',[CollectionController::class,'export'])->name('Collection.export')->middleware('auth');
Route::post('Collection_Import',[CollectionController::class,'import'])->name('Collection.import')->middleware('auth');
/// End Collection

// Buyer
Route::resource('/Buyer', BuyerController::class)->middleware('auth');
Route::get('/Buyer_Export',[BuyerController::class,'export'])->name('Buyer.export')->middleware('auth');
Route::post('/Buyer_Import',[BuyerController::class,'import'])->name('Buyer.import')->middleware('auth');
// End Buyer

// Pembelian
Route::resource('/Suplier', SuplierController::class)->middleware('auth');
Route::post('/import', [SuplierController::class, 'import'])->name('suplier.import')->middleware('auth');
Route::get('/export', [SuplierController::class, 'export'])->name('suplier.export')->middleware('auth');
// End Pembelian

// Register
Route::resource('/User', UserController::class)->middleware('auth');
// Route::resource('/login', LoginController::class)->name('login')->middleware('guest');
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth');
// End Register







