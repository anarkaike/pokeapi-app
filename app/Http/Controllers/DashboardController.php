<?php

namespace App\Http\Controllers;

use App\Services\DashboardService;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(DashboardService $service): View
    {
        $stats = $service->getStats();
        return view('pages.dashboard', compact('stats'));
    }
}
