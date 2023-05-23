<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPurchaseOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'Item_Id',
        'Job_Order',
        'Quantity_Purchase_Order'
    ];

    public function item()
    {
        return $this->belongsTo(Item::class ,'Item_Id' ,'id');
    }
}
