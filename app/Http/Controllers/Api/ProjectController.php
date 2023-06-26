<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    public function index(){

        // Prendiamo tutti i progetti con il metodo 'all()'
        $projects = Project::all();

        // Stampiamo i dati in un file json
        return response()->json($projects);

    }
}
