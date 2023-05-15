<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KebutuhanKartonBoxItem extends Model
{
    use HasFactory;
    protected $keyType = 'string';
    public $incrementing = false;
    protected $primaryKey = 'id';
    protected $fillable=[
        'id',
        'Item_Id',
        'Jenis_Kebutuhan_Karton_Box',
        'Keterangan_Kebutuhan_Karton_Box_Item',
        'Tinggi_Kebutuhan_Karton_Box_Item',
        'Lebar_Kebutuhan_Karton_Box_Item',
        'Panjang_Kebutuhan_Karton_Box_Item',
        'Quantity_Kebutuhan_Karton_Box_Item',
        'Harga_Kebutuhan_Karton_Box_Item',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class ,'Item_Id' ,'id');
    }

}
