<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Contracts\Activity;


class KebutuhanKayuItem extends Model
{
    use HasFactory;
    protected $keyType = 'string';
    public $incrementing = false;
    protected $primaryKey = 'id';
    protected $fillable=[
        'id',
        'Item_Id',
        'Kayu_Id',
        'KP_Kebutuhan_Kayu_Item',
        'Keterangan_Kebutuhan_Kayu_Item',
        'Grade_Kebutuhan_Kayu_Item',
        'Tebal_Kebutuhan_Kayu_Item',
        'Lebar_Kebutuhan_Kayu_Item',
        'Panjang_Kebutuhan_Kayu_Item',
        'Quantity_Kebutuhan_Kayu_Item',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class ,'Item_Id' ,'id');
    }

    public function masterkayu()
    {
        return $this->belongsTo(MasterKayu::class ,'Kayu_Id' ,'id');
    }

      // Log Activity
      use LogsActivity;
      public function getActivitylogOptions(): LogOptions
      {
          return LogOptions::defaults()->logFillable()->useLogName('Kebutuhan Kayu Item');
      }
      public function tapActivity(Activity $activity, string $eventName)
      {
          // $activity->description = "This model has been  {$eventName}";
          $activity->subject_id = '1';// or user if you are using auth package
      }
  
}
