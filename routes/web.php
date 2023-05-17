<?php

use App\Http\Controllers\BoronganDalamItemController;
use App\Http\Controllers\BoronganLuarItemController;
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
use App\Http\Controllers\KebutuhanKartonBoxItemController;
use App\Http\Controllers\KebutuhanKomponenFinishingItemController;
use App\Http\Controllers\KebutuhanPendukungPackingItemController;
use App\Models\KebutuhanPlywoodMdfItem;
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
Route::resource('/Kayu',KayuController::class);
Route::post('/Kayu_import', [KayuController::class, 'import'])->name('kayu.import');
Route::get('/kayu_export', [KayuController::class, 'export'])->name('kayu.export');
// End Kayu

// Kebutuhan Kayu Item
Route::resource('Kebutuhan_Kayu_Item',KebutuhanKayuItemController::class);
Route::get('/Kebutuhan_Kayu_Item/export/{itemId}', [KebutuhanKayuItemController::class, 'export'])->name('Kebutuhan_Kayu_Item.export');
Route::post('/Kebutuhan_Kayu_Item/import/{itemId}', [KebutuhanKayuItemController::class, 'import'])->name('Kebutuhan_Kayu_Item.import');
// End Kebutuhan Kayu Item

// Plywood MDF
Route::resource('/Plywood_MDF',MasterPlywoodMDFController::class);
Route::post('/Plywood_MDF_import', [MasterPlywoodMDFController::class, 'import'])->name('Plywood_MDF.import');
Route::get('/Plywood_MDF_export', [MasterPlywoodMDFController::class, 'export'])->name('Plywood_MDF.export');
// End Plywood MDF

// Kebutuhan Plywood MDF
Route::resource('/Kebutuhan_Plywood_MDF_Item',KebutuhanPlywoodMdfItemController::class);
Route::get('/Kebutuhan_Plywood_MDF_Item/export/{itemId}',[KebutuhanPlywoodMdfItemController::class,'export'])->name('Kebutuhan_Plywood_MDF_Item.export');
Route::post('/Kebutuhan_Plywood_MDF_Item/import/{itemId}',[KebutuhanPlywoodMdfItemController::class,'import'])->name('Kebutuhan_Plywood_MDF_Item.import');
// End Kebutuhan Plywood MDF

// Accessories Hardware
Route::resource('/Accessories_Hardware',MasterAccessoriesHardwareController::class);
Route::get('/Accessories_Hardware_Export',[MasterAccessoriesHardwareController::class,'export'])->name('Accessories_Hardware.export');
Route::post('/Accessories_Hardware_Import',[MasterAccessoriesHardwareController::class,'import'])->name('Accessories_Hardware.import');
// End AccessoriesHardware

// Kebutuhan Accessories Hardware
Route::resource('/Kebutuhan_Accessories_Item',KebutuhanAccessoriesHardwareItemController::class);
Route::get('/Kebutuhan_Accessories_Item/export/{itemId}',[KebutuhanAccessoriesHardwareItemController::class,'export'])->name('Kebutuhan_Accessories_Hardware_Item.export');
Route::post('/Kebutuhan_Accessories_Item/import/{itemId}',[KebutuhanAccessoriesHardwareItemController::class,'import'])->name('Kebutuhan_Accessories_Hardware_Item.import');
// End Kebutuhan Accessries Hardware

// KomponenFinishing
Route::resource('/Komponen_Finishing',MasterKomponenFinishingController::class);
Route::get('/Komponen_Finishing_Export',[MasterKomponenFinishingController::class,'export'])->name('Komponen_Finishing.export');
Route::post('/Komponen_Finishing_Import',[MasterKomponenFinishingController::class,'import'])->name('Komponen_Finishing.import');
// End KomponenFinishing

// Kebutuhan Komponen Finishing 
Route::resource('/Kebutuhan_Finishing_Item',KebutuhanKomponenFinishingItemController::class);
Route::get('/Kebutuhan_Finishing_Item/export/{itemId}',[KebutuhanKomponenFinishingItemController::class,'export'])->name('Kebutuhan_Komponen_Finishing_Item.export');
Route::post('/Kebutuhan_Finishing_Item/import/{itemId}',[KebutuhanKomponenFinishingItemController::class,'import'])->name('Kebutuhan_Komponen_Finishing_Item.import');
// End Kebutuhan Komponen Finishing

