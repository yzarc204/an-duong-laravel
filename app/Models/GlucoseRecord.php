<?php

namespace App\Models;

use App\Enums\GlucoseStatus;
use App\Enums\MeasurementPoint;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GlucoseRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'glucose',
        'weight',
        'measurement_point',
        'status',
        'measure_at'
    ];

    protected $appends = [
        'formatted_measure_at',
        'status_label',
        'measurement_point_label'
    ];

    protected function casts()
    {
        return [
            'measurement_point' => MeasurementPoint::class,
            'status' => GlucoseStatus::class,
            'measure_at' => 'datetime'
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getFormattedMeasureAtAttribute()
    {
        return $this->measure_at->format('d/m H:i');
    }

    public function getMeasurementPointLabelAttribute()
    {
        return $this->measurement_point->label();
    }

    public function getStatusLabelAttribute()
    {
        return $this->status->label();
    }
}
