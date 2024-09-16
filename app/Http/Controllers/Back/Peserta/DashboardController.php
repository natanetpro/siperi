<?php

namespace App\Http\Controllers\Back\Peserta;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('pages.back.peserta.dashboard.index');
    }
}
