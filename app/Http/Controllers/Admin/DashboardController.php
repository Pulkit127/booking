<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Video;   
class DashboardController extends Controller
{
    public function index() {
        $totalUsers = User::count();
        $totalVideos = Video::count();
        return view('admin.dashboard',compact('totalUsers','totalVideos'));     
    }
}
