<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Contracts\Activity;


class GambarItem extends Model
{
    use HasFactory;
    protected $fillable = ['Item_Id', 'Gambar_Item'];
    public function item()
    {
        return $this->belongsTo(Item::class ,'Item_Id' ,'id');
    }
     // Log Activity
     use LogsActivity;
     public function getActivitylogOptions(): LogOptions
     {
         return LogOptions::defaults()->logFillable()->useLogName('Gambar Item');
     }
     public function tapActivity(Activity $activity, string $eventName)
     {
         // $activity->description = "This model has been  {$eventName}";
         $activity->subject_id = '1';// or user if you are using auth package
     }
 

}
