<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalStudents = Student::count();
        $recentStudents = Student::latest()->take(5)->get();

        return view('dashboard', compact('totalStudents', 'recentStudents'));
    }
}