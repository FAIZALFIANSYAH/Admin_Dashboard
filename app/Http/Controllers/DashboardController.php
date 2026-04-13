<?php

namespace App\Http\Controllers;

use App\Models\Dashboard;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stat = Dashboard::all();
        return view('dashboard.index', compact('stat'));
    }
}