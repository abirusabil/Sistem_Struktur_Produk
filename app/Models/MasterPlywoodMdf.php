<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Contracts\Activity;


class MasterPlywoodMdf extends Model
{
    use HasFactory;
    protected $keyType = 'string';
    public $incrementing = false;
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'Nama_Plywood_MDF',
        'Tebal_Plywood_MDF',
        'Panjang_Plywood_MDF',
        'Lebar_Plywood_MDF',
        'Harga_Plywood_MDF',
        'Satuan_Plywood_MDF',
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
                ->orWhere('Nama_Plywood_MDF', 'like', '%' . $search . '%')
                ->orWhere('Tebal_Plywood_MDF', 'like', '%' . $search . '%')
                ->orWhere('Panjang_Plywood_MDF', 'like', '%' . $search . '%')
                ->orWhere('Lebar_Plywood_MDF', 'like', '%' . $search . '%')
                ->orWhere('Satuan_Plywood_MDF', 'like', '%' . $search . '%')
                ->orWhere('Harga_Plywood_MDF', 'like', '%' . $search . '%')
            );
        }

    public function suplier()
    {
        return $this->belongsTo(Suplier::class,'Suplier_Id' , 'id');
    }

      // Log Activity
      use LogsActivity;
      public function getActivitylogOptions(): LogOptions
      {
          return LogOptions::defaults()->logFillable()->useLogName('Master Plywood MDF');
      }
      public function tapActivity(Activity $activity, string $eventName)
      {
          // $activity->description = "This model has been  {$eventName}";
          $activity->subject_id = '1';// or user if you are using auth package
      }
  
}
