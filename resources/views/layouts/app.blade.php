<!DOCTYPE html>
<html lang="en">
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
        /* .dark-mode {
            background-color: #121212;
            color: #ffffff;
        } */


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
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">Proyecto Final Testing - Camila Arias</a>
            <!-- Agrega aquí tus elementos de navegación -->
            <div class="d-flex gap-2">
                <form action="{{ route('tasks.search') }}" method="GET">
                    <div class="input-group">
                        <input type="text" class="form-control bg-dark text-light" placeholder="Search" name="search">
                        <button class="btn btn-outline-light" type="submit"><i class="me-1 bi bi-search"></i>Search</button>
                    </div>
                </form>
                <button class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#addTaskModal"><i class="me-1 bi bi-file-earmark-plus"></i>Add Task</button>
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
