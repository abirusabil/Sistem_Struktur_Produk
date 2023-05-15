<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoronganDalamItem extends Model
{
    use HasFactory;
    protected $keyType = 'string';
    public $incrementing = false;
    protected $primaryKey = 'id';
    protected $fillable=[
        'Item_Id',
        'Bahan_1',
        'Bahan_2',
        'Sanding_1',
        'Sanding_2',
        'Proses_Assembling',
        'Finishing',
        'Packing',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class ,'Item_Id' ,'id');
    }
}
