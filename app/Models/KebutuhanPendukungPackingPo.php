<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KebutuhanPendukungPackingPo extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function scopeFilter($query , array $filters)
    {
        $query->when(
            $filters['search'] ?? false,
            fn ($query, $search) =>
            $query->whereHas('PurchaseOrder', function ($query) use ($search) {
                $query->where('Dasar_Po', 'like', '%' . $search . '%')
                ->orwhere('Buyer_Id', 'like', '%' . $search . '%')
                ->orwhere('Tanggal_Masuk', 'like', '%' . $search . '%')
                ->orwhere('Schedule_Kirim', 'like', '%' . $search . '%');
            })
            ->orWhere('Job_Order', 'like', '%' . $search . '%')
            ->orWhere('Nama_Item', 'like', '%' . $search . '%')
            ->orWhere('Quantity_Purchase_Order', 'like', '%' . $search . '%')
            ->orWhere('No_Cutting', 'like', '%' . $search . '%')
            ->orWhere('Pendukung_Packing_Id', 'like', '%' . $search . '%')
            ->orWhere('Nama_Pendukung_Packing', 'like', '%' . $search . '%')
            ->orWhere('Lebar_Kebutuhan_Pendukung_Packing_Item', 'like', '%' . $search . '%')
            ->orWhere('Panjang_Kebutuhan_Pendukung_Packing_Item', 'like', '%' . $search . '%')
            ->orWhere('Tebal_Pendukung_Packing', 'like', '%' . $search . '%')
            ->orWhere('Satuan_Pendukung_Packing', 'like', '%' . $search . '%')
            ->orWhere('Harga_Pendukung_Packing', 'like', '%' . $search . '%')
        );
    }
    public function PurchaseOrder()
    {
       return $this->belongsTo(PurchaseOrder::class,'Job_Order','id');
    }
}
