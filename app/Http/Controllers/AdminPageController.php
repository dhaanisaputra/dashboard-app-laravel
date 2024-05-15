<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminPageController extends Controller
{
    public function index()
    {
        return view('admin.admin');
    }

    public function adminList()
    {
        return view('admin.all-list-admin');
    }
}
