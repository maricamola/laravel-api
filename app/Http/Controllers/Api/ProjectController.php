<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    public function index(){

        // Prendiamo tutti i progetti con il metodo 'all()'
        $projects = Project::white('category')->paginate(10);

        // Stampiamo i dati in un file json
        return response()->json($projects);

    }
}
