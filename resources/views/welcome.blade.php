<!DOCTYPE html>
<html lang="en">
<head>
    <title>WebProject</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>

<section class="container">
    <h2>To Do List</h2>
    <form method="POST" action=" {{ route('createTask') }}">
        <div class="form-group">
            <label for="text">Enter a new task</label>
            <input type="text" class="form-control" id="task" placeholder="Enter your new task" name="task">
        </div>

        <button type="submit" class="btn btn-primary">Add Task</button>
        <!-- security reason, volgens het internet -->
        <input type="hidden" value="{{ Session::token() }}" name="_token">
    </form>


    <h2>To Do List</h2>
    <table class="table">
        <thead>
        <tr>
            <th>Task</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <!-- dynamisch inladen van de tasks in de server -->
        <!-- // uitleg van na de TaskController.php, komt hij hier terug, foreachloopje zodat het telkens wordt ingeladen als het gerefreshed wordt. Bij het aanmaken van een nieuwe object wordt de pagina gerefreshed-->
        @foreach($tasks as $task)
        <tr>
            <td>{{ $task->note }}</td>

        <!-- functionaliteit delete -->
            <td><a href="{{ route('deleteTask', ['task_id' => $task->id]) }}">Delete Task</a></td>
        </tr>
        @endforeach
        </tbody>
    </table>
</section>

</body>
</html>
