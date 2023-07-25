<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Contracts\Activity;


class KebutuhanAccessoriesHardwareItem extends Model
{
    use HasFactory;
    protected $keyType = 'string';
    public $incrementing = false;
    protected $primaryKey = 'id';
    protected $fillable=[
        'id',
        'Item_Id',
        'Accessories_Hardware_Id',
        'Keterangan_Kebutuhan_Accessories_Hardware_Item',
        'Quantity_Kebutuhan_Accessories_Hardware_Item',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class ,'Item_Id' ,'id');
    }

    public function masteraccessorieshardware()
    {
        return $this->belongsTo(MasterAccessoriesHardware::class ,'Accessories_Hardware_Id' ,'id');
    }
      // Log Activity
      use LogsActivity;
      public function getActivitylogOptions(): LogOptions
      {
          return LogOptions::defaults()->logFillable()->useLogName('Kebutuhan Accessories Hardware');
      }
      public function tapActivity(Activity $activity, string $eventName)
      {
          // $activity->description = "This model has been  {$eventName}";
          $activity->subject_id = '1';// or user if you are using auth package
      }
  
}
