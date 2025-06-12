<?php

namespace App\Http\Controllers;

use App\Models\GlucoseRecord;
use App\Repositories\GlucoseRecordRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    private $glucoseRecordRepository;

    public function __construct(GlucoseRecordRepository $glucoseRecordRepository)
    {
        $this->glucoseRecordRepository = $glucoseRecordRepository;
    }

    public function dashboard()
    {
        $query = GlucoseRecord::where('user_id', Auth::id())->orderBy('measure_at', 'desc');
        $records = $this->glucoseRecordRepository->getLatestRecordQuery($query)->take(30)->get();
        return view('dashboard', compact('records'));
    }
}
