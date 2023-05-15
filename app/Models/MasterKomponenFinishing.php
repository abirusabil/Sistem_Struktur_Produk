<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterKomponenFinishing extends Model
{
    use HasFactory;
    protected $keyType = 'string';
    public $incrementing = false;
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'Nama_Komponen_Finishing',
        'Quantity_Komponen_Finishing',
        'Satuan_Komponen_Finishing',
        'Harga_Komponen_Finishing',
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
                ->orWhere('Nama_Komponen_Finishing', 'like', '%' . $search . '%')
                ->orWhere('Quantity_Komponen_Finishing', 'like', '%' . $search . '%')
                ->orWhere('Satuan_Komponen_Finishing', 'like', '%' . $search . '%')
                ->orWhere('Harga_Komponen_Finishing', 'like', '%' . $search . '%')
            );
        }

    public function suplier()
    {
        return $this->belongsTo(Suplier::class,'Suplier_Id','id');
    }
        
}
