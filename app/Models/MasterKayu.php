<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterKayu extends Model
{
    use HasFactory;
    protected $keyType = 'string';
    public $incrementing = false;
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'Nama_Kayu',
        'Satuan',
        'Harga_Kayu',
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
                ->orWhere('Nama_Kayu', 'like', '%' . $search . '%')
                ->orWhere('Satuan', 'like', '%' . $search . '%')
                ->orWhere('Harga_Kayu', 'like', '%' . $search . '%')
            );
        }
    
    public function suplier()
    {
        return $this->belongsTo(Suplier::class,'Suplier_Id' , 'id');
    }
}
