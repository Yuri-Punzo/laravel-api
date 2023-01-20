<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    public function index()
    {
        return response()->json([
            'success' => true,
            'results' => Project::with(['type', 'technologies'])->orderByDesc('id')->paginate(6)
        ]);
    }

    public function show($slug)
    {
        /* Show the single project as json */
        $project = Project::with('type', 'technologies')->where('slug', $slug)->first();
        //dd($project);        
        if ($project) {
            return response()->json([
                'success' => true,
                'results' => $project
            ]);
        }
        //altrimenti utilizza un messaggio per gestire l'errore
        else {
            return response()->json([
                'success' => false,
                'results' => 'Project Not Found'
            ]);
        }
    }
}
