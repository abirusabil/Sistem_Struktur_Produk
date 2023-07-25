<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Contracts\Activity;


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
      // Log Activity
      use LogsActivity;
      public function getActivitylogOptions(): LogOptions
      {
          return LogOptions::defaults()->logFillable()->useLogName('Master Komponen Finishing');
      }
      public function tapActivity(Activity $activity, string $eventName)
      {
          // $activity->description = "This model has been  {$eventName}";
          $activity->subject_id = '1';// or user if you are using auth package
      }
  
        
}
