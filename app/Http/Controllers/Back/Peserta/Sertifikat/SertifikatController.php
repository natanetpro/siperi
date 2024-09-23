<?php

namespace App\Http\Controllers\Back\Peserta\Sertifikat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SertifikatController extends Controller
{
    public function index()
    {
        return view('pages.back.peserta.sertifikat.index');
    }
}
