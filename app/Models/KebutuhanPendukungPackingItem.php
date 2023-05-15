<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KebutuhanPendukungPackingItem extends Model
{
    use HasFactory;
    protected $keyType = 'string';
    public $incrementing = false;
    protected $primaryKey = 'id';
    protected $fillable=[
        'id',
        'Item_Id',
        'Pendukung_Packing_Id',
        'Keterangan_Kebutuhan_Pendukung_Packing_Item',
        'Lebar_Kebutuhan_Pendukung_Packing_Item',
        'Panjang_Kebutuhan_Pendukung_Packing_Item',
        'Quantity_Kebutuhan_Pendukung_Packing_Item',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class ,'Item_Id' ,'id');
    }

    public function masterpendukungpacking()
    {
        return $this->belongsTo(MasterPendukungPacking::class ,'Pendukung_Packing_Id' ,'id');
    }
}
