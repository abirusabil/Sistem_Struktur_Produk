<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KebutuhanKayuItem extends Model
{
    use HasFactory;
    protected $keyType = 'string';
    public $incrementing = false;
    protected $primaryKey = 'id';
    protected $fillable=[
        'id',
        'Item_Id',
        'Kayu_Id',
        'KP_Kebutuhan_Kayu_Item',
        'Keterangan_Kebutuhan_Kayu_Item',
        'Grade_Kebutuhan_Kayu_Item',
        'Tebal_Kebutuhan_Kayu_Item',
        'Lebar_Kebutuhan_Kayu_Item',
        'Panjang_Kebutuhan_Kayu_Item',
        'Quantity_Kebutuhan_Kayu_Item',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class ,'Item_Id' ,'id');
    }

    public function masterkayu()
    {
        return $this->belongsTo(MasterKayu::class ,'Kayu_Id' ,'id');
    }
}
