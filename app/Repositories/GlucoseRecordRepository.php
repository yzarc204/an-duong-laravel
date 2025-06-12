<?php

namespace App\Repositories;

use App\Models\GlucoseRecord;
use Carbon\Carbon;

class GlucoseRecordRepository
{
    public function getFilteredQuery($userId, $filters)
    {
        $query = GlucoseRecord::query();

        if (!empty($filters['dateFrom']) && !empty($filters['dateTo'])) {
            $startDate = Carbon::parse($filters['dateFrom'])->startOfDay();
            $endDate = Carbon::parse($filters['dateTo'])->endOfDay();
            $query->whereBetween('measure_at', [$startDate, $endDate]);
        }

        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        $query->where('user_id', $userId);

        return $query;
    }

    public static function getLatestRecordQuery($subQuery)
    {
        $query = GlucoseRecord::fromSub($subQuery, 'sub')->orderBy('measure_at', 'asc');
        return $query;
    }
}
