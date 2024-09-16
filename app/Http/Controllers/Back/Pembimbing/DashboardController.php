<?php

namespace App\Http\Controllers\Back\Pembimbing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('pages.back.pembimbing.dashboard.index');
    }
}
