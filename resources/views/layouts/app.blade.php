<!DOCTYPE html>
<html lang="en" class="dark-mode">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Agrega aquí tus estilos CSS comunes -->
    <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
    
    <!-- Incluir Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Incluir SweetAlert CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@12.2.3/dist/sweetalert2.min.css" rel="stylesheet">

    <style>
        /* Tema oscuro */
        .dark-mode {
            background-color: #121212;
            color: #ffffff;
        }

        .dark-mode span{
            background-color: #121212;
            color: #ffffff;
        }

        .dark-mode .card {
            background-color: #212121;
            color: #ffffff;
        }

        .dark-mode .form-control {
            background-color: #333333;
            color: #ffffff;
        }

        .dark-mode .navbar {
            background-color: #333333;
            color: #ffffff;
        }

        .task-container{
            margin: 1em;
            position: absolute;
            top: 5em;
            height: calc(100vh - 4em)
        }

        .navbar .container{
            display: flex;
            gap: 1em;
        }
        
        @media (max-width: 994px) {
            /* Add your styles for tablets here */
            .navbar .container{
                align-items: flex-start;
                justify-content: center;
            }
            
        }

    </style>
</head>
<body class="dark-mode">
    <!-- Barra de navegación -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand text-light" href="{{ url('/') }}">Proyecto Final Testing - Camila Arias</a>
            <!-- Agrega aquí tus elementos de navegación -->
            <div class="d-flex gap-2">
                <form action="{{ route('tasks.search') }}" method="GET">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search" name="search">
                        <button class="btn btn-outline-secondary" type="submit">Search</button>
                    </div>
                </form>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addTaskModal">Add Task</button>
            </div>
            
        </div>
    </nav>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <div class="container mt-4">
        @yield('content')
    </div>

    <!-- Agrega aquí tus scripts JS comunes -->
    <!-- <script src="{{ asset('js/app.js') }}"></script> -->
    <!-- Incluir SweetAlert JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@12.2.3/dist/sweetalert2.min.js"></script>

    <!-- Incluir Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

</body>
</html>
