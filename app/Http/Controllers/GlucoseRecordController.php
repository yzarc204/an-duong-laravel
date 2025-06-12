<?php

namespace App\Http\Controllers;

use App\Enums\GlucoseStatus;
use App\Enums\MeasurementPoint;
use App\Http\Requests\GlucoseRecordFilterRequest;
use App\Http\Requests\GlucoseRecordRequest;
use App\Repositories\GlucoseRecordRepository;
use App\Models\GlucoseRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GlucoseRecordController extends Controller
{
    protected $glucoseRecordRepository;

    public function __construct(GlucoseRecordRepository $glucoseRecordRepository)
    {
        $this->glucoseRecordRepository = $glucoseRecordRepository;
    }

    public function index(GlucoseRecordFilterRequest $request)
    {
        $userId = Auth::id();
        $filters = $request->validated();
        $page = $request->query('page', 1);

        $subQuery = $this->glucoseRecordRepository->getFilteredQuery($userId, $filters)->select('measure_at', 'glucose', 'weight', 'status', 'measurement_point')->orderBy('measure_at', 'desc')->limit(30)->offset(($page - 1) * 10);
        $chartRecords = $this->glucoseRecordRepository->getLatestRecordQuery($subQuery)->get();

        $records = $this->glucoseRecordRepository->getFilteredQuery(Auth::id(), $filters)->orderBy('measure_at', 'desc')->paginate(10);
        $records->appends($request->query());

        $statuses = GlucoseStatus::keysLabels();

        return view('glucose-record.index', compact('records', 'statuses', 'chartRecords', 'filters'));
    }

    public function create()
    {
        $measurementPoints = MeasurementPoint::keysLabels();
        return view('glucose-record.create', compact('measurementPoints'));
    }

    public function store(GlucoseRecordRequest $request)
    {
        $glucoseRecordData = array_merge($request->validated(), [
            'user_id' => Auth::id()
        ]);
        GlucoseRecord::create($glucoseRecordData);
        return redirect()->back()->with('success', 'Lưu lịch sử đường huyết thành công');
    }
}
