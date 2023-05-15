<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KebutuhanPlywoodMdfItem extends Model
{
    use HasFactory;
    protected $keyType = 'string';
    public $incrementing = false;
    protected $primaryKey = 'id';
    protected $fillable=[
        'id',
        'Item_Id',
        'Plywood_MDF_Id',
        'KP_Kebutuhan_Plywood_MDF_Item',
        'Keterangan_Kebutuhan_Plywood_MDF_Item',
        'Grade_Kebutuhan_Plywood_MDF_Item',
        'Lebar_Kebutuhan_Plywood_MDF_Item',
        'Panjang_Kebutuhan_Plywood_MDF_Item',
        'Quantity_Kebutuhan_Plywood_MDF_Item',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class ,'Item_Id' ,'id');
    }

    public function masterplywoodmdf()
    {
        return $this->belongsTo(MasterPlywoodMdf::class ,'Plywood_MDF_Id' ,'id');
    }
}
