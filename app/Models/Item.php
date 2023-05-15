<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $keyType = 'string';
    public $incrementing = false;
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'Collection_Id',
        'Nama_Item',
        'Tinggi_Item',
        'Lebar_Item',
        'Panjang_Item',
        'Berat_Item',
        'Warna_Item'
    ];

    public function scopeFilter($query , array $filters)
        {
            $query->when(
                $filters['search'] ?? false, fn ($query, $search) =>
                    $query->whereHas('collection.buyer', function ($query) use ($search) 
                        { 
                            $query->where('Nama_Buyer', 'like', '%' . $search . '%');
                        })
                    ->orwhereHas('collection', function ($query) use ($search) 
                        { 
                            $query->where('Nama_Collection', 'like', '%' . $search . '%');
                        })
                    ->orWhere('id', 'like', '%' . $search . '%')
                    ->orWhere('Nama_Item', 'like', '%' . $search . '%')
                    ->orWhere('Tinggi_Item', 'like', '%' . $search . '%')
                    ->orWhere('Lebar_Item', 'like', '%' . $search . '%')
                    ->orWhere('Panjang_Item', 'like', '%' . $search . '%')
                    ->orWhere('Berat_Item', 'like', '%' . $search . '%')
                    ->orWhere('Warna_Item', 'like', '%' . $search . '%')
            );
        }
    public function collection()
    {
        return $this->belongsTo(Collection::class ,'Collection_Id' ,'id');
    }
}
