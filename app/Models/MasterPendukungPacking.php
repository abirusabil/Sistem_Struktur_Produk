<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Contracts\Activity;

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

    // Log Activity
    use LogsActivity;
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logFillable()->useLogName('Master Pendukung Packing');
    }
    public function tapActivity(Activity $activity, string $eventName)
    {
        // $activity->description = "This model has been  {$eventName}";
        $activity->subject_id = '1';// or user if you are using auth package
    }

    
}
