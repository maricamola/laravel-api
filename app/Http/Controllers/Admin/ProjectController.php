<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Category;
use App\Http\Requests\ProjectRequest;
use App\Models\Technology;
use Illuminate\Support\Facades\Storage;


class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $direction= 'asc';
        $projects = Project::orderBy('id', $direction)->paginate(5);
        return view('admin.projects.index', compact('projects', 'direction'));
    }

    public function orderBy($direction){
        $direction = $direction === 'asc' ? 'desc' : 'asc';
        $projects = Project::orderBy('id', $direction)->paginate(5);
        return view('admin.projects.index', compact('projects', 'direction'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $technologies = Technology::all();
        $title = 'Creazione nuovo progetto';
        $method = 'POST';
        $route = route('admin.projects.store');
        $project = null;
        return view('admin.projects.create-edit', compact('title','method','route','project', 'categories','technologies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectRequest $request)
    {
        // dd($request->all());
        $form_data = $request->all();
        // Creare slug
        $form_data['slug'] = Project::generateSlug($form_data['title']);
        $form_data['date_creation'] = date('Y-m-d');

        //Verifico se è stata caricata un'immagine;
        if(array_key_exists('thumb' , $form_data)){


            //Salvo il nome originale dell'immagine
            $form_data['thumb_original_name'] = $request->file('thumb')->getClientOriginalName();

            $form_data['thumb'] = Storage::put('uploads/', $form_data['thumb']);
            // dd('esiste');
        }



        // $new_project = new Project();
        // $new_project->fill($form_data);
        // $new_project->save();

                // soluzione short per fare quello commentato sopra
                $new_project = Project::create($form_data);

                // se ho inviato almeno un tag
                if(array_key_exists('technologies', $form_data)){
                    // "attacco" al post appena creato l'array dei tags proveniente dal form
                    $new_project->technologies()->attach($form_data['technologies']);
                }
        return redirect()->route('admin.projects.show', $new_project);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {


        $date = date_create($project->date);
        $data_formatted = date_format($date, 'd/m/Y') ;

        return view('admin.projects.show', compact('project', 'data_formatted'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $categories = Category::all();
        $technologies = Technology::all();
        $title= "Modifica di: " . $project->title;
        $method= 'PUT';
        $route= route('admin.projects.update' , $project);
        return view('admin.projects.create-edit', compact('title','method','route', 'project', 'categories', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProjectRequest $request, Project $project)
    {
        $form_data = $request->All();
        if($form_data['title'] !== $project->title){
            $form_data['slug'] = Project::generateSlug($form_data['title']);
        }else{
            $form_data['slug'] = $project->slug;
        }
        $form_data['date_creation'] = date('Y-m-d');

        //Verifico se è stata caricata un'immagine;
        if(array_key_exists('thumb',$form_data)){

            //Se l'immagine esiste, elimino quella vecchia
            if($project->thumb){
                Storage::disk('public')->delete($project->thumb);
            }

            //Salvo il nome originale dell'immagine
            $form_data['thumb_original_name'] = $request->file('thumb')->getClientOriginalName();

            $form_data['thumb'] = Storage::put('uploads/', $form_data['thumb']);
            // dd('esiste');
        }

        if(array_key_exists('noImage', $form_data) && $project->thumb) {
            Storage::disk('public')->delete($project->thumb);
            $form_data['thumb_original_name'] = '';
            $form_data['thumb'] = '';
        }

        $project->update($form_data);



        if(array_key_exists('technologies', $form_data)){
            // se esiste la chiave sicronizzo con i nuovi dati la tabella pivot
            $project->technologies()->sync($form_data['technologies']);
        }else{
            // se non passo nessun tag elimino tutte le relazioni
            $project->technologies()->detach();
        }

        return redirect()->route('admin.projects.show',$project);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        if($project->thumb){
            Storage::disk('public')->delete($project->thumb);
        }

        $project->delete();

        return redirect()->route('admin.projects.index')->with('deleted', 'Progetto eliminato correttamente');
    }
}
