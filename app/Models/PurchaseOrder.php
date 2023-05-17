<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    use HasFactory;
    protected $keyType = 'string';
    public $incrementing = false;
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'Dasar_Po',
        'Buyer_Id',
        'Tanggal_Masuk',
        'Schedule_Kirim'
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
                ->orWhere('Dasar_Po', 'like', '%' . $search . '%')
                ->orWhere('Tanggal_Masuk', 'like', '%' . $search . '%')
                ->orWhere('Schedule_Kirim', 'like', '%' . $search . '%')
            );
        }

    public function buyer()
    {
        return $this->belongsTo(Buyer::class ,'Buyer_Id' ,'id');
    }
}
