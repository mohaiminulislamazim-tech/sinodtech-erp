<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    public function index(Request $request)
    {
        $query = ActivityLog::with('user');

        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        $logs = $query->latest()->paginate(25);
        return view('activity-logs.index', compact('logs'));
    }

    public function show(ActivityLog $activityLog)
    {
        return view('activity-logs.show', compact('activityLog'));
    }
}
