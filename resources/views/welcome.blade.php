@extends('layouts.master')

@section('title', 'Home')
@section('nav')
@section('content')
<article class="mt-5 align-content-center my-auto">
    <h1 class="text-center h1 text-light bg-info p-2 mb-0">Last Created</h1>
    <div class="table-responsive">
        <table class="table table-striped table-light">
            <thead class="thead-dark">
                <tr>
                    <th>Task</th>
                    <th>Category</th>
                    <th>Due Date</th>
                    <th>Date Created</th>
                    <th colspan="2"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($tasks as $task)
                <tr>
                    <td class="{{ $task->complete == 1 ? 'task-completed text-success' : 'text-danger' }}">{{ $task->note }}</td>
                    <td>{{ $task->category }}</td>
                    <td>{{ $task->dueDate }}</td>
                    <td>{{ $task->date }}</td>
                    <td class="text-center"><a href="#delete-modal" data-toggle="modal">Delete Task</a></td>
                    @if (!$task->complete)
                    <td class="text-left"><a href="{{ route('markComplete', ['task_id' => $task->id]) }}">Mark as completed</a></td>
                    @else
                    <td class="text-left"><a href="{{ route('markIncomplete', ['task_id' => $task->id]) }}">Mark as incomplete</a></td>
                    @endif
                </tr>
                @section('delete-task', route('deleteTask', ['task_id' => $task->id]))
                @endforeach
            </tbody>
        </table>
    </div>
</article>
<button type="button" class="btn btn-primary btn-lg mb-2 btn-block" data-toggle="modal" data-target="#create-task-modal" id="open">Create new task</button>
@endsection