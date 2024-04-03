@extends('layouts.app')

@section('content')
<div class="container task-container">
    <div class="row">
        @foreach($tasks as $task)
        <div class="col-md-4" id="taskCard-{{$task->id}}">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="d-flex">
                        <h5 class="card-title">{{ $task->title }}</h5>
                        <p class="ms-2 card-text">(Due Date: {{ $task->due_date }})</p>
                    </div>
                    <hr>
                    <span class="badge">Category: {{ $task->category }}</span>
                    <hr>
                    <p class="card-text">{{ $task->description }}</p>
                    <button class="btn btn-danger" onclick="deleteTask({{ $task }})">Delete</button>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<!-- Modal para agregar tarea -->
<div class="modal fade" id="addTaskModal" tabindex="-1" aria-labelledby="addTaskModalLabel" aria-hidden="true">
    <div class="modal-dialog dark-mode">
        <div class="modal-content dark-mode">
            <div class="modal-header dark-mode">
                <h5 class="modal-title" id="addTaskModalLabel">Add Task</h5>
                <button type="button" class="btn-close dark-mode text-light" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Formulario para agregar tarea -->
                <form action="{{ route('tasks.store') }}" method="POST" id="addTaskForm">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-card-text"></i></span>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-file-earmark-text"></i></span>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="category" class="form-label">Category</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-folder2-open"></i></span>
                            <input type="text" class="form-control" id="category" name="category">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="due_date" class="form-label">Due Date</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-calendar3"></i></span>
                            <input type="date" class="form-control" id="due_date" name="due_date">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Task</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
// Definir la función deleteTask en el ámbito global
function deleteTask(task) {
    Swal.fire({
        title: `¿Desea eliminar la tarea ${task.title}?`,
        text: '¡No podrás revertir esto!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, eliminarlo!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        const id = task.id;
        if (result.isConfirmed) {
            // Enviar una solicitud AJAX para eliminar la tarea
            $.ajax({
                url: "{{ route('tasks.destroy', ':id') }}".replace(':id', id),
                type: 'DELETE',
                data: {
                    "_token": "{{ csrf_token() }}",
                },
                success: function(response) {
                    // Mostrar una alerta de SweetAlert si la operación fue exitosa
                    if (response.success) {
                        // Eliminar la tarjeta de la tarea eliminada
                        $(`#taskCard-${id}`).remove();
                        Swal.fire({
                            title: 'Eliminado!',
                            text: 'La tarea ha sido eliminada.',
                            icon: 'success'
                        });
                    }
                },
                error: function(xhr) {
                    // Manejar errores si es necesario
                    Swal.fire({
                        title: 'Error!',
                        text: 'Hubo un error al eliminar la tarea.',
                        icon: 'error'
                    });
                }
            });
        }
    });
}
</script>

@endsection
