<?php

namespace App\Http\Controllers;

use App\Services\ReportService;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function __construct(
        protected ReportService $reportService
    ) {}

    public function index(Request $request)
    {
        $stats = $this->reportService->getDashboardStats();
        return view('reports.index', compact('stats'));
    }

    public function exportPdf(Request $request)
    {
        $stats = $this->reportService->getDashboardStats();
        $pdf = Pdf::loadView('reports.pdf', compact('stats'));
        return $pdf->download('sinodtech-report-' . now()->format('Y-m-d') . '.pdf');
    }
}
