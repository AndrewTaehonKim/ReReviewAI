<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $seenProblems = $user->calcProblems()->wherePivot('is_seen', true)->get();
        return view('dashboard', compact('seenProblems'));
    }
}
