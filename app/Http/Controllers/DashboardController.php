<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index');
    }

    public function pageOperator()
    {
        return view('dashboard.operator-index');
    }

    public function page()
    {
        // return redirect('/home')->with('success', 'Login Berhasil');
        return view('admin.admin');
    }
}
