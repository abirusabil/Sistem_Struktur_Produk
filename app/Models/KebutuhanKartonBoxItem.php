<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Contracts\Activity;


class KebutuhanKartonBoxItem extends Model
{
    use HasFactory;
    protected $keyType = 'string';
    public $incrementing = false;
    protected $primaryKey = 'id';
    protected $fillable=[
        'id',
        'Item_Id',
        'Jenis_Kebutuhan_Karton_Box',
        'Keterangan_Kebutuhan_Karton_Box_Item',
        'Tinggi_Kebutuhan_Karton_Box_Item',
        'Lebar_Kebutuhan_Karton_Box_Item',
        'Panjang_Kebutuhan_Karton_Box_Item',
        'Quantity_Kebutuhan_Karton_Box_Item',
        'Harga_Kebutuhan_Karton_Box_Item',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class ,'Item_Id' ,'id');
    }
     // Log Activity
     use LogsActivity;
     public function getActivitylogOptions(): LogOptions
     {
         return LogOptions::defaults()->logFillable()->useLogName('Kebutuhan Karton Box Item');
     }
     public function tapActivity(Activity $activity, string $eventName)
     {
         // $activity->description = "This model has been  {$eventName}";
         $activity->subject_id = '1';// or user if you are using auth package
     }
 

}
