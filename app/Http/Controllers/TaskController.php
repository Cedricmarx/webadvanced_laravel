<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Task;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // hier krijgt ge uw index terug en gaat die het sorteren op desc dus de laaste toegevoegde taak eerst en stuurt hij een lijst terug naar de view. (ga naar welcome.blade.php)
        $tasks = Task::orderBy('created_at','desc')->get(); // laatste task is de eerste
        return view('welcome')->with('tasks',$tasks);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //hier wordt de task megegeven en wordt een nieuw objTask aangemaakt en wordt de note ingestoken.
        $task = $request['task'];

        $objTask = new Task();
        $objTask->note = $task;
        $objTask->save();

        return redirect() -> back(); // geeft dezelfde website terug

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // het verwijderen van tasks
        $task = Task::where('id',$id)->first(); // kijken welke id gelijk is aan welke task

        $task->delete(); // task uit de database verwijderd

        return redirect() -> back(); // refreshen van de pagina
    }
}
