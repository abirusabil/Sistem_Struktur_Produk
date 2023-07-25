<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Contracts\Activity;

class Suplier extends Model
{
    use LogsActivity;
    use HasFactory;
    protected $guarded = ['id'];
    public $timestamps = true;

    public function scopefilter($query , array $filters)
    {
        $query->when(
            $filters['search'] ?? false,
            fn ($query, $search) =>
            $query->where('Nama_Suplier', 'like', '%' . $search . '%')
                ->orWhere('Alamat_Suplier', 'like', '%' . $search . '%')
                ->orWhere('Kontak_Suplier', 'like', '%' . $search . '%')
        );
    }
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logUnguarded()->useLogName('Suplier');
    }
    public function tapActivity(Activity $activity, string $eventName)
    {
        $activity->description = "This model has been  {$eventName}";// or user if you are using auth package
    }
}
