<?php

// Contoh AdminUserController
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function manageUser()
    {
        return view('admin.users.index');
    }
    public function managePost()
    {
        return view('admin.posts.index');
    }
    public function manageUserViolations()
    {
        return view('admin.violations.index');
    }
    public function communityStatistics()
    {
        return view('admin.statistics.index');
    }
}

