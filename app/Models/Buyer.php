<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Contracts\Activity;



class Buyer extends Model
{
    use HasFactory;
    protected $keyType=['id'];
    public $incrementing = false;
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'Nama_Buyer',
        'Alamat_Buyer',
        'Kontak_Buyer'
    ];

    public function scopefilter($query , array $filters)
    {
        $query->when(
            $filters['search'] ?? false,
            fn ($query, $search) =>
            $query->where('id', 'like', '%' . $search . '%')
                ->orWhere('Nama_Buyer', 'like', '%' . $search . '%')
                ->orWhere('Alamat_Buyer', 'like', '%' . $search . '%')
                ->orWhere('Kontak_Buyer', 'like', '%' . $search . '%')
        );
    }
       // Log Activity
    use LogsActivity;
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logFillable()->useLogName('Buyer');
    }
    public function tapActivity(Activity $activity, string $eventName)
    {
        // $activity->description = "This model has been  {$eventName}";
        $activity->subject_id = '1';// or user if you are using auth package
    }

 
}



