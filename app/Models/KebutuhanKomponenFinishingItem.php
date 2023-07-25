<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Contracts\Activity;


class KebutuhanKomponenFinishingItem extends Model
{
    use HasFactory;
    protected $keyType = 'string';
    public $incrementing = false;
    protected $primaryKey = 'id';
    protected $fillable=[
        'id',
        'Item_Id',
        'Komponen_Finishing_Id',
        'Quantity_Kebutuhan_Komponen_Finishing_Item',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class ,'Item_Id' ,'id');
    }

    public function masterkomponenfinishing()
    {
        return $this->belongsTo(MasterKomponenFinishing::class ,'Komponen_Finishing_Id' ,'id');
    }
     // Log Activity
     use LogsActivity;
     public function getActivitylogOptions(): LogOptions
     {
         return LogOptions::defaults()->logFillable()->useLogName('Kebutuhan Komponen Finishing Item');
     }
     public function tapActivity(Activity $activity, string $eventName)
     {
         // $activity->description = "This model has been  {$eventName}";
         $activity->subject_id = '1';// or user if you are using auth package
     }
 
}