// KartonBox
Route::resource('/Karton_Box',MasterKartonBoxController::class);
Route::get('Karton_Box_Export' ,[MasterKartonBoxController::class,'export'])->name('Karton_Box.export');
Route::post('Karton_Box_Import',[MasterKartonBoxController::class,'import'])->name('Karton_Box.import');
// End KartonBox

// Kebutuhan Karton Box
Route::resource('/Kebutuhan_Karton_Box_Item',KebutuhanKartonBoxItemController::class);
Route::get('/Kebutuhan_Karton_Box_Item/export/{itemId}',[KebutuhanKartonBoxItemController::class,'export'])->name('Kebutuhan_Karton_Box_Item.export');
Route::post('/Kebutuhan_Karton_Box_Item/import/{itemId}',[KebutuhanKartonBoxItemController::class,'import'])->name('Kebutuhan_Karton_Box_Item.import');
// End Kebutuhan Karton Box

// Pendukung_Packing
Route::resource('/Pendukung_Packing',MasterPendukungPackingController::class);
Route::get('Pendukung_Packing_Export',[MasterPendukungPackingController::class,'export'])->name('Pendukung_Packing.export');
Route::post('Pendukung_Packing_Import',[MasterPendukungPackingController::class,'import'])->name('Pendukung_Packing.import');
// end Pendukung Packing

// Kebutuhan Pendukung Packing
Route::resource('/Kebutuhan_Packing_Item',KebutuhanPendukungPackingItemController::class);
Route::get('/Kebutuhan_Packing_Item/export/{itemId}',[KebutuhanPendukungPackingItemController::class,'export'])->name('Kebutuhan_Pendukung_Packing_Item.export');
Route::post('/Kebutuhan_Packing_Item/import/{itemId}',[KebutuhanPendukungPackingItemController::class,'import'])->name('Kebutuhan_Pendukung_Packing_Item.import');
// End Kebutuhan Pendukung Packing

// Borongan Dalam
Route::resource('/Borongan_Dalam_Item',BoronganDalamItemController::class);
Route::get('/Borongan_Dalam_Item/export/{itemId}',[BoronganDalamItemController::class,'export'])->name('Borongan_Dalam_Item.export');
// end Borongan Dalam

// Borongan Luar
Route::resource('/Borongan_Luar_Item',BoronganLuarItemController::class);
Route::get('/Borongan_Luar_Item/export/{itemId}',[BoronganLuarItemController::class,'export'])->name('Borongan_Luar_Item.export');
// end Borongan Luar

// Gambar Item
Route::resource('/Gambar_Item',GambarItemController::class);
Route::get('/download-gambar/{id}', [GambarItemController::class, 'downloadGambar'])->name('download.gambar');
// End Gambar Item

// Gambar Kerja
Route::resource('/Gambar_Kerja',GambarKerjaController::class);

// End Gambar Kerja

// Purchase Order
Route::get('/', [PurchaseOrderController::class, 'index'])->name('home');
Route::resource('/Purchase_Order', PurchaseOrderController::class);
Route::get('/Purchase_Order/Export',[PurchaseOrderController::class,'export'])->name('Purchase_Order.export');
Route::post('/Purchase_Order/Import',[PurchaseOrderController::class,'import'])->name('Purchase_Order.import');
// End Purchase


// Detail Purchase Order
Route::resource('/Detail_Purchase_Order',DetailPurchaseOrderController::class);
// End Detail Purchase Order 

// Item
Route::resource('/Item', ItemController::class);
Route::get('/Item_Export',[ItemController::class,'export'])->name('Item.export');
Route::post('/Item_Import',[ItemController::class,'import'])->name('Item.import');
// End Item

// Collection
Route::resource('/Collection',CollectionController::class);
Route::get('Collection_Export',[CollectionController::class,'export'])->name('Collection.export');
Route::post('Collection_Import',[CollectionController::class,'import'])->name('Collection.import');
/// End Collection

// Buyer
Route::resource('/Buyer', BuyerController::class);
Route::get('/Buyer_Export',[BuyerController::class,'export'])->name('Buyer.export');
Route::post('/Buyer_Import',[BuyerController::class,'import'])->name('Buyer.import');
// End Buyer

// Pembelian
Route::resource('/Suplier', SuplierController::class);
Route::post('/import', [SuplierController::class, 'import'])->name('suplier.import');
Route::get('/export', [SuplierController::class, 'export'])->name('suplier.export');
// End Pembelian

// Register
Route::resource('/User', UserController::class);
Route::resource('/login', LoginController::class);
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);
// End Register







