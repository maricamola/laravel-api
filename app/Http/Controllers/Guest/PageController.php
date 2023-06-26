<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;

class PageController extends Controller
{
    public function index(){
        $projects = Project::orderBy('id','desc')->limit(5)->get();
        return view('guest.home');
    }

    public function contacts(){
        return view('guest.contacts');
    }
}
