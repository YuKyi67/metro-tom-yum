<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class SalesReportController extends Controller
{
    public function downloadPDF()
    {
        $sales = DB::table('orders')
            ->selectRaw('DATE(created_at) as date, SUM(total) as total_sales')
            ->where('status', 'Completed')
            ->groupByRaw('DATE(created_at)')
            ->orderBy('date', 'asc')
            ->get();

        $pdf = Pdf::loadView('pdf.sales-report', ['sales' => $sales]);
        return $pdf->download('daily-sales-report.pdf');
    }
}
