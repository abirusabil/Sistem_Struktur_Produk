<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GambarKerja extends Model
{
    use HasFactory;
    protected $fillable = ['Item_Id', 'pdf_file'];
    public function item()
    {
        return $this->belongsTo(Item::class ,'Item_Id' ,'id');
    }
}
