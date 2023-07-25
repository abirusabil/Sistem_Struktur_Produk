<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Contracts\Activity;


class KebutuhanPendukungPackingItem extends Model
{
    use HasFactory;
    protected $keyType = 'string';
    public $incrementing = false;
    protected $primaryKey = 'id';
    protected $fillable=[
        'id',
        'Item_Id',
        'Pendukung_Packing_Id',
        'Keterangan_Kebutuhan_Pendukung_Packing_Item',
        'Lebar_Kebutuhan_Pendukung_Packing_Item',
        'Panjang_Kebutuhan_Pendukung_Packing_Item',
        'Quantity_Kebutuhan_Pendukung_Packing_Item',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class ,'Item_Id' ,'id');
    }

    public function masterpendukungpacking()
    {
        return $this->belongsTo(MasterPendukungPacking::class ,'Pendukung_Packing_Id' ,'id');
    }
    // Log Activity
    use LogsActivity;
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logFillable()->useLogName('Kebutuhan Pendukung Packing Item');
    }
    public function tapActivity(Activity $activity, string $eventName)
    {
        // $activity->description = "This model has been  {$eventName}";
        $activity->subject_id = '1';// or user if you are using auth package
    }

    
}
