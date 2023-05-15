<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterKartonBox extends Model
{
    use HasFactory;

    protected $keyType = 'string';
    public $incrementing = false;
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'Jenis_Karton_Box',
        'Satuan_Karton_Box',
        'Harga_Karton_Box',
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
                ->orWhere('Jenis_Karton_Box', 'like', '%' . $search . '%')
                ->orWhere('Satuan_Karton_Box', 'like', '%' . $search . '%')
                ->orWhere('Harga_Karton_Box', 'like', '%' . $search . '%')
            );
        }

    public function suplier()
    {
        return $this->belongsTo(Suplier::class,'Suplier_Id','id');
    }
}
