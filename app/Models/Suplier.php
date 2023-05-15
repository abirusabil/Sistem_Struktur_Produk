<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suplier extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public $timestamps = true;

    public function scopefilter($query , array $filters)
    {
        $query->when(
            $filters['search'] ?? false,
            fn ($query, $search) =>
            $query->where('Nama_Suplier', 'like', '%' . $search . '%')
                ->orWhere('Alamat_Suplier', 'like', '%' . $search . '%')
                ->orWhere('Kontak_Suplier', 'like', '%' . $search . '%')
        );
    }
}
