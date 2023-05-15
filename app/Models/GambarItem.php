<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GambarItem extends Model
{
    use HasFactory;
    protected $fillable = ['Item_Id', 'Gambar_Item'];
    public function item()
    {
        return $this->belongsTo(Item::class ,'Item_Id' ,'id');
    }

}
