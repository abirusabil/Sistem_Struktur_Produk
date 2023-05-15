<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterPendukungPacking extends Model
{
    use HasFactory;
    protected $keyType = 'string';
    public $incrementing = false;
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'Nama_Pendukung_Packing',
        'Tebal_Pendukung_Packing',
        'Panjang_Pendukung_Packing',
        'Lebar_Pendukung_Packing',
        'Harga_Pendukung_Packing',
        'Satuan_Pendukung_Packing',
        'Suplier_Id'
    ];
    public function scopeFilter($query , array $filters)
        {
            $query->when(
                $filters['search'] ?? false,
                fn ($query, $search) =>
                $query->whereHas('suplier', function ($query) use ($search) {
                    $query->where('nama_suplier', 'like', '%' . $search . '%');
                })
                ->orWhere('id', 'like', '%' . $search . '%')
                ->orWhere('Nama_Pendukung_Packing', 'like', '%' . $search . '%')
                ->orWhere('Tebal_Pendukung_Packing', 'like', '%' . $search . '%')
                ->orWhere('Panjang_Pendukung_Packing', 'like', '%' . $search . '%')
                ->orWhere('Lebar_Pendukung_Packing', 'like', '%' . $search . '%')
                ->orWhere('Satuan_Pendukung_Packing', 'like', '%' . $search . '%')
                ->orWhere('Harga_Pendukung_Packing', 'like', '%' . $search . '%')
            );
        }

    public function suplier()
    {
        return $this->belongsTo(Suplier::class,'Suplier_Id','id');
    }
    
}
