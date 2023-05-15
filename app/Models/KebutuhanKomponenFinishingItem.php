<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KebutuhanKomponenFinishingItem extends Model
{
    use HasFactory;
    protected $keyType = 'string';
    public $incrementing = false;
    protected $primaryKey = 'id';
    protected $fillable=[
        'id',
        'Item_Id',
        'Komponen_Finishing_Id',
        'Quantity_Kebutuhan_Komponen_Finishing_Item',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class ,'Item_Id' ,'id');
    }

    public function masterkomponenfinishing()
    {
        return $this->belongsTo(MasterKomponenFinishing::class ,'Komponen_Finishing_Id' ,'id');
    }
}