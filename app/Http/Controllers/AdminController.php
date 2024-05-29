<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function welcome()
    {
        return view('pages.admin.index-admin');
    }

    public function proposals()
    {
        // Logic to fetch and display proposals
    }

    public function students()
    {
        // Logic to manage students
    }

    public function settings()
    {
        // Logic for settings
    }
}
