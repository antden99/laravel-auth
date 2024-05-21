<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Http\Controllers\Controller;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //dd(Project::all()); //ricordati di definire la rotta adesso in routes
        $projects = Project::all();
        return view('admin.projects.index',compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.projects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request) //quando invii il form, ricordati di andare nella cartella Request e autorizzare cambiando da false a true, altrimenti non funzionerà
    {
        //dd($request->all()); //ricorda all() 

        //per create, ricorda ri aggiungere le $fillable nel modello Project

        //valida 
        $val_date=$request->all();

        //crea
        Project::create($val_date); //con create creo una nuova istanza di project e la salvo direttamente nel db ma ricorda le $fillable

        //redirect
        return to_route('admin.projects.index')->with('success', 'Project added successfully');;
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('admin.projects.show',compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
       return view('admin.projects.edit',compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        //dd($request->all());
        //dd($project);

        //1) i dati vengono validati direttamente da UpdatProjectRequest
        $project->update($request->all());

        return to_route('admin.projects.index')->with('success', 'Project update successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return to_route('admin.projects.index')->with('success', 'Project destory successfully');
    }
}
