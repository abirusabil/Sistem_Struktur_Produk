<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    use HasFactory;
    use HasFactory;
    protected $keyType = 'string';
    public $incrementing = false;
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'Nama_Collection',
        'Buyer_Id'
    ];

    public function scopeFilter($query , array $filters)
        {
            $query->when(
                $filters['search'] ?? false,
                fn ($query, $search) =>
                $query->whereHas('buyer', function ($query) use ($search) {
                    $query->where('Nama_Buyer', 'like', '%' . $search . '%');
                })
                ->orWhere('id', 'like', '%' . $search . '%')
                ->orWhere('Nama_Collection', 'like', '%' . $search . '%')
            );
        }

    public function buyer()
    {
        return $this->belongsTo(Buyer::class ,'Buyer_Id' ,'id');
    }
}
