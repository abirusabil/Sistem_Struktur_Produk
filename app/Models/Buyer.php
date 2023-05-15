<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buyer extends Model
{
    use HasFactory;
    protected $keyType=['id'];
    public $incrementing = false;
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'Nama_Buyer',
        'Alamat_Buyer',
        'Kontak_Buyer'
    ];

    public function scopefilter($query , array $filters)
    {
        $query->when(
            $filters['search'] ?? false,
            fn ($query, $search) =>
            $query->where('id', 'like', '%' . $search . '%')
                ->orWhere('Nama_Buyer', 'like', '%' . $search . '%')
                ->orWhere('Alamat_Buyer', 'like', '%' . $search . '%')
                ->orWhere('Kontak_Buyer', 'like', '%' . $search . '%')
        );
    }
}



