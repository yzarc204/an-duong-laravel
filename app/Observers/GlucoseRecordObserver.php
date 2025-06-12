<?php

namespace App\Observers;

use App\Enums\GlucoseStatus;
use App\Enums\MeasurementPoint;
use App\Jobs\GetExerciseSuggestionJob;
use App\Jobs\GetMealSuggestionJob;
use App\Models\GlucoseRecord;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class GlucoseRecordObserver
{
    private function calculateStatus($glucose, $measurementPoint): GlucoseStatus
    {
        if ($measurementPoint == MeasurementPoint::BEFORE_MEAL) {
            if ($glucose < 70) {
                return GlucoseStatus::LOW;
            } else if ($glucose <= 130) {
                return GlucoseStatus::NORMAL;
            } else {
                return GlucoseStatus::HIGH;
            }
        } else {
            if ($glucose < 70) {
                return GlucoseStatus::LOW;
            } else if ($glucose <= 180) {
                return GlucoseStatus::NORMAL;
            } else {
                return GlucoseStatus::HIGH;
            }
        }

        return GlucoseStatus::NORMAL;
    }

    public function creating(GlucoseRecord $glucoseRecord)
    {
        // Tính toán trạng thái dựa vào chỉ số đường huyết và thời điểm đo
        if ($glucoseRecord->glucose && $glucoseRecord->measurement_point) {
            $glucoseRecord->status = $this->calculateStatus($glucoseRecord->glucose, $glucoseRecord->measurement_point);
        }

        // Lấy cân nặng từ bảng user nếu không có input weight
        if (!$glucoseRecord->weight) {
            $glucoseRecord->weight = $glucoseRecord->weight ?? $glucoseRecord->user->weight;
        }

        // Tính thời gian đo
        if (!$glucoseRecord->measure_at) {
            $glucoseRecord->measure_at = Carbon::now();
        }

        // Cập nhật cân nặng của người dùng theo input của người dùng
        if ($glucoseRecord->weight) {
            $user = $glucoseRecord->user;
            $user->weight = $glucoseRecord->weight;
            $user->save();
        }

        // Cập nhật chỉ số đường huyết gần nhất theo input của người dùng
        if ($glucoseRecord->glucose) {
            $user = $glucoseRecord->user;
            $user->latest_glucose = $glucoseRecord->glucose;
            $user->save();
        }

        // Lấy thông tin gợi ý món ăn mới
        GetMealSuggestionJob::dispatch($glucoseRecord->user);
        // Lấy thông tin gợi ý bài tập mới
        GetExerciseSuggestionJob::dispatch($glucoseRecord->user);
    }
}
