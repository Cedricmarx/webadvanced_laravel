<!DOCTYPE html>
<html lang="en">

<head>
    <title>WebProject - @yield('title')</title>
    <meta charset="utf-8">
    <meta name="_token" content="{{csrf_token()}}" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
</head>

<body>
    @section('nav')
    <nav class="navbar navbar-expand-sm navbar-dark">
        <a class="navbar-brand" href="{{ url('') }}">
            <img src="{{URL::asset('../images/checklist.png')}}" alt="Logo" width="40">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('overview') }}">Overview</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Categories
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @foreach ($categories as $category)
                        <a class="dropdown-item" href="{{ route('searchCategory', ['category' => $category->category]) }}">{{ $category->category }}</a>
                        @endforeach
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    @show


    <section class="container bg-light border border-dark rounded p-5 mt-5">
        @yield('content')
        <div id="delete-modal" class="modal fade">
            <div class="modal-dialog modal-confirm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Are you sure?</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p>Do you really want to delete these records? This process cannot be undone.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-danger" href="@yield('delete-task')">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <form method="POST" action="{{ route('createTask') }}" id="form">
        @csrf
        <div id="create-task-modal" class="modal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="alert alert-danger" style="display:none"></div>
                    <div class="modal-header">
                        <h5 class="modal-title">Create Task</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Enter a new task to add it to your To-Do list</p>
                        <div class="form-group">
                            <p>Note</p>
                            <input type="text" class="form-control" id="note" placeholder="Enter note" name="note">
                        </div>
                        <div class="form-group">
                            <p>Category</p>
                            <input type="text" class="form-control" id="category" placeholder="Enter category" name="category">
                        </div>
                        <div class="form-group">
                            <p>Due date</p>
                            <input type="datetime-local" class="form-control" id="due" placeholder="Enter due date" name="due">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button id="ajaxSubmit" class="btn btn-primary">Add Task</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <footer class="fixed-bottom text-center bg-dark text-light p-3">
        <p class="small my-auto">Copyright Joren Knieper, Cedric Marx © {{ now()->year }}</p>
    </footer>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script>
        jQuery(document).ready(function() {
            $('#create-task-modal').on('hidden.bs.modal', function() {
                $(this).find("input,textarea,select").val('').end();
                $('.alert-danger').hide();
            });

            jQuery('#ajaxSubmit').click(function(e) {
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
                jQuery.ajax({
                    url: "{{ route('createTask') }}",
                    method: 'post',
                    data: {
                        note: jQuery('#note').val(),
                        category: jQuery('#category').val(),
                        due: jQuery('#due').val()
                    },
                    success: function(result) {
                        if (result.errors) {
                            jQuery('.alert-danger').html('');

                            jQuery.each(result.errors, function(key, value) {
                                jQuery('.alert-danger').show();
                                jQuery('.alert-danger').append('<li>' + value + '</li>');
                            });
                        } else {
                            jQuery('.alert-danger').hide();
                            $('#open').hide();
                            $('#create-task-modal').modal('hide');
                            window.location.reload();
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>