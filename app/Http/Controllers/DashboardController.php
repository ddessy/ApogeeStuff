<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

class DashboardController extends BaseController
{
    public function dashboardPage() {
        return view('pages.dashboard.dashboard');
    }
}
