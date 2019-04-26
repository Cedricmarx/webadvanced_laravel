<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Task;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    /**
     * Display index
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::orderBy('created_at', 'desc')->take(5)->get();
        $categories = Task::distinct()->get('category');
        return view('welcome')->with(['tasks' => $tasks, 'categories' => $categories]);
    }

    /**
     * Display overview
     * 
     * @return \Illuminate\Http\Response
     */
    public function overview() {
        $tasks = Task::orderBy('created_at', 'desc')->get();
        $categories = Task::distinct()->get('category');
        return view('overview')->with(['tasks' => $tasks, 'categories' => $categories]);
    }

    /**
     * Search category
     * 
     * @return \Illuminate\Http\Response
     */
    public function searchCategory($category) {
        $tasks = Task::orderBy('created_at', 'desc')->where('category', '=', $category)->get();
        $categories = Task::distinct()->get('category');
        return view('searchCategory')->with(['category' => $category, 'tasks' => $tasks, 'categories' => $categories]);
    }

    /**
     * Store a newly created task in storage
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'note' => 'required',
            'category' => 'required',
            'due' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $task = new Task();
        $task->note = $request->get('note');
        $task->category = $request->get('category');
        $task->date = now();
        $task->dueDate = $request->get('due');
        $task->save();

        return response()->json(['success' => 'Data successfully added']);
    }

    /**
     * Remove the specified task from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::where('id', $id)->first();
        $task->delete();
        return redirect()->back();
    }

    /**
     * Complete the specified task 
     * 
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function complete($id)
    {
        $task = Task::where('id', $id)->first();
        $task->complete = true;
        $task->save();
        return redirect()->back();
    }

    /**
     * Mark specified task as incomplete
     * 
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function incomplete($id)
    {
        $task = Task::where('id', $id)->first();
        $task->complete = false;
        $task->save();
        return redirect()->back();
    }
}
