<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Contracts\Activity;


class PurchaseOrder extends Model
{
    use HasFactory ;
    use LogsActivity;
    // protected static $logFillable = true;
    protected $keyType = 'string';
    public $incrementing = false;
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'Dasar_Po',
        'Buyer_Id',
        'Tanggal_Masuk',
        'Schedule_Kirim',
        'Status'
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
    // Log Activity
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logFillable()->useLogName('Purchase Order');
    }
    public function tapActivity(Activity $activity, string $eventName)
    {
        // $activity->description = "This model has been  {$eventName}";
        $activity->subject_id = '1';// or user if you are using auth package
    }
}
